<?php

namespace App\Http\Controllers;

use App\Noche;
use Illuminate\Http\Request;
use App\Contrato;

class BeneficiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contrato $contrato)
    {
        return Noche::where('contrato_id',$contrato->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Contrato $contrato)
    {
        $noche = new Noche();
        
        $noche->contrato_id = $contrato->id;
        $noche->nombre = ucwords(strtolower($request->nombre1.' '.$request->nombre2));
        $noche->apellido = ucwords(strtolower($request->apellido1.' '.$request->apellido2));
        $nohe->cedula = $request->cedula;
        $noche->pasaporte = $request->pasaporte;
        $noche->celular = $request->celular;
        $noche->telefono = $request->telefono;
        $noche->email = $request->email;
        $noche->edad = $request->edad;

        $noche->save();

        return $noche;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noche $noche)
    {
        $noche->nombre = ucwords(strtolower($request->nombre1.' '.$request->nombre2));
        $noche->apellido = ucwords(strtolower($request->apellido1.' '.$request->apellido2));
        $noche->cedula = $request->cedula;
        $noche->pasaporte = $request->pasaporte;
        $noche->celular = $request->celular;
        $noche->telefono = $request->telefono;
        $noche->email = $request->email;
        $noche->edad = $request->edad;

        $noche->save();

        return $noche;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noche $noche)
    {
        $noche->delete();
    }
}
