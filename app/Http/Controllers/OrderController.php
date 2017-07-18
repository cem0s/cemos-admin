<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;


class OrderController extends Controller
{
    protected $em;


    public function __construct(EntityManager $em)
    {
    	$this->em = $em;
    }

    public function index()
    {

    	$orderRepo = $this->em->getRepository('App\Entity\Commerce\Order');
    	$orderData = $orderRepo->getAllOrders();
    
    	return view('pages.orders.index')->with('orderData',$orderData);
    }
}
