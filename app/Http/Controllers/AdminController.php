<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    protected $table = 'admin';

        public function login()
    {
        return view('admin/admin_login');
    }

    public function dashboard()
    {
        return view('admin/admin_dashboard');
    }

    public function profile()
    {
        return view('admin/admin_profile');
    }

    public function donasi()
    {
        return view('admin/admin_donasi');
    }

    public function detailDonasi()
    {
        return view('admin/admin_detail_donasi');
    }

    public function donatur()
    {
        return view('admin/admin_donatur');
    }

    public function detailDonatur()
    {
        return view('admin/admin_detail_donatur');
    }

    public function ngo()
    {
        return view('admin/admin_ngo');
    }

    public function detailNgo()
    {
        return view('admin/admin_detail_ngo');
    }

    public function admin()
    {
        return view('admin/admin_admins');
    }

    public function detailAdmin()
    {
        return view('admin/admin_detail_admin');
    }

    public function kota()
    {
        return view('admin/admin_kota');
    }

    public function detailKota()
    {
        return view('admin/admin_detail_kota');
    }

    public function createKota()
    {
        return view('admin/admin_create_kota');
    }

    public function jenis()
    {
        return view('admin/admin_jenis');
    }

    public function detailJenis()
    {
        return view('admin/admin_detail_jenis');
    }

    public function createJenis()
    {
        return view('admin/admin_create_jenis');
    }

    public function kategori()
    {
        return view('admin/admin_kategori');
    }

    public function detailKategori()
    {
        return view('admin/admin_detail_kategori');
    }

    public function createKategori()
    {
        return view('admin/admin_create_kategori');
    }

    public function satuan()
    {
        return view('admin/admin_satuan');
    }

    public function detailSatuan()
    {
        return view('admin/admin_detail_satuan');
    }

    public function createSatuan()
    {
        return view('admin/admin_create_satuan');
    }

    public function statusDonasi()
    {
        return view('admin/admin_statusDonasi');
    }

    public function detailStatusDonasi()
    {
        return view('admin/admin_detail_status_donasi');
    }

    // public function createStatusDonasi()
    // {
    //     return view('admin/admin_create_statusDonasi');
    // }

    public function deleteDonasi(){

    }

    public function getNGO(){

    }

    public function getDonatur(){

    }

    public function getDonasi(){

    }

}
