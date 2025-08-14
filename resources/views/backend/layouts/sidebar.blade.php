@php
  $admin = Auth::guard('admin')->user();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img
      src="{{ asset('assets/backend') }}/dist/img/logo.png"
      alt="Ravivari Logo"
      class="brand-image elevation-3"
      style="opacity: 0.8"
      />
    <span class="brand-text ">VPN</span>
  </a>
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if ($admin && $admin->can('dashboard.view'))
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link  @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('country.view'))
        <li class="nav-item">
          <a href="{{ route('admin.countries.index') }}" class="nav-link @if(Request::segment(2) == 'countries') active @endif">
            <i class="nav-icon fas fa-globe"></i>
            <p>Countries</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('server.view'))
        <li class="nav-item">
          <a href="{{ route('admin.servers.index') }}" class="nav-link @if(Request::segment(2) == 'servers') active @endif">
            <i class="nav-icon fas fa-server"></i>
            <p>Servers</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('package_pricing.view'))
        <li class="nav-item">
          <a href="{{ route('admin.pricings.index') }}" class="nav-link @if(Request::segment(2) == 'pricings') active @endif">
            <i class="nav-icon fas fa-dollar-sign"></i>
            <p>Pricings</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('notification.send'))
        <li class="nav-item">
          <a href="{{ route('admin.notifications.index') }}" class="nav-link @if(Request::segment(2) == 'notifications') active @endif">
            <i class="nav-icon fas fa-bell"></i>
            <p>Notification</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('user.view'))
        <li class="nav-item">
          <a href="{{ route('admin.users.index') }}" class="nav-link @if(Request::segment(2) == 'users') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('admin.view'))
        <li class="nav-item">
          <a href="{{ route('admin.admins.index') }}" class="nav-link @if(Request::segment(2) == 'admins') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>Admins</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('role.view'))
        <li class="nav-item">
          <a href="{{ route('admin.roles.index') }}" class="nav-link @if(Request::segment(2) == 'roles') active @endif">
            <i class="nav-icon fas fa-user-shield"></i>
            <p class="text-nowrap">Roles & Permissions</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('page.view'))
        <li class="nav-item">
          <a href="{{ route('admin.pages.index') }}" class="nav-link @if(Request::segment(2) == 'pages') active @endif">
            <i class="nav-icon fas fa-file"></i>
            <p>Pages</p>
          </a>
        </li>
        @endif

        @if ($admin && $admin->can('email-settings.view'))
        <li class="nav-item @if(Request::segment(2) == 'email') menu-open @endif">
          <a href="#" class="nav-link @if(Request::segment(2) == 'email') active @endif">
            <i class="nav-icon fas fa-envelope"></i>
            <p class="text-nowrap">
              Email Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.email.configuration') }}" class="nav-link @if(Request::segment(3) == 'configuration') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-nowrap">Email Configuration</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.email.templates.index') }}" class="nav-link @if(Request::segment(3) == 'templates') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-nowrap">Email Templates</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.email.global-template') }}" class="nav-link @if(Request::segment(3) == 'global-template') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-nowrap">Global Email Template</p>
              </a>
            </li>
          </ul>
        </li>
        @endif

        @if ($admin && $admin->can('settings.view'))
        <li class="nav-item @if(Request::segment(2) == 'settings') menu-open @endif">
          <a href="#" class="nav-link @if(Request::segment(2) == 'settings') active @endif">
            <i class="nav-icon fas fa-cogs"></i>
            <p class="text-nowrap">
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if ($admin && $admin->can('advertisement-settings.view'))
              <li class="nav-item">
                <a href="{{ route('admin.settings.advertisement') }}" class="nav-link @if(Request::segment(3) == 'advertisement') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-nowrap">Advertisement</p>
                </a>
              </li>
            @endif
            @if ($admin && $admin->can('notification-settings.view'))
              <li class="nav-item">
                <a href="{{ route('admin.settings.notification') }}" class="nav-link @if(Request::segment(3) == 'notification') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-nowrap">Notification</p>
                </a>
              </li>
            @endif
            @if ($admin && $admin->can('app-settings.view'))
              <li class="nav-item">
                <a href="{{ route('admin.settings.app') }}" class="nav-link @if(Request::segment(3) == 'app') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="text-nowrap">App Settings</p>
                </a>
              </li>
            @endif
          </ul>
        </li>
        @endif

        <li class="nav-item">
          <a href="{{ route('admin.logout') }}" class="nav-link">
            <i class="nav-icon far fa-user"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>