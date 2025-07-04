<?php

namespace App\Http\Controllers;

use App\Beneficiario;
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
        return Beneficiario::where('contrato_id',$contrato->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Contrato $contrato)
    {
        $beneficiario = new Beneficiario();
        
        $beneficiario->contrato_id = $contrato->id;
        $beneficiario->nombre = ucwords(strtolower($request->nombre1.' '.$request->nombre2));
        $beneficiario->apellido = ucwords(strtolower($request->apellido1.' '.$request->apellido2));
        $beneficiario->cedula = $request->cedula;
        $beneficiario->pasaporte = $request->pasaporte;
        $beneficiario->celular = $request->celular;
        $beneficiario->telefono = $request->telefono;
        $beneficiario->email = $request->email;
        $beneficiario->edad = $request->edad;

        $beneficiario->save();

        return $beneficiario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiario $beneficiario)
    {
        $beneficiario->nombre = ucwords(strtolower($request->nombre1.' '.$request->nombre2));
        $beneficiario->apellido = ucwords(strtolower($request->apellido1.' '.$request->apellido2));
        $beneficiario->cedula = $request->cedula;
        $beneficiario->pasaporte = $request->pasaporte;
        $beneficiario->celular = $request->celular;
        $beneficiario->telefono = $request->telefono;
        $beneficiario->email = $request->email;
        $beneficiario->edad = $request->edad;

        $beneficiario->save();

        return $beneficiario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beneficiario  $beneficiario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beneficiario $beneficiario)
    {
        $beneficiario->delete();
    }
}
