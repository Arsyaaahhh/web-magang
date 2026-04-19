<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = DB::table('users')
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if(!$user){
            return response()->json([
                'status' => 'error',
                'message' => 'Username atau password salah'
            ]);
        }

        // 🔥 SET SESSION
        session([
            'login' => true,
            'role' => $user->role,
            'username' => $user->username
        ]);

        session()->save(); // 🔥 PENTING BANGET

        return response()->json([
            'status' => 'success',
            'role' => $user->role
        ]);
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
}