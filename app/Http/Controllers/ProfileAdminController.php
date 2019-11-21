<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\User;

class ProfileAdminController extends Controller
{
    //
    public function __construct()
    {   
        $this->middleware('auth');
    }

    




}

