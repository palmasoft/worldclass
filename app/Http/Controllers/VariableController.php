<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\variable;

class VariableController extends Controller
{
    public function index()
    {
        return variable::get();
    }

    public function update(Request $request, variable $variable)
    {
        $variable->valor = $request->valor;

        $variable->save();
    }
}
