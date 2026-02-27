<?php

namespace App\Admin\Bestellingen\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBestellingenRequest extends FormRequest
{
    /**
     * @return string[]
     */
    // Regels voor het opslaan van een bestelling.
    public function rules(): array
    {
        return [
            'klanten_id' => 'integer|required',
            'restaurant_id' => 'integer|required',
        ];
    }
}
