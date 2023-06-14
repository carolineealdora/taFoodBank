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
            <form id="register-form" action="{{route('donatur.register')}}" method="post" enctype="multipart/form-data" role="form">
              <div class="form-group mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Foto Profil</label>
                <input id="foto" name="foto" class="form-control" type="file" id="donasiFoto" name="donasiFoto" required>
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Nama Lengkap</label>
                <input id="nama" name="nama" type="text" class="form-control" placeholder="Name" aria-label="Name" required>
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Alamat Lengkap</label>
                <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Alamat" aria-label="Alamat" required>
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Nomor Identitas (KTP)</label>
                <input id="no_identitas" name="no_identitas" type="text" class="form-control" placeholder="Nomor Identitas (KTP)" aria-label="Nomor Identitas" required>
              </div>
              <div class="mb-3">
                <div class="form-group">
                  <label for="donatur_donasiFoto" class="form-control-label">Tanggal Lahir</label>
                  <input id="tanggal_lahir" name="tanggal_lahir" class="form-control datepicker" placeholder="Silahkan Pilih Tanggal" type="text" id="datepicker" name="WaktuPembuatan" value="{{ old('WaktuPembuatan') }}" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Nomor Telepon</label>
                <input id="no_telp" name="no_telp" type="text" class="form-control" placeholder="Nomor Telepon" aria-label="Nomor Telepon" required>
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" placeholder="Email" aria-label="Email" required>
              </div>
              <div class="mb-3">
                <label for="donatur_donasiFoto" class="form-control-label">Password</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Password" aria-label="Password" required>
              </div>
              <div class="text-center">
                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
              </div>
              <p class="text-sm mt-3 mb-0">Sudah punya akun? Langsung <a href="{{ URL::route('donatur.showLogin') }}" class="text-dark font-weight-bolder"> Log in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
  $('#register-form').on('submit', function(event) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    event.preventDefault();
    let dataForm = new FormData($(this)[0]);

    $.ajax({
      url: $(this).attr("action"),
      method: "POST",
      data: dataForm,
      contentType: false,
      cache: false,
      processData: false,
      success: function(data) {
        Swal.fire({
          title: 'Berhasil!',
          type: "success",
          text: data.message,
          showConfirmButton: false,
        });
        setTimeout(function() {
          Swal.close();
          window.location.href = data.route;
        }, 2000);
      },

      error: (data) => {
        if (data.responseJSON.status == "failed") {
          Swal.fire({
            title: 'Perhatian!',
            type: "error",
            text: data.responseJSON.message,
            showConfirmButton: false
          });
          setTimeout(function() {
            Swal.close();
          }, 2000);
        }
      }
    });
  });
</script>
@endsection