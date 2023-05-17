<!-- Navbar -->
@php
$pages = [
    ['route' => 'donatur/dashboard', 'title' => 'Dashboard', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'donatur/profile', 'title' => 'Profile', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'donatur/donasi', 'title' => 'Donasi', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'donatur/detail-donasi', 'title' => 'Detail Donasi', 'link-main-title' => 'donatur.donasi', 'main-title' => 'Donasi'],
    ['route' => 'donatur/create-donasi', 'title' => 'Tambah Donasi Baru', 'link-main-title' => 'donatur.donasi', 'main-title' => 'Donasi'],
  ];
@endphp

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          @foreach($pages as $page)
            @if(Request::is($page['route']))
              @if($page['main-title']===[null])
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Donatur</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $page['title'] }}</li>
              @else
              @php
                $maintitle = $page['link-main-title'];
              @endphp
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Donatur</a></li>
                @if($maintitle != null)
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{ URL::route($maintitle) }}">{{ $page['main-title'] }}</a></li>
                @endif
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $page['title'] }}</li>
              @endif
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $page['title'] }}</h6>
            @endif
        @endforeach
      </nav>
      @if(Request::is('donatur/donasi'))
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Type here...">
          </div>
        </div>
      </div>
      @endif
    </div>
  </nav>
  <!-- End Navbar -->