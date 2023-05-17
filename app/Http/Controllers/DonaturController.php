<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DonaturController extends Controller
{
    public function login()
    {
        return view('donatur/donatur_login');
    }

    public function dashboard()
    {
        return view('donatur/donatur_dashboard');
    }

    public function donasi()
    {
        return view('donatur/donatur_donasi');
    }

    public function profile()
    {
        return view('donatur/donatur_profile');
    }

    public function detailDonasi()
    {
        return view('donatur/donatur_detail_donasi');
    }

    public function createDonasi()
    {
        return view('donatur/donatur_create_donasi');
    }

    public function register()
    {
        return view('donatur/donatur_register');
    }
}
