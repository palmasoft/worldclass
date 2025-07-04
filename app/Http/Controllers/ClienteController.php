<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use App\Comentario;
use App\User;
use App\Participante;
use App\Cargo;
use App\Clienteprod;
use Barryvdh\DomPDF\Facade as PDF;
use App\Clientefactura;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::where('tipo','=',1)->get();
    }

    public function store(Request $request)
    {
        $cliente = new Cliente();

        $cliente->tipo = $request->tipo;
        $cliente->edad = $request->edad;
        $cliente->acompanante = $request->acompanante;
        $cliente->fechaCita = $request->fechaCita;
        $cliente->horaCita = $request->horaCita;
        $cliente->estadoCita = $request->estadoCita;
        $cliente->nombre = ucwords(strtolower($request->nombre));
        $cliente->apellido = ucwords(strtolower($request->apellido));
        $cliente->cedula = $request->cedula;
        $cliente->pasaporte = $request->pasaporte;
        if ($request->sede) {
            # code...
            $cliente->sede = $request->sede;
        } else {
            # code...
            $cliente->sede = '';
        }
        $cliente->celular = $request->celular;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->email2 = $request->email2;
        $cliente->pais = $request->pais;
        $cliente->provincia = $request->provincia;
        $cliente->ciudad = $request->ciudad;
        $cliente->direccion = $request->direccion;
        $cliente->estadoCivil = $request->estadoCivil;
        $cliente->ocupacion = $request->ocupacion;
        $cliente->fechaNacimiento = $request->fechaNacimiento;
        $cliente->tmk = $request->tmk;
        
        $cliente->save();

        return $cliente;
    }

    public function show(Cliente $cliente)
    {
        return $cliente;
    }

    public function update(Request $request,Cliente $cliente)
    {
        $cliente->tipo = $request->tipo;
        $cliente->edad = $request->edad;
        $cliente->acompanante = $request->acompanante;
        $cliente->fechaCita = $request->fechaCita;
        $cliente->horaCita = $request->horaCita;
        $cliente->estadoCita = $request->estadoCita;
        $cliente->nombre = ucwords(strtolower($request->nombre));
        $cliente->apellido = ucwords(strtolower($request->apellido));
        $cliente->cedula = $request->cedula;
        $cliente->pasaporte = $request->pasaporte;
        if ($request->sede) {
            # code...
            $cliente->sede = $request->sede;
        } else {
            # code...
            $cliente->sede = '';
        }
        
        $cliente->celular = $request->celular;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->email2 = $request->email2;
        $cliente->pais = $request->pais;
        $cliente->provincia = $request->provincia;
        $cliente->ciudad = $request->ciudad;
        $cliente->direccion = $request->direccion;
        $cliente->estadoCivil = $request->estadoCivil;
        $cliente->ocupacion = $request->ocupacion;
        $cliente->fechaNacimiento = $request->fechaNacimiento;
        $cliente->tmk = $request->tmk;
        
        $cliente->save();

        return $cliente;
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    }

    public function getClientes($tipo)
    {
        return Cliente::where('tipo','=',$tipo)->get();
    }

    public function confirmarClientes(Request $request, Cliente $cliente)
    {
        $cliente->confirmacion = $request->confirmacion;

        $cliente->save();

        $comentario = new Comentario();

        $comentario->usuario = Auth::user()->name;
        $comentario->comentario = $request->comentario;

        if ($request->cargo) {
            $comentario->cargo = $request->cargo;
        }else {
            $comentario->cargo = User::getRole(Auth::user()->id)->name;
        }

        $comentario->cliente_id = $cliente->id;

        $comentario->save();

        return $cliente;
    }

    public function rastrearClientes(Request $request, Cliente $cliente)
    {
        $cliente->rastreo = $request->rastreo;

        $cliente->save();

        $comentario = new Comentario();

        $comentario->usuario = Auth::user()->name;
        $comentario->comentario = $request->comentario;

        if ($request->cargo) {
            $comentario->cargo = $request->cargo;
        }else {
            $comentario->cargo = User::getRole(Auth::user()->id)->name;
        }

        $comentario->cliente_id = $cliente->id;

        $comentario->save();

        return $cliente;
    }

    public function calificarClientes(Request $request, Cliente $cliente)
    {
        $cliente->calificacion = $request->calificacion;

        $cliente->save();

        $comentario = new Comentario();

        $comentario->usuario = Auth::user()->name;
        $comentario->comentario = $request->comentario;

        if ($request->cargo) {
            $comentario->cargo = $request->cargo;
        }else {
            $comentario->cargo = User::getRole(Auth::user()->id)->name;
        }

        $comentario->cliente_id = $cliente->id;

        $comentario->save();

        return $cliente;
    }

    public function reprogramarClientes(Request $request, Cliente $cliente)
    {
        $cliente->fechaCita = $request->fechaCita;
        $cliente->horaCita = $request->horaCita;

        $cliente->confirmacion = '';
        $cliente->rastreo = '';
        $cliente->calificacion = '';

        if($cliente->estadoCita == 'CA' || $cliente->estadoCita == 'LI'){
            $cliente->estadoCita = 'CR';
        }

        $cliente->save();

        $comentario = new Comentario();

        $comentario->usuario = Auth::user()->name;
        $comentario->comentario = $request->comentario;

        if ($request->cargo) {
            $comentario->cargo = $request->cargo;
        }else {
            $comentario->cargo = User::getRole(Auth::user()->id)->name;
        }

        $comentario->cliente_id = $cliente->id;

        $comentario->save();

        return $cliente;
    }

    public function intercambiarParticipantes($cliente, $cliente2)
    {
        $cargosE = Cargo::where('nombre','=','CLOSER')->orWhere('nombre','=','LINER')->orWhere('nombre','=','JEFE DE SALA')->get();
        
        if ($cliente == $cliente2) {
            # code...
            Participante::where('cliente_id','=',$cliente)->where('cargo_id','=',$cargosE[0]->id)->delete();
            Participante::where('cliente_id','=',$cliente)->where('cargo_id','=',$cargosE[1]->id)->delete();
            Participante::where('cliente_id','=',$cliente)->where('cargo_id','=',$cargosE[2]->id)->delete();
        }

        $participantes =  Participante::where('cliente_id','=',$cliente)->get();

        foreach ($participantes as $row) {
            if (@$cargosE[0]->id != $row->cargo_id && @$cargosE[1]->id != $row->cargo_id && @$cargosE[2]->id != $row->cargo_id) {
                # code...
                $row->cliente_id = $cliente2;
                $row->save();    
            }
        }
    }

    public function soporteasignado(Request $request)
    {
        $cliente = Cliente::find($request->id);

        $cliente->soporte1 = $request->soporte1;
        $cliente->soporte2 = $request->soporte2;
        $cliente->soporte3 = $request->soporte3;

        $cliente->save();
    }
}
