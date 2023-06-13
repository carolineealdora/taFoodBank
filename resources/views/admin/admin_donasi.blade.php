@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>List Donasi</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Donatur</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama NGO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Donasi Makanan/Minuman</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal & Waktu</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                {{-- <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">John Michael</h6>
                          <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Nama NGO</p>
                      <p class="text-xs text-secondary mb-0">Organization</p>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Manager</p>
                      <p class="text-xs text-secondary mb-0">Organization</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">Online</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                    </td>
                    <td class="align-middle">
                      <a href="{{ URL::route('admin.detail-donasi', ['id' => $item->donasi]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Detail
                      </a>
                    </td>
                  </tr>
                </tbody> --}}
                <tbody>
                    @foreach($data as $item)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$item->nama_user}}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$item->ngo_nama}}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{$item->donasi_konsumsi}}</p>
                    </td>
                    @if($item->status_donasi == "submitted")
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-warning">{{$item->status_donasi}}</span>
                    </td>
                    @elseif($item->status_donasi == "approved")
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">{{$item->status_donasi}}</span>
                    </td>
                    @elseif($item->status_donasi == "rejected")
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-danger">{{$item->status_donasi}}</span>
                    </td>
                    @endif
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{$item->tanggal}}</span>
                    </td>
                    <td class="align-middle">
                      <a href="{{ URL::route('admin.detail-donasi', ['id' => $item->donasi]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Detail
                      </a><br>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  {{-- </div> --}}
@endsection
