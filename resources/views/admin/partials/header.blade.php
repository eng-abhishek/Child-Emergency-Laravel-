<div class="wrapper"> 
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo"><b>Child Emergency</b></a>
        <!-- Header Navbar: style can be found in header.less -->
      <!--   <i class="fa fa-bell"></i> -->

        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <a href="#"><i class="fa fa-bell" style="float: right;margin-right:0;padding-top:19px;padding-right: 16px;font-size: 15px;color:white" aria-hidden="true">
              <sup class="countNotificationNumber" style="color: red;font-size: 13px;background: white;text-align: center;font-weight: 600;padding: 2px 4px;border-radius:25px;position:relative;top:-11px;left: -10px;">0</sup></i></a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Child Emergency</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                    <p>
                    Child Emergency
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="{{url('admin-logout')}}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Child Emergency</p>

            </div>
          </div>
        
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
            </li>

             <li class="treeview">
              <a href="{{url('admin-dashboard')}}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
              </a>
              </li>

            <li class="treeview">
              <a href="{{url('user')}}">
                <i class="fa fa-user"></i>
                <span>User Management</span>
              </a>
            </li>

            <li class="treeview">
              <a href="{{url('child')}}">
                <i class="fa fa-bar-chart"></i>
                <span>Child Management</span>
            </a>
            </li>


             <li class="treeview">
              <a href="{{url('parent')}}">
                <i class="fa fa-bar-chart"></i>
                <span>Parent Management</span>
            </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-copy"></i> <span>Medical Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('medical-level-one')}}"><i class="fa fa-circle-o"></i>Medical Level One</a></li>
                <li><a href="{{url('medical-level-two')}}"><i class="fa fa-circle-o"></i>Medical Level Two</a></li>
              </ul>
            </li>

              <li class="treeview">
              <a href="{{url('care-provider')}}">
                <i class="fa fa-bar-chart"></i>
                <span>Child Care Provider Management</span>
            </a>
            </li>

          <!--   <li class="treeview">
              <a href="{{url('school-detail-level-one')}}">
                <i class="fa fa-bar-chart"></i>
                <span>School Detail Level One Management</span>
            </a>
            </li> -->

          <li class="treeview">
              <a href="#">
                <i class="fa fa-copy"></i> <span>School Detail Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('school-detail-level-one')}}"><i class="fa fa-circle-o"></i>School Detail Level One Management</a></li>
                <li><a href="{{url('school-detail-level-two')}}"><i class="fa fa-circle-o"></i>School Detail Level Two Management</a></li>
              </ul>
            </li>

             <!-- 
            <li class="treeview">
              <a href="{{url('school-detail-level-two')}}">
                <i class="fa fa-bar-chart"></i>
                <span></span>
            </a>
            </li> -->
    
            <li class="treeview">
              <a href="{{url('extra-curricular')}}">
                <i class="fa fa-bar-chart"></i>
                <span>Extra Curricular Activity</span>
            </a>
            </li>

            <li class="treeview">
              <a href="{{url('about-details')}}">
                <i class="fa fa-bar-chart"></i>
                <span>About Detail</span>
            </a>
            </li>

            <li class="treeview">
              <a href="{{url('insurance-details')}}">
                <i class="fa fa-bar-chart"></i>
                <span>Insurance Detail</span>
            </a>
            </li>

            <li class="treeview">
              <a href="{{url('support-details')}}">
                <i class="fa fa-bar-chart"></i>
                <span>Support Detail</span>
            </a>
            </li>
           
            <li class="treeview">
              <a href="{{url('document-details')}}">
                <i class="fa fa-bar-chart"></i>
                <span>Document Detail</span>
            </a>
            </li>

            <li class="treeview">
              <a href="{{url('legal-details')}}">
                <i class="fa fa-bar-chart"></i>
                <span>Legal Detail</span>
            </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
