<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\EmpleadoCargo;

class EmpleadoCargoController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.permission:empleado.cargo')->only('store');
    }

    public function index(Empleado $empleado)
    {
        return EmpleadoCargo::where('empleado_id','=',$empleado->id)->get();
    }

    public function store(Request $request, Empleado $empleado)
    {
        EmpleadoCargo::where('empleado_id','=',$empleado->id)->delete();

        if (@$request->cargos) {
            foreach ($request->cargos as $row) {
                $empleado_cargo = new EmpleadoCargo();

                $empleado_cargo->empleado_id = $empleado->id;
                $empleado_cargo->cargo_id = $row;

                $empleado_cargo->save();

                if ($row == 4 && $empleado->codigo1 == 0) {
                    $cod1 = @Empleado::orderBy('codigo1','desc')->get()[0]->codigo1 += 1;

                    $empleado->codigo1 = $cod1;

                    $empleado->save();
                }else if ($row == 5 && $empleado->codigo2 == 0) {
                    $cod2 = @Empleado::orderBy('codigo2','desc')->get()[0]->codigo2 += 1;

                    $empleado->codigo2 = $cod2;
                    
                    $empleado->save();
                }
            }
        }
    }
}
