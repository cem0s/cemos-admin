@extends('layouts.app')

@section('cont-head')
 <h1>
    Status
    <small>see status</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Status</li>
  </ol>
@endsection

@section('main-content')
<div class="row">
   	<div class="col-xs-12">
   		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Status</h3>
              <br><br>
              <button class="btn btn-primary" onclick="addStatus()"><i class="fa fa-plus"></i>  Add</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table id="data-table" class="table table-bordered table-striped">
               	 	<thead>
                		<tr>
			                <th>#</th>
			                <th>Name</th>
			                <th>Type</th>
			                <th>Action</th>
                		</tr>
	                </thead>
	                <tbody>
	                	@foreach($data as $key => $value)
	                		<tr>
	                			<td>{{$value['id']}}</td>
	                			<td>{{$value['name']}}</td>
	                			<td>{{$value['type']}}</td>
	                			<td>
	                			<a href="javascript:void(0)" onclick="editStatus({{$value['id']}})" class="btn btn-primary" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	                			</td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
   	</div>
</div>

<div class="modal fade" id="edit-status" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Status</h4>
        </div>
        <form action="{{url('edit-status')}}" method="POST">
	        <input type="hidden" name="_token" value="{{csrf_token()}}">
	        <input type="hidden" name="statusId" id="statusId">
	        <div class="modal-body">
	          <div class="form-group">
	            <label for="name">Status</label>
	            <input type="text" name="statusName" id="statusName" class="form-control" required>
	          </div>
	          <div class="form-group">
	        	<label for="name">Status Type</label>
        		<select class="form-control" name="typeId" id="typeId" required>
        			
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


 <div class="modal fade" id="add-status" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Status</h4>
        </div>
        <form action="{{url('add-status')}}" method="POST">
        	<input type="hidden" name="_token" value="{{csrf_token()}}">
	        <div class="modal-body">
	          	<div class="form-group">
	        		<label for="name">Status</label>
	        		<input type="text" class="form-control" name="status" id="status" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="name">Status Type</label>
	        		<select class="form-control" name="statusType" id="statusType" required>
	        			<option value="1">Order</option>
	        			<option value="2">Order Product</option>
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
