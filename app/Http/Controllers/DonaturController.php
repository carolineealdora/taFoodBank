<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\File;
use App\Models\Donasi;
use App\Models\Donatur;
use Illuminate\Http\Request;
use App\Models\DonasiKonsumsi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                'message'   => 'Register telah berhasil',
                'route'     => route('donatur.showLogin')
            ], 200);
        }catch(Throwable $e){
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }

    }

    public function storeDonasi(Request $request){
        try{
            // return $request;
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
            //return $konsumsi;
            foreach($konsumsi as $donasi_konsumsi){
               // return $donasi_konsumsi;
                // $path = "images/donasi";
                // $requestFile = $donasi_konsumsi['photo'];
                //return $requestFile;
                // $insertImage = File::fileUpload($requestFile, $path);

                // return $insertImage;
                $data = [
                    "donasi_id"    => $donasi['id'],
                    "nama"      => $donasi_konsumsi['nama'],
                    // "photo"     => $insertImage,
                    "photo"     => 'tes',
                    "deskripsi" => $donasi_konsumsi['deskripsi'],
                    "kategori"  => $donasi_konsumsi['kategori'],
                    "satuan"    => $donasi_konsumsi['satuan'],
                    "kuantitas" => $donasi_konsumsi['kuantitas'],
                    "expired"   => $donasi_konsumsi['expired']
                ];

                // return $data;

                $create = DonasiKonsumsi::create($data);
                // return $create;

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
                "ngo_tujuan"        => $request->ngo_tujuan,
                "kota"              => $request->kota,
                "nama_pickup"       => $request->nama_pickup,
                "alamat_pickup"     => $request->alamat_pickup,
                "no_telp_pickup"    => $request->no_telp_pickup,
            ];

            $donasi = Donasi::find($id)->update($data);
            // return $donasi;
            //bikin request bisa passing id (bikin tag hidden buat idnya)
            foreach($request->donasi_konsumsi as $donasi_konsumsi){
                $konsumsi_photo = DonasiKonsumsi::where('id', $donasi_konsumsi['id'])->get();
                // return $konsumsi_photo;
                if($donasi_konsumsi['photo'] !== null){ //kondisi saat foto berubah
                    unlink($konsumsi_photo->photo);
                    $path = "images/donasi";
                    $requestFile = $request->photo;
                    // return $requestFile;
                    $insertImage = File::fileUpload($requestFile, $path);
                    $data = [
                        "donasi"    => $donasi->id,
                        "nama"      => $donasi_konsumsi['nama'],
                        "photo"     => $insertImage,
                        "deskripsi" => $donasi_konsumsi['deskripsi'],
                        "kategori"  => $donasi_konsumsi['kategori'],
                        "satuan"    => $donasi_konsumsi['satuan'],
                        "kuantitas" => $donasi_konsumsi['kuantitas'],
                        "expired"   => $donasi_konsumsi['expired']
                    ];

                    DonasiKonsumsi::find($donasi_konsumsi['id'])->update($data);

                    return response()->json([
                        'status'    => 'ok',
                        'response'  => 'created',
                        'message'   => 'Selamat! Donasi telah terkirim.',
                        // 'route'     => route('donatur/donasi')
                    ], 200);
                }else{
                    $data = [
                        "donasi"    => $donasi->id,
                        "nama"      => $donasi_konsumsi['nama'],
                        "deskripsi" => $donasi_konsumsi['deskripsi'],
                        "kategori"  => $donasi_konsumsi['kategori'],
                        "satuan"    => $donasi_konsumsi['satuan'],
                        "kuantitas" => $donasi_konsumsi['kuantitas'],
                        "expired"   => $donasi_konsumsi['expired']
                    ];

                    DonasiKonsumsi::find($donasi_konsumsi['id'])->update($data);

                    return response()->json([
                        'status'    => 'ok',
                        'response'  => 'created',
                        'message'   => 'Selamat! Donasi telah terkirim.',
                        // 'route'     => route('donatur/donasi')
                    ], 200);
                }
            }
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);

        }
    }

    public function getList(){
        try{
            $getList = Donasi::with("donasi_konsumsi")->get();
            return $getList;
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function getDetail($id){
        try{
            $getDetail = Donasi::with("donasi_konsumsi")->find($id);
            return $getDetail;
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
