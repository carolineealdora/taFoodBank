<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'http://127.0.0.1:8000/donatur/register',
        'http://127.0.0.1:8000/user/login',
        'http://127.0.0.1:8000/donatur/store',
        'http://127.0.0.1:8000/ngo/register',
        'http://127.0.0.1:8000/ngo/donasi-approve/1',
        'http://127.0.0.1:8000/ngo/donasi-cancel/1',
    ];
}
