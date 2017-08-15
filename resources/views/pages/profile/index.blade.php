@extends('layouts.app')

@section('cont-head')
 <h1>
    Admin
    <small>update profile</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Admin Profile</li>
  </ol>
@endsection

@section('main-content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Profile</h3>
        <br><br>
        <div class="row">
          <div class="col-md-3">
            @if (session('status')) 
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{ session('status') }}  
              </div>
            @endif
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form class="form" action="{{url('profile')}}" method="POST">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name"  class="form-control" value="{{$data['user']['firstname']}}" required>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="company_id" value="{{$data['company']['id']}}">
                <input type="hidden" name="userId" value="{{$data['user']['id']}}">
                <input type="hidden" name="addressId" value="{{$data['address']['id']}}">
                <input type="hidden" name="inAddressId" value="{{$data['invoiceaddress']['id']}}">
              </div>
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name"  class="form-control" value="{{$data['user']['lastname']}}" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email"  class="form-control" value="{{$data['user']['email']}}" required>
              </div>
              <div class="form-group">
                <label for="password">Password (if to be updated)</label>
                <input type="password" name="password"  class="form-control" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="address_1">Address 1 </label>
                <input type="text" name="address_1"  class="form-control" value="{{$data['address']['address_1']}}" required>
              </div>
              <div class="form-group">
                <label for="address_2">Address 2</label>
                <input type="text" name="address_2"  value="{{$data['address']['address_2']}}" class="form-control">
              </div>
              <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code"  class="form-control" value="{{$data['address']['zipcode']}}" required>
              </div>
              <div class="form-group">
                <label for="town">Town</label>
                <input type="text" name="town"  class="form-control" value="{{$data['address']['town']}}" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="isDebit">Payment Method</label><br>
                @if($data['invoiceaddress']['payment'] == "Debit")
                  <input type="radio" name="isDebit" value="Debit" checked> Debit
                  <input type="radio" name="isDebit" value="Invoice"> Invoice
                @else
                  <input type="radio" name="isDebit" value="Debit"> Debit
                  <input type="radio" name="isDebit" value="Invoice" checked> Invoice
                @endif
              </div>
              <div class="form-group">
                <label for="iban">Iban</label>
                <input type="text" name="iban" value="{{$data['invoiceaddress']['cocNumber']}}"  class="form-control">
              </div>
              <div class="form-group">
                <label for="tax_number">Tax Number</label>
                <input type="text" name="tax_number" value="{{$data['invoiceaddress']['tax']}}"  class="form-control">
              </div>
              <div class="form-group">
                <input type="submit" name="Submit" class="btn btn-primary" value="Save Profile Changes">
              </div> 
            </div>
          </div>
        </form>
      </div>
	  </div>
  </div>
</div>


@endsection
