<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets\mainweb\img\apple-icon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets\mainweb\img\favicon.png') }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Web FoodBank Kita</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link href="{{ asset('assets\mainweb\css\bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets\mainweb\css\gaia.css') }}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Cambo|Poppins:400,600' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('assets\mainweb\css\fonts\pe-icon-7-stroke.css') }}" rel="stylesheet">
</head>

<body>

    @include('layouts.layouts_mainweb.mainweb_header')


    @yield('mainweb_content')


    @include('layouts.layouts_mainweb.mainweb_footer')

</body>

<!--   core js files    -->
<script src="{{ asset('assets/mainweb/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/mainweb/js/bootstrap.js') }}" type="text/javascript"></script>

<!--  js library for devices recognition -->
<script type="text/javascript" src="{{ asset('assets\mainweb\js\modernizr.js') }}"></script>

<!--  script for google maps   -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js') }}"></script>

<!--   file where we handle all the script from the Gaia - Bootstrap Template   -->
<script type="text/javascript" src="{{ asset('assets\mainweb\js\gaia.js') }}"></script>

</html>
