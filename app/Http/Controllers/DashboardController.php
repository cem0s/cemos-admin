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
    	
    	return view('pages.dashboard.index');
    }
}
