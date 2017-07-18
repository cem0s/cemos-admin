<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::check())
            <img src="{{ asset(Auth::user()->getProfilePic())}}" class="img-circle" alt="User Image">
          @else 
            <img src="{{ asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info">
          @if(Auth::check())
          <p>{{Auth::user()->getFirstname()}} {{Auth::user()->getLastName()}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          @endif
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-building-o"></i>
            <span>Company</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">{{Session::get('company_count')}}</span>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Suppliers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> View Suppliers</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Supplier Types</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
          <i class="fa fa-shopping-bag"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Product List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home"></i>
            <span>Property</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Residential</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Commercial</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Property Type</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Order List</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Order Status</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Order Product List</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Order Product Status</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-print"></i>
            <span>Invoices</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> All Invoices</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text"></i>
            <span>Memos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Memo List</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>