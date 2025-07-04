<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sede;

class SedeController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.permission:sede.store')->only('store');
        $this->middleware('has.permission:sede.update')->only('update');
        $this->middleware('has.permission:sede.destroy')->only('destroy');
    }

    public function index()
    {
        return Sede::get();
    }

    public function store(Request $request)
    {
        $sede = new Sede();

        $sede->sede = $request->sede;
        $sede->nombre = $request->nombre;
        $sede->direccion = $request->direccion;
        $sede->ciudad = $request->ciudad;
        $sede->consecutivo = $request->consecutivo;
        $sede->metaq1 = $request->metaq1;
        $sede->metaq2 = $request->metaq2;
        $sede->metaq3 = $request->metaq3;

        $sede->save();

        return $sede;
    }

    public function update(Request $request, Sede $sede)
    {
        $sede->sede = $request->sede;
        $sede->nombre = $request->nombre;
        $sede->direccion = $request->direccion;
        $sede->ciudad = $request->ciudad;
        $sede->consecutivo = $request->consecutivo;
        $sede->metaq1 = $request->metaq1;
        $sede->metaq2 = $request->metaq2;
        $sede->metaq3 = $request->metaq3;

        $sede->save();

        return $sede;
    }

    public function destroy(Sede $sede)
    {
        $sede->delete();
    }
}
