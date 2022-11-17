<?php

namespace App\Helpers;

class MessageHelper
{
    public static function error($status, $message)
    {
        return response()->json([
            'status'        => $status,
            'msg'           => $message,
        ], 200);
  	}

    public static function resultAuth($status, $message, $data, $responseCode = 200)
    {
        return response()->json([
            'status'             => $status,
            'msg'                => $message,
            'data'               => $data,
        ], $responseCode);
    }
}