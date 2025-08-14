<style>
  .dropdown-menu-lg {
    max-width: 200px;
    min-width: 200px;
  }
  .dropdown-item-title {
    font-size: 20px;
    font-weight: bold;
  }
</style>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="nav-icon far fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item py-3">
          <div class="text-start">
            <h3 class="dropdown-item-title fs-5 fw-bold">
              @if(Request::segment(1) === 'admin')
                @if (Auth::guard('admin')->check())
                  {{ Auth::guard('admin')->user()->name }}
                @endif
              @endif
            </h3>
            <p class="text-muted">
              @if(Request::segment(1) === 'admin')
                @if (Auth::guard('admin')->check())
                  {{ Auth::guard('admin')->user()->username }}
                @endif
              @endif
            </p>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('admin.logout') }}" class="dropdown-item text-start">
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>