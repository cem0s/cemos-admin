<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class CompanyRepository extends EntityRepository
{

	public function create($data)
	{

		if(isset($data['company']['id'])) {
			$compResult = $this->_em->find(\App\Entity\Management\Company::class, $data['company']['id']);
			$compResult->setName($data['company']['name']);
			$compResult->setPhone($data['company']['phone']);
			$this->_em->merge($compResult);
			$this->_em->flush();

			if(isset($data['company']['type'])) {
				$this->updateCompanyTypes($data['company']);
			}

			return $compResult->getId();
		}
		$company = new \App\Entity\Management\Company();
		$company->setName($data['company_name']);
		$company->setPhone($data['company_phone']);
		$this->_em->persist($company);
		$this->_em->flush();

		
		if(isset($data['company_type'])) {
			foreach ($data['company_type'] as $key => $value) {
				$companyType = new \App\Entity\Management\CompanyCompanyType();
				$companyType->setCompanyId($company->getId());
				$companyType->setCompanyTypeId($value);
				$this->_em->persist($companyType);
				$this->_em->flush();
			}
		}

		return $company->getId();
	}

	public function getCompanyById($id)
	{
		$compResult = $this->_em->find(\App\Entity\Management\Company::class, $id);
		if(isset($compResult) && !empty($compResult)) {
			return array(
					'id' => $compResult->getId(),
					'name'=> $compResult->getName(),
					'phone'=> $compResult->getPhone()
				);
		}
		return array();
	}

	public function getAllCompany()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('c')
		   ->from('App\Entity\Management\Company','c');

		$queryResults = $qb->getQuery()->getArrayResult();
		if(!empty($queryResults)) {
			foreach ($queryResults as $key => $value) {
				$queryResults[$key]['type'] = $this->getCompanyType($value['id']);
			}
			return $queryResults;
		}

		return array();
	}

	public function getCompanyType($id)
	{
		$res = array();
		$qb = $this->_em->createQueryBuilder();
		$qb->select('c.id, c.name, ct.name as company_type')
		   ->from('App\Entity\Management\Company', 'c')
		   ->leftJoin('App\Entity\Management\CompanyCompanyType','cct','WITH','cct.companyId = c.id')
		   ->leftJoin('App\Entity\Management\CompanyType','ct','WITH','ct.id = cct.companyTypeId')
		   ->where('c.id = :id')
		   ->setParameter('id', $id);
		$queryResults = $qb->getQuery()->getArrayResult();
		if(!empty($queryResults)) {
			foreach ($queryResults as $key => $value) {
				$res[] = $value['company_type'];
			}
		}
	
		return $res;
	}

	public function delete($id) 
	{
		$compResult = $this->_em->find(\App\Entity\Management\Company::class, $id);
		if(isset($compResult)) {
			$this->_em->remove($compResult);
			$this->_em->flush();
			return true;
		}
		return false;
	}

	public function updateCompanyTypes($data)
	{

		$ccTypeRepo = $this->_em->getRepository('App\Entity\Management\CompanyCompanyType');
		$res = $ccTypeRepo->findBy(array('companyId' => $data['id']));
		

		if(count($res) > 0 ){
			foreach ($res as $key => $value) {
				$cct = $ccTypeRepo->findBy(array('companyId' => $value->getCompanyId(),'companyTypeId' => $value->getCompanyTypeId()));
				$this->_em->remove($cct[0]);
				$this->_em->flush();
				$this->_em->clear();
			}
		}

		if(!empty($data['type'])) {
			foreach ($data['type'] as $key => $value) {
				if($value > 0 ){
					$companyType = new \App\Entity\Management\CompanyCompanyType();
					$companyType->setCompanyId($data['id']);
					$companyType->setCompanyTypeId($value);
					$this->_em->persist($companyType);
					$this->_em->flush();
				}
			}
		}
	}
}



?>