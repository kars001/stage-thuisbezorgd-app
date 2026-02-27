<?php

namespace App\Admin\Klanten\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKlantenRequest extends FormRequest
{
    /**
     * @return string[]
     */
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
