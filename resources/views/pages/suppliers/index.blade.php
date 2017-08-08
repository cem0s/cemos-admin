@extends('layouts.app')

@section('cont-head')
 <h1>
    Suppliers
    <small>discover new suppliers</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Suppliers</li>
  </ol>
@endsection

@section('main-content')
<div class="row">
   	<div class="col-xs-12">
   		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Suppliers</h3>
              <br><br>
              <button class="btn btn-primary" onclick="addSupplier()"><i class="fa fa-plus"></i>  Add</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table id="data-table" class="table table-bordered table-striped">
               	 	<thead>
                		<tr>
			                <th>#</th>
			                <th>Supplier</th>
			                <th>Supplier Type</th>
			                <th>Action</th>
                		</tr>
	                </thead>
	                <tbody>
	                	@foreach($data as $key => $value)
	                		<tr>
	                			<td>
	                			    @if($key == 0)
   										1
   									@else 
   										{{++$key}}
   									@endif

	                			</td>
	                			<td>{{$value['name']}}</td>
	                			<td>{{$value['type']}}</td>
	                			<td>
	                			    <a href="javascript:void(0)" onclick="compDelSup({{$value['id']}}, {{$value['typeId']}})" class="btn btn-primary" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
	                			</td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
   	</div>
</div>

<div class="modal fade" id="add-supplier-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Supplier</h4>
        </div>
        <form action="{{url('add-supplier')}}" method="POST">
        	<input type="hidden" name="_token" value="{{csrf_token()}}">
	        <div class="modal-body">
	          	<div class="form-group">
	        		<label for="name">Supplier</label>
	        		<select class="form-control" name="supplier" id="supplier" required></select>
	          	</div>
	          	<div class="form-group">
	          		<label for="desc">SupplierType</label>
	          		<select class="form-control" name="supplierType" id="supplierType" required></select>
	          	</div>
	        </div>
	        <div class="modal-footer">
	        	<button type="submit" class="btn btn-primary">Save</button>
	          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
          </form>
      </div>
      
    </div>
  </div>

@endsection
