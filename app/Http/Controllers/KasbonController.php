<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKasbonRequest;
use App\Http\Requests\UpdateKasbonRequest;
use App\Http\Requests\UpdateMasalKasbonRequest;
use App\Models\Kasbon;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\KasbonResource;
use App\Jobs\SetujuiKasbonMasal;
use App\Models\Pegawai;
use Illuminate\Support\Carbon;

class KasbonController extends Controller
{
    public function index(Request $request)
    {
        $kasbon = new Kasbon();
        $data = $kasbon->getAll($request);
        return response()->json(KasbonResource::collection($data));
    }

    public function store(StoreKasbonRequest $request)
    {
        $kasbon = Kasbon::create([
            'tanggal_diajukan' => Carbon::now(),
            'pegawai_id' => $request->pegawai_id,
            'total_kasbon' => $request->total_kasbon,
        ]);

        return response()->json(new KasbonResource($kasbon));
    }

    public function setujui(UpdateKasbonRequest $request)
    {
        $kasbon = new Kasbon();
        $data = $kasbon->setujui($request->id);

        return response()->json(new KasbonResource($data));
    }

    public function setujui_masal(UpdateMasalKasbonRequest $request)
    {
        $job = (new SetujuiKasbonMasal($request->id))
            ->delay(now()->addSeconds(2));
        dispatch($job);

        $kasbon = new Kasbon();
        $data = $kasbon->getAllTotalKasbon($request->id);

        return response()->json($data);
    }
}
