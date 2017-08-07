<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;
use Exception;

class SupplierTypeRepository extends EntityRepository
{

	public function getSupplierTypes()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('st')
		   ->from('App\Entity\Supplier\SupplierType','st');

		return $qb->getQuery()->getArrayResult();
		
	}

	public function getSupplierByTypeId($id)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('c.id, c.name')
		   ->from('App\Entity\Supplier\SupplierSupplierType','sst')
		   ->leftJoin('App\Entity\Management\Company','c', 'WITH', 'sst.supplierId = c.id')
		   ->where('sst.supplierTypeId = :id')
		   ->setParameter('id', $id);
		   
		return $qb->getQuery()->getArrayResult();
	}

	public function addSupplierType($data)
	{
		try {
			$type = new \App\Entity\Supplier\SupplierType();
			$type->setName($data['stype']);
			$this->_em->persist($type);
			$this->_em->flush();

			return true;

		} catch (Exception $e) {

			return false;

		}
	}

	public function getTypeId($id)
	{
		$repo = $this->_em->getRepository('App\Entity\Supplier\SupplierType')->find($id);

		if(!empty($repo)) {
			return array(
				'id' => $repo->getId(),
				'name' => $repo->getName(),
			);
		}
		return array();
	}

	public function editType($data)
	{
		$repo = $this->_em->getRepository('App\Entity\Supplier\SupplierType')->find($data['typeId']);
		if(!empty($repo)) {
			$repo->setName($data['typeName']);
			$this->_em->merge($repo);
			$this->_em->flush();
			return true;
		}
		return false;

	}


}

?>