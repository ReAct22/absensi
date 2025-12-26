  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ADMIN PANEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('dashboard')}}" class="nav-link {{Route::is('dashboard') ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('attendance.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('presensi')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Presensi Manual</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('presensi.list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Approve Presensi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{Route::is('department.*') || Route::is('position.*') || Route::is('employeed.*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Route::is('department.*') || Route::is('position.*') || Route::is('employeed.*') ? 'active' : ''}}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employeed.index')}}" class="nav-link {{Route::is('employeed.*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('department.index')}}" class="nav-link {{Route::is('department.*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Department</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('position.index')}}" class="nav-link {{Route::is('position.*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Position</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Shift
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('shift.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shift Manajement</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee-shift.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Shift</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Leave
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('leave-approve.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Leave Request</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-gear"></i>
              <p>
                Config
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('geo-fance.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>GPS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Management</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
