@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Satuan</p>
          </div>
        </div>
        <form id="satuan-form" action="{{ $dataSatuan->id }}" method="post" role="form">
            <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input id="satuan" name="nama" class="form-control" type="text" value="{{ $dataSatuan->nama }}">
                    </div>
                </div>
            </div>
            <button type="submit" id="action" value="" class="submit btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
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
      $('#satuan-form').on('submit', function(event) {
        event.preventDefault();
        var id = $(this).attr('action');
        let route_url = "{{ URL::route('admin.edit-satuan', ':id') }}"
        route_url = route_url.replace(':id', id);
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
              text: "Update Data Gagal!",
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
