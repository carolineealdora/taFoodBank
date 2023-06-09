@extends('layouts.layouts_backendweb.donatur.donatur_master')

@section('donatur_content')
<div class="card shadow-lg mx-4">
    <div class="card shadow-lg">
    <div class="card-body p-3">
      <div class="row gx-4">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
              <a href="{{ asset('storage/'.$data['donatur']->foto) }}" data-pswp-width="1669"
              data-pswp-height="2500">
                <img src="{{ asset('storage/'.$data['donatur']->foto) }}" class="avatar avatar-lg" alt="profilePIC">
              </a>
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
                {{ $data->nama }}
            </h5>
            <p class="mb-0 font-weight-bold text-sm">
                Donatur
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
        {{-- <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                  <i class="ni ni-app"></i>
                  <span class="ms-2">App</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-email-83"></i>
                  <span class="ms-2">Messages</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="ni ni-settings-gear-65"></i>
                  <span class="ms-2">Settings</span>
                </a>
              </li>
            </ul>
          </div>
        </div> --}}
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
            <p class="text-uppercase text-sm">Data Profile</p>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="foto" class="form-control-label">Foto Profile</label>
              {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
              <input class="form-control" type="file" id="foto" name="foto" value="{{ old('foto') }}" onchange="previewImage()">
              @error('foto')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nama" class="form-control-label">Nama</label>
                  <input class="form-control" id="nama" name="nama" type="text" value="{{ $data->nama }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nomor identitas" class="form-control-label">Nomor Identitas</label>
                  <input class="form-control" id="noIdentitas" name="noIdentitas" type="text" value="{{ $data['donatur']->no_identitas }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="tanggal lahir" class="form-control-label">Tanggal Lahir</label>
                  <input class="form-control" id="tanggalLahir" name="tanggalLahir" type="text" value="{{ $data['donatur']->tanggal_lahir }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nomor telepon" class="form-control-label">Nomor Telepon</label>
                  <input class="form-control" id="noTelp" name="noTelp" type="text" value="{{ $data['donatur']->no_telp }}">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                    <label for="alamat" class="form-control-label">Alamat Lengkap</label>
                    <input class="form-control" id="alamat" name="alamat" type="text" value="{{ $data['donatur']->alamat }}">
                </div>
                </div>
            </div>
            <hr class="horizontal dark">
            <p class="text-uppercase text-sm">Informasi Log in</p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="form-control-label">Email</label>
                  <input class="form-control" id="email" name="email" type="email" value="{{ $data->email }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password" class="form-control-label">Password</label>
                  <input class="form-control" id="password" name="password" type="password" value="">
                </div>
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
            const image = document.querySelector('#foto');
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
            let route_url = "{{ URL::route('donatur.edit-profile') }}"

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            event.preventDefault();

            // Create a new FormData object
            const formData = new FormData();

            // Append the form fields to the FormData object
            formData.append('foto', document.querySelector('#foto').files[0]);
            formData.append('nama', document.querySelector('#nama').value);
            formData.append('no_identitas', document.querySelector('#noIdentitas').value);
            formData.append('tanggal_lahir', document.querySelector('#tanggalLahir').value);
            formData.append('no_telp', document.querySelector('#noTelp').value);
            formData.append('alamat', document.querySelector('#alamat').value);
            formData.append('email', document.querySelector('#email').value);
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
