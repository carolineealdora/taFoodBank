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
            <form id="register-form" action="{{route('ngo.register')}}" method="post" enctype="multipart/form-data" role="form">
              <div class="card-header text-center pt-4">
                <h5>Data NGO</h5>
              </div>
              <div class="mb-3">
                <label for="ngo_nama" class="form-control-label">Nama NGO</label>
                <input id="ngo_nama" name="ngo_nama" type="text" class="form-control" placeholder="Nama NGO" aria-label="Nama NGO">
              </div>
              <div class="form-group">
                <label for="ngo_kota" class="form-control-label">Kota Kantor NGO</label>
                <select id="ngo_kota" name="ngo_kota" class="form-control" id="kotaDonasi">
                  @foreach($kota as $item)
                  <option value="{{ $item->id }}">{{ $item->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="ngo_alamat" class="form-control-label">Alamat Kantor NGO</label>
                <input id="ngo_alamat" name="ngo_alamat" type="text" class="form-control" placeholder="Alamat Kantor NGO" aria-label="Alamat Kantor NGO">
              </div>
              <div class="mb-3"> 
                <label for="ngo_no_telp" class="form-control-label">Nomor Telepon Kantor NGO</label>
                <input id="ngo_no_telp" name="ngo_no_telp" type="text" class="form-control" placeholder="Nomor Telepon Kantor NGO" aria-label="Nomor Telepon Kantor NGO">
              </div>
              <div class="mb-3">
                <label for="email" class="form-control-label">Email Kantor NGO</label>
                <input name="email" id="email" type="email" class="form-control" placeholder="Email Kantor NGO" aria-label="Email Kantor NGO">
              </div>
              <hr class="horizontal dark">
              <div class="card-header text-center pt-0">
                <h5>Data PIC</h5>
              </div>
              <div class="form-group mb-3">
                <label for="pic_foto" class="form-control-label">Foto Profil <span class="mb-2 text-xs font-weight-light">(opsional)</span></label>
                {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
                <input class="form-control" type="file" id="pic_foto" name="pic_foto" value="{{ old('AdminFoto') }}" onchange="previewImage()">
                @error('AdminFoto')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
                </div>
                <div class="mb-3">
                  <label for="nama" class="form-control-label">Nama PIC</label>
                  <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama PIC" aria-label="Nama PIC">
                </div>
                <div class="mb-3">
                  <label for="no_identitas" class="form-control-label">Nomor Identitas (KTP)</label>
                  <input id="no_identitas" name="no_identitas" type="text" class="form-control" placeholder="Nomor Identitas (KTP)" aria-label="Nomor Identitas">
                </div>
              <div class="mb-3">
                <label for="password" class="form-control-label">Password</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Password" aria-label="Password">
              </div>
              <div class="text-center">
                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
              </div>
              <p class="text-sm mt-3 mb-0">NGO sudah terdaftar? Langsung <a href="{{ URL::route('ngo.showLogin') }}" class="text-dark font-weight-bolder"> Log in</a></p>
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
        if (data.status == "failed") {
          Swal.fire({
            title: 'Perhatian!',
            text: data.message,
            icon: 'error',
            confirmButtonText: 'Oke'
          });
        }
      }
    });
  });
</script>
@endsection