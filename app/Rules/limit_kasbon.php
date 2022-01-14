<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Kasbon;
use App\Models\Pegawai;
use Illuminate\Support\Carbon;

class limit_kasbon implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($pegawai_id)
    {
        $this->pegawai_id = $pegawai_id;
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
        $kasbon_sum = Kasbon::whereMonth('tanggal_diajukan', '=', Carbon::now())
            ->where('pegawai_id', $this->pegawai_id)
            ->sum('total_kasbon');

        $pegawai = Pegawai::findOrFail($this->pegawai_id);

        if (($kasbon_sum + $value) > ($pegawai->total_gaji / 2)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pegawai ini telah melakukan kasbon melebih 50% dari total';
    }
}
