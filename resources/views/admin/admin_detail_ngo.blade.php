@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="card shadow-lg mx-4">
  <div class="card shadow-lg">
    <div class="card-body p-3">
      <div class="row gx-4">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            <a href="{{ asset('storage/'.$dataUser->pic_foto) }}" data-pswp-width="1669" data-pswp-height="2500">
              <img src="{{ asset('storage/'.$dataUser->pic_foto) }}" class="avatar avatar-lg" alt="profilePIC">
            </a>
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{$dataUser->userData->nama}}
            </h5>
            <p class="mb-1 font-weight-bold text-sm">
              PIC
            </p>
            @if($dataUser->ngo_status == 0)
            <span class="badge badge-sm bg-gradient-warning">Submitted</span>
            @elseif($dataUser->ngo_status == 1)
            <span class="badge badge-sm bg-gradient-success">Approved</span>
            @elseif($dataUser->ngo_status == 2)
            <span class="badge badge-sm bg-gradient-danger">Rejected</span>
            @endif
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
        <form id="edit-ngo-form" action="{{$dataUser->id}}" method="post" enctype="multipart/form-data" role="form">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Profile NGO</p>
              <button type="submit" class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nama NGO</label>
                  <input name="ngo_nama" id="ngo_nama" class="form-control" type="text" value="{{$dataUser->ngo_nama}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="kotaNGO" class="form-control-label">Kota Kantor NGO</label>
                  <select class="form-control" id="ngo_kota" name="ngo_kota">
                    @foreach($kotaData as $kota)
                    @if($kota->id == $dataUser->kotaData->id)
                    <option value="{{$kota->id}}" selected>{{$kota->nama}}</option>
                    @else
                    <option value="{{$kota->id}}">{{$kota->nama}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nomor Telepon Kantor NGO</label>
                  <input id="ngo_no_telp" name="ngo_no_telp" class="form-control" type="text" value="{{$dataUser->ngo_no_telp}}">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Alamat Lengkap Kantor NGO</label>
                  <input id="ngo_alamat" name="ngo_alamat" class="form-control" type="text" value="{{$dataUser->ngo_alamat}}">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container-fluid pb-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form id="edit-pic-form" action="{{$dataUser->id}}" method="post" enctype="multipart/form-data" role="form">
          <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              <p class="mb-0">Profile PIC</p>
              <button id="edit-pic-form" type="submit" class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Email</label>
                  <input id="email" name="email" class="form-control" type="email" value="{{$dataUser->userData->email}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Password</label>
                  <input id="password" name="password" class="form-control" type="password">
                  <p><small style="color: red;">* Jika tidak ingin diubah harap dikosongkan</small></p>
                </div>
              </div>
              <div class="form-group col-md-12">
                <label for="donatur_donasiFoto" class="form-control-label">Foto Profil PIC</label>
                <input id="pic_foto" name="pic_foto" class="form-control" type="file">
                <p><small style="color: red;">* Jika tidak ingin diubah harap dikosongkan</small></p>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nama PIC</label>
                  <input id="nama_user" name="nama_user" class="form-control" type="text" value="{{$dataUser->userData->nama}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nomor Identitas</label>
                  <input id="no_identitas" name="no_identitas" class="form-control" type="text" value="{{$dataUser->no_identitas}}">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @if($dataUser->ngo_status == 0)
  <div class="row">
    <button id="{{$dataUser->id}}" class="approve btn btn-success btn-sm ms-auto col-5 mt-4 mx-5">Approve</button>
    <button id="{{$dataUser->id}}" class="reject btn btn-danger btn-sm ms-auto col-5 mt-4 mx-5">Reject</button>
  </div>
  @endif
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
    $('#edit-ngo-form').on('submit', function(event) {
      event.preventDefault();
      var id = $(this).attr('action');
      let route_url = "{{ URL::route('admin.edit-ngo', ':id') }}"
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

    $('#edit-pic-form').on('submit', function(event) {
      event.preventDefault();
      var id = $(this).attr('action');
      let route_url = "{{ URL::route('admin.edit-pic', ':id') }}"
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

    $(document).on('click', '.approve', function() {
      let id = $(this).attr("id");
      let route_url = "{{ URL::route('admin.ngo-approve', ':id') }}"
      route_url = route_url.replace(':id', id);

      event.preventDefault();
      Swal.fire({
        title: "Apakah anda yakin?",
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
            type: "PUT",
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
                window.location.href = data.route;
              }, 2000);
            },

            error: (data) => {
              console.log(data)
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
          })
        } else {
          Swal.fire({
            title: 'Perhatian!',
            text: 'Status Gagal Diubah!',
            type: 'error',
            showConfirmButton: false
          });
          setTimeout(function() {
            Swal.close();
          }, 2000);
        }
      })
    })

    $(document).on('click', '.reject', function() {
      let id = $(this).attr("id");
      let route_url = "{{ URL::route('admin.ngo-cancel', ':id') }}"
      route_url = route_url.replace(':id', id);

      event.preventDefault();
      Swal.fire({
        title: "Apakah anda yakin?",
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
            type: "PUT",
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
          })
        } else {
          Swal.fire({
            title: 'Perhatian!',
            text: 'Status Gagal Diubah!',
            type: 'error',
            showConfirmButton: false
          });
          setTimeout(function() {
            Swal.close();
          }, 2000);
        }
      })
    })
  </script>
  @endsection
