@extends('layouts.layouts_backendweb.donatur.donatur_master')

@section('donatur_content')
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
                  <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pickedup" role="tab" aria-controls="preview" aria-selected="false">
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
                  {{-- <button class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button> --}}
                </div>
              </div>
              <div class="card-body">
                {{-- <p class="text-uppercase text-sm">Semua Status Donasi</p> --}}
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
                <div class="row col-12">
                    <div class="d-flex align-items-center col-6">
                        <p class="mb-0">Data Donasi dari Donatur</p>
                    </div>
                    <div class="col-6 text-end">
                        <button action="" id="" value="" type="button" class="open-modal btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#modalAddDonasi"><a class="btn bg-gradient-dark mb-0"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Donasi</a></button>
                    </div>
                </div>

              </div>
              <div class="card-body">
                @foreach ($dataDonKom as $index => $item)
                <div class="card-body pt-2 p-3">
                  <p class="text-uppercase text-sm">Data Donasi</p>
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <div class="mb-2">
                          <img src="{{ asset('storage/'.$item->photo) }}" class="avatar avatar-lg me-3" alt="user1">
                        </div>
                        <h6 class="text-sm">{{ $item->nama }}</h6>
                        <span class="text-xs">Deskripsi: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->deskripsi }}</span></span><br>
                        <div class="row">
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Perkiraan Tanggal Expired: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->expired }}</span></span><br>
                          </div>
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Kategori: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->dataKategori->nama }}</span></span><br>
                            </div>
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Kuantitas: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->kuantitas }}</span></span><br>
                            <span class="mb-2 text-xs">Satuan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->dataSatuan->nama }}</span></span><br>
                          </div>
                        </div>
                      </div>
                      @if($dataDonasi->status_donasi == 1)
                      <div class="ms-auto text-end">
                        <a class="delete-confirm btn btn-link text-danger text-gradient px-3 mb-0" href="{{ URL::route('donatur.deleteDonasiKonsumsi', ['id' => $dataDonKom[0]->id]) }}"><i class="far fa-trash-alt me-2"></i>Delete</a>
                        <button action="" index="{{$index}}" id="{{ $dataDonKom[$index]->id }}" value="{{ $dataDonKom }}" type="button" class="open-modal btn btn-link text-dark px-3 mb-0" data-bs-toggle="modal" data-bs-target="#formModal"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</button>
                      </div>
                      @endif
                    </li>
                  </ul>
                </div>
                @endforeach
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Form Pickup Donasi</p>
                @if($dataDonasi->status_donasi == 1)
                <form id="pickup-donasi-form" action="{{ URL::route('donatur.editPickup', ['id' => $dataDonasi->id]) }}" method="post" role="form">
                    <div class="form-group">
                        <label for="kotaPickup">Pickup Location - Kota</label>
                        <select class="form-control" id="kotaPickup" name="kotaPickup" required>
                            @foreach($kota as $city)
                            <option value="{{$city->id}}" @if($city->id == $dataDonasi->kota) selected @endif>{{$city->nama}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="ngoDonasi">NGO Tujuan</label>
                        <select class="form-control" id="ngoPickup" name="ngoPickup" required>
                            @foreach($ngos as $ngo)
                            <option value="{{$ngo->id}}" @if($ngo->id == $dataDonasi->ngo_tujuan) selected @endif>{{$ngo->ngo_nama}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nama pengirim" class="form-control-label">Nama</label>
                            <input id="namaPickup" name="namaPickup" class="form-control" type="text" value="{{ $dataDonasi->nama_pickup }}" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nomor telepon pengirim" class="form-control-label">Nomor Telepon</label>
                            <input id="noTelp" name="noTelp" class="form-control" type="text" value="{{ $dataDonasi->no_telp_pickup }}" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat pengirim" class="form-control-label">Pickup Location - Alamat Lengkap</label>
                            <input id="alamatPickup" name="alamatPickup" class="form-control" type="text" value="{{ $dataDonasi->alamat_pickup }}" required>
                        </div>
                      </div>
                      <button type ="submit" class="btn btn-success btn-sm ms-auto col-12">Submit Seluruh Data Donasi</button>
                </form>
                @else
                <form id="pickup-donasi-form" action="{{ URL::route('donatur.editPickup', ['id' => $dataDonasi->id]) }}" method="post" role="form">
                    <div class="form-group">
                        <label for="kotaDonasi">Pickup Location - Kota</label>
                        <select class="form-control" id="kotaDonasi" name="kotaDonasi" required>
                            @foreach($kota as $city)
                            <option value="{{$city->id}}">{{$city->nama}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="ngoDonasi">NGO Tujuan</label>
                        <select class="form-control" id="ngoDonasi" name="ngoDonasi" required>
                            @foreach($ngos as $ngo)
                            <option value="{{$ngo->id}}">{{$ngo->ngo_nama}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nama pengirim" class="form-control-label">Nama</label>
                            <input id="nama" name="nama" class="form-control" type="text" value="" readonly required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nomor telepon pengirim" class="form-control-label">Nomor Telepon</label>
                            <input id="noTelp" name="noTelp" class="form-control" type="text" value="" readonly required>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat pengirim" class="form-control-label">Pickup Location - Alamat Lengkap</label>
                            <input id="alamat" name="alamat" class="form-control" type="text" value="" readonly required>
                        </div>
                      </div>
                </form>
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
                  {{-- <button class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button> --}}
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Data - Picked Up</p>
                <div class="card-body pt-0 p-3">
                  <div class="card-body pt-1 p-3">
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex p-4 mb-1 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            {{-- <h6 class="text-sm">Data Pickup</h6> --}}
                            <span class="mb-2 text-xs">Tanggal & Waktu Pick Up: <span class="text-dark ms-sm-2 font-weight-bold">
                                @if($dataPickup !== null && $dataPickup == 'undefined')
                                    {{ $dataPickup[0]->waktu_pickup }}
                                @endif
                            </span></span>
                            <span class="mb-2 text-xs">NGO Tujuan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonasi->ngo->ngo_nama }}</span></span>
                            <span class="mb-2 text-xs">Nama: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonasi->nama_pickup }}</span></span>
                              <span class="mb-2 text-xs">Nomor Telepon: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonasi->no_telp_pickup }}</span></span>
                              <span class="mb-2 text-xs">Pickup Location - Kota: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonasi->kotaData->nama }}</span></span>
                              <span class="mb-2 text-xs">Pickup Location - Alamat Lengkap: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonasi->alamat_pickup }}</span></span>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <hr class="horizontal dark mt-0">
                  <p class="text-uppercase text-sm">Data Donasi - Picked Up</p>
                  @if(empty($dataPickup) == 0)
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="text-sm">Donasi Belum di Pick Up NGO</h6>
                      </div>
                    </li>
                  </ul>
                  @else
                    @foreach ($dataPickup as $pickup)
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <div class="mb-2">
                            <img src="{{ asset('storage/'.$pickup->photo ) }}" class="avatar avatar-lg me-3" alt="Bukti foto donasi konsumsi yang berhasil dipick ep">
                            </div>
                            <h6 class="text-sm">{{ $pickup->nama }}</h6>
                            <span class="text-xs">Deskripsi: <span class="text-dark font-weight-bold ms-sm-2">{{ $pickup->deskripsi }}</span></span><br>
                            <div class="row">
                            <div class="form-group col-4">
                                <span class="mb-2 text-xs">Perkiraan Tanggal Expired: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pickup->expired }}</span></span><br>
                            </div>
                            <div class="form-group col-4">
                                <span class="mb-2 text-xs">Kategori: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pickup->dataKategori->nama }}</span></span><br>
                            </div>
                            <div class="form-group col-4">
                                <span class="mb-2 text-xs">Kuantitas: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pickup->kuantitas }}</span></span><br>
                                <span class="mb-2 text-xs">Satuan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pickup->dataSatuan->nama }}</span></span><br>
                            </div>
                            </div>
                        </div>
                        </li>
                    </ul>
                    @endforeach
                  @endif
                </div>
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
                  {{-- <button class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button> --}}
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Data Laporan</p>
                @if(empty($dataReport) == 0)
                <ul class="list-group">
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="text-sm">Belum Ada Laporan Donasi dari NGO</h6>
                    </div>
                  </li>
                </ul>
                @else
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        @foreach($dataReport as $item)
                          <div class="row">
                            <div class="col-auto mb-2">
                              <a href="{{ asset('storage/'.$item->foto_laporan) }}" data-pswp-width="1669"
                              data-pswp-height="2500">
                                <img src="{{ asset('storage/'.$item->foto_laporan) }}" class="avatar avatar-lg" alt="buktifotopickedup">
                              </a>
                            </div>
                          </div>
                        <div class="mt-4">
                          <h6 class="text-sm">Deskripsi</h6>
                          <span class="text-xs"><span class="text-dark font-weight-bold ms-sm-2">{{ $item->deskripsi }}</span></span><br>
                        </div>
                        @endforeach
                      </div>
                    </li>
                  </ul>
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
                  {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
                  {{-- <input class="form-control" type="file" id="donasiFoto" name="donasiFoto" value="{{ old('AdminFoto') }}" onchange="previewImage()"> --}}
                  <input class="form-control" type="file" id="donasiFoto" name="donasiFoto">
                  <p><small style="color: red;">* Jika tidak ingin diubah harap dikosongkan</small></p>
                  {{-- @error('AdminFoto')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror --}}
                </div>
                <div class="form-group">
                  <label for="WaktuExpired" class="form-control-label">Perkiraan Tanggal Expired</label>
                  <input id="expired" name="expired" class="form-control datepicker" placeholder="Silahkan Pilih Tanggal" type="datetime-local" id="datepicker" name="WaktuPembuatan" value="" required>
                </div>
              </div>
              <div class="form-group col-md-6">
                <div class="form-group">
                  <label for="kategoriDonasi">Kategori</label>
                  <select id="kategori" name="kategori" class="form-control" required>
                    @foreach($kategori as $category)
                    <option value="{{$category->id}}">{{$category->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kuantitasDonasi" class="form-control-label">Kuantitas</label>
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
 <!-- Modal Create Donasi-->
 <div id="modalAddDonasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" class="text-uppercase text-sm">Form Data Donasi</h5>
        </div>
        <div class="modal-body">
          <form id="add-donasi-form" action="{{ $dataDonasi->id }}" method="post" enctype="multipart/form-data" role="form">
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
                  {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
                  {{-- <input class="form-control" type="file" id="donasiFoto" name="photo" value="{{ old('donasiFoto') }}"> --}}
                  <input class="form-control" type="file" id="donasiFoto" name="photo">
                  {{-- @error('donasiFoto')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror --}}
                </div>
                <div class="form-group">
                  <label for="WaktuExpired" class="form-control-label">Perkiraan Tanggal Expired</label>
                  <input id="expired" name="expired" class="form-control datepicker" placeholder="Silahkan Pilih Tanggal" type="datetime-local" id="datepicker" name="WaktuPembuatan" value="" required>
                </div>
              </div>
              <div class="form-group col-md-6">
                <div class="form-group">
                  <label for="kategoriDonasi">Kategori</label>
                  <select id="kategori" name="kategori" class="form-control" required>
                    @foreach($kategori as $category)
                    <option value="{{$category->id}}">{{$category->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kuantitasDonasi" class="form-control-label">Kuantitas</label>
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
  <!-- End Modal Create Donasi -->

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
    $(document).on('click', '.open-modal', function(event) {
      var id = $(this).attr('id');
      var index = $(this).attr('index');
      var value = $(this).attr('value');
      var jsonify = JSON.parse(value)[index];
      document.getElementById("nama").setAttribute("value", jsonify.nama);
      document.getElementById("deskripsi").setAttribute("value", jsonify.deskripsi);
      document.getElementById("expired").setAttribute("value", jsonify.expired);
      document.getElementById("kuantitas").setAttribute("value", jsonify.kuantitas);
      const $selectKategori = document.querySelector('#kategori');
      $selectKategori.value = jsonify.kategori
      const $selectSatuan = document.querySelector('#satuan');
      $selectSatuan.value = jsonify.satuan
      document.getElementById("edit-form").setAttribute("action", id);
    });

    $('#edit-form').on('submit', function(event) {
      event.preventDefault();
      var id = $(this).attr('action');
      let route_url = "{{ URL::route('donatur.editDonasi', ':id') }}"
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
              if (data.responseJSON.responseJSON.status == "failed") {
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

    $('#add-donasi-form').on('submit', function(event) {
      event.preventDefault();
      var id = $(this).attr('action');
      let route_url = "{{ URL::route('donatur.add-donasi', ':id') }}"
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
    });

    $('#pickup-donasi-form').on('submit', function(event) {
      event.preventDefault();

      const dataForm = new FormData();

        // Append the form fields to the dataForm object
        dataForm.append('kota', document.querySelector('#kotaPickup').value);
        dataForm.append('ngo_tujuan', document.querySelector('#ngoPickup').value);
        dataForm.append('nama_pickup', document.querySelector('#namaPickup').value);
        dataForm.append('no_telp_pickup', document.querySelector('#noTelp').value);
        dataForm.append('alamat_pickup', document.querySelector('#alamatPickup').value);

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
              if (data.responseJSON.status == "failed") {
                Swal.fire({
                  title: 'Perhatian!',
                  text: data.responseJSON.message,
                  type: 'error',
                  showConfirmButton: false
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
