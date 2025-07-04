<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contrato;
use App\ContratoCuota;

class ContratoCuotaController extends Controller
{
    public function index(Contrato $contrato)
    {
        return ContratoCuota::where('contrato_id','=',$contrato->id)->get();
    }

    public function store(Request $request, Contrato $contrato)
    {
        ContratoCuota::where('contrato_id','=',$contrato->id)->delete();

        if (@$request->cuotas) {
            foreach ($request->cuotas as $row) {
                $cuota = new ContratoCuota();

                $cuota->contrato_id = $contrato->id;
                $cuota->tipo = $row['tipo'];
                $cuota->valor = $row['valor'];
                $cuota->saldo = $row['saldo'];
                $cuota->pagado = $row['pagado'];
                $cuota->fecha = $row['fecha'];

                $cuota->save();
            }
        }
    }

    public function update(Request $request, Contrato $contrato, $cuota)
    {
        $contrato_cuota = ContratoCuota::find($cuota);

        $cuota->valor = $contrato_cuota->valor;
        $cuota->saldo = $contrato_cuota->saldo;
        $cuota->pagado = $contrato_cuota->pagado;
        $cuota->fecha = $contrato_cuota->fecha;

        $cuota->save();
    }

    public function destroy(Contrato $contrato, $cuota)
    {
        $contrato_cuota = ContratoCuota::find($cuota);
        $contrato_cuota->delete();
    }
}
