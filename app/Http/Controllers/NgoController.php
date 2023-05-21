<?php

namespace App\Http\Controllers;

use App\Helpers\File;
use App\Models\Donasi;
use App\Models\NGO;
use App\Models\Pickup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class NgoController extends Controller
{

    public function dashboard()
    {
        return view('ngo/ngo_dashboard');
    }

    public function listDonasi()
    {
        //get all data donasi
        try {
            //whos login
            $user = Auth::user();
            //get donasi by user login
            $getDataDonasi = Donasi::with("donasi_konsumsi", "status_donasi", "kota", "ngo", "donatur")->where("ngo.user_id", $user->id)->get();
            return response()->json([
                'status' => 'ok',
                'response' => 'get-donasi',
                'message' => 'Success Get Donasi Data!',
                'data' => $getDataDonasi
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'response' => 'failed',
                'message' => $e,
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            //get detail donasi
            $getDataDonasi = Donasi::with("donasi_konsumsi", "status_donasi", "kota", "ngo")->where("d_id", $id)->first();
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
    public function approvalDonasi(Request $request, $id)
    {
        try {
            //general request
            $data = [
                'id' => $request->id,
                'donasi' => $request->donasi,
                'nama' => $request->nama,
                'photo' => $request->photo,
                'deskripsi ' => $request->deskripsi,
                'kategori' => $request->kategori,
                'jenis' => $request->jenis,
                'satuan' => $request->satuan,
                'kuantitas' => $request->kuantitas,
                'expired' => $request->expired,
                'status_donasi' => $request->status_donasi,
            ];
            $updateDonasiStatus = Donasi::find("d_id", $id)->update(['status_donasi' => $request->status_donasi]);
            if ($request->status_donasi == 2) {
                //insert to pickup
                $insertPickup = Pickup::store($data);
                return response()->json([
                    'status' => 'ok',
                    'response' => 'updated-donasi',
                    'message' => 'Data Berhasil Di-Approve!',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'ok',
                    'response' => 'updated-donasi',
                    'message' => 'Data Berhasil Di-reject',
                ], 200);
            }
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
            //get donasi by user login
            $getDataPickup = Donasi::with("pickup", "status_donasi", "kota", "ngo", "donator")->where("ngo.user_id", $user->id)->get();
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

    public function editPickup(Request $request, $id)
    {
        try {
            foreach ($request->data as $data) {
                //general request
                $request = [
                    'id' => $data->id,
                    'donasi' => $data->donasi,
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

        $user =  User::firstOrCreate($data_user);
        $user->assignRole('ngo');
        $path = "images/profile";
        $requestFile = $request->pic_foto;
        $insertImage = File::fileUpload($requestFile, $path);
        $data_ngo = [
            'ngo_status'        => 1,
            'user_id'           => $user->id,
            'ngo_nama'          => $request->ngo_nama,
            'ngo_alamat'        => $request->ngo_alamat,
            'ngo_kota'          => $request->ngo_kota,
            'ngo_no_telp'       => $request->ngo_no_telp,
            'no_identitas'      => $request->no_identitas, 
            'pic_foto'          => $insertImage
        ];
        
        $ngoCreate = NGO::create($data_ngo);

        //getData
        $getDataNgo = NGO::find($ngoCreate->id);
        return response()->json([
            'status'    => 'ok',
            'response'  => 'registered',
            'message'   => 'Selamat! NGO telah terdaftar.',
            'data'     => $getDataNgo
        ], 200);
    }
}
