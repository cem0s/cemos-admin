@extends('layouts.app')

@section('cont-head')
 <h1>
    Company
    <small>meet new clients</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Company</li>
  </ol>
@endsection

@section('main-content')
<div class="row">
   	<div class="col-xs-12">
   		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Companies</h3>
              <br><br>
              <button class="btn btn-primary" onclick="addCompany()"><i class="fa fa-plus"></i>  Add</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table id="data-table" class="table table-bordered table-striped">
               	 	<thead>
                		<tr>
			                <th>Id</th>
			                <th>Name</th>
			                <th>Contact #</th>
			                <th>Type</th>
			                <th>Action</th>
                		</tr>
	                </thead>
	                <tbody>
	                	@foreach($data as $key => $value)
	                		<tr>
	                			<td>{{$value['id']}}</td>
	                			<td>{{$value['name']}}</td>
	                			<td>{{$value['phone']}}</td>
	                			<td>
	                			
	                				@foreach($value['type'] as $ckey => $cvalue)
	                					@if(isset($cvalue))
	                					<b>{{$cvalue}}</b> <br>
	                					@else
	                					No Company Type specified.
	                					@endif
	                				@endforeach
		                			
	                			</td>
	                			<td>
	                			    <a href="javascript:void(0)" onclick="editCompany({{$value['id']}})" class="btn btn-primary" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	                			    <a href="javascript:void(0)" onclick="compDelModal({{$value['id']}})" class="btn btn-primary" title="Deactivate"><i class="fa fa-times" aria-hidden="true"></i></a>
	                			</td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
   	</div>
</div>

<div class="modal fade" id="company-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Company</h4>
        </div>
        <form action="{{url('add-company')}}" method="POST">
        	<input type="hidden" name="_token" value="{{csrf_token()}}">
	        <div class="modal-body">
	          	<div class="form-group">
	        		<label for="name">Company</label>
	          		<input type="text" name="name"  class="form-control" required>
	          	</div>
	          	<div class="form-group">
	          		<label for="phone">Phone</label>
	          		<input type="text" name="phone" class="form-control" >
	          	</div>
	          	<div class="form-group">
	                <label>Company Type</label>
	                <select name="type[]" class="form-control select2" multiple="multiple" data-placeholder="Select Types"
	                        style="width: 100%;" required>
	                  <option value="1">Admin</option>
	                  <option value="2">Realtor</option>
	                  <option value="3">Supplier</option>
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

  <div class="modal fade" id="company-edit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Company</h4>
        </div>
        <div id="status-msg" style="display: none;">&emsp;Please wait while fetching form...</div>
        <form action="{{url('edit-company')}}" method="POST">
        	<input type="hidden" name="_token" value="{{csrf_token()}}">
        	<input type="hidden" name="company_id" id="company_id">
	        <div class="modal-body">
	          	<div class="form-group">
	        		<label for="name">Company</label>
	          		<input type="text" name="name" id="company" class="form-control" required>
	          	</div>
	          	<div class="form-group">
	          		<label for="phone">Phone</label>
	          		<input type="text" name="phone" id="phone" class="form-control" >
	          	</div>
	          	<div class="form-group">
	                <label>Company Type</label>
	                <select name="type[]" id="type" class="form-control select2" multiple="multiple" data-placeholder="Select Types"
	                        style="width: 100%;" required>
	                 
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
