<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;
use Exception;


class SupplierSupplierTypeRepository extends EntityRepository
{

	public function getSuppliers()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('c.id, c.name, t.id as typeId, t.name as type')
		   ->from('App\Entity\Supplier\SupplierSupplierType','s')
		   ->leftJoin('App\Entity\Management\Company','c', 'WITH', 's.supplierId = c.id')
		   ->leftJoin('App\Entity\Supplier\SupplierType','t', 'WITH', 's.supplierTypeId = t.id');

		$queryResults = $qb->getQuery()->getArrayResult();
		
		return $queryResults;
	}

	public function addSupplier($data)
	{
		$sst = new \App\Entity\Supplier\SupplierSupplierType();

		try {
			$sst->setSupplierId($data['supplier']);
			$sst->setSupplierTypeId($data['supplierType']);
			$this->_em->persist($sst);
			$this->_em->flush();

			return true;

		} catch (Exception $e) {
			return false;
		}
	}

	public function delSupplier($data)
	{
		$repo = $this->_em->getRepository('App\Entity\Supplier\SupplierSupplierType');
		$res = $repo->findBy(array('supplierId'=> $data['id'],'supplierTypeId'=> $data['typeId']));
		if(count($res) > 0) {
			$this->_em->remove($res[0]);
			$this->_em->flush();

			return true;
		}
		return false;
	}

}


?>