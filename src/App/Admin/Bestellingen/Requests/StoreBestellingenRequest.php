<?php

namespace App\Admin\Bestellingen\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBestellingenRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'klanten_id' => 'integer|required',
            'restaurant_id' => 'integer|required',
        ];
    }
}
