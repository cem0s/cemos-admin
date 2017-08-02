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
              <h3 class="box-title">All credit points</h3><span style="float: right; position: relative;"><button class="btn btn-info" type="button" data-toggle="modal" data-target="#modal-primary"> Add Credit </button></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="ordertable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      {{-- <th>User</th> --}}
                      <th>Company</th>
                      <th>Credits</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($info['credits'] as $key => $value)
                      <tr>
                        <td>{{$key+1}}</td>
                        {{-- <td>test</td> --}}
                        <td>{{$value['name']}}</td>
                        <td>{{$value['points']}}</td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-flat">Action</button>
                            <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="javascript:void()"><i class="ion ion-wrench"></i> Update</a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    @endforeach
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

<div id="modal-primary" class="modal modal-primary fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title">Add Credit</h4>
      </div>
      <form name="creditForm" class="form-horizontal" method="POST"  action="{{url('add-credit')}}" >
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="modal-body">
        <div class="form-group">
          <label>Company</label>
          <select id="company" name="company" class="form-control" required="required">
            <option>--Please select--</option>
            @foreach ($info['users'] as $key => $value)
              <option value="{{$value['id']}}">{{$value['name']}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Credits</label>
          <select id="credit" name="credit" class="form-control" required="required">
            <option>--Please select--</option>
            <option value="100">100</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="400">400</option>
            <option value="500">500</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline pull-left" type="button" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline"> Save</button>
        </div>
    </div>
    </form>
  </div>
</div>

@endsection
