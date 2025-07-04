<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contrato;
use App\ContratoPago;
use App\ContratoCuota;

class ContratoPagoController extends Controller
{
    public function index(Contrato $contrato)
    {
        return ContratoPago::where('contrato_id','=',$contrato->id)->orderBy('id','desc')->get();
    }

    public function store(Request $request, Contrato $contrato)
    {
        $pago = new ContratoPago();

        $pago->contrato_id = $contrato->id;
        $pago->tipo = $request->tipo;
        $pago->factura = $request->factura;
        $pago->valor = $request->valor;

        if ($pago->tipo == 'TARJETA') {
            $pago->banco = $request->banco;
            $pago->tarjeta = $request->tarjeta;
            $pago->diferido = $request->diferido;
            $pago->autorizacion = $request->autorizacion;
            $pago->lote = $request->lote;
        } else {
            $pago->banco = $request->banco;
            $pago->numero = $request->numero;
        }
            
        $pago->save();

        return $pago;
    }

    public function update(Request $request, Contrato $contrato, $id)
    {
        $pago = ContratoPago::find($id);

        $pago->contrato_id = $contrato->id;
        $pago->tipo = $request->tipo;
        $pago->factura = $request->factura;
        $pago->valor = $request->valor;
        $pago->fecha = $request->fecha;

        if ($pago->tipo == 'TARJETA') {
            $pago->banco = $request->banco;
            $pago->tarjeta = $request->tarjeta;
            $pago->diferido = $request->diferido;
            $pago->autorizacion = $request->autorizacion;
            $pago->lote = $request->lote;
        } else {
            $pago->banco = $request->banco;
            $pago->numero = $request->numero;
        }
            
        $pago->save();

        return $pago;
    }

    public function destroy($pago)
    {
        $contrato_pago = ContratoPago::find($pago);

        $valor = $contrato_pago->valor;

        $contrato=Contrato::find($contrato_pago->contrato_id);
        $contrato_cuota = ContratoCuota::where('pagado','>',0)->where('contrato_id',$contrato_pago->contrato_id)->orderBy('fecha','DESC');

        $contrato->pagoInicial = $contrato->pagoInicial - $valor;
        
        foreach ($contrato_cuota as $cuota) {
            if ($valor > 0) {
                
                $valorAux = $cuota->pagado;

                if ($valor >= $cuota->pagado) {
                    $cuota->pagado = 0;
                    $cuota->saldo = $cuota->valor;
                }else {
                    $cuota->pagado = $cuota->pagado - $valor;
                    $cuota->saldo = $cuota->saldo + $valor;
                }

                $cuota->save();

                if ($cuota->tipo == 1) {
                    $contrato->saldoInicial = $contrato->saldoInicial + $valorAux;
                }else{
                    $contrato->saldoFinanciado = $contrato->saldoFinanciado + $valorAux;
                }

                $valor = $valor - $valorAux;
            }else {
                break;
            }
        }

        if ($valor > 0) {
            $contrato->saldoInicial = $contrato->saldoInicial + $valor;
        }

        $contrato->save();

        $contrato_pago->delete();
    }

    public function eliminatodo($contrato)
    {
        ContratoPago::where('contrato_id','=',$contrato)->delete();
    }
}
