@extends('layouts.layouts_backendweb.admin.admin_master')

@section('admin_content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex align-items-center">
            <p class="mb-0">Status NGO</p>
            <button class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="jenis">Status NGO</label>
                <select class="form-control" id="jenis">
                  <option>Malang</option>
                  <option>Jakarta</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection