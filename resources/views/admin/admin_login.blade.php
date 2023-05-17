@extends('layouts.layouts_backendweb.ngo.ngo_login_master')

@section('ngo_login_content')
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
                <form role="form">
                  <div class="mb-3">
                    <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email">
                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                  </div>
                  <!-- <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div> -->
                  <div class="text-center">
                    <button type="button" class="btn btn-lg btn-success btn-lg w-100 mt-4 mb-0">Log in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-success h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('{{ asset('assets/backendweb/img/admin/login-bg.jpg') }}');
        background-size: cover;">
              <span class="mask bg-gradient-success opacity-6"></span>
              <h4 class="mt-5 text-white font-weight-bolder position-relative">"Sharing is Caring"</h4>
              <p class="text-white position-relative">Selamat Datang Admin! Terima kasih sudah menjadi bagian dari FoodBank Kita.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection