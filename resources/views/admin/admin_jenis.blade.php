@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">List Jenis</h6>
              </div>
              <div class="col-6 text-end">
                <a class="btn bg-gradient-dark mb-0" href="{{ URL::route('admin.create-jenis')}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Data Baru</a>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-3 py-1">
                        <p class="text-xs font-weight-bold mb-0">Makanan</p>
                      </div>
                    </td>
                    <td class="align-middle">
                      <a href="{{ URL::route('admin.detail-jenis') }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Detail
                      </a><br>
                      <a href="{{ URL::route('admin.detail-jenis') }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Hapus">
                        Hapus
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  {{-- </div> --}}
@endsection