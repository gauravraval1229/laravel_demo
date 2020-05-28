
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" id="loginProfileImage">
        </div>
        <div class="info">
         <a href="#" class="d-block">
          <p>{{ Auth::user()->email }}</p>
         </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @if(Auth::user()->role == "user")
        <ul class="nav nav-pills nav-sidebar flex-column" id="menu" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('/edit-profile') }}" class="nav-link"><i class="nav-icon fa fa-edit"></i><p>Edit Profile</p></a>
          </li>
        </ul>
        @endif
        <ul class="nav nav-pills nav-sidebar flex-column" id="menu" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fa fa-sign-out"></i><p>LogOut</p></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper"> <!-- end in footer.php -->