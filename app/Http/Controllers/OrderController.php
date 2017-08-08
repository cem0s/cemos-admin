<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;


class OrderController extends Controller
{
    protected $em;
    protected $orderRepo;


    public function __construct(EntityManager $em)
    {
    	$this->em = $em;
        $this->orderRepo = $em->getRepository('App\Entity\Commerce\Order');
    }

    public function index()
    {

    	
    	$orderData = $this->orderRepo->getAllOrders();
    
    	return view('pages.orders.index')->with('orderData',$orderData);
    }

    public function orderDetails($id, $nId = 0)
    {
        
        $orderProductRepo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
        $order = $this->orderRepo->getOrderById($id);
        $orderProduct = $orderProductRepo->getOrderProductByOrderId($id);
        
        return view('pages.orders.order-details')->with('data', array('order' => $order, 'oproduct' => $orderProduct, 'nId' => $nId));
    }

    public function changeOrderStatus(Request $request)
    {
        echo $this->orderRepo->updateOrderStatus($request->all());
        exit();
    }

    public function getAllStatus()
    {
        $statusRepo = $this->em->getRepository('App\Entity\Commerce\Status');
        $data = $statusRepo->getAllStatus();

        return view('pages.orders.status')->with('data', $data);
    }

    public function editStatus($id)
    {
        $statusRepo = $this->em->getRepository('App\Entity\Commerce\Status');
        echo json_encode($statusRepo->getStatusById($id));
    }

    public function postEditStatus(Request $request)
    {
        $data = $request->all();
        $statusRepo = $this->em->getRepository('App\Entity\Commerce\Status');
        $res =  json_encode($statusRepo->updateStatusById($data));

        if($res) {
            return redirect()->route('all-status');
        }
        return view('pages.error.warning');
    }

    public function postAddStatus(Request $request)
    {
        $data = $request->all();
        $statusRepo = $this->em->getRepository('App\Entity\Commerce\Status');
        $res =  json_encode($statusRepo->addStatus($data));

        if($res) {
            return redirect()->route('all-status');
        }
        return view('pages.error.warning');
    }
}
