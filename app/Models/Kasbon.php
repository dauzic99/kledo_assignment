<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasbon extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal_diajukan',
        'tanggal_disetujui',
        'pegawai_id',
        'total_kasbon'
    ];

    public function getAll($request)
    {
        $date = explode('-', $request->bulan);
        $year = $date[0];
        $month = $date[1];
        $data = $this->whereYear('tanggal_diajukan', '=', $year)
            ->whereMonth('tanggal_diajukan', '=', $month);
        if ($request->belum_disetujui) {
            $data->where('tanggal_disetujui', '=', null);
        }
        if ($request->page != null) {
            return $data->paginate(10);
        }
        return $data->get();
    }

    public function setujui($id)
    {

        $data = $this->findOrFail($id);
        $data->tanggal_disetujui = Carbon::now();
        $data->update();
        return $data;
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
