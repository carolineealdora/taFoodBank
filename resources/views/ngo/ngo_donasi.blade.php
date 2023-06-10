@extends('layouts.layouts_backendweb.ngo.ngo_master')

@section('ngo_content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>List Donasi</h6>
        </div>
        <div class="card-body px-5 pt-0 pb-2">
          <div class="table-responsive">
            <table id="ngo-table" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Nama Donatur</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Jenis Donasi</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Status</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Tanggal & Waktu</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Action</th>
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
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>

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
      table = $('#ngo-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
          url: "{{ route('ngo.donasi') }}",
        },
        columns: [{
            data: 'nama_user',
            name: 'nama_user'
          },
          {
            data: 'donasi_konsumsi',
            name: 'donasi_konsumsi',
          },
          {
            data: 'status_donasi',
            name: 'status_donasi'
          },
          {
            data: 'tanggal_waktu',
            name: 'tanggal_waktu'
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

    $(document).on('click', '.action-edit', function() {
      let id = $(this).attr("id");
      let route_url = "{{ URL::route('ngo.detail-donasi', ':id') }}"
      route_url = route_url.replace(':id', id);

      event.preventDefault();
      window.location.href = route_url;
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
  </script>
  @endsection