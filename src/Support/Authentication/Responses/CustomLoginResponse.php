<?php

namespace Support\Authentication\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;

class CustomLoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  Request  $request
     * @return Response
     */
    public function toResponse($request)
    {
        // Place own login response logic here, according to the project needs
        $adminUrl = config('app.url', 'http://localhost');
        return redirect()->intended($adminUrl);
    }
}
