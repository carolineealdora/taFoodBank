<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NgoController extends Controller
{
    public function login()
    {
        return view('ngo/ngo_login');
    }

    public function dashboard()
    {
        return view('ngo/ngo_dashboard');
    }

    public function donasi()
    {
        return view('ngo/ngo_donasi');
    }

    public function profile()
    {
        return view('ngo/ngo_profile');
    }

    public function detailDonasi()
    {
        return view('ngo/ngo_detail_donasi');
    }

    public function createDonasi()
    {
        return view('ngo/ngo_create_donasi');
    }

    public function register()
    {
        return view('ngo/ngo_register');
    }
}
