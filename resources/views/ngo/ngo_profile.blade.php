@extends('layouts.layouts_backendweb.ngo.ngo_master')

@section('ngo_content')
<div class="card shadow-lg mx-4 mb-4">
  <div class="card shadow-lg">
    <div class="card-body p-3">
      <div class="card-shadow pt-2 p-3">
        {{-- <p class="text-uppercase text-sm">Data Donasi</p> --}}
        <ul class="list-group">
          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
            <div class="d-flex flex-column">
              <h6 class="text-sm">Nama NGO</h6>
              <span class="mb-2 text-xs">Kota Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
              <div class="row">
                <span class="mb-2 text-xs">Alamat Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
                <span class="mb-2 text-xs">Nomor Telepon Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
                <span class="mb-2 text-xs">Email Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="card shadow-lg mx-4">
  <div class="card shadow-lg">
  <div class="card-body p-3">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
            <a href="{{asset('assets\backendweb\img\team-2.jpg')}}" data-pswp-width="1669" 
            data-pswp-height="2500">
              <img src="{{asset('assets\backendweb\img\team-2.jpg')}}" class="avatar avatar-lg" alt="profilePIC">
            </a>
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            Sayo Kravits
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            PIC
          </p>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Edit Profile</p>
            <button class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
          </div>
        </div>
        <div class="card-body">
          <p class="text-uppercase text-sm">Data Profile PIC</p>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="donatur_donasiFoto" class="form-control-label">Foto Profil PIC</label>
            {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
            <input class="form-control" type="file" id="donasiFoto" name="donasiFoto" value="{{ old('AdminFoto') }}" onchange="previewImage()">
            @error('AdminFoto')
              <p class="text-danger">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Nama PIC</label>
                <input class="form-control" type="text" value="lucky.jesse">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Nomor Identitas</label>
                <input class="form-control" type="text" value="lucky.jesse">
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase text-sm">Informasi Log in</p>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Password</label>
                <input class="form-control" type="password" value="Password">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection