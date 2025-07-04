<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;

class ServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.permission:servicio.store')->only('store');
        $this->middleware('has.permission:servicio.update')->only('update');
        $this->middleware('has.permission:servicio.destroy')->only('destroy');
    }

    public function index()
    {
        return Servicio::get();
    }

    public function store(Request $request)
    {
        $servicio = new Servicio();

        $servicio->servicio = $request->servicio;
        $servicio->tipo = $request->tipo;
        $servicio->porcentaje = $request->porcentaje;

        $servicio->save();

        return $servicio;
    }

    public function update(Request $request, Servicio $servicio)
    {
        $servicio->servicio = $request->servicio;
        $servicio->tipo = $request->tipo;
        $servicio->porcentaje = $request->porcentaje;

        $servicio->save();

        return $servicio;
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
    }
}
