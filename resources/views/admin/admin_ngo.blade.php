@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>List NGO</h6>
        </div>
        <div class="card-body px-5 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table id="ngo-admin-table" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>Nama NGO</th>
                  <th>Nama PIC</th>
                  <th>Kota NGO</th>
                  <th>Status Akun</th>
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
  {{-- </div> --}}
{{-- @endsection --}}

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
      table = $('#ngo-admin-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
          url: "{{ route('admin.ngo') }}",
        },
        columns: [{
            data: 'ngo_nama',
            name: 'ngo_nama'
          },
          {
            data: 'nama_user',
            name: 'nama_user',
          },
          {
            data: 'kota',
            name: 'kota'
          },
          {
            data: 'status',
            name: 'status'
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
      let route_url = "{{ URL::route('admin.detail-ngo', ':id') }}"
      route_url = route_url.replace(':id', id);

      event.preventDefault();
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
              type: 'error',
              showConfirmButton: false
            });
          }
        }
      });
    });

    $(document).on('click', '.action-hapus', function() {
      let id = $(this).attr("id");
      let route_url = "{{ URL::route('admin.delete-ngo', ':id') }}"
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
              if (data.status == "failed") {
                Swal.fire({
                  title: 'Terjadi Kesalahan!',
                  type: 'error',
                  showConfirmButton: false
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
