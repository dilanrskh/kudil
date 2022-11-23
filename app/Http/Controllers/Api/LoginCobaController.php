<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginCobaController extends Controller
{
    public function LoginCoba()
    {
        $response = Http::post("https://warungbangkrut14.herokuapp.com/api/login");
        dd(json_decode($response));
        // $data_doa = json_decode($response);

        return $response;
        //   return view('additional.logincoba');
    }
    public function RegisCoba(Request $request)
    {
        $respon = Http::post("https://warungbangkrut14.herokuapp.com/api/registrasi", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,

        ]);
        dd(json_decode($respon));

        return $respon;
    }

    public function FormCoba()
    {
        return view('additional.logincoba');
    }
}
