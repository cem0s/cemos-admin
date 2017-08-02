<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;

class NotificationController extends Controller
{

	protected $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}


    public function getNotifs()
    {
    	$nRepo = $this->em->getRepository('App\Entity\Management\Notification');

    	$results = $nRepo->getAll();

    	echo json_encode($results);
    }
}
