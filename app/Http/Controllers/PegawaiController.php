<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiFormRequest;
use App\Http\Requests\StorePegawaiRequest;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\PegawaiResource;
use App\Models\Pegawai;

class PegawaiController extends Controller
{

    public function index(Request $request)
    {
        $pegawai = new Pegawai();
        $data = $pegawai->getAll($request);

        return response()->json(PegawaiResource::collection($data));
    }

    public function store(StorePegawaiRequest $request)
    {

        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'tanggal_masuk' => $request->tanggal_masuk,
            'total_gaji' => $request->total_gaji,
        ]);

        return response()->json(new PegawaiResource($pegawai));
    }
}
