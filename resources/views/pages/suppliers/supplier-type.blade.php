@extends('layouts.app')

@section('cont-head')
 <h1>
    Supplier Types
    <small>classify suppliers</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Supplier Types</li>
  </ol>
@endsection

@section('main-content')
<div class="row">
   	<div class="col-xs-12">
   		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Supplier Types</h3>
              <br><br>
              <button class="btn btn-primary" onclick="addSupplierType()"><i class="fa fa-plus"></i>  Add</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table id="data-table" class="table table-bordered table-striped">
               	 	<thead>
                		<tr>
			                <th>#</th>
			                <th>Name</th>
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
	                			<td>
                            <a href="javascript:void(0)" onclick="editType({{$value['id']}})" class="btn btn-primary" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	                			    <a href="javascript:void(0)" onclick="deleteType({{$value['id']}})" class="btn btn-primary" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
	                			</td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
   	</div>
</div>

<div class="modal fade" id="add-supp-type-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Supplier Type</h4>
      </div>
      <form action="{{url('add-supplier-type')}}" method="POST">
      	<input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="modal-body">
          	<div class="form-group">
        		 <label for="name">Supplier Type</label>
        	   <input type="text" name="stype" class="form-control" required>    
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

  <div class="modal fade" id="edit-type" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Supplier Type</h4>
        </div>
        <form action="{{url('edit-supplier-type')}}" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="typeId" id="typeId">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Supplier Type</label>
              <input type="text" name="typeName" id="typeName" class="form-control" required>
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
