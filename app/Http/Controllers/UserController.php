<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendActivationCode;


class UserController extends Controller
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
    	$users = $this->userRepo->getUsers();

    	return view('pages.users.index')->with('data',$users);
    }

    public function postUser(Request $request)
    {
    	$data = $request->all();

    	$res = $this->userRepo->create($data);

    	if(isset($res['code'])) {
    		$data = array(
                'url' => config('app.url')."/cemos-portal/activate/".$res['code'],
                'name' => $res['user']['firstname']. " ".$res['user']['lastname']
            );

            Mail::to("vailoces.gladys@gmail.com")->send(new SendActivationCode($data)); 
    	}
    	
    	return redirect()->route('user')->with('status','New User has been added.');
    	
    }

    public function getUser($id)
    {
    	$data = $this->userRepo->getAllUserInfo($id);

    	echo json_encode($data);
    }

    public function postEditUser(Request $request)
    {
    	$data = $request->all();
    	$res = $this->userRepo->updateUser($data);

    	if($res) {
    		return redirect()->route('user')->with('status','User has been updated.');
    	}

    }

    public function postDeacUser($id)
    {
    	
    	echo $this->userRepo->deactivateUser($id);

    }
}
