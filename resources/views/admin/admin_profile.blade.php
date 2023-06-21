@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="card shadow-lg mx-4">
  <div class="card shadow-lg">
  <div class="card-body p-3">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
            <a href="{{ asset('storage/'.$data['admin']->foto_profil) }}" data-pswp-width="1669"
            data-pswp-height="2500">
              <img src="{{ asset('storage/'.$data['admin']->foto_profil) }}" class="avatar avatar-lg" alt="profilePIC">
            </a>
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ $data->nama }}
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            Admin
          </p>
        </div>
      </div>
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
          <p class="text-uppercase text-sm">Data Profile</p>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="foto_profil" class="form-control-label">Foto Profil</label>
            {{-- <img class="img-preview mb-3" height="30%" width="30%"> --}}
            {{-- <input class="form-control" type="file" id="fotoProfil" name="fotoProfil" value="{{ old('foto_profil') }}" onchange="previewImage()"> --}}
            <input class="form-control" type="file" id="fotoProfil" name="fotoProfil">
            <p><small style="color: red;">* Jika tidak ingin diubah harap dikosongkan</small></p>
            {{-- @error('foto_profil')
              <p class="text-danger">{{ $message }}</p>
            @enderror --}}
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama" class="form-control-label">Nama</label>
                <input class="form-control" type="text" id="nama" name="nama" value="{{ $data->nama }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="noIdentitas" class="form-control-label">Nomor Identitas</label>
                <input class="form-control" type="text" id="noIdentitas" name="noIdentitas" value="{{ $data['admin']->no_identitas }}">
              </div>
            </div>
          </div>
          <hr class="horizontal dark">
          <p class="text-uppercase text-sm">Informasi Log in</p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
                <input class="form-control" type="email" id="email" name="email" value="{{ $data->email }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="password" class="form-control-label">Password</label>
                <input class="form-control" type="password" id="password" name="password" value="">
                <p><small style="color: red;">* Jika tidak ingin diubah harap dikosongkan</small></p>
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
            const image = document.querySelector('#foto_profil');
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
            let route_url = "{{ URL::route('admin.edit-profile') }}"

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            event.preventDefault();

            // Create a new FormData object
            const formData = new FormData();

            // Append the form fields to the FormData object
            formData.append('foto_profil', document.querySelector('#fotoProfil').files[0]);
            formData.append('nama', document.querySelector('#nama').value);
            formData.append('no_identitas', document.querySelector('#noIdentitas').value);
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
