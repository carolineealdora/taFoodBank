@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
  <div class="card shadow-lg mx-4">
    <div class="card-body p-3">
      <div class="row gx-4">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            <a href="{{ asset('storage/'.$getData->foto) }}" data-pswp-width="1669" data-pswp-height="2500">
              <img src="{{ asset('storage/'.$getData->foto) }}" class="avatar avatar-lg" alt="profilePIC">
            </a>
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{$getData->userData->nama}}
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
          <form id="edit-donatur-form" action="{{$getData->id}}" method="post" enctype="multipart/form-data" role="form">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile Donatur</p>
                <button type="submit" class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="donatur_donasiFoto" class="form-control-label">Foto Profile Donatur</label>
                  <input class="form-control" type="file" id="foto" name="foto">
                  <p><small style="color: red;">* Jika tidak ingin diubah harap dikosongkan</small></p>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama</label>
                    <input class="form-control" id="nama" name="nama" type="text" value="{{$getData->userData->nama}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nomor Identitas</label>
                    <input class="form-control" id="no_identitas" name="no_identitas" type="text" value="{{$getData->no_identitas}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Tanggal Lahir</label>
                    <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="text" value="{{$getData->tanggal_lahir}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nomor Telepon</label>
                    <input class="form-control" id="no_telp" name="no_telp" type="text" value="{{$getData->no_telp}}">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Alamat Lengkap</label>
                    <input class="form-control" id="alamat" name="alamat" type="text" value="{{$getData->alamat}}">
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <p class="text-uppercase text-sm">Informasi Akun</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email</label>
                    <input class="form-control" id="email" name="email" type="email" value="{{$getData->userData->email}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Password</label>
                    <input class="form-control" id="passowrd" name="password" type="password">
                    <p><small style="color: red;">* Jika tidak ingin diubah harap dikosongkan</small></p>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <button id="{{$getData->id}}" class="action-delete btn btn-danger btn-sm ms-auto col-12 mt-4">Hapus Data Donatur</button>
      </div>
    </div>
    {{-- </div> --}}
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
    $('#edit-donatur-form').on('submit', function(event) {
      event.preventDefault();
      var id = $(this).attr('action');
      let route_url = "{{ URL::route('admin.edit-donatur', ':id') }}"
      route_url = route_url.replace(':id', id);

      let dataForm = new FormData($(this)[0]);
      Swal.fire({
        title: "Apakah Data yang anda masukan benar?",
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
                // window.location.href = data.route;
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
            icon: 'error',
            confirmButtonText: 'Oke'
          });
          setTimeout(function() {
            Swal.close();
          }, 2000);
        }
      })
    });

    $(document).on('click', '.action-delete', function() {
      let id = $(this).attr("id");
      let route_url = "{{ URL::route('admin.delete-donatur', ':id') }}"
      route_url = route_url.replace(':id', id);

      event.preventDefault();
      Swal.fire({
        title: "Apakah anda yakin Ingin Menghapus Data?",
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
            type: "DELETE",
            url: route_url,
            success: function(data) {
              console.log(data)
              Swal.fire({
                title: 'Berhasil!',
                type: "success",
                text: data.message,
                showConfirmButton: false,
              });
              setTimeout(function() {
                Swal.close();
                // window.location.href = data.route;
              }, 2000);
            },

            error: (data) => {
              console.log(data)
              if (data.responseJSON.status == "failed") {
                Swal.fire({
                  title: 'Perhatian!',
                  text: data.responseJSON.message,
                  icon: 'error',
                  confirmButtonText: 'Oke'
                });
                setTimeout(function() {
                  Swal.close();
                }, 2000);
              }
            }
          })
        } else {
          Swal.fire({
            title: 'Perhatian!',
            text: 'Data Gagal Dihapus!',
            icon: 'error',
            confirmButtonText: 'Oke'
          });
          setTimeout(function() {
            Swal.close();
          }, 2000);
        }
      })
    })
    </script>
    @endsection
