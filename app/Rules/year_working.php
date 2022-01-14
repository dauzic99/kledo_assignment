<?php

namespace App\Rules;

use App\Models\Pegawai;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class year_working implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pegawai = Pegawai::findOrFail($value);
        $date = Carbon::parse($pegawai->tanggal_masuk);
        $now = Carbon::now();
        $diff = $date->diffInYears($now);

        if ($diff > 0) {
            return true;
        } else return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pegawai ini belum 1 tahun bekerja';
    }
}
