<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;


class TransactionsController extends Controller
{
    protected $em;
    protected $orderRepo;


    public function __construct(EntityManager $em)
    {
    	$this->em = $em;
        $this->transRepo = $em->getRepository('App\Entity\Commerce\Transaction');
    }

    public function index()
    {

    	
        $creditPointsTrans = $this->transRepo->getAllCreditPointsTrans();
        $invoiceTrans = $this->transRepo->getAllInvoiceTrans();
        $creditCardTrans = $this->transRepo->getAllCreditCardTrans();
        $visaTrans = $this->transRepo->getAllVisaTrans();
    	$paypalTrans = $this->transRepo->getAllPaypalTrans();
    
    	return view('pages.transactions.index')->with(
            array(
                'credit_points' => $creditPointsTrans,
                'invoice' => $invoiceTrans,
                'credit_card' => $creditCardTrans,
                'visa' => $visaTrans,
                'paypal' => $paypalTrans,
            ));
    }
}
