@extends('layouts.app')

@section('cont-head')
 <h1>
    Users
    <small>meet users</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Users</li>
  </ol>
@endsection
@section('main-content')
<div class="row">
   	<div class="col-xs-12">
   		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Users</h3>
              <br><br>
              <button class="btn btn-primary" onclick="addUser()"><i class="fa fa-plus"></i>  Add</button><br><br>
              	@if (session('status')) 
              		 <div class="alert alert-success alert-dismissible">
					    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					    <strong>Success!</strong> {{ session('status') }}  
					  </div>
				    <hr>    
			    @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              	<table id="data-table" class="table table-bordered table-striped">
               	 	<thead>
                		<tr>
			                <th>Id</th>
			                <th>Name</th>
			                <th>Email</th>
			                <th>Company</th>
			                <th>Type</th> 
			                <th>Is Verified?</th>
			                <th>Is Active?</th>
			                <th>Action</th>
                		</tr>
	                </thead>
	                <tbody>
	                	@foreach($data as $key => $value)
	                		<tr>
	                			<td>{{$value['id']}}</td>
	                			<td>{{$value['firstName']}} {{$value['lastName']}}</td>
	                			<td>{{$value['email']}}</td>
	                			<td>
	                				@if(isset($value['company']['name']))
	                					{{$value['company']['name']}}
	                				@endif
	                			</td>
	                			<td>
	                				@if($value['groupId'])
	                					Admin
	                				@else
	                					User
	                				@endif
	                			</td>
	                			<td>
	                				@if($value['emailVerified'])
	                					Yes
	                				@else
	                					No
	                				@endif
	                			</td>
	                			<td>
	                				@if($value['active'])
	                					Yes
	                				@else
	                					No
	                				@endif
	                			</td>
	                			<td>
	                			    <a href="javascript:void(0)" onclick="editUser({{$value['id']}})" class="btn btn-primary" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	                			    <a href="javascript:void(0)" onclick="deactivateUser({{$value['id']}})" class="btn btn-primary" title="Deactivate"><i class="fa fa-times" aria-hidden="true"></i></a>
	                			</td>
	                		</tr>
	                	@endforeach
	                </tbody>
	            </table>
	        </div>
	    </div>
   	</div>
</div>

<div class="modal fade" id="user-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New User</h4>
        </div>
        <form action="{{url('user')}}" method="POST">
        	<input type="hidden" name="_token" value="{{csrf_token()}}">
	        <div class="modal-body">
	          	<div class="form-group">
	        		<label for="first_name">First Name</label>
	          		<input type="text" name="first_name"  class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="last_name">Last Name</label>
	          		<input type="text" name="last_name"  class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="email">Email</label>
	          		<input type="text" name="email"  class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="password">Password</label>
	          		<input type="password" name="password"  class="form-control">
	          	</div>
	          	<div class="form-group">
	          		<label for="company_name">Company</label>
	          		<select class="form-control" name="company_name" id="company_name" required></select>
	          	</div>
	          	<div class="form-group">
	          		<label for="groupId">Group</label>
	          		<select class="form-control" name="groupId">
	          			<option value="1">Admin</option>
	          			<option value="0">User</option>
	          		</select>
	          	</div>
	          	<hr>
	          	<div class="form-group">
	        		<label for="address_1">Address 1 </label>
	          		<input type="text" name="address_1"  class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="address_2">Address 2</label>
	          		<input type="text" name="address_2"  class="form-control">
	          	</div>
	        	<div class="form-group">
	        		<label for="postal_code">Postal Code</label>
	          		<input type="text" name="postal_code"  class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="town">Town</label>
	          		<input type="text" name="town"  class="form-control" required>
	          	</div>
	          	<hr>
	          	<div class="form-group">
	        		<label for="isDebit">Payment Method</label><br>
	          		<input type="radio" name="isDebit" value="Debit"> Debit
	          		<input type="radio" name="isDebit" value="Invoice"> Invoice
	          	</div>
	          	<div class="form-group">
	        		<label for="iban">Iban</label>
	          		<input type="text" name="iban"  class="form-control">
	          	</div>
	          	<div class="form-group">
	        		<label for="tax_number">Tax Number</label>
	          		<input type="text" name="tax_number"  class="form-control">
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

<div class="modal fade" id="user-edit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit User</h4>
        </div>
    
         <form action="{{url('edit-user')}}" method="POST">
        	<input type="hidden" name="_token" value="{{csrf_token()}}">
        	<input type="hidden" name="userId" id="userId">
        	<input type="hidden" name="addressId" id="addressId">
        	<input type="hidden" name="inAddressId" id="inAddressId">
	        <div class="modal-body">
	          	<div class="form-group">
	        		<label for="first_name">First Name</label>
	          		<input type="text" name="first_name"  id="first_name" class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="last_name">Last Name</label>
	          		<input type="text" name="last_name"   id="last_name" class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="email">Email</label>
	          		<input type="text" name="email" id="email" class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="password">New Password (if to be updated)</label>
	          		<input type="password" id="password" name="password"  class="form-control">
	          	</div>
	          	<div class="form-group">
	          		<label for="company_name">Company</label>
	          		<select class="form-control" name="company_id" id="company_id" required></select>
	          	</div>
	          	<div class="form-group">
	          		<label for="groupId">Group</label>
	          		<select class="form-control" name="groupId" id="groupId"></select>
	          	</div>
	          	<hr>
	          	<div class="form-group">
	        		<label for="address_1">Address 1 </label>
	          		<input type="text" name="address_1" id="address_1" class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="address_2">Address 2</label>
	          		<input type="text" name="address_2" id="address_2"  class="form-control">
	          	</div>
	        	<div class="form-group">
	        		<label for="postal_code">Postal Code</label>
	          		<input type="text" name="postal_code" id="postal_code"  class="form-control" required>
	          	</div>
	          	<div class="form-group">
	        		<label for="town">Town</label>
	          		<input type="text" name="town" id="town" class="form-control" required>
	          	</div>
	          	<hr>
	          	<div class="form-group">
	        		<label for="isDebit">Payment Method</label><br>
	          		<div id="debitOpt"></div>
	          	</div>
	          	<div class="form-group">
	        		<label for="iban">Iban</label>
	          		<input type="text" name="iban" id="iban"  class="form-control">
	          	</div>
	          	<div class="form-group">
	        		<label for="tax_number">Tax Number</label>
	          		<input type="text" name="tax_number" id="tax_number"  class="form-control">
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
