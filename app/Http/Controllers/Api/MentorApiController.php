<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MentorApiController extends Controller
{
    public function mentor()
    {
        $mentor = User::where('role',2)->get();
        return response()->json([
            'status'    => true,
            'msg'       => "Berhasil mendapatkan mentor",
            'data'      => $mentor,
        ]);
    }
}
