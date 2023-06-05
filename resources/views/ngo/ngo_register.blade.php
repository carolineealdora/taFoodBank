@extends('layouts.layouts_backendweb.ngo.ngo_register_master')

@section('ngo_register_content')
<main class="main-content  mt-0">
  <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('assets/backendweb/img/ngo/register-bg.jpg') }}'); background-position: top;">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 text-center mx-auto">
          <h1 class="text-white mb-2 mt-5">Halo NGO!</h1>
          <p class="text-lead text-white">Silahkan masukkan data berikut untuk mendaftarkan organisasi Anda. Selanjutnya hanya perlu menunggu persetujuan oleh admin Food Bank Kita.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
      <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
        <div class="card z-index-0">
          <div class="card-body">
            <form id="form-regis" role="form">
              <div class="card-header text-center pt-4">
                <h5>Data NGO</h5>
              </div>
              <div class="mb-3">
                <label for="ngo_donasiFoto" class="form-control-label">Nama NGO</label>
                <input type="text" class="form-control" placeholder="Nama NGO" aria-label="Nama NGO">
              </div>
              <div class="form-group">
                <label for="kotaNGO" class="form-control-label">Kota Kantor NGO</label>
                <select class="form-control" id="kotaDonasi">
                  <option>Malang</option>
                  <option>Jakarta</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="ngo_donasiFoto" class="form-control-label">Alamat Kantor NGO</label>
                <input type="text" class="form-control" placeholder="Alamat Kantor NGO" aria-label="Alamat Kantor NGO">
              </div>
              <div class="mb-3"> 
                <label for="ngo_donasiFoto" class="form-control-label">Nomor Telepon Kantor NGO</label>
                <input type="text" class="form-control" placeholder="Nomor Telepon Kantor NGO" aria-label="Nomor Telepon Kantor NGO">
              </div>
              <div class="mb-3">
                <label for="ngo_donasiFoto" class="form-control-label">Email Kantor NGO</label>
                <input type="email" class="form-control" placeholder="Email Kantor NGO" aria-label="Email Kantor NGO">
              </div>
              <hr class="horizontal dark">
              <div class="card-header text-center pt-0">
                <h5>Data PIC</h5>
              </div>
              <div class="form-group mb-3">
                <label for="ngoPICFoto" class="form-control-label">Foto Profil <span class="mb-2 text-xs font-weight-light">(opsional)</span></label>
                {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
                <input class="form-control" type="file" id="ngoFoto" name="ngoPICFoto" value="{{ old('AdminFoto') }}" onchange="previewImage()">
                @error('AdminFoto')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
                <div class="mb-3">
                  <label for="ngo_donasiFoto" class="form-control-label">Nama PIC</label>
                  <input type="text" class="form-control" placeholder="Nama PIC" aria-label="Nama PIC">
                </div>
                <div class="mb-3">
                  <label for="ngo_donasiFoto" class="form-control-label">Nomor Identitas (KTP)</label>
                  <input type="text" class="form-control" placeholder="Nomor Identitas (KTP)" aria-label="Nomor Identitas">
                </div>
              <div class="mb-3">
                <label for="ngo_donasiFoto" class="form-control-label">Password</label>
                <input type="password" class="form-control" placeholder="Password" aria-label="Password">
              </div>
              <div class="text-center">
                <button type="button" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
              </div>
              <p class="text-sm mt-3 mb-0">NGO sudah terdaftar? Langsung <a href="javascript:;" class="text-dark font-weight-bolder"> Log in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection