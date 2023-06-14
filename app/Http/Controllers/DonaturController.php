<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\NGO;
use App\Models\Kota;
use App\Models\User;
use App\Helpers\File;
use App\Models\Donasi;
use App\Models\Pickup;
use App\Models\Satuan;
use App\Models\Donatur;
use App\Models\Kategori;
use App\Models\LogStatus;
use Illuminate\Http\Request;
use App\Models\LaporanDonasi;
use App\Models\DonasiKonsumsi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as facadesFile;
use Illuminate\Support\Facades\Validator;

class DonaturController extends Controller
{
    public function showLoginForm()
    {
        return view('donatur.donatur_login');
    }

    public function showRegisterForm()
    {
        return view('donatur.donatur_register');
    }

    public function dashboard()
    {
        $userId = Auth::user()->id;
        $getDataDonatur = Donatur::where("user_id", $userId)->first();
        $donaturId = $getDataDonatur->id;
        $countSubmitted = Donasi::where("donatur", $donaturId)->where("status_donasi", 1)->count();
        $countApproved = Donasi::where("donatur", $donaturId)->where("status_donasi", 2)->count();
        $countRejected = Donasi::where("donatur", $donaturId)->where("status_donasi", 3)->count();
        $countPickedUp = Donasi::where("donatur", $donaturId)->where("status_donasi", 4)->count();
        $countFinished = Donasi::where("donatur", $donaturId)->where("status_donasi", 5)->count();
        $data = [
            'submited' => $countSubmitted,
            'approved' => $countApproved,
            'rejected' => $countRejected,
            'pickedup' => $countPickedUp,
            'finished' => $countFinished,
        ];
        return view('donatur/donatur_dashboard', $data);
    }

    public function createDonasi()
    {
        //constanta untuk form
        $kategori = Kategori::get();
        $satuan = Satuan::get();
        $kota = Kota::get();
        $ngos = NGO::get();
        $data = [
            "kategori" => $kategori,
            "satuan" => $satuan,
            "kota" => $kota,
            "ngos" => $ngos
        ];

        return view('donatur/donatur_create_donasi', $data);
    }

    public function register(Request $request)
    {
        try{
            // Validation
            $rules = [
                'foto' => 'required|mimes:jpg,jpeg,png,svg',
                'password' => 'required|min:8',
                'no_identitas' => 'required|max:20|min:16',
            ];

            $messages = [
                'foto.mimes' => 'Hanya menerima extensi JPG, JPEG, PNG, SVG !',
                'password.min' => 'Password minimal 8 karakter!',
                'no_identitas.min' => 'No identitas minimal 16 karakter!',
                'no_identitas.max' => 'No identitas maksimasl 20  karakter!',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $data_user = [
                'nama'  => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];

            $user = User::firstOrCreate($data_user);
            $user->assignRole('donatur');

            $path = "images/donatur";
            $requestFile = $request->foto;
            $insertImage = File::fileUpload($requestFile, $path);
            $data_donatur = [
                'user_id'       => $user->id,
                'foto'          => $insertImage,
                'alamat'        => $request->alamat,
                'no_telp'       => $request->no_telp,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_identitas'  => $request->no_identitas
            ];

            //bikin kondisi kalo email sama
            Donatur::create($data_donatur);
            return response()->json([
                'status'    => 'ok',
                'response'  => 'register-donatur',
                'message'   => 'Selamat! Anda telah terdaftar',
                'route'     => route('donatur.showLogin')
            ], 200);
        }catch(Throwable $e){
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan pada sistem!'
            ], 500);
        }

    }

    public function getProfile(){
        try{
            //check user logged in
            $user = Auth::user();
            // return $user;

            // get data donatur berdasarkan id user logged in
            $getData= User::with("donatur")->where('email', $user->email)->first();

            return view('donatur/donatur_profile', ['data' => $getData]);
        }catch(Throwable $e){
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }

    public function editProfile(Request $request){
        try{
            // return $request;
            //check user logged in
            $user = Auth::user();
            // return $user;

            // get data donatur berdasarkan id user logged in
            $getData = User::where('email', $user->email)->first();
            $getDonatur = Donatur::where('user_id', $getData['id'])->first();
            // return $getData['id'];
            //edit
            if($request->password == null){
                $data_credentials = [
                    "nama"      => $request->nama,
                    "email"     => $request->email
                ];
            }else{
                $data_credentials = [
                    "nama"      => $request->nama,
                    "email"     => $request->email,
                    "password"  => Hash::make($request->password)
                ];
            }

            User::find($getData['id'])->update($data_credentials);

            if($request['foto'] !== null && $request['foto'] !== 'undefined'){ //kondisi saat foto berubah
                File::delete($getDonatur->foto);

                $path = "images/donatur";
                $requestFile = $request['foto'];
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    "foto"              => $insertImage,
                    "alamat"            => $request->alamat,
                    "no_identitas"      => $request->no_identitas,
                    "tanggal_lahir"     => $request->tanggal_lahir,
                    "no_telp"           => $request->no_telp
                ];
            }else{
                $data = [
                    "alamat"            => $request->alamat,
                    "no_identitas"      => $request->no_identitas,
                    "tanggal_lahir"     => $request->tanggal_lahir,
                    "no_telp"           => $request->no_telp
                ];
            }

            Donatur::find($getDonatur['id'])->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Data profile telah diubah.',
                'route'     => route('donatur.profile')
            ], 200);
        }catch(Throwable $e){
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('donatur/show-login');
    }

    public function storeDonasi(Request $request){
        try{
            // return 'sampe sini';
            // return $request;
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getData = User::where('email', $user->email)->first();
            $getDonatur = Donatur::where('user_id', $getData['id'])->first();
            // return $getData['id'];
            //
            // $email = Auth::user()->email;
            // $user = User::with('donatur')->where('email', $request->email)->first();
            // return $user;
            $id_donatur = $getDonatur->id;

            // return $id_donatur;

            $data = [
                "donatur"           => $id_donatur,
                "ngo_tujuan"        => $request->ngo_tujuan,
                "kota"              => $request->kota,
                "nama_pickup"       => $request->nama_pickup,
                "alamat_pickup"     => $request->alamat_pickup,
                "no_telp_pickup"    => $request->no_telp_pickup,
                "status_donasi"     => 1,
            ];

            $donasi = Donasi::create($data);

            $konsumsi = $request->donasi_konsumsi;
            // return $konsumsi;
            foreach($konsumsi as $donasi_konsumsi){
                // return $donasi_konsumsi;
                $path = "images/donasi";
                $requestFile = $donasi_konsumsi['photo'];
                // return $requestFile;
                $insertImage = File::fileUpload($requestFile, $path);
                $data = [
                    "donasi_id"     => $donasi['id'],
                    "nama"          => $donasi_konsumsi['nama'],
                    "photo"         => $insertImage,
                    "deskripsi"     => $donasi_konsumsi['deskripsi'],
                    "kategori"      => $donasi_konsumsi['kategori'],
                    "satuan"        => $donasi_konsumsi['satuan'],
                    "kuantitas"     => $donasi_konsumsi['kuantitas'],
                    "expired"       => $donasi_konsumsi['expired']
                ];

                DonasiKonsumsi::create($data);

                $logData = [
                    'donasi_id' => $donasi['id'],
                    'status_message' => "Submitted",
                ];

                LogStatus::create($logData);

                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'created',
                    'message'   => 'Selamat! Donasi telah terkirim.',
                    'route'     => route('donatur.donasi')
                ], 200);
            }
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => $e,
                // 'message' => $e,
            ], 500);
        }
    }

    public function tambahDonasiKonsumsi(Request $request, $id){
        try{
            // return 'sampe sini';
            // return $request;
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getData = User::where('email', $user->email)->first();
            $getDonatur = Donatur::where('user_id', $getData['id'])->first();
            $id_donatur = $getDonatur->id;

            // $dataDonasi = Donasi::find($id)->first();

            $path = "images/donasi";
            $requestFile = $request['photo'];
            // return $requestFile;
            $insertImage = File::fileUpload($requestFile, $path);
            $data = [
                "donasi_id"     => $id,
                "nama"          => $request['nama'],
                "photo"         => $insertImage,
                "deskripsi"     => $request['deskripsi'],
                "kategori"      => $request['kategori'],
                "satuan"        => $request['satuan'],
                "kuantitas"     => $request['kuantitas'],
                "expired"       => $request['expired']
            ];

            DonasiKonsumsi::create($data);

            $logData = [
                'donasi_id' => $id,
                'status_message' => "Submitted",
            ];

            LogStatus::create($logData);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Donasi telah ditambahkan.',
                'route'     => route('donatur.detail-donasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => $e,
                // 'message' => $e,
            ], 500);
        }
    }

    public function editDonasi(Request $request, $id)
    {
        try{
            // return $request;
            $dataDonasiKonsumsi = DonasiKonsumsi::find($id)->first();

            $photo = $dataDonasiKonsumsi->photo;
            $requestFile = $request->donasiFoto;
            if ($requestFile !== null && $requestFile !== 'undefined') {
                File::delete($photo);
                $path = "images/donasi";
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

            DonasiKonsumsi::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated-donkom',
                'message'   => 'Update Data Telah Berhasil!',
                'route'     => route('donatur.detail-donasi', $dataDonasiKonsumsi->donasi_id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);

        }
    }

    public function editPickup(Request $request, $id){
        try{
            // return $request;

            $getPickup = Donasi::find($id)->first();

            $data = [
                'kota' => $request->kota,
                'ngo_tujuan' => $request->ngo_tujuan,
                'nama_pickup' => $request->nama_pickup,
                'no_telp_pickup' => $request->no_telp_pickup,
                'alamat_pickup' => $request->alamat_pickup
            ];

            Donasi::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated-pickup',
                'message'   => 'Update Data Telah Berhasil!',
                'route'     => route('donatur.detail-donasi', $id)
            ], 200);
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function getListDonasi(){
        try{
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getUser = User::with("donatur")->where('email', $user->email)->first();

            //get list donasi berdasarkan id donatur
            $getDataTable = DB::table("views_donasi")->where("donatur", $getUser->donatur->id);

            //generate datatable
            if(request()->ajax()){
                return DataTables()->queryBuilder($getDataTable)
                    ->addColumn('ngo_nama', function ($query){
                        $ngo_nama = $query->ngo_nama;

                        return $ngo_nama;
                    })
                    ->addColumn('donasi_konsumsi', function ($query){
                        $donasi_konsumsi = $query->donasi_konsumsi;

                        return $donasi_konsumsi;
                    })
                    ->addColumn('status_donasi', function ($query){
                        $status_donasi = $query->status_donasi;
                        if($status_donasi == "submitted"){
                            $badge = '<span class="badge badge-sm bg-gradient-warning">Submitted</span>';
                        }elseif($status_donasi == "approved"){
                            $badge = '<span class="badge badge-sm bg-gradient-success">Approved</span>';
                        }elseif($status_donasi == "rejected"){
                            $badge = '<span class="badge badge-sm bg-gradient-danger">Rejected</span>';
                        }elseif($status_donasi == "pickedup"){
                            $badge = '<span class="badge badge-sm bg-gradient-info">Picked Up</span>';
                        }elseif($status_donasi == "finished"){
                            $badge = '<span class="badge badge-sm bg-gradient-primary">Finished</span>';
                        }
                        return $badge;
                    })
                    ->addColumn('tanggal_waktu', function ($query){
                        $tanggal = $query->tanggal;

                        return $tanggal;
                    })
                    ->addColumn('action', function ($query){
                        $button = '
                        <div>
                        <button id="' . $query->id . '" class="action-detail btn btn-secondary btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Detail">
                          <span style="color : white">Detail</span>
                        </button>
                        </div>
                        <div>
                        <button id="' . $query->id . '" class="action-hapus btn btn-danger btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Edit">
                            <span style="color : white">Hapus</span>
                        </button>
                        </div>
                        ';

                        return $button;
                    })
                    ->rawColumns(['nama_user', 'donasi_konsumsi', 'status_donasi', 'tanggal_wwaktu', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('donatur/donatur_donasi');
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function detailDonasi($id){
        try{
            //Current Status
            $dataCurrentLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'desc')->first();
            //log donasi
            $dataLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'asc')->get();
            $dataDonasi = Donasi::with("donaturData", "ngo", "kotaData")->where("id", $id)->first();
            //informasi user
            $userId = $dataDonasi->donaturData->user_id;
            $userData = User::where("id", $userId)->first();
            //informasi donasi konsumsi
            $dataDonasiKonsumsi = DonasiKonsumsi::with("donasi", "dataKategori", "dataSatuan")->where("donasi_id", $id)->get();
            //informasi data pickup
            $dataPickup = Pickup::with("donasiData", "dataKategori", "dataSatuan")->where("donasi_id", $id)->get();

            //Get Data Report Donasi
            $dataReport = LaporanDonasi::where('donasi_id', $id)->get();

            //constanta untuk form
            $kategori = Kategori::get();
            $satuan = Satuan::get();
            $kota = Kota::get();
            $ngos = NGO::get();
            $data = [
                "dataCurrentLog" => $dataCurrentLog,
                "dataLog" => $dataLog,
                "dataDonasi" => $dataDonasi,
                "dataUser" => $userData,
                "dataDonKom" => $dataDonasiKonsumsi,
                "dataPickup" => $dataPickup,
                "dataReport" => $dataReport,
                "kategori" => $kategori,
                "satuan" => $satuan,
                "kota" => $kota,
                "ngos" => $ngos
            ];

            return view('donatur/donatur_detail_donasi', $data);
        }catch(Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function deleteDonasiKonsumsi($id){
        try{
            $dataDonasiKonsumsi = DonasiKonsumsi::find($id)->first();
            $dataDonasi = $dataDonasiKonsumsi->donasi_id;

            File::delete($dataDonasiKonsumsi->photo);

            DonasiKonsumsi::find($id)->delete();

            return response()->json([
                'status'    => 'ok',
                'response'  => 'deleted-donasi',
                'message'   => 'Delete data Telah Berhasil!',
                'route'     => route('donatur.detail-donasi', $dataDonasi)
            ], 200);
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function deleteDonasi($id){
        try{
            //get all data donasi konsumsi with the same donasi id
            $dataDonasiKonsumsi = DonasiKonsumsi::where('donasi_id', $id)->get();

            foreach($dataDonasiKonsumsi as $donasi_konsumsi){
                File::delete($donasi_konsumsi->photo);
            }

            Donasi::find($id)->delete();

            return response()->json([
                'status'    => 'ok',
                'response'  => 'deleted-donasi',
                'message'   => 'Delete data Telah Berhasil!',
                'route'     => route('donatur.donasi')
            ], 200);
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }
}
