@extends('layouts.layouts_backendweb.donatur.donatur_master')

@section('donatur_content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-3 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">List Donasi</h6>
              </div>
              <div class="col-6 text-end">
                <a class="btn bg-gradient-dark mb-0" href="{{ URL::route('donatur.create-donasi')}}"><i class="fas fa-plus"></i>&nbsp;&nbsp;Berikan Donasi</a>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">

              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama NGO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Donasi Makanan/Minuman</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal & Waktu</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
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
                      <a href="{{ URL::route('donatur.detail-donasi', ['id' => $item->donasi]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Detail
                      </a><br>
                      <a href="{{ URL::route('donatur.detail-donasi', ['id' => $item->donasi]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Hapus
                      </a>
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
