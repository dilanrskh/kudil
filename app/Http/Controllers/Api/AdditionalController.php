<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdditionalController extends Controller
{
    public function getDoa()
    {
        $response = Http::get("https://doa-doa-api-ahmadramadhan.fly.dev/api");
        //    dd(json_decode($response));
        $data_doa = json_decode($response);

        return view('additional.doa', [
            'data_doa' => $data_doa
        ]);
    }

    public function regis()
    {
        return view('additional.logincoba');
    }

    public function login()
    {
        return view('additional.login');
    }

    public function ProsesRegis(Request $request)
    {
        $respon = Http::post("https://warungbangkrut14.herokuapp.com/api/registrasi", $request->all());
        $data = json_decode($respon);

        if($data->status == 0) {
            return redirect()->back()->with('error', $data->message);
        }else{
            return redirect('/login')->with('Ok', $data->pesan);
        }
    }
}
