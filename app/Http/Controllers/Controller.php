<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}
class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('/dangky');
    }
}
