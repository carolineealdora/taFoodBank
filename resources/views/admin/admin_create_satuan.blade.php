@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Satuan</p>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Satuan</label>
                  <input class="form-control" type="text" value="lucky.jesse">
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-sm ms-auto">Tambah Data Baru</button>
        </div>
      </div>
    </div>
  </div>


@endsection