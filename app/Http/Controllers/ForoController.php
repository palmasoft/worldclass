<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Foro;
use App\Foromensaje;

class ForoController extends Controller
{
    public function index()
    {
        return Foro::get();
    }

    public function show(Foro $foroX)
    {
        return Foromensaje::where('foro_id',$foroX->id)->orderBy('created_at','desc')->get();
    }

    public function store(Request $request)
    {
        $foro = new Foro();

        $foro->usuario = $request->user()->name;
        $foro->tipo = $request->user()->tipo;
        $foro->user_id = $request->user()->id;
        $foro->titulo = $request->titulo;
        $foro->mensaje = $request->mensaje;

        $foro->save();

        return $foro;
    }

    public function update(Request $request, Foro $foroX)
    {
        $foro = new Foromensaje();

        $foro->usuario = $request->user()->name;
        $foro->tipo = $request->user()->tipo;
        $foro->user_id = $request->user()->id;
        $foro->foro_id = $foroX->id;
        $foro->mensaje = $request->mensaje;

        $foro->save();

        return $foro;
    }

    public function destroy(Foro $foroX)
    {
        $foroX->delete();
    }
}
