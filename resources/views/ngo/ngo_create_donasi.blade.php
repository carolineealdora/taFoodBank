@extends('layouts.layouts_backendweb.ngo.ngo_master')

@section('ngo_content')
<div class="container-fluid py-4">
    <div class="tab-pane fade show active" id="submitted" role="tabpanel" aria-labelledby="submitted-tab">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Data Donasi dari ngo</p>
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
                    <label for="ngo_donasiFoto" class="form-control-label">Foto Makanan/Minuman</label>
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
              <div class="card-body pt-2 p-3">
                {{-- <p class="text-uppercase text-sm">Data Donasi</p> --}}
                <ul class="list-group">
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <div class="mb-2">
                        <img src="{{asset('assets\backendweb\img\team-1.jpg')}}" class="avatar avatar-lg me-3" alt="user1">
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
                    <div class="ms-auto text-end">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                      <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    </div>
                  </li>
                </ul>
              </div>
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
</div>
@endsection