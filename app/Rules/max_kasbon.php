<?php

namespace App\Rules;

use App\Models\Kasbon;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class max_kasbon implements Rule
{

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        $kasbon_count = Kasbon::whereMonth('tanggal_diajukan', '=', Carbon::now())
            ->where('pegawai_id', $value)
            ->count();
        $this->kasbon_count = $kasbon_count;
        if ($kasbon_count > 2) {
            return false;
        } else return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pegawai ini telah mengajukan ' . $this->kasbon_count . ' kali kasbon dalam bulan ini';
    }
}
