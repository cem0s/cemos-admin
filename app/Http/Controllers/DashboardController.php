<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;


class DashboardController extends Controller
{

	protected $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}


    public function index()
    {
        $orderRepo = $this->em->getRepository('App\Entity\Commerce\Order');
    	$orderPRepo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
        $deliveredP = $orderPRepo->getDeliveredProducts();
    	$orders = $orderRepo->getAllOrders();

    	return view('pages.dashboard.index')
                ->with('data',array(
                    'orders' => $orders,
                    'delivered' => $deliveredP

                ));
    }
}
