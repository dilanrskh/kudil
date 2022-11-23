<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UjiController extends Controller
{
    public function ujiCoba()
    {
        return view('additional.baru');
    }
}
