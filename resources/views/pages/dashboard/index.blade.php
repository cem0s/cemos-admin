@extends('layouts.app')

@section('cont-head')
 <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
@endsection

@section('main-content')
 <div class="row">
 	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
	    <span class="info-box-icon bg-red"><i class="ion ion-ios-home"></i></span>

	    <div class="info-box-content">
	      <span class="info-box-text">Property</span>
	      <span class="info-box-number">41</span>
	    </div>
	    <!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
	    <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>

	    <div class="info-box-content">
	      <span class="info-box-text">Orders</span>
	      <span class="info-box-number">{{count($data)}}</span>
	    </div>
	    <!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>

	<!-- fix for small devices only -->
	<div class="clearfix visible-sm-block"></div>

	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
	    <span class="info-box-icon bg-green"><i class="ion ion-person-add"></i></span>

	    <div class="info-box-content">
	      <span class="info-box-text">User Registrations</span>
	      <span class="info-box-number">10</span>
	    </div>
	    <!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
	    <span class="info-box-icon bg-yellow"><i class="ion ion-document-text"></i></span>

	    <div class="info-box-content">
	      <span class="info-box-text">Messages</span>
	      <span class="info-box-number">20</span>
	    </div>
	    <!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>
	<!-- /.col -->
	</div>
	 <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>New Orders!</b> <a href="# "><i class="fa fa-bell faa-ring animated"></i></a> </h3>

           
        </div>
       
	    <div class="box-body">
	        <div class="col-md-12">
	            <ul class="products-list product-list-in-box">
	            	@if(!empty($data))
	            		@foreach($data as $key => $value)
		            		@if(strtolower($value['status']) == "new")
			                <li class="item">
			                    <div class="product-img">
				                     <i class="fa fa-shopping-cart fa-3x"></i>
				                </div>
				                 <div class="product-info">
				                    <a href="{{ url('order-details/'.$value['id'].'')}}" class="product-title">Order # {{$value['id']}}</a>
	  			                        <span class="label label-primary pull-right">{{date('F d, Y h:i:s', strtotime($value['createdAt']))}}</span></a>
					                    <span class="product-description">
					                        {{ $value['address1']}}, {{$value['town']}}, {{$value['zipcode']}}, Philippines
					                        <p style="display: inline;margin-left: 27%">{{$value['company']}} - {{$value['firstName']}} {{$value['lastName']}}</p>
					                    </span>

				                 </div>
			                </li>
			                @endif
		                @endforeach
		            @else 
		            	No new orders for today.
	                @endif
	            </ul>
	        </div>
        </div>
    </div>
@endsection
