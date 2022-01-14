<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'tanggal_masuk',
        'total_gaji',
    ];

    public function getAll($request)
    {
        if ($request->page == null) {
            $data = $this->all();
        } else {
            $data = $this->paginate(10);
        }
        return $data;
    }

    public function kasbon()
    {
        return $this->hasMany(Kasbon::class);
    }
}
