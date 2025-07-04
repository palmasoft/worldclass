<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Cargo;
use Illuminate\Support\Facades\DB;
use App\User;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.permission:empleado.store')->only('store');
        $this->middleware('has.permission:empleado.update')->only('update');
        $this->middleware('has.permission:empleado.destroy')->only('destroy');
    }

    public function index()
    {
        return Empleado::get();
    }

    public function store(Request $request)
    {
        $empleado = new Empleado();

      //  $empleado->tipo = $tipo;
        $empleado->nombre = ucwords(strtolower($request->nombre));
        $empleado->apellido = ucwords(strtolower($request->apellido));
        $empleado->cedula = $request->cedula;
        $empleado->pasaporte = $request->pasaporte;

        if(User::find(@$request->user_id)){
            $empleado->user_id = $request->user_id;
        }

        $empleado->save();

        return $empleado;
    }

    public function update(Request $request, Empleado $empleado)
    {
        $empleado->nombre = ucwords(strtolower($request->nombre));
        $empleado->apellido = ucwords(strtolower($request->apellido));
        $empleado->cedula = $request->cedula;
        $empleado->pasaporte = $request->pasaporte;

        if(User::find(@$request->user_id)){
            $empleado->user_id = $request->user_id;
        }

        $empleado->save();

        return $empleado;
    }

    public function show(Empleado $empleado)
    {
        return $empleado;
    }

    public function destroy( Empleado $empleado)
    {
        $empleado->delete();
    }

    public function getEmpleadosCargo($cargo)
    {
        return DB::table('empleados')
                    ->join('empleado_cargos','empleado_cargos.empleado_id','=','empleados.id')
                    ->join('cargos','cargos.id','=','empleado_cargos.cargo_id')
                    ->where('cargos.nombre','=',$cargo)
                    ->select('empleados.*','cargos.id as cargo_id')
                    ->get();
    }

    public function getEmpleadosCargo2($cargo)
    {
        return DB::table('empleados')
                    ->join('empleado_cargos','empleado_cargos.empleado_id','=','empleados.id')
                    ->where('empleado_cargos.cargo_id','=',$cargo)
                    ->select('empleados.*')
                    ->get();
    }

    public function empleadousuario($user)
    {
        return Empleado::where('user_id','=',$user)->get();
    }

    public function existeTmk($tmk)
    {
        $codigo1 = str_ireplace("TM","",$tmk);

        return Empleado::where('codigo1','=',$codigo1)->where('codigo1','>',0)->get();
    }
}
