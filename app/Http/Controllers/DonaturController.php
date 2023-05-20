<?php

namespace App\Http\Controllers;

use App\Models\Donatur;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class DonaturController extends Controller
{
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

    public function register(Request $request)
    {
        // return view('donatur/donatur_register');

        // return json_encode('sampe sini kak');
        $data_user = [
            'nama'  => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = ModelsUser::firstOrCreate($data_user);
        $user->assignRole('donatur');
        
        $data_donatur = [
            'user_id'       => $user->id,
            'foto_profil'   => $request->foto_profil,
            'alamat'        => $request->alamat,
            'no_telp'       => $request->no_telp,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_identitas'  => $request->no_identitas
        ];

        //bikin kondisi kalo email sama
        $profile = Donatur::create($data_donatur);
        return response()->json([
            'status'    => 'ok',
            'response'  => 'registered',
            'message'   => 'Selamat! Anda telah terdaftar',
            'data'     => $profile,
        ], 200);
    }

    public function storeDonasi(Request $request){
        
    }
}
