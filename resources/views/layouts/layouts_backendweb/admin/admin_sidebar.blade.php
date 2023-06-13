<div class="min-height-300 bg-gradient-success position-absolute w-100"></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="{{ asset('assets/logo.png')}}" class="navbar-brand-img h-100" alt="logo">
        <span class="ms-1 font-weight-bold">FoodBank Kita : Admin</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ URL::route('admin.dashboard') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-diamond text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/donasi') ? 'active' : '' }}" href="{{ URL::route('admin.donasi') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-favourite-28 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Donasi</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}" href="{{ URL::route('admin.profile') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/ngo') ? 'active' : '' }}" href="{{ URL::route('admin.ngo') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-briefcase-24 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">NGO</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/donatur') ? 'active' : '' }}" href="{{ URL::route('admin.donatur') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-satisfied text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Donatur</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ URL::route('admin.admins') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-satisfied text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Admin</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data master</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/kota') ? 'active' : '' }}" href="{{ URL::route('admin.kota') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-pin-3 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kota</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/kategori') ? 'active' : '' }}" href="{{ URL::route('admin.kategori') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kategori</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/satuan') ? 'active' : '' }}" href="{{ URL::route('admin.satuan') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Satuan</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/statusDonasi') ? 'active' : '' }}" href="{{ URL::route('admin.status-donasi') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-basket text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Status Donasi</span>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/statusNGO') ? 'active' : '' }}" href="{{ URL::route('admin.statusNGO') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-badge text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Status NGO</span>
          </a>
        </li> --}}
      </ul>
    </div>
    <div class="sidenav-footer mx-3 position-absolute bottom-0 end-0">
      <a href="{{ URL::route('admin.logout') }}" class="btn btn-dark btn-sm w-100 mb-3">Log out</a>
    </div>
  </aside>
