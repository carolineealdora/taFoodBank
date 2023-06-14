@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">List Kategori</h6>
              </div>
              <div class="col-6 text-end">
                <a class="btn bg-gradient-dark mb-0" href="{{ URL::route('admin.create-kategori')}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data Baru</a>
              </div>
          </div>
          <div class="card-body my-3 px-3 py-5 pt-0 pb-2">
            <div class="table-responsive">
              <table id="kategori-table" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th>Kategori</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    </script>

    <script>
      var table
      $(function() {
        let i = 1;
        table = $('#kategori-table').DataTable({
          processing: true,
          serverSide: false,
          ajax: {
            url: "{{ route('admin.kategori') }}",
          },
          columns: [{
              data: 'kategori',
              name: 'kategori'
            },
            {
              data: 'action',
              name: 'action'
            },
          ]
        });
        table.on('draw.dt order.dt search.dt', function() {
          table.column(1, {
              order: 'applied',
              search: 'applied'
            })
        }).draw();
      });

      $(document).on('click', '.action-detail', function() {
        let id = $(this).attr("id");
        let route_url = "{{ URL::route('admin.detail-kategori', ':id') }}"
        route_url = route_url.replace(':id', id);

        event.preventDefault();
        // window.location.href = rpoute_url;
        $.ajax({
          url: route_url,
          method: "GET",
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            window.location.href = route_url;
          },
          error: (data) => {
            if (data.status == "failed") {
              Swal.fire({
                title: 'Terjadi Kesalahan!',
                icon: 'error',
                confirmButtonText: 'Oke'
              });
            }
          }
        });
      });

      $(document).on('click', '.action-hapus', function() {
      let id = $(this).attr("id");
      let route_url = "{{ URL::route('admin.delete-kategori', ':id') }}"
      route_url = route_url.replace(':id', id);

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
            url: route_url,
            type: "DELETE",
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
                  title: data.responseJSON.message,
                  icon: 'error',
                  confirmButtonText: 'Oke'
                });
                setTimeout(function() {
                  Swal.close();
                }, 2000);
              }
            }
          });
        }
      })
    });
    </script>
@endsection
