<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Comentario;
use Illuminate\Support\Facades\Auth;
use App\User;

class ComentarioController extends Controller
{
    public function index(Cliente $cliente)
    {
        return Comentario::where('cliente_id','=',$cliente->id)->orderBy('id','desc')->get();
    }

    public function store(Request $request, Cliente $cliente)
    {
        $comentario = new Comentario();

        $comentario->usuario = Auth::user()->name;
        $comentario->lugar = $request->lugar;
        $comentario->comentario = $request->comentario;

        if ($request->cargo) {
            $comentario->cargo = $request->cargo;
        }else {
            $comentario->cargo = User::getRole(Auth::user()->id)->name;
        }

        $comentario->cliente_id = $cliente->id;

        $comentario->save();

        return $comentario;
    }

    public function update(Request $request, Cliente $cliente, Comentario $comentario)
    {
        $comentario->usuario = Auth::user()->name;
        $comentario->lugar = $request->lugar;
        $comentario->comentario = $request->comentario;
        $comentario->cargo = $request->cargo;
        $comentario->cliente_id = $cliente->id;

        $comentario->save();

        return $comentario;
    }

    public function destroy(Cliente $cliente, Comentario $comentario)
    {
        $comentario->delete();
    }
}
