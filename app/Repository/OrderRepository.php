<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class OrderRepository extends EntityRepository
{

	/**
     * Create new data for order 
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @return integer
     */
	public function createOrder($data)
	{
		$order = new \App\Entity\Commerce\Order();
		try {

			$order->setCompanyId($data['company_id']);
			$order->setObjectId($data['object_id']);
			$order->setUserId($data['user_id']);
			$order->setOrderStatusId(1);
			$this->_em->persist($order);
			$this->_em->flush();

			//Log activity
			$this->addLog(array(
					'user_id' => $data['user_id'],
					'company_id' => $data['company_id'],
					'data' => 'You created new order for object id '.$data['object_id'].' with order id '.$order->getId().'.',
					'category' => 'order',
					'action' => 'create' 
				));

			return $order->getId();

		} catch (Exception $e) {
			return 0;
		}
	}

	public function getOrders($objId)
	{
		$orderLines = array();
		$orderArray = array();
		$orderPRepo = $this->_em->getRepository('App\Entity\Commerce\OrderProduct');
		$objectRepo = $this->_em->getRepository('App\Entity\Realestate\Object');
		$ordersByObject = $this->getOrdersByObjId($objId);
		$objDetails  = $objectRepo->getObjectByid($objId);

		if(!empty($ordersByObject)) {
			foreach ($ordersByObject as $key => $value) {
				$orderArray[] = $orderPRepo->getOrderProductByOrderId($value['id']);
			}
		}

		if(!empty($orderArray)){
			foreach ($orderArray as $key => $value) {
				foreach ($value as $key2 => $value2) {
					$orderLines[] = $value2;
				}
				
			}
		}
	
		return array('orderData'=>$orderLines,'objData' => $objDetails);

	}

	public function getOrdersByObjId($objId)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('o')
		   ->from('App\Entity\Commerce\Order', 'o')
		   ->where('o.objectId = :objId')
		   ->setParameter('objId', $objId);

		$queryResult = $qb->getQuery()->getArrayResult();
		if(!empty($queryResult)) {
			return $queryResult;
		} 
		return array();
	}


	 /**
     * This logs all activity
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $data 
     * @return boolean
     */
    private function addLog($data)
    {
    	$log = $this->_em->getRepository('App\Entity\Management\CompanyActivityLog');
    	$log->create($data); 
    	return 1;
    }

	

}

?>