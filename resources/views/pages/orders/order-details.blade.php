@extends('layouts.app')

@section('cont-head')
 <h1>
     Order Details #{{ $data['order']['id']}}
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Order</li>
    <li class="active">Order Details #{{ $data['order']['id']}}</li>
  </ol>
@endsection

@section('main-content')
	<section class="orderdetails">
		<div class="row">
			<div class="col-xs-12">
				<small class="pull-left">Date Created: {{date('F d, Y h:i:s', strtotime($data['order']['createdAt']))}}</small>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				{{ $data['order']['company']}} <br>
				{{ $data['order']['firstName']}} {{ $data['order']['lastName']}} <br>
				{{ $data['order']['address1']}}, {{$data['order']['town']}}, {{$data['order']['zipcode']}}, Philippines <br>
				
			</div>
			<div class="col-sm-4"> <b>Status: </b> {{ $data['order']['status']}} <br>
				<div class="margin">
	                <div class="btn-group">
	                  <button type="button" class="btn btn-primary">Change</button>
	                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	                    <span class="caret"></span>
	                    <span class="sr-only">Toggle Dropdown</span>
	                  </button>
	                  <ul class="dropdown-menu" role="menu">
	                  	@if(strtolower($data['order']['status']) == "new")
	                    <li><a href="javascript:void(0)" onclick="changeStatus(3, {{$data['order']['id']}})">Accepted</a></li>
	                    @else 
	                    <li class="disabled"><a href="#">Accepted</a></li>
	                    @endif
	                  </ul>
	                </div>
                </div>
			</div>
		</div>
		<hr>
		Order Products
		<div class="row">
			<?php $count = 1;?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Supplier</th>
						<th>Step</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data['oproduct'] as $key => $value)
						<tr>
							<td>{{ $count++}}</td>
							<td>{{ $value['product']['name']}}</td>
							<td>&#8369 {{ $value['price']}}</td>
							<td>{{ $value['quantity']}}</td>
							<td>
								@if(isset($value['supplier']['name']))
									{{$value['supplier']['name']}}
								@else 
									No Supplier Yet.
								@endif
							</td>
							<td>{{ $value['step']}}</td>
							<td>{{ $value['status']['name']}}</td>
							<td>
				                <div class="btn-group">
				                  <button type="button" class="btn btn-primary">Change</button>
				                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				                    <span class="caret"></span>
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                <ul class="dropdown-menu" role="menu">
				                    <li><a href="javascript:void(0)" onclick="changeSupplier({{$value['id']}})">Supplier</a></li>
				                  </ul>
				                </div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>

	
@endsection