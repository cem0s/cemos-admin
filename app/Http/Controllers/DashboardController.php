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
        $userRepo = $this->em->getRepository('App\Entity\Management\User');
    	$objRepo = $this->em->getRepository('App\Entity\Realestate\Object');
        $op = $orderPRepo->getAllOrderProducts();
        $orders = $orderRepo->getAllOrders();
        $users = $userRepo->getUsers();
    	$obj = $objRepo->getAllObjects();
            
        $delivered = array();
        $unassigned = array();

        if(count($op) > 0 ){
            foreach ($op as $key => $value) {
                if($value['orderProductStatusId'] == 8) {
                    $delivered[] = $value;
                }
                if($value['orderProductStatusId'] != 8 && $value['supplierId'] == 0){
                    $unassigned[] = $value;
                }
            }
        }

    	return view('pages.dashboard.index')
                ->with('data',array(
                    'orders' => $orders,
                    'delivered' => $delivered,
                    'unassigned' => $unassigned,
                    'users' => count($users),
                    'obj' => $obj['count']

                ));
    }
}
