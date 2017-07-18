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
			return $compResult->getId();
		}
		$company = new \App\Entity\Management\Company();
		$company->setName($data['company_name']);
		$company->setPhone($data['company_phone']);
		$this->_em->persist($company);
		$this->_em->flush();
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
}



?>