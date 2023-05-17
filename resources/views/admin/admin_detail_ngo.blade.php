@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
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
          <p class="mb-1 font-weight-bold text-sm">
            PIC
          </p>
          <span class="badge badge-sm bg-gradient-success">Approved</span>
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
            <p class="mb-0">Profile NGO</p>
            <button class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
          </div>
        </div>
        <div class="card-body">
          <p class="text-uppercase text-sm">Data Profile</p>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Nama NGO</label>
                <input class="form-control" type="text" value="lucky.jesse">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="kotaNGO" class="form-control-label">Kota Kantor NGO</label>
                <select class="form-control" id="kotaDonasi">
                  <option>Malang</option>
                  <option>Jakarta</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="example-text-input" class="form-control-label">Nomor Telepon Kantor NGO</label>
                <input class="form-control" type="text" value="lucky.jesse">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="example-text-input" class="form-control-label">Alamat Lengkap Kantor NGO</label>
                <input class="form-control" type="text" value="lucky.jesse">
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
    </div>
  </div>
</div>
<div class="container-fluid pb-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Profile PIC</p>
            <button class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
          </div>
        </div>
        <div class="card-body">
          <p class="text-uppercase text-sm">Data Profile</p>
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
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <button class="btn btn-success btn-sm ms-auto col-5 mt-4 mx-5">Approve</button>
    <button class="btn btn-danger btn-sm ms-auto col-5 mt-4 mx-5">Reject</button>
  </div>
  
@endsection