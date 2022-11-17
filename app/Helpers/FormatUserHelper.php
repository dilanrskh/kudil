<?php

namespace App\Helpers;

use Carbon\Carbon;

class FormatUserHelper
{
    public static function formatResultAuth($user)
    {
        return [
            'user_id'       => $user->id,
            'nama'          => $user->name,
            'username'      => $user->username,
            'email'         => $user->email,
            'terdaftar'     => Carbon::parse($user->created_at)->translatedFormat('d F Y'),
        ];
    }
}