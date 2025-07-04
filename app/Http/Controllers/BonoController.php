<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bono;

class BonoController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.permission:bono.store')->only('store');
        $this->middleware('has.permission:bono.update')->only('update');
        $this->middleware('has.permission:bono.destroy')->only('destroy');
    }

    public function index()
    {
        return Bono::get();
    }

    public function store(Request $request)
    {
        $bono = new Bono();

        $bono->bono = $request->bono;
        $bono->dias = $request->dias;
        $bono->noches = $request->noches;
        $bono->personas = $request->personas;
        $bono->tipo = $request->tipo;

        $bono->save();

        return $bono;
    }

    public function update(Request $request, Bono $bono)
    {
        $bono->bono = $request->bono;
        $bono->dias = $request->dias;
        $bono->noches = $request->noches;
        $bono->personas = $request->personas;

        $bono->save();

        return $bono;
    }

    public function destroy(Bono $bono)
    {
        $bono->delete();
    }
}
