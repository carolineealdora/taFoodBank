<?php

namespace App\Http\Controllers;

use App\Helpers\File;
use App\Models\Donasi;
use App\Models\DonasiKonsumsi;
use App\Models\Kategori;
use App\Models\Kota;
use App\Models\LaporanDonasi;
use App\Models\LogStatus;
use App\Models\NGO;
use App\Models\Pickup;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Throwable;

class NgoController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::user()->id;
        $getDataNGO = NGO::where("user_id", $userId)->first();
        $ngoId = $getDataNGO->id;
        $countSubmitted = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 1)->count();
        $countApproved = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 2)->count();
        $countRejected = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 3)->count();
        $countPickedUp = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 4)->count();
        $countFinished = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 5)->count();
        $data = [
            'submited' => $countSubmitted,
            'approved' => $countApproved,
            'rejected' => $countRejected,
            'pickedup' => $countPickedUp,
            'finished' => $countFinished,
        ];
        return view('ngo/ngo_dashboard', $data);
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
            //insert to log 
            $logData = [
                'donasi_id' => $id,
                'status_message' => "Disetujui Oleh NGO",
            ];
            LogStatus::create($logData);

            $getData = Donasi::with("donasi_konsumsi")->where("id", $id)->first();
            $getDataKonsumsi = $getData->donasi_konsumsi;
            foreach ($getDataKonsumsi as $item) {
                $data = [
                    'donasi' => $item['donasi']->id,
                    'nama' => $item['nama'],
                    'photo' => "default",
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
        } catch (Throwable $e) {
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

    public function editPickup(Request $request, $id)
    {
        try {
            $dataPickup = Pickup::find($id)->first();
            $photo = $dataPickup->photo;
            $requestFile = $request->donasiFoto;
            if ($requestFile !== null && $requestFile !== 'undefined') {
                File::delete($photo);
                $path = "images/pickup";
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    'nama' => $request->nama,
                    'photo' => $insertImage,
                    'deskripsi' => $request->deskripsi,
                    'kategori' => $request->kategori,
                    'satuan' => $request->satuan,
                    'kuantitas' => $request->kuantitas,
                    'expired' => $request->expired,
                ];
            } else {
                $data = [
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                    'kategori' => $request->kategori,
                    'satuan' => $request->satuan,
                    'kuantitas' => $request->kuantitas,
                    'expired' => $request->expired,
                ];
            }
            Pickup::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated-donkom',
                'message'   => 'Update Data Telah Berhasil!',
                'route'     => route('ngo.detail-donasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Update Data Gagal!'
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

    public function detailDonasi($id)
    {
        //Current Status
        $dataCurrentLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'desc')->first();
        //log donasi
        $dataLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'asc')->get();
        $dataDonasi = Donasi::with("donaturData", "ngo", "kotaData")->where("id", $id)->first();
        //informasi user
        $userId = $dataDonasi->donaturData->user_id;
        $userData = User::where("id", $userId)->first();
        //informasi donasi konsumsi
        $dataDonasiKonsumsi = DonasiKonsumsi::with("donasi", "kategoriData", "satuanData")->where("donasi_id", $id)->get();
        //informasi data pickup
        $dataPickup = Pickup::with("donasiData", "dataKategori", "dataSatuan")->where("donasi", $id)->get();
        //Get Data Report Donasi
        $dataReport = LaporanDonasi::where("donasi_id", $id)->count();
        //constanta untuk form
        $kategori = Kategori::get();
        $satuan = Satuan::get();
        $data = [
            "dataCurrentLog" => $dataCurrentLog,
            "dataLog" => $dataLog,
            "dataDonasi" => $dataDonasi,
            "dataUser" => $userData,
            "dataDonKom" => $dataDonasiKonsumsi,
            "dataPickup" => $dataPickup,
            "dataReport" => $dataReport,
            "kategori" => $kategori,
            "satuan" => $satuan
        ];
        return view('ngo/ngo_detail_donasi', $data);
    }

    public function addTimePickup(Request $request, $id)
    {
        try {
            $data = [
                "waktu_pickup" => $request->WaktuPembuatan,
            ];
            Pickup::where("donasi", $id)->update($data);
            //update status to pickedup
            Donasi::where("id", $id)->update(['status_donasi' => 4]);
            //insert to log 
            $logData = [
                'donasi_id' => $id,
                'status_message' => "Picked Up",
            ];
            LogStatus::create($logData);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated-donkom',
                'message'   => 'Update Data Telah Berhasil!',
                'route'     => route('ngo.detail-donasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Update Data Gagal!'
            ], 500);
        }
    }

    public function deletePickup($id)
    {
        try {
            Pickup::find($id)->delete();
            return response()->json([
                'status'    => 'ok',
                'response'  => 'delete-pickup',
                'message'   => 'Data Berhasil Dihapus!',
                'route'     => route('ngo.detail-donasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data Gagal Dihapus!'
            ], 500);
        }
    }

    public function reportDonasi(Request $request, $id)
    {
        try {
            $path = "images/report";
            $requestFile = $request->photo;
            $insertImage = File::fileUpload($requestFile, $path);

            $data = [
                'donasi_id' => $id,
                'foto_laporan' => $insertImage,
                'deskripsi' => $request->deskripsi,
            ];
            LaporanDonasi::create($data);
            //update status to finished
            Donasi::where("id", $id)->update(['status_donasi' => 5]);
            //insert to log 
            $logData = [
                'donasi_id' => $id,
                'status_message' => "Berhasil Dikirim",
            ];
            LogStatus::create($logData);
            return response()->json([
                'status'    => 'ok',
                'response'  => 'add-report',
                'message'   => 'Data Berhasil Ditambahkan!',
                'route'     => route('ngo.detail-donasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data Gagal Ditambahkan!'
            ], 500);
        }
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

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('ngo/show-login');
    }

    public function getProfile()
    {
        try {
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getUser = User::where('email', $user->email)->first();

            $getNgo = NGO::where('user_id', $getUser->id)->first();

            $getKota = Kota::where('id', $getNgo->ngo_kota)->first();

            $data = [
                'pic' => $getUser,
                'ngo' => $getNgo,
                'kota' => $getKota->nama
            ];

            return view('ngo/ngo_profile', ['data' => $data]);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }

    public function editProfile(Request $request)
    {
        try {
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getData = User::where('email', $user->email)->first();

            $getNgo = NGO::where('user_id', $getData['id'])->first();

            //edit
            if ($request->password == null) {
                $data_credentials = [
                    "nama"      => $request->nama,
                ];
            } else {
                $data_credentials = [
                    "nama"      => $request->nama,
                    "password"  => Hash::make($request->password)
                ];
            }


            if ($request['pic_foto'] !== null && $request['pic_foto'] !== 'undefined') { //kondisi saat foto berubah
                File::delete($getNgo->pic_foto);

                $path = "images/ngo";
                $requestFile = $request['pic_foto'];
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    "no_identitas"      => $request->no_identitas,
                    "pic_foto"          => $insertImage
                ];
            } else {
                $data = [
                    "no_identitas"      => $request->no_identitas
                ];
            }

            NGO::find($getNgo['id'])->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Data profile telah diubah.',
                'route'     => route('ngo.profile')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }
}
