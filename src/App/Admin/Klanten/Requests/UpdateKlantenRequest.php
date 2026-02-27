<?php

namespace App\Admin\Klanten\Requests;

use Domain\Klanten\Models\Klanten;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKlantenRequest extends FormRequest
{
    /**
     * @return array<string, string|Rule|array<string|Rule>>
     */
    public function rules(): array
    {
        /** @var Klanten $klanten */
        $klanten = $this->route('klanten');

        return [
            'voornaam' => 'string',
            'achternaam' => 'string',
            'adres' => 'string',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('klanten', 'email')->ignore($klanten->id),
            ],
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
