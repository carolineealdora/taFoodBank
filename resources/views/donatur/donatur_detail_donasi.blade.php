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
                </h5>
                <p class="mb-0">
                  diperbarui pada
                  <span class="text-success text-sm font-weight-bolder">25/03/2023</span>
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
                  <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#all-status" role="tab" aria-controls="preview" aria-selected="true">
                  <i class="ni ni-badge text-sm me-2"></i> All Status
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#submitted" role="tab" aria-controls="code" aria-selected="false">
                    <i class="ni ni-laptop text-sm me-2"></i> Data Donasi dari Donatur
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pickedup" role="tab" aria-controls="preview" aria-selected="true">
                  <i class="ni ni-badge text-sm me-2"></i> Data Pick Up Donasi
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pelaporan" role="tab" aria-controls="code" aria-selected="false">
                    <i class="ni ni-laptop text-sm me-2"></i> Pelaporan Distribusi Donasi
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- {{$data}} --}}
    {{-- @for($data as $item) --}}
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
                    <li class="list-group-item border-0 d-flex p-4 mb-0 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">Submitted oleh Donatur</h6>
                        <span class="mb-1 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">{{ $donasi_konsumsi }}</span></span>
                    </div>
                    </li>
                    <li class="list-group-item border-0 d-flex p-4 mb-0 mt-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">Disetujui oleh NGO</h6>
                        <span class="mb-1 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">25/03/2023 - 10:10</span></span>
                      </div>
                    </li>
                    <li class="list-group-item border-0 d-flex p-4 mb-0 mt-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">Picked Up</h6>
                        <span class="mb-1 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">25/03/2023 - 10:10</span></span>
                      </div>
                    </li>
                    <li class="list-group-item border-0 d-flex p-4 mb-0 mt-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">Dalam Pengiriman</h6>
                        <span class="mb-1 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">25/03/2023 - 10:10</span></span>
                      </div>
                    </li>
                    <li class="list-group-item border-0 d-flex p-4 mb-0 mt-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-sm">Berhasil Dikirim</h6>
                        <span class="mb-1 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">25/03/2023 - 10:10</span></span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show active" id="submitted" role="tabpanel" aria-labelledby="submitted-tab">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Data Donasi dari Donatur</p>
                  {{-- <div class="ms-auto text-end">
                    <button class="btn btn-dark btn-sm ms-auto">Edit</button>
                    <button class="btn btn-danger btn-sm ms-auto">Delete</button>
                  </div> --}}
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Form Data Donasi</p>
                <div class="row">
                  <div class="form-group col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Nama Makanan/Minuman</label>
                      <input class="form-control" type="text" value="lucky.jesse">
                    </div>
                    <div class="form-group">
                      <label for="deskripsiDonasi" class="form-control-label">Deskripsi</label>
                      <input class="form-control" type="text" value="lucky.jesse">
                    </div>
                    <div class="form-group">
                      <label for="donatur_donasiFoto" class="form-control-label">Foto Makanan/Minuman</label>
                    {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
                    <input class="form-control" type="file" id="donasiFoto" name="donasiFoto" value="{{ old('AdminFoto') }}" onchange="previewImage()">
                    @error('AdminFoto')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="WaktuExpired" class="form-control-label">Perkiraan Tanggal Expired</label>
                      <input class="form-control datepicker" placeholder="Silahkan Pilih Tanggal" type="text" id="datepicker" name="WaktuPembuatan" value="{{ old('WaktuPembuatan') }}" required>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <div class="form-group">
                      <label for="kategoriDonasi">Kategori</label>
                      <select class="form-control" id="kategoriDonasi">
                        <option>Makanan</option>
                        <option>Minuman</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="jenisDonasi">Jenis</label>
                      <select class="form-control" id="jenisDonasi">
                        <option>Daging</option>
                        <option>Susu</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Kuantitas</label>
                      <input class="form-control" type="text" value="lucky.jesse">
                    </div>
                    <div class="form-group">
                      <label for="satuanDonasi">Satuan</label>
                      <select class="form-control" id="satuanDonasi">
                        <option>Kilogram</option>
                        <option>Liter</option>
                      </select>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-sm ms-auto">Simpan</button>
                {{-- <hr class="horizontal dark"> --}}
                @foreach ($donasi_konsumsi as $item)
                <div class="card-body pt-2 p-3">
                  <p class="text-uppercase text-sm">Data Donasi</p>
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <div class="mb-2">
                          <img src="{{asset('assets\backendweb\img\team-1.jpg')}}" class="avatar avatar-lg me-3" alt="user1">
                        </div>
                        <h6 class="text-sm">{{ $item->nama }}</h6>
                        <span class="text-xs">Deskripsi: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->deskripsi }}</span></span><br>
                        <div class="row">
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Perkiraan Tanggal Expired: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->expired }}</span></span><br>
                          </div>
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Kategori: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->kategori }}</span></span><br>                          </div>
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Kuantitas: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->kuantitas }}</span></span><br>
                            <span class="mb-2 text-xs">Satuan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->satuan }}</span></span><br>
                          </div>
                        </div>
                      </div>
                      <div class="ms-auto text-end">
                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                      </div>
                    </li>
                  </ul>
                </div>
                @endforeach
                <hr class="horizontal dark">
                <p class="text-uppercase text-sm">Form Pickup Donasi</p>
                <div class="form-group">
                  <label for="kotaDonasi">Pickup Location - Kota</label>
                  <select class="form-control" id="kotaDonasi">
                    <option>Malang</option>
                    <option>Jakarta</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ngoDonasi">NGO Tujuan</label>
                  <select class="form-control" id="ngoDonasi">
                    <option>Garda Pangan</option>
                    <option>FOI</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Nama</label>
                      <input class="form-control" type="email" value="Email">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Nomor Telepon</label>
                      <input class="form-control" type="password" value="Password">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Pickup Location - Alamat Lengkap</label>
                      <input class="form-control" type="text" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                  </div>
                </div>
                {{-- <button class="btn btn-primary btn-sm ms-auto">Simpan</button>
                <div class="card-body pt-4 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <span class="mb-2 text-xs">NGO Tujuan: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                            <span class="mb-2 text-xs">Nomor Telepon: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                            <span class="mb-2 text-xs">Pickup Location - Kota: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                            <span class="mb-2 text-xs">Pickup Location - Alamat Lengkap: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                      </div>
                      <div class="ms-auto text-end">
                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                      </div>
                    </li>
                  </ul>
                </div> --}}
                {{-- <hr class="horizontal dark"> --}}
                <button class="btn btn-success btn-sm ms-auto col-12">Submit Seluruh Data Donasi</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show active" id="pickedup" role="tabpanel" aria-labelledby="pickedup-tab">
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
                            <span class="mb-2 text-xs">Tanggal & Waktu Pick Up: <span class="text-dark ms-sm-2 font-weight-bold">{{ $donasi }}</span></span>
                            <span class="mb-2 text-xs">NGO Tujuan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $donasi->ngo_tujuan }}</span></span>
                            <span class="mb-2 text-xs">Nama: <span class="text-dark ms-sm-2 font-weight-bold">{{ $donasi->nama_pickup }}</span></span>
                              <span class="mb-2 text-xs">Nomor Telepon: <span class="text-dark ms-sm-2 font-weight-bold">{{ $donasi->no_telp_pickup }}</span></span>
                              <span class="mb-2 text-xs">Pickup Location - Kota: <span class="text-dark ms-sm-2 font-weight-bold">{{ $donasi->ngo_tujuan }}</span></span>
                              <span class="mb-2 text-xs">Pickup Location - Alamat Lengkap: <span class="text-dark ms-sm-2 font-weight-bold">{{ $donasi->alamat_pickup }}</span></span>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <hr class="horizontal dark mt-0">
                  <p class="text-uppercase text-sm">Data Donasi - Picked Up</p>
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <div class="mb-2">
                          <img src="{{asset('assets\backendweb\img\team-1.jpg')}}" class="avatar avatar-lg me-3" alt="buktifotopickedup">
                        </div>
                        <h6 class="text-sm">Nama Makanan/Minuman</h6>
                        <span class="text-xs">Deskripsi: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span><br>
                        <div class="row">
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Perkiraan Tanggal Expired: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span><br>
                          </div>
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Kategori: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span><br>
                            <span class="mb-2 text-xs">Jenis: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span><br>
                          </div>
                          <div class="form-group col-4">
                            <span class="mb-2 text-xs">Kuantitas: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span><br>
                            <span class="mb-2 text-xs">Satuan: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span><br>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade show active" id="pelaporan" role="tabpanel" aria-labelledby="pelaporan-tab">
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
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        {{-- <div class="gallery" id="gallery"> --}}
                          <div class="row">
                            <div class="col-auto mb-2">
                              <a href="{{asset('assets\backendweb\img\team-2.jpg')}}" data-pswp-width="1669"
                              data-pswp-height="2500">
                                <img src="{{asset('assets\backendweb\img\team-2.jpg')}}" class="avatar avatar-lg" alt="buktifotopickedup">
                              </a>
                            </div>
                            <div class="col-auto mb-2">
                              <a href="{{asset('assets\backendweb\img\team-2.jpg')}}">
                                <img src="{{asset('assets\backendweb\img\team-2.jpg')}}" class="avatar avatar-lg" alt="buktifotopickedup">
                              </a>
                            </div>
                            <div class="col-auto mb-2">
                              <a href="{{asset('assets\backendweb\img\team-2.jpg')}}">
                                <img src="{{asset('assets\backendweb\img\team-2.jpg')}}" class="avatar avatar-lg" alt="buktifotopickedup">
                              </a>
                            </div>
                          </div>
                        {{-- </div> --}}
                        <div class="mt-4">
                          <h6 class="text-sm">Deskripsi</h6>
                          <span class="text-xs"><span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span><br>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
