<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GunungApiController extends Controller
{
    public function GunungApi() 
    {
       $response = Http::get("https://indonesia-public-static-api.vercel.app/api/volcanoes");
    //    dd(json_decode($response));
    $gunung_api = json_decode($response);

    return view('additional.gunungapi', [
        'gunung_api' => $gunung_api
    ]);
    }
}
