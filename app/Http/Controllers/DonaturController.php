<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\File;
use App\Models\Donasi;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
        // $donasi = $request->validate([
        //     'ngo_tujuan'        => 'required',
        //     'kota'              => 'required',
        //     'nama_pickup'     => 'required|max:20',
        //     'alamat_pickup'   => 'required|max:255',
        //     'alamat_pickup'   => 'required|max:255',
        //     'kota'          => 'image|file'
        // ]);

        try{
            $email = Auth::user()->email;

            $user = User::with('donatur')->where('email', $email)->first();

            $id_donatur = $user->donatur->id;
            $data = [
                "donatur"           => $id_donatur,
                "ngo_tujuan"        => $request->ngo_tujuan,
                "kota"              => $request->kota,
                "nama_pickup"       => $request->nama_pickup,
                "alamat_pickup"     => $request->alamat_pickup,
                "no_telp_pickup"    => $request->no_telp_pickup,
                "status_donasi"     => 1
            ];

            $donasi = Donasi::create($data);
            return $donasi;
            foreach($request->donasi_konsumsi as $donasi_konsumsi){
                $path = "images/donasi";
                $requestFile = $request->photo;
                $insertImage = File::fileUpload($requestFile, $path);
                $data = [
                    "donasi"    => $donasi->id,
                    "nama"      => $donasi_konsumsi->nama,
                    "photo"     => $donasi_konsumsi->$insertImage,
                    "deskripsi" => $donasi_konsumsi->deskripsi,
                    "kategori"  => $donasi_konsumsi->kategori,
                    "satuan"    => $donasi_konsumsi->satuan,
                    "kuantitas" => $donasi_konsumsi->kuantitas,
                    "expired"   => Carbon::now(),
                    // "expired"   => $donasi_konsumsi->datenow,
                ];

                DonasiKonsumsi::insert($data);

                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'created',
                    'message'   => 'Selamat! Donasi telah terkirim.',
                    'route'     => route('donatur/donasi')
                ], 200);
            }
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'failed',
            ], 500);
        }
    }
}
