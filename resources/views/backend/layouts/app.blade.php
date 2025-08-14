<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ !empty($headerTitle) ? $headerTitle : "VPN" }}</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/plugins/select2/css/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/dist/css/adminlte.min.css">
  <!-- Custom style -->
  <link rel="stylesheet" href="{{ asset('assets/backend') }}/dist/css/custom.css">
  <!-- Toaster -->
  <link rel="stylesheet" href="{{ asset('assets/backend/css/toastify.min.css') }}" />
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    @if(
        !request()->routeIs('admin.loginView') && 
        !request()->routeIs('admin.password.forget') && 
        !request()->routeIs('admin.password.reset')
      )
        @include('backend.layouts.header')
    @endif

    <!-- Sidebar -->
    @if(
        !request()->routeIs('admin.loginView') && 
        !request()->routeIs('admin.password.forget') && 
        !request()->routeIs('admin.password.reset')  
    )
        @include('backend.layouts.sidebar')
    @endif

    @yield('content')

    <!-- Main Footer -->
    @if(
        !request()->routeIs('admin.loginView') && 
        !request()->routeIs('admin.password.forget') && 
        !request()->routeIs('admin.password.reset') 
    )
        @include('backend.layouts.footer')
    @endif

  </div>
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{ asset('assets/backend') }}/plugins/jquery/jquery.min.js"></script>
  <script src="{{ asset('assets/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('assets/backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('assets/backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('assets/backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ asset('assets/backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assets/backend') }}/dist/js/adminlte.min.js"></script>
  <!-- Select2 -->
  <script src="{{ asset('assets/backend') }}/plugins/select2/js/select2.full.min.js"></script>
  <!-- Toaster -->
  <script src="{{ asset('assets/backend/js/toastify-js.js') }}"></script>
  <script src="{{ asset('assets/backend/js/config.js') }}"></script>
  <script>
    // Show Toast
    window.onload = function() {
      @foreach ($errors->all() as $error)
        errorToast("{{ $error }}");
      @endforeach

      @if(session('success'))
        successToast("{{ session('success') }}");
      @endif
          
      @if(session('error'))
        errorToast("{{ session('error') }}");
      @endif
    };
  </script>
  
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    });
  </script>
  
  @stack('scripts')

</body>
</html>
