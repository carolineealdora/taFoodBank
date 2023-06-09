@extends('layouts.layouts_backendweb.ngo.ngo_master')

@section('ngo_content')
<div class="card shadow-lg mx-4 mb-4">
  <div class="card shadow-lg">
    <div class="card-body p-3">
      <div class="card-shadow pt-2 p-3">
        {{-- <p class="text-uppercase text-sm">Data Donasi</p> --}}
        <ul class="list-group">
          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
            <div class="d-flex flex-column">
                {{-- nama ngo --}}
              <h6 class="text-sm">{{ $data['ngo']->ngo_nama }}</h6>
              <span class="mb-2 text-xs">Kota Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">{{ $data['kota'] }}</span></span>
              <div class="row">
                <span class="mb-2 text-xs">Alamat Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">{{ $data['ngo']->ngo_alamat }}</span></span>
                <span class="mb-2 text-xs">Nomor Telepon Kantor NGO: <span class="text-dark font-weight-bold ms-sm-2">{{ $data['ngo']->ngo_no_telp }}</span></span>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="card shadow-lg mx-4">
  <div class="card shadow-lg">
  <div class="card-body p-3">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
            <a href="{{ asset('storage/'.$data['ngo']->pic_foto) }}" data-pswp-width="1669"
            data-pswp-height="2500">
              <img src="{{ asset('storage/'.$data['ngo']->pic_foto) }}" class="avatar avatar-lg" alt="profilePIC">
            </a>
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ $data['pic']->nama }}
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            PIC
          </p>
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
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Edit Profile</p>
            <button class="btn btn-primary btn-sm ms-auto save">Simpan Perubahan</button>
          </div>
        </div>
        <div class="card-body">
          <p class="text-uppercase text-sm">Data Profile PIC</p>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="fotoPIC" class="form-control-label">Foto Profil PIC</label>
            {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
            <input class="form-control" type="file" id="picFoto" name="picFoto" value="{{ old('pic_foto') }}" onchange="previewImage()">
            @error('pic_foto')
              <p class="text-danger">{{ $message }}</p>
            @enderror
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="namaPIC" class="form-control-label">Nama PIC</label>
                <input class="form-control" type="text" id="nama" name="nama" value="{{ $data['pic']->nama }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="noIdentitas" class="form-control-label">Nomor Identitas</label>
                <input class="form-control" type="text" id="noIdentitas" name="noIdentitas" value="{{ $data['ngo']->no_identitas }}">
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase text-sm">Informasi Log in</p>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="password" class="form-control-label">Password</label>
                <input class="form-control" type="password" id="password" name="password" value="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
        //preview image
        function previewImage(){
            const image = document.querySelector('#pic_foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).on('click', '.save', function() {
            console.log('clicked');
            let route_url = "{{ URL::route('ngo.edit-profile') }}"

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            event.preventDefault();

            // Create a new FormData object
            const formData = new FormData();

            // Append the form fields to the FormData object
            formData.append('pic_foto', document.querySelector('#picFoto').files[0]);
            formData.append('nama', document.querySelector('#nama').value);
            formData.append('no_identitas', document.querySelector('#noIdentitas').value);
            formData.append('password', document.querySelector('#password').value);

            console.log(formData, 'ini form data');

            Swal.fire({
                title: "Apakah anda yakin ingin mengubah data profile?",
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
                    type: "POST", // Change the request type to POST
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    url: route_url,
                    data: formData, // Pass the formData object as the data to be sent
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
                    text: 'Status Gagal Diubah!',
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
