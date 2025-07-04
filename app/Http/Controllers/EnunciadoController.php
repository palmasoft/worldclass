<?php

namespace App\Http\Controllers;

use App\Enunciado;
use Illuminate\Http\Request;

class EnunciadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Enunciado::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enunciado = new Enunciado();

        $enunciado->enunciado = $request->enunciado;
        $enunciado->activo = $request->activo;

        $enunciado->save();

        return $enunciado;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enunciado  $enunciado
     * @return \Illuminate\Http\Response
     */
    public function show(Enunciado $enunciado)
    {
        return $enunciado;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enunciado  $enunciado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enunciado $enunciado)
    {
        $enunciado->enunciado = $request->enunciado;
        $enunciado->activo = $request->activo;

        $enunciado->save();

        return $enunciado;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enunciado  $enunciado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enunciado $enunciado)
    {
        $enunciado->delete();
    }
}
