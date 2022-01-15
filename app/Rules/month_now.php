<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Kasbon;
use Carbon\Carbon;

class month_now implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $this->value = $value;
        $kasbon = Kasbon::findOrFail($value);
        $kasbon_month = Carbon::parse($kasbon->tanggal_diajukan)->format('M');
        $now_month = Carbon::now()->format('M');
        if ($kasbon_month == $now_month) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Kasbon dengan id ' . $this->value . ' diajukan bukan pada bulan ini';
    }
}
