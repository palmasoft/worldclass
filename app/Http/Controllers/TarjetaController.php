<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Tarjeta;

class TarjetaController extends Controller
{
    public function index(Cliente $cliente)
    {
        return Tarjeta::where('cliente_id','=',$cliente->id)->get();
    }

    public function store(Request $request, Cliente $cliente)
    {
        $tarjeta = new Tarjeta();

        $tarjeta->tarjeta = $request->tarjeta;
        $tarjeta->cliente_id = $cliente->id;
        $tarjeta->tipo = $request->tipo;
        $tarjeta->subtipo = $request->subtipo;

        $tarjeta->save();

        return $tarjeta;
    }

    public function update(Request $request, Cliente $cliente, Tarjeta $tarjeta)
    {
        $tarjeta->tarjeta = $request->tarjeta;
        $tarjeta->cliente_id = $cliente->id;
        $tarjeta->tipo = $request->tipo;
        $tarjeta->subtipo = $request->subtipo;

        $tarjeta->save();

        return $tarjeta;
    }

    public function destroy(Cliente $cliente, Tarjeta $tarjeta)
    {
        $tarjeta->delete();
    }
}
