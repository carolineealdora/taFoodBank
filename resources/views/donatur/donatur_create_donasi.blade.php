@extends('layouts.layouts_backendweb.donatur.donatur_master')

@section('donatur_content')
<div class="container-fluid py-4">
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
              {{-- Form Data Donasi Konsumsi --}}
            <form id="formDonasi" action="{{ URL::route('donatur.store-donasi') }}" method="post" role="form">
              <div class="fields-row row border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg" id="fieldForm" index="0">
                <div class="ms-auto text-end">
                    <a class="delete btn btn-link text-danger text-gradient px-3 mb-0"><i class="far fa-trash-alt me-2"></i>Delete</a>
                </div>
                <div class="form-group col-md-6">
                  <div class="form-group">
                    <label for="namaKonsumsi" class="form-control-label">Nama Makanan/Minuman</label>
                    <input id="namaKonsumsi" name="nama" class="form-control" type="text" value="" placeholder="Masukkan nama makanan/minuman" required>
                  </div>
                  <div class="form-group">
                    <label for="deskripsiDonasi" class="form-control-label">Deskripsi</label>
                    <input id="deskripsiDonasi" name="deskripsi"class="form-control" type="text" value="" required>
                  </div>
                  <div class="form-group">
                    <label for="donatur_donasiFoto" class="form-control-label">Foto Makanan/Minuman</label>
                  {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
                  {{-- <input class="form-control" type="file" id="donasiFoto" name="photo" value="{{ old('donasiFoto') }}" onchange="previewImage()"> --}}
                  <input class="form-control" type="file" id="donasiFoto" name="photo">
                  {{-- @error('donasiFoto')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror --}}
                  </div>
                  <div class="form-group">
                    <label for="WaktuExpired" class="form-control-label">Perkiraan Tanggal Expired</label>
                    <input id="expired" name="expired" class="form-control datepicker" placeholder="Silahkan Pilih Tanggal" type="datetime-local" id="datepicker" name="WaktuPembuatan" value="{{ old('WaktuPembuatan') }}" required>
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
            </form>
              <button class="btn btn-primary btn-sm ms-auto add">Add</button>
              <hr class="horizontal dark">
            <form id="formPickup" action="{{ URL::route('donatur.store-donasi') }}" method="post" role="form">
              <p class="text-uppercase text-sm">Form Pickup Donasi</p>
              <div class="form-group">
                <label for="kotaDonasi">Pickup Location - Kota</label>
                <select class="form-control" id="kotaDonasi" name="kota" required>
                    @foreach($kota as $city)
                    <option value="{{$city->id}}">{{$city->nama}}</option>
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="ngoDonasi">NGO Tujuan</label>
                <select class="form-control" id="ngoDonasi" name="ngo_tujuan" required>
                    @foreach($ngos as $ngo)
                    <option value="{{$ngo->id}}">{{$ngo->ngo_nama}}</option>
                    @endforeach
                </select>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama</label>
                    <input class="form-control" type="text" value="" id="namaPickup" name="nama_pickup" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nomor Telepon</label>
                    <input class="form-control" type="text" value="" id="noTelpPickup" name="no_telp_pickup" required>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Pickup Location - Alamat Lengkap</label>
                    <input class="form-control" type="text" value="" id="alamatPickup" name="alamat_pickup" required>
                </div>
              </div>
            </form>
              <button type="submit" id="action" value="" class="submit btn btn-success btn-sm ms-auto col-12">Submit Seluruh Data Donasi</button>
            </div>
          </div>
        </div>
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

<script>
    $(document).on('click', '.add', function(event) {
        const form = document.getElementById('formDonasi');
        const fieldForm = form.lastElementChild;

        // clone field data donasi
        const clonedFieldForm = fieldForm.cloneNode(true);

        // Reset the cloned form's input field values
        const clonedInputTextxFields = clonedFieldForm.querySelectorAll('input[type="text"]');
        clonedInputTextxFields.forEach(textField => {
            textField.value = '';
        });
        const clonedInputFileFields = clonedFieldForm.querySelectorAll('input[type="file"]');
        clonedInputFileFields.forEach(fieldField => {
            fieldField.value = '';
        });

        // get index
        let indexAttribute = parseInt(clonedFieldForm.getAttribute('index'));
        const clonedIndex = indexAttribute+1;
        clonedFieldForm.setAttribute('index', clonedIndex);

        // append new row to form donasi
        const formDonasi = document.getElementById('formDonasi');
        formDonasi.appendChild(clonedFieldForm);
    });

    $(document).on('click', '.delete', function(event) {
        // get form row sesuai button yang di klik
        const formDonasi = document.getElementById('formDonasi');
        const countFieldForm = formDonasi.childElementCount;
        if(countFieldForm !== 1){
            const getForm = $(event.target).closest('.fields-row');
            getForm.remove();
        }
    });

    $(document).on('click', '.submit', function(event) {
      event.preventDefault();

      const getFormDonasi = document.getElementById('formDonasi');
      const getFormPickup = document.getElementById('formPickup');


    const formDonasi = new FormData();

    // loop semua fields group donasi
    const groupDonasi = document.querySelectorAll('#fieldForm');

    groupDonasi.forEach((group, index) => {
    // inisiasi object untuk store value tiap group donasi
    const groupData = {};

    // get value dari tiap fields/key
    const namaValue = group.querySelector('#namaKonsumsi').value;
    const deskripsiValue = group.querySelector('#deskripsiDonasi').value;
    const expiredValue = group.querySelector('#expired').value;
    const kategoriValue = group.querySelector('#kategori').value;
    const kuantitasValue = group.querySelector('#kuantitas').value;
    const satuanValue = group.querySelector('#satuan').value;
    const photoInput = group.querySelector('#donasiFoto');
    const photoValue = photoInput.files[0];

    formDonasi.append(`donasi_konsumsi[${index}][nama]`, namaValue);
    formDonasi.append(`donasi_konsumsi[${index}][deskripsi]`, deskripsiValue);
    formDonasi.append(`donasi_konsumsi[${index}][expired]`, expiredValue);
    formDonasi.append(`donasi_konsumsi[${index}][kategori]`, kategoriValue);
    formDonasi.append(`donasi_konsumsi[${index}][kuantitas]`, kuantitasValue);
    formDonasi.append(`donasi_konsumsi[${index}][satuan]`, satuanValue);
    formDonasi.append(`donasi_konsumsi[${index}][photo]`, photoValue);
    });

    const formPickup = new FormData(getFormPickup);

    // merge formDonasi dan formPickup
      for (let entry of formPickup.entries()) {
        formDonasi.append(entry[0], entry[1]);
    }

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
            data: formDonasi,
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
      });
    });
</script>
@endsection
