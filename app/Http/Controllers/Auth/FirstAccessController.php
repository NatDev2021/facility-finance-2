<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class FirstAccessController extends Controller
{


    public function showPasswordForm()
    {
        $token = $this->request->route()->parameter('token');
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $this->request->email]
        );
    }
}
