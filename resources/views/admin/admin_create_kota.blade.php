@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Kota</p>
          </div>
        </div>
        <form id="kota-form" action="{{ URL::route('admin.store-kota') }}" method="post" role="form">
            <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                    <label for="kota" class="form-control-label">Kota</label>
                    <input id="kota" name="nama" class="form-control" type="text" value="" placeholder="Masukkan Nama Kota">
                </div>
                </div>
            </div>
            <button type="submit" id="action" value="" class="submit btn btn-primary btn-sm ms-auto">Tambah Data Baru</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

  <script>
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  </script>

  <script type="text/javascript">
      $('#kota-form').on('submit', function(event) {
        event.preventDefault();
        let route_url = "{{ URL::route('admin.store-kota') }}"
        let dataForm = new FormData($(this)[0]);
        Swal.fire({
          title: "Apakah data yang anda masukan benar?",
          showCancelButton: true,
          confirmButtonText: "Ya",
          cancelButtonText: "Batal",
          confirmButtonColor: "#28a745",
          cancelButtonColor: "#dc3545",
          focusConfirm: true,
          focusCancel: false
        }).then(result => {
          if (result.value == true) {
            $.ajax({
              url: route_url,
              type: "POST",
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
                    text: data.responseJSON.message,
                    type: 'error',
                    showConfirmButton: false
                  });
                  setTimeout(function() {
                    Swal.close();
                  }, 2000);
                }
              }
            });
          } else {
            Swal.fire({
              title: 'Perhatian!',
              text: "Tambah Data Gagal!",
              type: 'error',
              showConfirmButton: false
            });
            setTimeout(function() {
              Swal.close();
            }, 2000);
          }
        })
      });
  </script>
@endsection
