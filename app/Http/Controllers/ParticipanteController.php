<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Participante;

class ParticipanteController extends Controller
{
    public function index(Cliente $cliente)
    {
        return Participante::join('cargos','cargos.id','=','participantes.cargo_id')->
                            join('empleados','empleados.id','=','participantes.empleado_id')
                            ->where('participantes.cliente_id','=',$cliente->id)
                            ->select('participantes.*','cargos.nombre as cargo','empleados.nombre','empleados.apellido')
                            ->get();
    }

    public function store(Request $request, Cliente $cliente)
    {
//        Participante::where('cliente_id','=',$cliente->id)->where('cargo_id','=',$request->cargo_id)->where('empleado_id','=',$request->empleado_id)->delete();

        $participante = new Participante();

        $participante->cliente_id = $cliente->id;
        $participante->cargo_id = $request->cargo_id;
        $participante->empleado_id = $request->empleado_id;

        $participante->save();

        return  $participante;
    }

    public function destroy(Cliente $cliente,Participante $participante)
    {
        $participante->delete();
    }

    public function eliparticipantes($cliente)
    {
        Participante::where('cliente_id','=',$cliente)->delete();
    }
}
