<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;

class ProductController extends Controller
{
    protected $em;
    protected $prodRepo;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->prodRepo = $this->em->getRepository('App\Entity\Commerce\Product');
	}

	public function index()
	{
		$products = $this->prodRepo->getAllProducts();

		return view('pages.products.index')->with('data', $products);
	}

	public function addProduct(Request $request)
	{
		$data = array(
			'name' => $request->all()['name'],
			'description' => $request->all()['desc'],
			'price' => $request->all()['price'],
			'category' => $request->all()['category']

			);
		$this->prodRepo->create($data);

		return redirect()->route('product');
	}

	public function delProduct($id)
	{
		echo $this->prodRepo->delete($id);
	}

	public function editProduct($id)
	{
		$prodData = $this->prodRepo->getProductById($id);
		
		echo json_encode($prodData);
	}

	public function postEditProduct(Request $request)
	{
		$data = array(
			'id' => $request->all()['product_id'],
			'name' => $request->all()['name'],
			'description' => $request->all()['desc'],
			'price' => $request->all()['price'],
			'category' => $request->all()['category']
			);

		$this->prodRepo->update($data);

		return redirect()->route('product');
	}
}
