<?php

namespace App\Admin\Bestellingen\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderItemsRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'prijs' => 'float',
            'aantal' => 'integer',
            'bestellingen_id' => 'integer',
            'producten_id' => 'integer',
            'varianten_id' => 'integer',
        ];
    }
}
