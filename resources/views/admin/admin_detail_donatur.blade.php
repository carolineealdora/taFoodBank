@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
  <div class="card shadow-lg mx-4">
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
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Edit Profile Donatur</p>
              <button class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
            </div>
          </div>
          <div class="card-body">
            <p class="text-uppercase text-sm">Data Profile</p>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="donatur_donasiFoto" class="form-control-label">Foto Profile Donatur</label>
              {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
              <input class="form-control" type="file" id="donasiFoto" name="donasiFoto" value="{{ old('AdminFoto') }}" onchange="previewImage()">
              @error('AdminFoto')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nama</label>
                  <input class="form-control" type="text" value="lucky.jesse">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nomor Identitas</label>
                  <input class="form-control" type="text" value="lucky.jesse">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Tanggal Lahir</label>
                  <input class="form-control" type="text" value="lucky.jesse">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nomor Telepon</label>
                  <input class="form-control" type="text" value="lucky.jesse">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Alamat Lengkap</label>
                    <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                </div>
                </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Informasi Log in</p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Email</label>
                  <input class="form-control" type="email" value="Email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Password</label>
                  <input class="form-control" type="password" value="Password">
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-danger btn-sm ms-auto col-12 mt-4">Hapus Data Donatur</button>
      </div>
    </div>
{{-- </div> --}}

@endsection