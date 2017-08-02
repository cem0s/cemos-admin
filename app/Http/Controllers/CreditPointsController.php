<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;

class CreditPointsController extends Controller
{
    protected $em;


    public function __construct(EntityManager $em)
    {
    	$this->em = $em;
    }

    public function index()
    {
    	$company_repo = $this->em->getRepository('App\Entity\Management\Company');
    	$all_company = $company_repo->getAllCompany();

    	$credit_repo = $this->em->getRepository('App\Entity\Management\CreditPoints');
    	$all_credit = $credit_repo->getAllCredit();

    	return view('pages.credit-points.index')->with('info', array('users' => $all_company, 'credits' => $all_credit));
    }

    public function postCreditPoints(Request $request)
    {
    	$data = $request->all(); 
    	$credit_repo = $this->em->getRepository('App\Entity\Management\CreditPoints');
        $object_data = $credit_repo->create($data);

        return redirect()->route('pages.credit-points.index');

    }
}
