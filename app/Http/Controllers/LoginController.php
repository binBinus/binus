<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $checkrole = explode(',', $role);
        if (in_array('0', $checkrole)) {
            return redirect('/create-class');
        } else {
            return redirect('/join-class');
        }
    }
}
