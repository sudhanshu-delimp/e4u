<header class="main-header">
    <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>Dev</b>C</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Dev</b>Console</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img class="img-circle" src="{{ auth()->user()->admin_image }}" class="" alt="User Image" style="height: 45px;
    max-width: 124px;" onerror="this.src='/assets/dist/img/avatar04.png';">
            <span class="hidden-xs">{{auth()->user() ? auth()->user()->name: null}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Sign out
                </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
              </form>
              </div>
            </li>
          </ul>
        </li>
        
      </ul>
    </div>
  </nav>
</header>