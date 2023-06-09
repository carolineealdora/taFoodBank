<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\File;
use App\Models\Donasi;
use App\Models\Pickup;
use App\Models\Donatur;
use Illuminate\Http\Request;
use App\Models\DonasiKonsumsi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as facadesFile;

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
        return view('donatur/donatur_dashboard');
    }

    // public function donasi()
    // {
    //     return view('donatur/donatur_donasi');
    // }

    // public function profile()
    // {
    //     return view('donatur/donatur_profile');
    // }

    // public function detailDonasi()
    // {
    //     return view('donatur/donatur_detail_donasi');
    // }

    public function createDonasi()
    {
        return view('donatur/donatur_create_donasi');
    }

    public function register(Request $request)
    {
        try{
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
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }

    }

    public function getProfile(){
        try{
            //check user logged in
            $user = Auth::user();

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
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getData = User::where('email', $request->email)->first();
            $getDonatur = Donatur::where('user_id', $getData['id'])->first();

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

            if($request['foto'] !== null){ //kondisi saat foto berubah
                File::delete($getDonatur->foto);

                $path = "images/donatur";
                $requestFile = $request['foto'];
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    "foto"              => $request->insertImage,
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
                // 'route'     => route('donatur/donasi')
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
            //$email = Auth::user()->email;
            $user = User::with('donatur')->where('email', $request->email)->first();
            $id_donatur = $user->donatur->id;
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

                $create = DonasiKonsumsi::create($data);

                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'created',
                    'message'   => 'Selamat! Donasi telah terkirim.',
                    // 'route'     => route('donatur/donasi')
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

    public function editDonasi(Request $request, $id){
        try{
            $data = [
                // "ngo_tujuan"        => $request->ngo_tujuan,
                // "kota"              => $request->kota,
                "nama_pickup"       => $request->nama_pickup,
                "alamat_pickup"     => $request->alamat_pickup,
                "no_telp_pickup"    => $request->no_telp_pickup,
            ];

            $donasi = Donasi::find($id)->update($data);
            // return $donasi;
            //bikin request bisa passing id (bikin tag hidden buat idnya)
            foreach($request->donasi_konsumsi as $donasi_konsumsi){
                $konsumsi_photo = DonasiKonsumsi::where('id', $donasi_konsumsi['id'])->get();
                if($donasi_konsumsi['photo'] !== null){ //kondisi saat foto berubah
                    // return $konsumsi_photo[0]['photo'];
                    // unlink($konsumsi_photo[0]['photo']);
                    // facadesFile::delete($konsumsi_photo[0]['photo']);
                    File::delete($konsumsi_photo[0]['photo']);

                    $path = "images/donasi";
                    $requestFile = $donasi_konsumsi['photo'];
                    // return $tes = [$requestFile, 'ini'];
                    $insertImage = File::fileUpload($requestFile, $path);
                    // return $insertImage;
                    $data = [
                        // "donasi"    => $id,
                        "nama"      => $donasi_konsumsi['nama'],
                        "photo"     => $insertImage,
                        "deskripsi" => $donasi_konsumsi['deskripsi'],
                        "kategori"  => $donasi_konsumsi['kategori'],
                        "satuan"    => $donasi_konsumsi['satuan'],
                        "kuantitas" => $donasi_konsumsi['kuantitas'],
                        "expired"   => $donasi_konsumsi['expired']
                    ];

                    // return $data;

                    // DonasiKonsumsi::find($donasi_konsumsi['id'])->update($data);

                    return response()->json([
                        'status'    => 'ok',
                        'response'  => 'created',
                        'message'   => 'Selamat! Donasi telah terkirim.',
                        // 'route'     => route('donatur/donasi')
                    ], 200);
                }else{
                    $data = [
                        // "donasi"    => $donasi->id,
                        "nama"      => $donasi_konsumsi['nama'],
                        "deskripsi" => $donasi_konsumsi['deskripsi'],
                        "kategori"  => $donasi_konsumsi['kategori'],
                        "satuan"    => $donasi_konsumsi['satuan'],
                        "kuantitas" => $donasi_konsumsi['kuantitas'],
                        "expired"   => $donasi_konsumsi['expired']
                    ];


                    return response()->json([
                        'status'    => 'ok',
                        'response'  => 'created',
                        'message'   => 'Selamat! Donasi telah terkirim.',
                        // 'route'     => route('donatur/donasi')
                    ], 200);
                }

                DonasiKonsumsi::find($donasi_konsumsi['id'])->update($data);
            }
        } catch (Throwable $e) {
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

            // get data ngo berdasarkan id user logged in
            $getUser = User::with("donatur")->where('email', $user->email)->first();

            //get list donasi berdasarkan id ngo
            $getData = DB::table("views_donasi")->where("donatur", $getUser->donatur->id)->get();
            // return $getData;
            return view('donatur/donatur_donasi', ['data' => $getData]);
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function getDetailDonasi($id){
        try{
            $getDonasi = Donasi::with("kota")->find($id);
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
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function deleteDonasi($id){
        try{
            $delete = Donasi::find($id)->delete();
            return $delete;
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }
}
