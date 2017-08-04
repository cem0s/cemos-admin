<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;

class CompanyController extends Controller
{
    protected $em;
    protected $compRepo;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->compRepo = $this->em->getRepository('App\Entity\Management\Company');
	}

	public function index()
	{
		$allC = $this->compRepo->getAllCompany();

		return view('pages.company.index')->with('data', $allC);
	}

	public function addCompany(Request $request)
	{
		$data = array(
			'company_name' => $request->all()['name'],
			'company_phone' => $request->all()['phone'],
			'company_type' => $request->all()['type']

			);
		$this->compRepo->create($data);

		return redirect()->route('company');
	}

	public function delCompany($id)
	{
		echo $this->compRepo->delete($id);
	}

	public function editCompany($id)
	{
		$compData = $this->compRepo->getCompanyById($id);
		$compType['type'] = $this->compRepo->getCompanyType($id);
		$final = array_merge($compData, $compType);
		
		echo json_encode($final);
	}

	public function postEditCompany(Request $request)
	{
		$data['company'] = array(
			'id' => $request->all()['company_id'],
			'name' => $request->all()['name'],
			'phone' => $request->all()['phone'],
			'type' => $request->all()['type']
			);

		$this->compRepo->create($data);

		return redirect()->route('company');
	}
}
