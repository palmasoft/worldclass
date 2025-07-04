<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contrato;
use App\ContratoServicio;
use App\Servicio;
use Illuminate\Support\Facades\DB;

class ContratoServicioController extends Controller
{
    public function index(Contrato $contrato)
    {
        return DB::select("SELECT DISTINCT s.* FROM servicios AS s, contrato_servicios AS cs WHERE cs.contrato_id='".$contrato->id."' AND s.servicio = cs.servicio AND s.tipo = cs.tipo");
    }

    public function store(Request $request, Contrato $contrato)
    {
        ContratoServicio::where('contrato_id','=',$contrato->id)->delete();

        if (@$request->servicios) {
            foreach ($request->servicios as $row) {
                $serviciox = Servicio::find($row);

                $servicio = new ContratoServicio();

                $servicio->contrato_id = $contrato->id;
                $servicio->servicio = $serviciox->servicio;
                $servicio->porcentaje = $serviciox->porcentaje;
                $servicio->tipo = $serviciox->tipo;

                $servicio->save();
                
            }
        }
    }
}
