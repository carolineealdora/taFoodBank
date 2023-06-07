<?php

namespace App\Http\Controllers;

use App\Helpers\File;
use App\Models\Donasi;
use App\Models\Kota;
use App\Models\NGO;
use App\Models\Pickup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class NgoController extends Controller
{
    public function dashboard()
    {
        return view('ngo/ngo_dashboard');
    }

    public function showLoginForm()
    {
        return view('ngo.ngo_login');
    }

    public function showRegisterForm()
    {
        $kota = Kota::all();
        return view('ngo.ngo_register', ["kota" => $kota]);
    }

    public function listDonasi()
    {
    }

    public function showDonasi($id)
    {
        try {
            //get detail donasi
            $getDataDonasi = Donasi::with("donasi_konsumsi", "status_donasi", "kota", "ngo")->where("id", $id)->first();
            return response()->json([
                'status' => 'ok',
                'response' => 'get-donasi',
                'message' => 'Berhasil Get Donasi!',
                'data' => $getDataDonasi
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'failed',
            ], 500);
        }
    }

    public function donasiApprove($id)
    {
        try {
            Donasi::where("id", $id)->update(['status_donasi' => 2]);
            $getData = Donasi::with("donasi_konsumsi")->where("id", $id)->get();
            return $getData;
            $data = [
                'donasi' => $getData->donasi,
                'nama' => $getData->nama,
                'photo' => $getData->photo,
                'deskripsi ' => $getData->deskripsi,
                'kategori' => $getData->kategori,
                'jenis' => $getData->jenis,
                'satuan' => $getData->satuan,
                'kuantitas' => $getData->kuantitas,
                'expired' => $getData->expired,
                'status_donasi' => $getData->status_donasi,
            ];
            Pickup::store($data);
            return response()->json([
                'status' => 'ok',
                'response' => 'updated-donasi',
                'message' => 'Data Berhasil Di-Approve!',
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'failed',
            ], 500);
        }
    }

    public function donasiCancel($id)
    {
        try {
            Donasi::find("id", $id)->update(['status_donasi' => 3]);
            return response()->json([
                'status' => 'ok',
                'response' => 'updated-donasi',
                'message' => 'Status Berhasil diubah!',
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'failed',
            ], 500);
        }
    }

    public function getDataPickup()
    {
        //get all data donasi
        try {
            //whos login
            $user = Auth::user();
            //get ngo id
            $getUser = User::with("ngo")->where('email', "ngoTest@gmail.com")->first();
            //get donasi for ngo
            $getDataPickup = Donasi::with("pickup", "status_donasi", "kota", "ngo", "donator")->where("ngo", $getUser->ngo->id)->get();
            return response()->json([
                'status' => 'ok',
                'response' => 'get-donasi',
                'message' => 'Berhasil Get Pickup!',
                'data' => $getDataPickup
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'failed',
            ], 500);
        }
    }

    public function editPickup(Request $request)
    {
        try {
            foreach ($request->data as $data) {
                //general request
                $request = [
                    'id' => $data->id,
                    'donasi_id' => $data->donasi,
                    'nama' => $data->nama,
                    'photo' => $data->photo,
                    'deskripsi ' => $data->deskripsi,
                    'kategori' => $data->kategori,
                    'jenis' => $data->jenis,
                    'satuan' => $data->satuan,
                    'kuantitas' => $data->kuantitas,
                    'expired' => $data->expired,
                    'waktu_pickup' => $request->waktu_pickup
                ];

                Pickup::find($data->id)->update($request);
            };
            return response()->json([
                'status' => 'ok',
                'response' => 'updated-pickup',
                'message' => 'Data Berhasil Di-Approve!',
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'failed',
            ], 500);
        }
    }
    public function donasi()
    {

        //whos login
        $user = Auth::user();
        //get ngo id
        $getUser = User::with("ngo")->where('email', $user->email)->first();
        //get donasi for ngo
        $getData = DB::table("views_donasi")->where("ngo_tujuan", $getUser->ngo->id)->get();
        return view('ngo/ngo_donasi', ['data' => $getData]);
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
        try {
            $data_user = [
                'nama'  => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];

            $user =  User::firstOrCreate($data_user);
            $user->assignRole('ngo');
            $path = "images/ngo";
            $requestFile = $request->pic_foto;
            $insertImage = File::fileUpload($requestFile, $path);
            $data_ngo = [
                'ngo_status'        => 0,
                'user_id'           => $user->id,
                'ngo_nama'          => $request->ngo_nama,
                'ngo_alamat'        => $request->ngo_alamat,
                'ngo_kota'          => $request->ngo_kota,
                'ngo_no_telp'       => $request->ngo_no_telp,
                'no_identitas'      => $request->no_identitas,
                'pic_foto'          => $insertImage
            ];

            NGO::create($data_ngo);
            return response()->json([
                'status'    => 'ok',
                'response'  => 'register-ngo',
                'message'   => 'Register telah berhasil',
                'route'     => route('ngo.showLogin')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => $e
            ], 500);
        }
    }
}
