@extends('layouts.layouts_backendweb.donatur.donatur_login_master')

@section('donatur_login_content')
<main class="main-content  mt-0">
  <section>
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain">
              <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Log In</h4>
                <p class="mb-0">Silahkan Masukkan Email dan Password yang Telah Terdaftar</p>
              </div>
              <div class="card-body">
                <form id="login-form" role="form" action="{{route('user.login', 3)}}" method="post" role="form">
                  <div class="mb-3">
                    <input id="email" name="email" type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" required>
                  </div>
                  <div class="mb-3">
                    <input id="password" name="password" type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" required>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Log in</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Belum memiliki email dan password yang terdaftar?
                  <a href="{{ URL::route('donatur.showRegister') }}" class="text-primary text-gradient font-weight-bold">Daftar Terlebih Dulu</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('{{ asset('assets/backendweb/img/donatur/login-bg.jpg') }}');
        background-size: cover;">
              <span class="mask bg-gradient-primary opacity-6"></span>
              <h4 class="mt-5 text-white font-weight-bolder position-relative">"Sharing is Caring"</h4>
              <p class="text-white position-relative">Selamat Datang Donatur! Donasi dari Anda Memberikan Kekuatan untuk Saudara Kita di Luar Sana.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
<script>
  $('#login-form').on('submit', function(event) {
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
        if (data.responseJSON.status == "fail-verif") {
          Swal.fire({
            title: 'Perhatian!',
            type: "error",
            text: data.responseJSON.message,
            showConfirmButton: false,
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