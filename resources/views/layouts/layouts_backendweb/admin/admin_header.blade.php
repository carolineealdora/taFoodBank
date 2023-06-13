<!-- Navbar -->
@php
$pages = [
    ['route' => 'admin/dashboard', 'title' => 'Dashboard', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/profile', 'title' => 'Profile', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/donasi', 'title' => 'Donasi', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/detail-donasi', 'title' => 'Detail Donasi', 'link-main-title' => 'admin.donasi', 'main-title' => 'Donasi'],
    ['route' => 'admin/donatur', 'title' => 'Donatur', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/detail-donatur', 'title' => 'Detail Donatur', 'link-main-title' => 'admin.donatur', 'main-title' => 'Donatur'],
    ['route' => 'admin/ngo', 'title' => 'NGO', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/detail-ngo', 'title' => 'Detail NGO', 'link-main-title' => 'admin.ngo', 'main-title' => 'NGO'],
    ['route' => 'admin/kota', 'title' => 'Kota', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/create-kota', 'title' => 'Tambah Kota Baru', 'link-main-title' => 'admin.kota', 'main-title' => 'Kota'],
    ['route' => 'admin/detail-kota', 'title' => 'Detail Kota', 'link-main-title' => 'admin.kota', 'main-title' => 'Kota'],
    ['route' => 'admin/jenis', 'title' => 'Jenis', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/create-jenis', 'title' => 'Tambah Jenis Baru', 'link-main-title' => 'admin.jenis', 'main-title' => 'Jenis'],
    ['route' => 'admin/detail-jenis', 'title' => 'Detail Jenis', 'link-main-title' => 'admin.jenis', 'main-title' => 'Jenis'],
    ['route' => 'admin/kategori', 'title' => 'Kategori', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/create-kategori', 'title' => 'Tambah Kategori Baru', 'link-main-title' => 'admin.kategori', 'main-title' => 'Kategori'],
    ['route' => 'admin/detail-kategori', 'title' => 'Detail Kategori', 'link-main-title' => 'admin.kategori', 'main-title' => 'Kategori'],
    ['route' => 'admin/satuan', 'title' => 'Satuan', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/create-satuan', 'title' => 'Tambah Satuan Baru', 'link-main-title' => 'admin.satuan', 'main-title' => 'Satuan'],
    ['route' => 'admin/detail-satuan', 'title' => 'Detail Satuan', 'link-main-title' => 'admin.satuan', 'main-title' => 'Satuan'],
    ['route' => 'admin/statusDonasi', 'title' => 'Status Donasi', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/create-statusDonasi', 'title' => 'Tambah Status Donasi Baru', 'link-main-title' => 'admin.statusDonasi', 'main-title' => 'Status Donasi'],
    ['route' => 'admin/detail-statusDonasi', 'title' => 'Detail Status Donasi', 'link-main-title' => 'admin.statusDonasi', 'main-title' => 'Status Donasi'],
    ['route' => 'admin/statusNGO', 'title' => 'Status NGO', 'main-title' => null, 'link-main-title' => null],
    ['route' => 'admin/create-statusNGO', 'title' => 'Tambah Status NGO Baru', 'link-main-title' => 'admin.statusNGO', 'main-title' => 'Status NGO'],
    ['route' => 'admin/detail-statusNGO', 'title' => 'Detail Status NGO', 'link-main-title' => 'admin.statusNGO', 'main-title' => 'Status NGO'],
  ];
@endphp

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          @foreach($pages as $page)
            @if(Request::is($page['route']))
              @if($page['main-title']===[null])
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Admin</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $page['title'] }}</li>
              @else
              @php
                $maintitle = $page['link-main-title'];
              @endphp
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Admin</a></li>
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
    </div>
  </nav>
  <!-- End Navbar -->