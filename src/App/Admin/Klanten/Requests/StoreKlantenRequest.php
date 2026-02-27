<?php

namespace App\Admin\Klanten\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKlantenRequest extends FormRequest
{
    /**
     * @return string[]
     */
    // Regels voor het opslaan van een klant.
    public function rules(): array
    {
        return [
            'voornaam' => 'string',
            'achternaam' => 'string',
            'adres' => 'string',
            'email' => 'string|unique:klanten,email|email',
            'telefoonnummer' => 'string',
        ];
    }

    // Aangepast bericht als het email adres al in gebruik is
    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'Dit email adres is al in gebruik.'
        ];
    }
}
