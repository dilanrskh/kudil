<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MessageHelper;
use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255','unique:users'],
            'email'     => ['required', 'string', 'email', 'max:255','unique:users'],
            'password'  => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        if($validasi->fails()){
            $valIndex = $validasi->errors()->all();
            return MessageHelper::error(false, $valIndex[0]);
        }

        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'blokir'    => 1,
            'password'  => Hash::make($request->password),
        ]);

        Peserta::create([
            'user_id'   => $user->id
        ]);

        return response()->json([
            'status'             => true,
            'msg'                => 'Registrasi Berhasil',
        ], 200);

    }

}
