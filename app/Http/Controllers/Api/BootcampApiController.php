<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MessageHelper;
use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class BootcampApiController extends Controller
{
    public function index()
    {
        $bootcamp = Bootcamp::get()
                    ->map(function ($bootcamp){
                        return $this->format($bootcamp);
                    });
        return $this->result($bootcamp);
    }

    public function detail($id)
    {
        $bootcamp = Bootcamp::where('id',$id)
                    ->get()
                    ->map(function ($bootcamp){
                        return $this->format($bootcamp);
                    });
        return $this->result($bootcamp);
    }

    public function addBootcamp(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kategori_id'       => 'required',
            'mentor_id'         => 'required',
            'nama_bootcamp'     => 'required|unique:bootcamps',
            'harga'             => 'required|numeric',
            'deskripsi'         => 'required',
            'thumbnail'         => 'required',
            'kuota'             => 'required',
        ]);

        if($validasi->fails()){
            $valIndex = $validasi->errors()->all();
            return MessageHelper::error(false, $valIndex[0]);
        }

        $bootcamps = Bootcamp::create([
            'kategori_id'       => $request->kategori_id,
            'mentor_id'         => $request->mentor_id,
            'nama_bootcamp'     => $request->nama_bootcamp,
            'slug'              => Str::slug($request->nama_bootcamp),
            'harga'             => $request->harga,
            'deskripsi'         => $request->deskripsi,
            'thumbnail'         => $request->file('thumbnail')->store('img-bootcamp'),
            'kuota'             => $request->kuota,
        ]);

        $bootcamp = Bootcamp::where('id',$bootcamps->id)
                    ->get()
                    ->map(function ($bootcamp){
                        return $this->format($bootcamp);
                    });

        return $this->result($bootcamp);
    }

    public function format($bootcamp)
    {
        return [
            'id'        => $bootcamp->id,
            'kategori'  => $bootcamp->kategori->nama_kategori,
            'bootcamp'  => $bootcamp->nama_bootcamp,
            'mentor'    => $bootcamp->mentor->name,
            'price'     => $bootcamp->harga,
            'desc'      => $bootcamp->deskripsi,
            'image'     => $bootcamp->thumbnail,
            'status'    => $bootcamp->status,
            'kuota'     => $bootcamp->kuota,
        ];
    }

    public function result($bootcamp)
    {
        return response()->json([
            'status'    => true,
            'data'      => $bootcamp,
        ], 200);
    }

    public function errorWoy($status, $message)
    {
        return response()->json([
            'status'        => $status,
            'message'       => $message,
        ], 200);
    }
}
