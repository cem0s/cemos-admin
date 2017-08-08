<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class StatusRepository extends EntityRepository
{

	/**
     * This gets status details by id
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param id integer
     * @return  array
     */
	public function getStatusById($id)
	{
		$statusRepo = $this->_em->find('App\Entity\Commerce\Status', $id);
		$obj = (array)$statusRepo;

		if(!empty($obj)) {
			if($statusRepo instanceof \App\Entity\Commerce\OrderStatus) {
				$type = 1;
			} else {
				$type = 2;
			}

			return array(
				'id' => $statusRepo->getId(),
				'name' => $statusRepo->getName(),
				'type' => $type
			);
		}
	}

	/**
     * This gets all status
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @return  array
     */
	public function getAllStatus()
	{
		$orderSRepo = $this->_em->getRepository('App\Entity\Commerce\OrderStatus')->findAll();
		$orderProductSRepo = $this->_em->getRepository('App\Entity\Commerce\OrderProductStatus')->findAll();
			
		if(!empty($orderSRepo)) {
			foreach ($orderSRepo as $key => $value) {
				$data[] = array(
						'id' => $value->getId(),
						'name' => $value->getName(),
						'type' => 'order'
					);
			}

			if(!empty($orderProductSRepo)) {
				foreach ($orderProductSRepo as $key => $value) {
					$data[] = array(
							'id' => $value->getId(),
							'name' => $value->getName(),
							'type' => 'order product'
						);
				}
				
			}

			return $data;
			
		}

		return array();
		
	}


	/**
     * This updates status details by id
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param data array
     * @return  array
     */
	public function updateStatusById($data)
	{

		if($data['typeId'] == 1) {
			$statusRepo = $this->_em->find('App\Entity\Commerce\OrderStatus', $data['statusId']);
		} else {
			$statusRepo = $this->_em->find('App\Entity\Commerce\OrderProductStatus', $data['statusId']);
		}
	
		$obj = (array)$statusRepo;

		if(!empty($obj)) {
			$statusRepo->setName($data['statusName']);
			$this->_em->merge($statusRepo);
			$this->_em->flush();
			return true;
			
		} else {
			 return $this->addStatus(
					array(
						'statusType' => $data['typeId'],
						'status' => $data['statusName']
					)
				);
		}

		return false;
	}

	/**
     * This add new order status
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param data array
     * @return  array
     */
	public function addStatus($data)
	{
		if($data['statusType'] == 1) {
			$status = new \App\Entity\Commerce\OrderStatus();
		} else {
			$status = new \App\Entity\Commerce\OrderProductStatus();
		}
		
		$status->setName($data['status']);
		$this->_em->persist($status);
		$this->_em->flush();

		if($status->getId() >0) {
			return true;
		}

		return false;
	}




}

?>