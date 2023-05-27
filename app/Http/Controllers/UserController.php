<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function login(Request $request){
        $login = Auth::attempt([
            'email'     => $request->email,
            'password'  => $request->password,
        ]);

        if($login == 1){
            $user = Auth::user()->roles[0]->name;

            if($user == "admin"){
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'login-user',
                    'message'   => 'Log in berhasil',
                    'route'     => Auth::user()
                ], 200);
            }else if($user == "ngo"){
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'login-user',
                    'message'   => 'Log in berhasil',
                    'route'     => Auth::user()
                ], 200);
            }else if($user == "donatur"){
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'login-user',
                    'message'   => 'Log in berhasil',
                    //'route'     => route('donatur/dashboard')
                ], 200);
            }
        }else{
            return response()->json([
                'status'    => 'fail-verif',
                'message'   => 'Terdapat kesalahan pada email atau password'
            ], 400);
        }
    }

    public function detail(Request $request){
        try{
            //$email = Auth::user()->email;
            $user = User::with('donatur')->where('email', $request->email)->first();
            return $user;
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function edit(Request $request){
        try{
            //$email = Auth::user()->email;
            // $user = User::with('donatur')->where('email', $request->email)->first();

            $data_credentials = [
                "email"     => $request->email_new,
                "password"  => Hash::make($request->password)
            ];

            User::find($user['id'])->update($data_credentials);

            $data = [];
            if($role == 'donatur'){
                $donatur_profil = User::with('donatur')->where('email', $request['email_new'])->get();
                unlink($donatur_profil['foto']);
                $path = "images/donatur";
                $requestFile = $request->foto;
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    "foto"          => $insertImgae,
                    "nama"          => $request->nama,
                    "no_identitas"  => $request->no_identitas,
                    "tanggal_lahir" => $request->tanggal_lahir,
                    "no_telp"       => $request->no_telp,
                    "alamat"        => $request->alamat
                ];

                Donatur::find($user['id'])->update($data);
            }else if ($role == 'ngo'){
                $ngo_profil = User::with('ngo')->where('email', $request['email_new'])->get();
                unlink($ngo_profil['foto']);
                $path = "images/profile";
                $requestFile = $request->foto;
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

                NGO::find($user['id'])->update($data_ngo);
            }else if ($role == 'admin'){
                $admin_profil = User::with('admin')->where('email', $request['email_new'])->get();
                unlink($admin_profil['foto_profil']);
                $path = "images/admin";
                $requestFile = $request->foto;
                $insertImage = File::fileUpload($requestFile, $path);

                $data_admin = [
                    'id'            => $user->id,
                    'foto_profil'   => $request->foto_profil,
                    'no_identitas'  => $requet->no_identitas
                ];

                Admin::find($user['id'])->update($data_admin);
            }
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }
}
