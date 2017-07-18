<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class OrderProductRepository extends EntityRepository
{

	/**
     * Create new data for order line
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @return boolean
     */
	public function createOrderLine($data, $orderId)
	{
		$oData = get_object_vars($data);

		$dataArray = array();
		if(isset($oData['options'])) {
			foreach ($oData['options'] as $key => $value) {
				$dataArray[$key] = $value;
			}
		}
	
	
		try {
			
			$orderLine = new \App\Entity\Commerce\OrderProduct();
			$orderLine->setQuantity($oData['qty']);
			$orderLine->setPrice($oData['price']);
			$orderLine->setData(serialize($dataArray));
			$orderLine->setStep(1);
			$orderLine->setOrderId($orderId);
			$orderLine->setSupplierId(0);
			$orderLine->setSupplierUserId(0);
			$orderLine->setProductId($oData['id']);
			$orderLine->setOrderProductStatusId(2);
			$this->_em->persist($orderLine);
			$this->_em->flush();

			return 1;

		} catch (Exception $e) {

			return 0;
		}

	}

	public function getOrderProductByOrderId($orderId)
	{
		$result = array();
		$repo = $this->_em->getRepository(\App\Entity\Commerce\OrderProduct::class);
		$productRepo = $this->_em->getRepository(\App\Entity\Commerce\Product::class);
		$statusRepo = $this->_em->getRepository(\App\Entity\Commerce\Status::class);
		$compRepo = $this->_em->getRepository(\App\Entity\Management\Company::class);
		$search = $repo->findBy(array('orderId'=> $orderId));
		if(!empty($search)) {
			foreach ($search as $key => $value) {
				$result[] = array(
					'id' => $value->getId(),
					'quantity' => $value->getQuantity(),
					'price' => $value->getPrice(),
					'data' => unserialize($value->getData()),
					'step' => $value->getStep(),
					'orderId' => $value->getOrderId(),
					'product' => $productRepo->getProductById($value->getProductId()),
					'supplier' => $compRepo->getCompanyById($value->getSupplierId()),
					'supplierUserId' => $value->getSupplierUserId(),
					'status' => $statusRepo->getStatusById($value->getOrderProductStatusId()),
					'createdAt' => $value->getCreatedAt()->format('c'),
				);
			}
		}
		
		return $result;
	}
}

?>