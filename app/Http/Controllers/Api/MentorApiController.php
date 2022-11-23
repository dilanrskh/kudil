<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FormatUserHelper;
use App\Helpers\MessageHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MentorApiController extends Controller
{
    public function mentor()
    {
        $mentor = User::where('role', 2)
            ->get()
            ->map(function ($mentor) {
                return FormatUserHelper::formatResultAuth($mentor);
            });

            $msg = "Registrasi Mentor Baru Berhasil";
        return MessageHelper::resultAuth(true, $msg, $mentor);

    }

    public function addmentor(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'username'  => ['required', 'string', 'max:255', 'unique:users'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:4',],
            'images'    => ['required'],
        ]);

        if ($validasi->fails()) {
            $valIndex = $validasi->errors()->all();
            return MessageHelper::error(false, $valIndex[0]);
        }

        $mentor = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'blokir'    => 1,
            'role'    => 2,
            'password'  => Hash::make($request->password),
            'images'    => $request->file('images')->store('img-mentor'),
        ]);

        $detail = FormatUserHelper::resultUser($mentor->id);

        $msg = "Registrasi Mentor Baru Berhasil";
        return MessageHelper::resultAuth(true, $msg, $detail);
    }

    public function updatementor(Request $request, $username)
    {
        $mentor = User::where('username', $username)->first();

        if(!$mentor){
            return MessageHelper::error(false, "Username $username mana ada");
        }

        if($mentor->role !== 2){
            return MessageHelper::error(false, "Username $username bukan mentor cuy");
        }

        $validasi = Validator::make($request->all(), [
            'name'      => ['required'],
            'username'  => ['required'],
            'email'     => ['required', 'email'],
        //     'password'  => ['required', 'min:4'],
        //     'images'    => ['required'],
        ]);

        if ($validasi->fails()) {
            $valIndex = $validasi->errors()->all();
            return MessageHelper::error(false, $valIndex[0]);
        }

        $mentor->update([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            // 'password'  => Hash::make($request->password),
            // 'images'    => $request->file('images')->store('img-mentor'),

        ]);

            $detail = FormatUserHelper::resultUser($mentor->id);

        $msg = "Update Mentor Berhasil";
        return MessageHelper::resultAuth(true, $msg, $detail);
            
        // return $mentor;     
    }
}
