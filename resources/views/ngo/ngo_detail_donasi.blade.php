@extends('layouts.layouts_backendweb.ngo.ngo_master')

@section('ngo_content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Current Status</p>
                <h5 class="font-weight-bolder">
                  {{$dataCurrentLog->status_message}}
                </h5>
                <p class="mb-0">
                  diperbarui pada
                  <span class="text-success text-sm font-weight-bolder">{{$dataCurrentLog->created_at}}</span>
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-watch-time text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-content mt-4">
      <div class="tab-pane fade show active" id="ll" role="tabpanel" aria-labelledby="all-status-tab">
        <div class="col-md-12">
          <div class="card p-3">
            <div class="nav-wrapper position-relative end-0 mt-1">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#all-status" role="tab" aria-controls="preview" aria-selected="true">
                    <i class="ni ni-badge text-sm me-2"></i> All Status
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#submitted" role="tab" aria-controls="code" aria-selected="false">
                    <i class="ni ni-laptop text-sm me-2"></i> Data Donasi dari Donatur
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pickedup" role="tab" aria-controls="code" aria-selected="false">
                    <i class="ni ni-badge text-sm me-2"></i> Data Pick Up Donasi
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pelaporan" role="tab" aria-controls="code" aria-selected="false">
                    <i class="ni ni-laptop text-sm me-2"></i> Pelaporan Distribusi Donasi
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-content mt-3">
      <div class="tab-pane fade show active" id="all-status" role="tabpanel" aria-labelledby="all-status-tab">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">All Status</p>
                </div>
              </div>
              <div class="card-body">
                <div class="card-body pt-0 p-3">
                  <ul class="list-group">
                    @foreach($dataLog as $log)
                    <li class="list-group-item border-0 d-flex p-4 mb-3 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">{{$log->status_message}}</h6>
                        <span class="mb-1 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">{{$log->created_at}}</span></span>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show" id="submitted" role="tabpanel" aria-labelledby="submitted-tab">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Data Donasi dari Donatur</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Data Donatur</p>
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="text-sm">Nama Donatur: {{$dataUser->nama}} </h6>
                        <span class="mb-2 text-xs">Alamat: <span class="text-dark font-weight-bold ms-sm-2">{{$dataDonasi->donaturData->alamat}}</span></span>
                        <span class="mb-2 text-xs">Nomor Telepon: <span class="text-dark ms-sm-2 font-weight-bold">{{$dataDonasi->donaturData->no_telp}}</span></span>
                        <span class="mb-2 text-xs">Email: <span class="text-dark ms-sm-2 font-weight-bold">{{$dataUser->email}}</span></span>
                      </div>
                    </li>
                  </ul>
                </div>
                <p class="text-uppercase text-sm">Lokasi Pick Up Donasi</p>
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="text-sm">Pick Up Location - {{$dataDonasi->kotaData->nama}}</h6>
                        <span class="mb-2 text-xs">Nama: <span class="text-dark font-weight-bold ms-sm-2">{{$dataDonasi->nama_pickup}}</span></span>
                        <span class="mb-2 text-xs">Nomor Telepon: <span class="text-dark ms-sm-2 font-weight-bold">{{$dataDonasi->no_telp_pickup}}</span></span>
                        <span class="mb-2 text-xs">Alamat: <span class="text-dark ms-sm-2 font-weight-bold">{{$dataDonasi->alamat_pickup}}</span></span>
                      </div>
                    </li>
                  </ul>
                </div>
                <p class="text-uppercase text-sm">Data Donasi</p>
                @foreach($dataDonKom as $item)
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <div class="mb-2">
                          <img src="{{ asset('storage/'.$item->photo) }}" class="avatar avatar-lg me-3" alt="user1">
                        </div>
                        <h6 class="mb-2 text-sm">Nama {{$item->nama}}</h6>
                        <span class="mb-2 text-xs">Submitted at: <span class="text-dark font-weight-bold ms-sm-2">{{$item->created_at}}</span></span>
                        <span class="mb-2 text-xs">Deskripsi: <span class="text-dark font-weight-bold ms-sm-2">{{$item->deskripsi}}</span></span><br>
                        <div class="row">
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Perkiraan Tanggal Expired: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->expired}}</span></span><br>
                          </div>
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Kuantitas: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->kuantitas}}</span></span><br>
                            <span class="mb-2 text-xs">Satuan: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->dataSatuan->nama}}</span></span><br>
                          </div>
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Kategori: <span class="text-dark ms-sm-2 font-weight-bold">{{$item->dataKategori->nama}}</span></span><br>
                          </div>

                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                @endforeach
                @if($dataDonasi->status_donasi == 0)
                <div class="row">
                  <button id="{{$dataDonasi->id}}" class="btn btn-success btn-sm ms-auto col-md-6 approve">Approve</button>
                  <button id="{{$dataDonasi->id}}" class="btn btn-danger btn-sm ms-auto col-md-6 reject">Reject</button>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show" id="pickedup" role="tabpanel" aria-labelledby="pickedup-tab">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Data Pick Up Donasi</p>
                </div>
              </div>
              <div class="card-body">
                @foreach($dataPickup as $pickup)
                <div class="card-body">
                  <div class="card-body pt-2 p-3">
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                          @if($pickup->photo !='default')
                          <div class="mb-2">
                            <img src="{{ asset('storage/'.$pickup->photo) }}" class="avatar avatar-lg me-3" alt="user1">
                          </div>
                          @else
                          <div class="mb-2">
                            <img src="{{asset('assets\dummy.png')}}" class="avatar avatar-lg me-3" alt="user1">
                          </div>
                          @endif
                          <h6 class="text-sm">Nama {{$pickup->nama}}</h6>
                          <span class="text-xs">Deskripsi: <span class="text-dark font-weight-bold ms-sm-2">{{$pickup->deskripsi}}</span></span><br>
                          <div class="row">
                            <div class="form-group col-4">
                              <span class="mb-2 text-xs">Perkiraan Tanggal Expired: <span class="text-dark ms-sm-2 font-weight-bold"></span>{{$pickup->expired}}</span><br>
                            </div>
                            <div class="form-group col-4">
                              <span class="mb-2 text-xs">Kuantitas: <span class="text-dark ms-sm-2 font-weight-bold">{{$pickup->kuantitas}}</span></span><br>
                              <span class="mb-2 text-xs">Satuan: <span class="text-dark ms-sm-2 font-weight-bold">{{$pickup->dataSatuan->nama}}</span></span><br>
                            </div>
                            <div class="form-group col-4">
                              <span class="mb-2 text-xs">Kategori: <span class="text-dark ms-sm-2 font-weight-bold">{{$pickup->dataKategori->nama}}</span></span><br>
                            </div>
                          </div>
                        </div>
                        @if($pickup->waktu_pickup == "")
                        <div class="ms-auto text-end">
                          <a class="delete-confirm btn btn-link text-danger text-gradient px-3 mb-0" href="{{ URL::route('ngo.deletePickup', ['id' => $pickup->id]) }}"><i class="far fa-trash-alt me-2"></i>Delete</a>
                          <button action="" id="{{$pickup->id}}" value="{{$pickup}}" type="button" class="open-modal btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#formModal"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</button>
                        </div>
                        @endif
                      </li>
                    </ul>
                  </div>
                </div>
                @endforeach
                <hr class="horizontal dark">
                @if($dataPickup[0]->waktu_pickup == "")
                <p class="text-uppercase text-sm">Bukti Pick Up Donasi</p>
                <form id="add-tanggal-form" action="{{ URL::route('ngo.addTimePickup', ['id' => $dataDonasi->id]) }}" method="post" role="form">
                  <div class="form-group">
                    <label for="WaktuExpired" class="form-control-label">Tanggal & Waktu Pick Up</label>
                    <input class="form-control datepicker" placeholder="Silahkan Pilih Tanggal" type="datetime-local" id="datepicker" name="WaktuPembuatan" value="{{ old('WaktuPembuatan') }}" required>
                  </div>
                  <button type="submit" class="btn btn-success btn-sm ms-auto col-12">Submit</button>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show" id="pelaporan" role="tabpanel" aria-labelledby="pelaporan-tab">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Pelaporan Distibusi Donasi</p>
                </div>
              </div>
              <div class="card-body">
              @if($dataReport == 0)
                <p class="text-uppercase text-sm">Form Data Donasi</p>
                <form id="report-donasi" action="{{ URL::route('ngo.reportDonasi', $dataDonasi->id) }}" method="post" enctype="multipart/form-data" role="form">
                  <div class="row">
                    <div class="form-group">
                      <label for="donatur_donasiFoto" class="form-control-label">Foto Pengiriman Donasi</label>
                      <input class="form-control" type="file" id="photo" name="photo" required>
                    <div class="form-group">
                      <label for="deskripsiDonasi" class="form-control-label">Deskripsi</label>
                      <input class="form-control" id="deskripsi" name="deskripsi" type="text" value="" placeholder="deskripsi donasi" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success btn-sm ms-auto">Upload</button>
                </form>
                @else
                <div class="row">
                  <h7 class="text-center alert alert-success">Laporan Sudah Diisi!</h7>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Form Modal -->
  <div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" class="text-uppercase text-sm">Form Data Donasi</h5>
        </div>
        <div class="modal-body">
          <form id="edit-form" action="" method="post" enctype="multipart/form-data" role="form">
            <div class="row">
              <div class="form-group col-md-6">
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Nama Makanan/Minuman</label>
                  <input id="nama" name="nama" class="form-control" type="text" value="" required>
                </div>
                <div class="form-group">
                  <label for="deskripsiDonasi" class="form-control-label">Deskripsi</label>
                  <input id="deskripsi" name="deskripsi" class="form-control" type="text" value="" required>
                </div>
                <div class="form-group">
                  <label for="donatur_donasiFoto" class="form-control-label">Foto Makanan/Minuman</label>
                  <input class="form-control" type="file" id="donasiFoto" name="donasiFoto">
                  <p><small style="color: red;">* Jika tidak ingin diubah harap dikosongkan</small></p>
                </div>
                <div class="form-group">
                  <label for="WaktuExpired" class="form-control-label">Perkiraan Tanggal Expired</label>
                  <input id="expired" name="expired" class="form-control datepicker" placeholder="Silahkan Pilih Tanggal" type="text" id="datepicker" name="WaktuPembuatan" value="" required>
                </div>
              </div>
              <div class="form-group col-md-6">
                <div class="form-group">
                  <label for="kategoriDonasi">Kategori</label>
                  <select id="kategori" name="kategori" class="form-control" id="kategoriDonasi" required>
                    @foreach($kategori as $category)
                    <option value="{{$category->id}}">{{$category->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Kuantitas</label>
                  <input id="kuantitas" name="kuantitas" class="form-control" type="text" value="" required>
                </div>
                <div class="form-group">
                  <label for="satuanDonasi">Satuan</label>
                  <select id="satuan" name="satuan" class="form-control" id="satuanDonasi" required>
                    @foreach($satuan as $metric)
                    <option value="{{$metric->id}}">{{$metric->nama}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" id="action" value="" class="confirm btn btn-primary btn-sm ms-auto">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Form Modal -->
  <!-- custom script -->
  <script>
    $(document).on('click', '.open-modal', function(event) {
      var id = $(this).attr('id');
      var value = $(this).attr('value');
      var jsonify = JSON.parse(value)
      document.getElementById("nama").setAttribute("value", jsonify.nama);
      document.getElementById("deskripsi").setAttribute("value", jsonify.deskripsi);
      document.getElementById("expired").setAttribute("value", jsonify.expired);
      document.getElementById("kuantitas").setAttribute("value", jsonify.kuantitas);
      const $selectKategori = document.querySelector('#kategori');
      $selectKategori.value = jsonify.kategori
      const $selectSatuan = document.querySelector('#satuan');
      $selectSatuan.value = jsonify.satuan
      document.getElementById("edit-form").setAttribute("action", id);
    })

    $('#edit-form').on('submit', function(event) {
      event.preventDefault();
      var id = $(this).attr('action');
      let route_url = "{{ URL::route('ngo.editPickup', ':id') }}"
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
        } else {
          Swal.fire({
            title: 'Perhatian!',
            text: "Update Data Gagal!",
            type: 'error',
            showConfirmButton: false,
          });
          setTimeout(function() {
            Swal.close();
          }, 2000);
        }
      })
    });

    $('#report-donasi').on('submit', function(event) {
      event.preventDefault();
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
            url:  $(this).attr('action'),
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
                  showConfirmButton: false,
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
            text: "Data Gagal Ditambahkan!",
            type: 'error',
            showConfirmButton: false
          });
          setTimeout(function() {
            Swal.close();
          }, 2000);
        }
      })
    });

    $('#add-tanggal-form').on('submit', function(event) {
      event.preventDefault();

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
            url: $(this).attr("action"),
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
      let route_url = "{{ URL::route('ngo.donasiApprove', ':id') }}"
      route_url = route_url.replace(':id', id);

      event.preventDefault();
      Swal.fire({
        title: "Apakah anda yakin ingin menerima NGO?",
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

    $(document).on('click', '.reject', function() {
      let id = $(this).attr("id");
      let route_url = "{{ URL::route('ngo.donasiCancel', ':id') }}"
      route_url = route_url.replace(':id', id);

      event.preventDefault();
      Swal.fire({
        title: "Apakah anda yakin ingin menolak NGO?",
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

    $(document).on('click', '.delete-confirm', function() {
      event.preventDefault();
      Swal.fire({
        title: "Apakah anda yakin ingin menghapus data?",
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
            url: $(this).attr("href"),
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
          })
        } else {
          Swal.fire({
            title: 'Perhatian!',
            text: 'Data Gagal Dihapus!',
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
