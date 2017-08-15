<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;
//use \App\Entity\Commerce\CreditCardTransaction;
//use \App\Entity\Commerce\CreditPointsTransaction;
//use \App\Entity\Commerce\InvoiceTransaction;
//use \App\Entity\Commerce\PaypalTransaction;
//use \App\Entity\Commerce\VisaCardTransaction;


class TransactionsRepository extends EntityRepository
{ 
	public function getAllCreditPointsTrans() {
		$repo = 'App\Entity\Commerce\CreditPointsTransaction';
		$data = $this->get($repo);
		if(isset($data) && !empty($data)){
			return array(
				'transaction' => $data
			);
		}
		
		return array(
			'transaction' => array()
		);
	}

	public function getAllInvoiceTrans() {
		$repo = 'App\Entity\Commerce\InvoiceTransaction';
		$data = $this->get($repo);
		if(isset($data) && !empty($data)){
			return array(
				'transaction' => $data
			);
		}
		
		return array(
			'transaction' => array()
		);
	}

	public function getAllCreditCardTrans() {
		$repo = 'App\Entity\Commerce\CreditCardTransaction';
		$data = $this->get($repo);
		if(isset($data) && !empty($data)){
			return array(
				'transaction' => $data
			);
		}
		
		return array(
			'transaction' => array() 
		);
	}

	public function getAllVisaTrans() {
		$repo = 'App\Entity\Commerce\VisaCardTransaction';
		$data = $this->get($repo);
		if(isset($data) && !empty($data)){
			return array(
				'transaction' => $data
			);
		}
		
		return array(
			'transaction' => array()
		);
	}

	public function getAllPaypalTrans() {
		$repo = 'App\Entity\Commerce\PaypalTransaction';
		$data = $this->get($repo);
		if(isset($data) && !empty($data)){
			return array(
				'transaction' => $data
			);
		}
		
		return array(
			'transaction' => array()
		);
	}

	public function get($repo) {
		$data = array();
		$qb = $this->_em->createQueryBuilder();

		$qb->select('o')
		   ->from($repo, 'o');

		$queryResult = $qb->getQuery()->getArrayResult();


		if(!empty($queryResult)){
			foreach ($queryResult as $key => $value) {
				$data[] = array(
						'id' => $value['id'],
						'order_product_id' => $value['order_product_id'],
						'product_id' => $value['product_id'],
						'data' => $value['data'],
						'created_at' => $value['$created_at'],
						'discr' => $value['discr']
					);
			}
		}

		return $data;
	}
}