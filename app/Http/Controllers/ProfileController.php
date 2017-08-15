<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;

class ProfileController extends Controller
{
    protected $em;
    protected $userRepo;


    public function __construct(EntityManager $em)
    {
    	$this->em = $em;
        $this->userRepo = $em->getRepository('App\Entity\Management\User');
    }

    public function index()
    {
    	$data = $this->userRepo->getAllUserInfo(session('user_id'));

    	return view('pages.profile.index')->with('data', $data);
    }

     public function editProfile(Request $request)
    {
    	$data = $request->all();
    	$res = $this->userRepo->updateUser($data);

    	if($res) {
    		return redirect()->route('profile')->with('status','Profile has been updated.');
    	}

    }

}
