@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
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
                  Picked Up
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
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#all-status" role="tab" aria-controls="preview" aria-selected="true">
                    <i class="ni ni-badge text-sm me-2"></i> All Status
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#data-donatur-ngo" role="tab" aria-controls="code" aria-selected="false">
                      <i class="ni ni-laptop text-sm me-2"></i> Data Donasi & NGO
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
                        <li class="list-group-item border-0 d-flex p-4 mb-0 bg-gray-100 border-radius-lg">
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
      <div class="tab-pane fade show" id="data-donatur-ngo" role="tabpanel" aria-labelledby="submitted-tab">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                  <p class="mb-0">Data Donatur & NGO</p>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Data Donatur</p>
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="text-sm">{{ $dataDonatur->nama }}</h6>
                        <span class="mb-2 text-xs">Alamat: <span class="text-dark font-weight-bold ms-sm-2">{{ $dataDonasi->donaturData->alamat }}</span></span>
                        <span class="mb-2 text-xs">Nomor Telepon: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonasi->donaturData->no_telp }}</span></span>
                        <span class="mb-2 text-xs">Email: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonatur->email }}</span></span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body">
                <p class="text-uppercase text-sm">Data NGO</p>
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="text-sm">{{ $dataNgo->ngo_nama }}</h6>
                        <span class="mb-2 text-xs">Kota Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">{{ $dataNgoKota->nama }}</span></span>
                        <div class="row">
                          <span class="mb-2 text-xs">Alamat Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">{{ $dataDonasi->ngo->ngo_alamat }}</span></span>
                          <span class="mb-2 text-xs">Nomor Telepon Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">{{ $dataDonasi->ngo->ngo_no_telp }}</span></span>
                          <span class="mb-2 text-xs">Email Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">{{ $dataDonasi->ngo->ngo_nama }}</span></span>
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
                <p class="text-uppercase text-sm">Tanggal & Waktu</p>
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <span class="mb-2 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">{{ $dataDonasi->created_at}}</span></span>
                      </div>
                    </li>
                  </ul>
                </div>
                <p class="text-uppercase text-sm">Lokasi Pick Up Donasi</p>
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <h6 class="text-sm">Pick Up Location - {{ $dataDonasi->kotaData->nama }}</h6>
                        <span class="mb-2 text-xs">Nama: <span class="text-dark font-weight-bold ms-sm-2">{{ $dataDonasi->nama_pickup }}</span></span>
                        <span class="mb-2 text-xs">Nomor Telepon: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonasi->no_telp_pickup }}</span></span>
                        <span class="mb-2 text-xs">Alamat: <span class="text-dark ms-sm-2 font-weight-bold">{{ $dataDonasi->alamat_pickup }}</span></span>
                      </div>
                    </li>
                  </ul>
                </div>
                @foreach ($dataDonKom as $item)
                <p class="text-uppercase text-sm">Data Donasi</p>
                <div class="card-body pt-2 p-3">
                  {{-- <p class="text-uppercase text-sm">Data Donasi</p> --}}
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <div class="mb-2">
                          <img src="{{ asset('storage/'.$item->photo) }}" class="avatar avatar-lg me-3" alt="user1">
                        </div>
                        <h6 class="mb-2 text-sm">{{ $item->nama }}</h6>
                        <span class="mb-2 text-xs">Submitted at: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->created_at }}</span></span>
                        <span class="mb-2 text-xs">Deskripsi: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->deskripsi }}</span></span><br>
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
                    </li>
                  </ul>
                </div>
                @endforeach
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
                  {{-- <div class="card-body pt-2 p-3"> --}}
                    <p class="text-uppercase text-sm">Data Donasi - Picked Up</p>
                    @if(empty($dataPickup) == 0)
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                          <h6 class="text-sm">Donasi Belum Di Pick Up NGO</h6>
                        </div>
                      </li>
                    </ul>
                    @else
                        <p class="text-uppercase text-sm">Tanggal & Waktu</p>
                        <div class="card-body pt-2 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <span class="mb-2 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->waktu_pickup }}</span></span>
                            </div>
                            </li>
                        </ul>
                        </div>
                        @foreach ($dataPickup as $item)
                        <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$item->photo) }}" class="avatar avatar-lg me-3" alt="foto pickup donasi">
                            </div>
                            <h6 class="text-sm">{{ $item->nama }}</h6>
                            {{-- <span class="mb-2 text-xs">Picked Up at: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->waktu_pickup }}</span></span> --}}
                            <span class="text-xs">Deskripsi: <span class="text-dark font-weight-bold ms-sm-2">{{ $item->deskripsi }}</span></span><br>
                            <div class="row">
                                <div class="form-group col-4">
                                <span class="mb-2 text-xs">Perkiraan Tanggal Expired: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->expired }}</span></span><br>
                                </div>
                                <div class="form-group col-4">
                                <span class="mb-2 text-xs">Kategori: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->dataKategori->nama }}</span></span><br>
                                </div>
                                <div class="form-group col-4">
                                <span class="mb-2 text-xs">Kuantitas: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->nama }}</span></span><br>
                                <span class="mb-2 text-xs">Satuan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $item->dataSatuan->nama }}</span></span><br>
                                </div>
                            </div>
                            </div>
                        </li>
                        </ul>
                        @endforeach
                    @endif
                  {{-- </div> --}}

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
                <p class="text-uppercase text-sm">Tanggal & Waktu</p>
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <span class="mb-2 text-xs">Tanggal & Waktu: <span class="text-dark font-weight-bold ms-sm-2">{{ $dataReport->created_at }}</span></span>
                      </div>
                    </li>
                  </ul>
                </div>
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
        <button class="delete-confirm btn btn-danger btn-sm ms-auto col-12 mt-4" href="{{ URL::route('admin.deleteDonasi', ['id' => $dataDonKom[0]->id]) }}">Hapus Seluruh Data Donasi</button>
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
    });
</script>
@endsection
