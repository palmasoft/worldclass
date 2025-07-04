<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('web.index');
    }

    public function tmkNuevo()
    {
        return view('tmkNuevo');
    }
}
