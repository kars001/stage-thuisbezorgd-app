<?php

namespace Support\Authentication\Requests;

use Laravel\Fortify\Fortify;

class PasswordlessLoginRequest extends \Laravel\Fortify\Http\Requests\LoginRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules()
    {
        return [
            Fortify::username() => 'required|string',
            'password' => 'sometimes|string',
        ];
    }
}
