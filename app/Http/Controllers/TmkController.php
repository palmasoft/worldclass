<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tmk;

class TmkController extends Controller
{
    public function index($tipo)
    {
        return Tmk::where('tipo','=',$tipo)->get();
    }

    public function store(Request $request, $tipo)
    {
        $tmk = new Tmk();

        $tmk->tipo = $tipo;
        $tmk->nombre = $request->nombre;
        $tmk->apellido = $request->apellido;
        $tmk->cedula = $request->cedula;
        $tmk->pasaporte = $request->pasaporte;

        $codigo = @Tmk::where('tipo','=',$tipo)->orderBy('codigo','desc')->get()[0]->codigo;

        if($codigo){
            $tmk->codigo = $codigo++;
        }

        if(User::find(@$request->user_id)){
            $tmk->user_id = $request->user_id;
        }

        $tmk->save();

        return $tmk;
    }

    public function update(Request $request, $tipo, Tmk $tmk)
    {
        $tmk->nombre = $request->nombre;
        $tmk->apellido = $request->apellido;
        $tmk->cedula = $request->cedula;
        $tmk->pasaporte = $request->pasaporte;

        if(User::find(@$request->user_id)){
            $tmk->user_id = $request->user_id;
        }

        $tmk->save();

        return $tmk;
    }

    public function destroy($tipo, Tmk $tmk)
    {
        $tmk->delete();
    }

    public function getTmk($codigo)
    {
        return Tmk::where('tipo','=' , substr($codigo,0,2))->where('codigo','=' , substr($codigo,2,4))->get()[0];
    }
}
