<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comicionable;
use App\Empleado;
use App\Cargo;
use App\Participante;
use Carbon\Carbon;
use App\variable;
use App\Contrato;

class ComicionableController extends Controller
{
    public function index($contrato)
    {
        return Comicionable::where('contrato_id','=',$contrato)->get();
    }

    public function indexem($empleado,$busqueda='')
    {

        $busquedaN = explode('|',$busqueda);

        if (count($busquedaN) == 3) {    
            return Comicionable::join('contratos','contratos.id','=','comicionables.contrato_id')
                            ->where('comicionables.empleado_id','=',$empleado)
                            ->where('contratos.estadoServicio','=',0)
                            ->where('contratos.created_at','>=',$busquedaN[0].' 00:00:00')
                            ->where('contratos.created_at','<=',$busquedaN[1].' 23:59:59')
                            ->where('contratos.sede',$busquedaN[2])
                            ->where(function ($query) {
                                    $query->where('contratos.estadoContrato','=','CASH')
                                        ->orWhere('contratos.estadoContrato','=','PROCE');
                            })
                            ->select('comicionables.*')
                            ->orderBy('comicionables.cargo_id')
                            ->get();
        }
        return Comicionable::where('empleado_id','=',$empleado)->orderBy('cargo_id')->get();
    }

    public function store(Request $request, $contratoid)
    {
        $contrato = Contrato::find($contratoid);
        if ($contrato->estadoServicio == 0) {
            $empleado = Empleado::find($request->empleado_id);
            $cargo = Cargo::find($request->cargo_id);
            $variables = variable::get();
    
            $comicionable = @Comicionable::where('contrato_id','=',$contrato->id)->where('cargo_id','=',$request->cargo_id)->where('empleado_id','=',$request->empleado_id)->get()[0];

            if (!@$comicionable->id) {
                $comicionable = new Comicionable();
                
                $comicionable->empleado_id = $request->empleado_id;
                $comicionable->cargo_id = $request->cargo_id;
                $comicionable->contrato_id = $contrato->id;
            }
            
            $comicio = 0;
            $factorCash = 1;
            $factorRepeticion = 1;
            $hoy = Carbon::now();
            $dias = 0;

            while (substr($contrato->created_at,0,10) < substr($hoy,0,10)) {
                $dias++;
                $hoy->subDay();
            }

            if ($contrato->pagoInicial - $contrato->club >= $contrato->valorContrato/2) {
                if ($contrato->estadoContrato == 'CASH') {
                    $comicio = $cargo->comicion_cash;
                } else if ($contrato->estadoContrato == 'PROCE'){
                    $comicio = $cargo->comicion_proce;
                    $factorCash = 0.5;
                }            
            }
            
            if ($cargo->nombre == 'CLOSER') {
                $factorRepeticion = $factorRepeticion / Participante::where('cliente_id','=',$request->cliente_id)->where('cargo_id','=',$request->cargo_id)->count();
            }

            ///// Bloque dos propuesto
            if ($contrato->gastoLegal > 0 && $contrato->pagoInicial >= 700) {
                    $comicionable->pack = round(($cargo->pack * $factorRepeticion) - $comicionable->pagado2 , 2);
                }

            if ($contrato->estadoContrato == 'CASH' || $contrato->estadoContrato == 'PROCE') {
               if ($contrato->anosPactados >= 3) {
                   $comicionable->xpack = round(($cargo->xpack * $factorRepeticion) - $comicionable->pagado3 , 2);
               }
            }
            //// Fin Bloque dos
            
            /*
            if ($contrato->gastoLegal > 0 && $contrato->pagoInicial > $contrato->gastoLegal) {
                $comicionable->pack = round(($cargo->pack * $factorRepeticion) - $comicionable->pagado2 , 2);
            }

            if ($contrato->estadoContrato == 'CASH' || $contrato->estadoContrato == 'PROCE') {
                if ($contrato->xpack > 0 && $dias < 31 && $contrato->boordingCard*$variables[3]->valor >= 2600) {
                    $comicionable->xpack = round(($cargo->xpack * $factorRepeticion) - $comicionable->pagado3 , 2);
                }
            }
            */

            $comicionable->comicion = round((((($comicio / 100) * $variables[0]->valor * 0.85 * $factorCash * $contrato->anosPactados) ) * $factorRepeticion) - $comicionable->pagado1 ,2);

            $comicionable->save();

            return $comicionable;
        }else {
            return $contrato;
        }
    }

    public function update(Request $request,$contrato, Comicionable $comicionable)
    {
        $comicionable->pagado1 += $comicionable->comicion;
        $comicionable->pagado2 += $comicionable->pack;
        $comicionable->pagado3 += $comicionable->xpack;

        $comicionable->comicion = 0.00;
        $comicionable->pack = 0.00;
        $comicionable->xpack = 0.00;

        $comicionable->save();

        return $comicionable;
    }

    public function destroy($contrato,Comicionable $comicionable)
    {
        $comicionable->delete();
    }

    public function getContratos($busqueda='')
    {

        $busquedaN = explode('|',$busqueda);

        if (count($busquedaN) == 3) {    
            return Contrato::where('estadoServicio','=',0)
                            ->where('created_at','>=',$busquedaN[0].' 00:00:00')
                            ->where('created_at','<=',$busquedaN[1].' 23:59:59')
                            ->where('sede',$busquedaN[2])
                            ->where(function ($query) {
                                    $query->where('estadoContrato','=','CASH')
                                        ->orWhere('estadoContrato','=','PROCE');
                            })
                            ->get();
        }
        
        return Contrato::where('estadoServicio','=',0)
                        ->where(function ($query) {
                                $query->where('estadoContrato','=','CASH')
                                      ->orWhere('estadoContrato','=','PROCE');
                        })
                        ->get();
    }
}
