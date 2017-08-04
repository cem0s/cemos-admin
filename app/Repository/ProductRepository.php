<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class ProductRepository extends EntityRepository
{

	/**
     * This creates product
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param data array
     * @return id
     */
	public function create($data)
	{
		$product = new \App\Entity\Commerce\Product();
		$product->setName($data['name']);
		$product->setDescription($data['description']);
		$product->setPrice($data['price']);
		$product->setCategory($data['category']);
		$product->setEnabled(1);
		$this->_em->persist($product);
		$this->_em->flush();

		return $product->getId();
	}

	/**
     * This gets all the products
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @return product array
     */
	public function getAllProducts()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('p')
		   ->from('App\Entity\Commerce\Product', 'p');
		$queryResult = $qb->getQuery()->getArrayResult();

		if(!empty($queryResult)) {
			foreach ($queryResult as $key => $value) {
				if($value['category'] == "Photo") {
					$data['Photo'][]  = $value;
				} else if($value['category'] == "Archi") {
					$data['Archi'][] = $value;
				} else if($value['category'] == "Video") {
					$data['Video'][]  = $value;
				} else if($value['category'] == "Market") {
					$data['Market'][]  = $value;
				}
			}
			return $data;
		}
		return array();
	}

	/**
     * This gets product by id
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param id integer
     * @return product array
     */
	public function getProductById($id)
	{
		$product = $this->_em->find('App\Entity\Commerce\Product', $id);
		$obj = (array)$product;
		
		if(!empty($obj)) {
			return array(
				'id' => $product->getId(),
				'name' => $product->getName(),
				'description' => $product->getDescription(),
				'price' => $product->getPrice(),
				'category' => $product->getCategory()
			);
		}
	}


	/**
     * This deletes the product
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param id integer
     * @return boolean
     */
	public function delete($id)
	{
		$product = $this->_em->find('App\Entity\Commerce\Product', $id);
		$obj = (array)$product;
		
		if(!empty($obj)) {
			$this->_em->remove($product);
			$this->_em->flush();
			return true;
		}

		return false;
	}

	/**
     * This updates the product
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param id integer
     * @return boolean
     */
	public function update($data)
	{
		$product = $this->_em->find('App\Entity\Commerce\Product', $data['id']);
		$obj = (array)$product;
		
		if(!empty($obj)) {
			$product->setName($data['name']);
			$product->setDescription($data['description']);
			$product->setPrice($data['price']);
			$product->setCategory($data['category']);
			$this->_em->merge($product);
			$this->_em->flush();
			return true;
		}

		return false;
	}



}

?>