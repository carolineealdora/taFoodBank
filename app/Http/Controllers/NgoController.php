<?php

namespace App\Http\Controllers;

use App\Models\NGO;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class NgoController extends Controller
{

    public function dashboard()
    {
        return view('ngo/ngo_dashboard');
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

    public function register(Request $request)
    {
        // return view('ngo/ngo_register');

        $data_user = [
            'nama'  => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::firstOrCreate($data_user);
        $user->assignRole('donatur');

        $data_ngo = [
            'user_id'           => $user->id,
            'status'           => $user->id,
            'ngo_nama'          => $request->ngo_nama,
            'ngo_alamat'        => $request->ngo_alamat,
            'ngo_kota'          => $request->kota,
            'ngo_no_telp'       => $request->no_telp,
            'pic_foto'          => $request->pic_foto,
            'pic_no_identitas'  => $request->no_identitas
        ];

        $profile = NGO::create($data_ngo);
        return response()->json([
            'status'    => 'ok',
            'response'  => 'registered',
            'message'   => 'Selamat! NGO telah terdaftar.',
            'route'     => route('login')
        ], 200);
    }
}
