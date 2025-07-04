<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;

class CargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.permission:cargo.store')->only('store');
        $this->middleware('has.permission:cargo.update')->only('update');
        $this->middleware('has.permission:cargo.destroy')->only('destroy');
    }

    public function index()
    {
        return Cargo::get();
    }

    public function store(Request $request)
    {
        $cargo = new Cargo();

        $cargo->nombre = strtoupper($request->nombre);
        $cargo->comicion_proce = $request->comicion_proce;
        $cargo->comicion_cash = $request->comicion_cash;
        $cargo->pack = $request->pack;
        $cargo->xpack = $request->xpack;

        $cargo->save();

        return $cargo;
    }

    public function update(Request $request, Cargo $cargo)
    {
        $cargo->nombre = strtoupper($request->nombre);
        $cargo->comicion_proce = $request->comicion_proce;
        $cargo->comicion_cash = $request->comicion_cash;
        $cargo->pack = $request->pack;
        $cargo->xpack = $request->xpack;

        $cargo->save();

        return $cargo;
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
    }
}
