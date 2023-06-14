@extends('layouts.layouts_backendweb.ngo.ngo_master')

@section('ngo_content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>List Donasi</h6>
        </div>
        <div class="card-body px-3 py-5 pt-0 pb-2">
          <div class="table-responsive">
            <table id="ngo-table" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>Nama Donatur</th>
                  <th>Nama Donasi</th>
                  <th>Status</th>
                  <th>Tanggal & Waktu</th>
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
  <!-- custom script -->
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
      let route_url = "{{ URL::route('ngo.detailDonasi', ':id') }}"
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
    });
  </script>
  @endsection