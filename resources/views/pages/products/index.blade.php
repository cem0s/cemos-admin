@extends('layouts.app')

@section('cont-head')
 <h1>
    Products
    <small>add products</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Products</li>
  </ol>
@endsection

@section('main-content')
<div class="row">
   	<div class="col-xs-12">
   		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Products</h3>
              <br><br>
              <button class="btn btn-primary" onclick="addProduct()"><i class="fa fa-plus"></i>  Add</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table id="data-table" class="table table-bordered table-striped">
               	 	<thead>
                		<tr>
			                <th>Id</th>
			                <th>Name</th>
			                <th>Description</th>
			                <th>Price</th>
			                <th>Action</th>
                		</tr>
	                </thead>
	                <tbody>
	                	@foreach($data as $key => $value)
	                		@foreach($value as $pkey => $pvalue)
		                		<tr>
		                			<td>{{$pvalue['id']}}</td>
		                			<td>{{$pvalue['name']}}</td>
		                			<td>{{$pvalue['description']}}</td>
		                			<td>&#8369 {{$pvalue['price']}}</td>
		                			<td>
		                			    <a href="javascript:void(0)" onclick="editProduct({{$pvalue['id']}})" class="btn btn-primary" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
		                			    <a href="javascript:void(0)" onclick="prodDelModal({{$pvalue['id']}})" class="btn btn-primary" title="Deactivate"><i class="fa fa-times" aria-hidden="true"></i></a>
		                			</td>
		                		</tr>
	                		@endforeach
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
   	</div>
</div>

<div class="modal fade" id="product-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Product</h4>
        </div>
        <form action="{{url('add-product')}}" method="POST">
        	<input type="hidden" name="_token" value="{{csrf_token()}}">
	        <div class="modal-body">
	          	<div class="form-group">
	        		<label for="name">Name</label>
	          		<input type="text" name="name"  class="form-control" required>
	          	</div>
	          	<div class="form-group">
	          		<label for="desc">Description</label>
	          		<input type="text" name="desc" class="form-control" >
	          	</div>
	          	<div class="form-group">
	          		<label for="price">Price &#8369 </label>
	          		<input type="text" name="price" class="form-control" >
	          	</div>
	          	<div class="form-group">
	          		<label for="price">Category </label>
	          		<select class="form-control" name="category" id="category">
	          			<option value="Photo">Photography</option>
	          			<option value="Video">Video Editing</option>
	          			<option value="Archi">Architectural</option>
	          			<option value="Market">Marketing</option>
	          		</select>
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

  <div class="modal fade" id="product-edit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Product</h4>
        </div>
        <div id="status-msg" style="display: none;">&emsp;Please wait while fetching form...</div>
        <form action="{{url('edit-product')}}" method="POST">
        	<input type="hidden" name="_token" value="{{csrf_token()}}">
        	<input type="hidden" name="product_id" id="product_id">
	        <div class="modal-body">
	          	<div class="form-group">
	        		<label for="name">Product</label>
	          		<input type="text" name="name" id="name" class="form-control" required>
	          	</div>
	          	<div class="form-group">
	          		<label for="desc">Description</label>
	          		<input type="text" name="desc" id="desc" class="form-control" >
	          	</div>
	          	<div class="form-group">
	          		<label for="price">Price &#8369</label>
	          		<input type="text" name="price" id="price" class="form-control" >
	          	</div>
	          	<div class="form-group">
	          		<label for="price">Category </label>
	          		<select class="form-control" name="category" id="category">
	          		
	          		</select>
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
