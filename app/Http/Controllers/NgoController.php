<?php

namespace App\Http\Controllers;

use App\Helpers\File;
use App\Models\Donasi;
use App\Models\DonasiKonsumsi;
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
            $getData = Donasi::with("donasi_konsumsi")->where("id", $id)->first();
            $getDataKonsumsi = $getData->donasi_konsumsi;
            foreach($getDataKonsumsi as $item){
                $data = [
                    'donasi' => $item['donasi']->id,
                    'nama' => $item['nama'],
                    'photo' => $item['photo'],
                    'deskripsi' => $item['deskripsi'],
                    'kategori' => $item['kategori'],
                    'satuan' => $item['satuan'],
                    'kuantitas' => $item['kuantitas'],
                    'expired' => $item['expired'],
                ];
                Pickup::create($data);
            }
            return response()->json([
                'status'    => 'ok',
                'response'  => 'approve-donasi',
                'message'   => 'Status Berhasil Diubah!',
                'route'     => route('ngo.detail-donasi', $id)
            ], 200);
        } 
        catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Status Gagal Diubah',
            ], 500);
        }
    }

    public function donasiCancel($id)
    {
        try {
            Donasi::where("id", $id)->update(['status_donasi' => 3]);
            return response()->json([
                'status'    => 'ok',
                'response'  => 'reject-donasi',
                'message'   => 'Status Berhasil Diubah!',
                'route'     => route('ngo.detail-donasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Status Gagal Diubah',
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
                'status' => 'failed',
                'response' => $e,
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
        //check user logged in
        $user = Auth::user();

        // get data ngo berdasarkan id user logged in
        $getUser = User::with("ngo")->where('email', $user->email)->first();

        //get list donasi berdasarkan id ngo
        $getData = DB::table("views_donasi")->where("ngo_tujuan", $getUser->ngo->id)->get();
        return view('ngo/ngo_donasi', ['data' => $getData]);
    }

    public function profile()
    {
        return view('ngo/ngo_profile');
    }

    public function detailDonasi($id)
    {
        $dataDonasi = Donasi::with("donaturData", "ngo", "kotaData")->where("id", $id)->first();
        //informasi user
        $userId = $dataDonasi->donaturData->user_id;
        $userData = User::where("id", $userId)->first();
        //informasi donasi konsumsi
        $dataDonasiKonsumsi = DonasiKonsumsi::with("donasi", "kategoriData", "satuanData")->where("donasi_id", $id)->get();
        $data = [
            "dataDonasi" => $dataDonasi,
            "dataUser" => $userData,   
            "dataDonKom" => $dataDonasiKonsumsi,
        ];
        return view('ngo/ngo_detail_donasi', $data);
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

    public function getProfile(){
        try{
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getData= User::with("ngo", "kota")->where('email', $user->email)->first();

            return view('ngo/ngo_profile', ['data' => $getData]);
//
            $getNGO = NGO::with("kota")->find($id);
            $getDonasiKonsumsi = DonasiKonsumsi::where('donasi_id', $id)->get();
            $getPickup = Pickup::where('donasi_id', $id)->get();
            // return $getDonasiKonsumsi;
            $data = [
                'donasi' => $getDonasi,
                'donasi_konsumsi' => $getDonasiKonsumsi
                // 'pickup' => $
            ];
            // return $data['donasi'];
            return view('donatur/donatur_detail_donasi', $data);
        }catch(Throwable $e){
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }

    public function editProfile(Request $request){
        try{
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getData = User::where('email', $request->email)->first();

            $getNgo = NGO::where('user_id', $getData['id'])->first();

            // return $getNgo;

            //edit
            if($request->password == null){
                $data_credentials = [
                    "nama"      => $request->nama,
                    "email"     => $request->req_email
                ];
            }else{
                $data_credentials = [
                    "nama"      => $request->nama,
                    "email"     => $request->req_email,
                    "password"  => Hash::make($request->password)
                ];
            }

            User::find($getData['id'])->update($data_credentials);

            if($request['pic_foto'] !== null){ //kondisi saat foto berubah
                File::delete($getDonatur->foto);

                $path = "images/ngo";
                $requestFile = $request['pic_foto'];
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    "ngo_nama"          => $request->ngo_nama,
                    "ngo_alamat"        => $request->ngo_alamat,
                    "ngo_kota"          => $request->ngo_kota,
                    "ngo_no_telp"       => $request->ngo_no_telp,
                    "no_identitas"      => $request->no_identitas,
                    "pic_foto"          => $request->pic_foto
                ];
            }else{
                $data = [
                    "ngo_nama"          => $request->ngo_nama,
                    "ngo_alamat"        => $request->ngo_alamat,
                    "ngo_kota"          => $request->ngo_kota,
                    "ngo_no_telp"       => $request->ngo_no_telp,
                    "no_identitas"      => $request->no_identitas
                ];
            }

            NGO::find($getNgo['id'])->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Data profile telah diubah.',
                // 'route'     => route('donatur/donasi')
            ], 200);
        }catch(Throwable $e){
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }
}
