<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets\backendweb\img\apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets\backendweb\img\favicon.png') }}">
  <title>
    Donatur-Login
  </title>
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets\backendweb\css\nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets\backendweb\css\nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets\backendweb\css\nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets\backendweb\css\argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="">
   <!-- New Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
  @yield('ngo_login_content')

</body>

<!--   Core JS Files   -->
<script src="{{ asset('assets\backendweb\js\corepopper.min.js') }}"></script>
<script src="{{ asset('assets\backendweb\js\corebootstrap.min.js') }}"></script>
<script src="{{ asset('assets\backendweb\js\plugins\perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets\backendweb\js\plugins\smooth-scrollbar.min.js') }}"></script>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets\backendweb\js\argon-dashboard.min.js?v=2.0.4') }}"></script>


</html>