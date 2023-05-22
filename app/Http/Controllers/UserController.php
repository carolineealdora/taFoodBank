<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

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
                    'route'     => route('admin/dashboard')
                ], 200);
            }else if($user == "ngo"){
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'login-user',
                    'message'   => 'Log in berhasil',
                    'route'     => route('ngo/dashboard')
                ], 200);
            }else if($user == "donatur"){
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'login-user',
                    'message'   => 'Log in berhasil',
                    'route'     => route('donatur/dashboard')
                ], 200);
            }
        }else{
            return response()->json([
                'status'    => 'fail-verif',
                'message'   => 'Terdapat kesalahan pada email atau password'
            ], 400);
        }
    }
}
