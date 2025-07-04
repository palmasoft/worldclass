<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contrato;
use App\ContratoBono;

class ContratoBonoController extends Controller
{
    public function index(Contrato $contrato)
    {
        return ContratoBono::where('contrato_id','=',$contrato->id)->get();
    }

    public function store(Request $request, Contrato $contrato)
    {
        ContratoBono::where('contrato_id','=',$contrato->id)->delete();

        if (@$request->bonos) {
            foreach ($request->bonos as $row) {
                    $bono = new ContratoBono();
    
                    $bono->contrato_id = $contrato->id;
                    $bono->bono = $row['bono'];
                    $bono->cantidad = $row['cantidad'];
                    $bono->dias = $row['dias'];
                    $bono->tipo = $row['tipo'];
                    $bono->noches = $row['noches'];
                    $bono->personas = $row['personas'];
    
                    $bono->save();
            }
        }
    }
}
