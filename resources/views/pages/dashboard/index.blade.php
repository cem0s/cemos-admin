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
	      <span class="info-box-number">{{$data['obj']}}</span>
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
	      <span class="info-box-number">{{count($data['orders'])}}</span>
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
	      <span class="info-box-number">{{$data['users']}}</span>
	    </div>
	    <!-- /.info-box-content -->
	  </div>
	  <!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="info-box">
	    <span class="info-box-icon bg-yellow"><i class="ion ion-checkmark-round"></i></span>

	    <div class="info-box-content">
	      <span class="info-box-text">Delivered Products</span>
	      <span class="info-box-number">{{count($data['delivered'])}}</span>
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
	        <div class="row">
	        	<div class="col-md-12">
		        	<div style="overflow: scroll;height: 400px;">
			            <ul class="products-list product-list-in-box">
			            	@if(!empty($data['orders']))
			            		@foreach($data['orders'] as $key => $value)
				            		@if(strtolower($value['status']) == "new")
					                <li class="item">
					                    <div class="product-img">
						                     <i class="fa fa-shopping-cart fa-2x"></i>
						                </div>
						                 <div class="product-info">

						                 	<div class="row">
						                		<div class="col-sm-4">
						                			<a href="{{ url('order-details/'.$value['id'].'')}}" class="product-title">Order # {{$value['id']}}</a> <br>
						                			   {{ $value['address1']}}, {{$value['town']}}, {{$value['zipcode']}}, Philippines
						                		</div>
						                		<div class="col-sm-4">
						                			<p>{{$value['company']}} - {{$value['firstName']}} {{$value['lastName']}}</p>
						                		</div>
						                		<div class="col-sm-4">
						                		 <small><i>Order Date:  &emsp;</i></small><span class="label label-primary">{{date('F d, Y h:i:s', strtotime($value['createdAt']))}}</span>
						                		</div>
						                	</div>
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
        </div>
    </div>
    <hr>
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Delivered Products!</b> <a href="# "><i class="fa fa-bell faa-ring animated"></i></a> </h3>    
        </div>
       
	    <div class="box-body">
	        <div class="row">
	        	<div class="col-md-12">
		        	<div style="overflow: scroll;height: 400px;">
			            <ul class="products-list product-list-in-box">
			            	@if(!empty($data['delivered']))
			            		@foreach($data['delivered'] as $key => $value)
					                <li class="item">
					                    <div class="product-img">
						                     <i class="fa fa-check fa-2x"></i>
						                </div>
						                <div class="product-info">
						                	<div class="row">
						                		<div class="col-sm-4">
						                			<a href="{{ url('order-details/'.$value['orderId'].'')}}" class="product-title">Order # {{$value['orderId']}}</a> <br>
						                			 {{ $value['object']}}
						                		</div>
						                		<div class="col-sm-4">
						                			<p>{{$value['product']}}</p>
						                		</div>
						                		<div class="col-sm-4">
						                			{{ $value['company']}}
						                		</div>
						                	</div>
						                </div>
					                </li>
				                @endforeach
				            @else 
				            	No delivered orders for today.
			                @endif
			            </ul>
		            </div>
		        </div>
	        </div>
        </div>
    </div>
    <hr>
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>In Progress Orders</b></h3>
        </div>
	    <div class="box-body">
	        <div class="row">
	        	<div class="col-md-12">
		        	<div style="overflow: scroll;height: 400px;">
			            <ul class="products-list product-list-in-box">
			            	@if(!empty($data['orders']))
			            		@foreach($data['orders'] as $key => $value)
				            		@if(strtolower($value['status']) == "in progress")
					                <li class="item">
					                    <div class="product-img">
						                     <i class="fa fa-cog fa-2x"></i>
						                </div>
						                <div class="product-info">
						                 	<div class="row">
						                		<div class="col-sm-4">
						                			<a href="{{ url('order-details/'.$value['id'].'')}}" class="product-title">Order # {{$value['id']}}</a> <br>
						                			   {{ $value['address1']}}, {{$value['town']}}, {{$value['zipcode']}}, Philippines
						                		</div>
						                		<div class="col-sm-4">
						                			<p>{{$value['company']}} - {{$value['firstName']}} {{$value['lastName']}}</p>
						                		</div>
						                		<div class="col-sm-4">
						                			 <span class="label label-warning">In progress</span> 
						                		</div>
						                	</div>
						                </div>
					                </li>
					                @endif
				                @endforeach
				            @else 
				            	No in progress orders
			                @endif
			            </ul>
		            </div>
		        </div>
	        </div>
        </div>
    </div>
     <hr>
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Unassigned Products</b> <a href="# "><i class="fa fa-bell faa-ring animated"></i></a> </h3>    
        </div>
       
	    <div class="box-body">
	        <div class="row">
	        	<div class="col-md-12">
		        	<div style="overflow: scroll;height: 400px;">
			            <ul class="products-list product-list-in-box">
			            	@if(!empty($data['unassigned']))
			            		@foreach($data['unassigned'] as $key => $value)
					                <li class="item">
					                    <div class="product-img">
						                     <i class="fa fa-question-circle-o fa-2x"></i>
						                </div>
						                <div class="product-info">
						                	<div class="row">
						                		<div class="col-sm-4">
						                			<a href="{{ url('order-details/'.$value['orderId'].'')}}" class="product-title">Order # {{$value['orderId']}}</a> <br>
						                			 {{ $value['object']}}
						                		</div>
						                		<div class="col-sm-4">
						                			<p>{{$value['product']}}</p>
						                		</div>
						                		<div class="col-sm-4">
						                			{{ $value['company']}}
						                		</div>
						                	</div>
						                </div>
					                </li>
				                @endforeach
				            @else 
				            	No unassigned orders for today.
			                @endif
			            </ul>
		            </div>
		        </div>
	        </div>
        </div>
    </div>
    <hr>
@endsection
