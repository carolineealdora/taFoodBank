@extends('layouts.layouts_backendweb.donatur.donatur_register_master')

@section('donatur_register_content')
<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('assets/backendweb/img/donatur/register-bg.jpg') }}'); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center mx-auto">
          <h1 class="text-white mb-2 mt-5">Halo Donatur!</h1>
          <p class="text-lead text-white">Silahkan masukkan data berikut untuk melakukan registrasi.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
          <div class="card-body">
            <form role="form">
              <div class="form-group mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Foto Profil <span class="mb-2 text-xs font-weight-light">(opsional)</span></label>
              {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
              <input class="form-control" type="file" id="donasiFoto" name="donasiFoto" value="{{ old('AdminFoto') }}" onchange="previewImage()">
              @error('AdminFoto')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Name" aria-label="Name">
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Alamat Lengkap</label>
                <input type="text" class="form-control" placeholder="Alamat" aria-label="Alamat">
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Nomor Identitas (KTP)" aria-label="Nomor Identitas">
              </div>
              {{-- ambil dari form donasi --}}
              <div class="mb-3"> 
                <div class="form-group">
                  <label for="donatur_donasiFoto" class="form-control-label">Tanggal Lahir</label>
                  <input class="form-control datepicker" placeholder="Silahkan Pilih Tanggal" type="text" id="datepicker" name="WaktuPembuatan" value="{{ old('WaktuPembuatan') }}" required>                   
                </div>
              </div>
              <div class="mb-3"> 
                <label for="donatur_donasiFoto" class="form-control-label">Nomor Telepon</label>
                <input type="text" class="form-control" placeholder="Nomor Telepon" aria-label="Nomor Telepon">
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Email</label>
                <input type="email" class="form-control" placeholder="Email" aria-label="Email">
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Password</label>
                <input type="password" class="form-control" placeholder="Password" aria-label="Password">
              </div>
              <div class="text-center">
                <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
              </div>
              <p class="text-sm mt-3 mb-0">Sudah punya akun? Langsung <a href="javascript:;" class="text-dark font-weight-bolder"> Log in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection