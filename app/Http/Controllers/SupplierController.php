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
        $supST = $this->em->getRepository('App\Entity\Supplier\SupplierSupplierType');
        $data = $supST->getSuppliers();

        return view('pages.suppliers.index')->with('data', $data);

    }

    public function postAddSupplier(Request $request)
    {
        $data = $request->all();
        $supST = $this->em->getRepository('App\Entity\Supplier\SupplierSupplierType');
        $addSupplier = $supST->addSupplier($data);
        
        return redirect()->route('supplier');
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

    public function deleteSupplier(Request $request)
    {
        $data = $request->all();
        $supST = $this->em->getRepository('App\Entity\Supplier\SupplierSupplierType');

        echo $supST->delSupplier($data);
    }

    public function viewSupplierTypes()
    {
        $supT = $this->em->getRepository('App\Entity\Supplier\SupplierType');
        $data = $supT->getSupplierTypes();
        return view('pages.suppliers.supplier-type')->with('data', $data);
    }

    public function postAddSupplierType(Request $request)
    {
        $data = $request->all();
        $supT = $this->em->getRepository('App\Entity\Supplier\SupplierType');
        $res = $supT->addSupplierType($data);

        return redirect()->route('supplier-type');
    }

    public function getTypeById($id)
    {
        $supT = $this->em->getRepository('App\Entity\Supplier\SupplierType');
        echo json_encode($supT->getTypeId($id));
    }

    public function postEditType(Request $request)
    {
        $data = $request->all();
        $supT = $this->em->getRepository('App\Entity\Supplier\SupplierType');
        $res = $supT->editType($data);
        
        return redirect()->route('supplier-type');

    }
}
