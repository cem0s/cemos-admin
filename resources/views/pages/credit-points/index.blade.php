@extends('layouts.app')

@section('cont-head')
 <h1>
    Dashboard
    <small>Control Panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Credit points</a></li>
    <li class="active">All</li>
  </ol>
@endsection

@section('main-content')
<div class="row">
   	<div class="col-xs-12">
   		<div class="box">
            <div class="box-header">
              <h3 class="box-title">All credit points</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="ordertable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>User</th>
                      <th>Company</th>
                      <th>Credits</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- @foreach($orderData as $key => $value) --}}
                      <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-flat">Action</button>
                            <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="javascript:void()" onclick="showOrderStatusModal('1')"><i class="ion ion-wrench"></i> Update</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    {{-- @endforeach --}}
                  </tbody>
              </table>
          </div>
	    </div>
   	</div>
</div>

 <div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Default Modal</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection
