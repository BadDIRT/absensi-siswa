<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function index2()
    {
        return view('admin.dashboard');
    }
}
