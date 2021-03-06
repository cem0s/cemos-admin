@extends('layouts.app')

@section('cont-head')
 <h1>
    Order
    <small>see orders</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Orders</li>
  </ol>
@endsection

@section('main-content')
<div class="row">
   	<div class="col-xs-12">
   		<div class="box">
            <div class="box-header">
              <h3 class="box-title">All Orders</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table id="data-table" class="table table-bordered table-striped">
               	 	<thead>
                		<tr>
			                <th>Order #</th>
			                <th>Property</th>
			                <th>Company</th>
			                <th>Address</th>
			                <th>Order Date</th>
			                <th>Status</th>
			                <th>Action</th>
                		</tr>
	                </thead>
	                <tbody>
	                	@foreach($orderData as $key => $value)
	                		<tr>
	                			<td>{{$value['id']}}</td>
	                			<td>{{$value['objectName']}}</td>
	                			<td>{{$value['company']}}</td>
	                			<td>{{$value['address1']}}, {{$value['town']}}, {{$value['zipcode']}}, Philippines</td>
	                			<td>{{date('F d, Y', strtotime($value['createdAt']))}}</td>
	                			<td>{{$value['status']}}</td>
	                			<td><a href="{{ url('order-details/'.$value['id'].'')}}" class="btn btn-primary" title="View Order"><i class="fa fa-search" aria-hidden="true"></i></a></td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
   	</div>
</div>



@endsection
