<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;


class SupplierController extends Controller
{
	protected $em;



    public function __construct(EntityManager $em)
    {
    	$this->em = $em;

    }

    public function getSuppliers()
    {

    }

    public function getSupplierTypes()
    {
    	$supT = $this->em->getRepository('App\Entity\Supplier\SupplierType');
    	echo json_encode($supT->getSupplierTypes());
    }

    public function getSupplierByType(Request $request)
    {
    	$supT = $this->em->getRepository('App\Entity\Supplier\SupplierType');
    	echo json_encode($supT->getSupplierByTypeId($request->all()['id']));
    }

    public function assignSupplier(Request $request)
    {
    	$opRepo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
    	echo $opRepo->assignSupplier($request->all());
    }
}
