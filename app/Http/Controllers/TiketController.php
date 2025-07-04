<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiket;
use App\Tiketmensaje; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TiketController extends Controller
{
    public function index($cliente)
    {
        return Tiket::where('cliente_id','=',$cliente)->orderBy('id','desc')->get();
    }

    public function store(Request $request, $cliente)
    {
        $tiket = new Tiket();


        $tiket->asunto = $request->asunto;
        $tiket->departamento = $request->departamento;
        $tiket->servicio_relacionado = $request->servicio_relacionado;
        $tiket->prioridad = $request->prioridad;
        $tiket->cliente_id = $cliente;

        $tiket->save();

        return $tiket;
    }

    public function update(Request $request, Tiket $tiket)
    {
        $tiket->estado = $request->estado;
        
        $tiket->save();

        $mensaje = new Tiketmensaje();

        $mensaje->mensaje = $request->mensaje;
        $mensaje->cliente_id = $tiket->cliente_id;
        $mensaje->tiket_id = $tiket->id;

        if ($request->estado == 1) {
            $mensaje->empleado = Auth::user()->name;
            $mensaje->empleado_id = Auth::user()->id;
        }
        
        $mensaje->save();

        if ($request->email) {
            # code...
            $datosMail = [
                'mensaje' => $mensaje,
                'tiket' => $tiket
            ];
    
            Mail::send('documentos.email.tiket',$datosMail,function ($msg) use($request, $tiket)
            {
                $msg->subject('Tiket #'. $tiket->id);
                $msg->to($request->email);
            });
        }

        return $mensaje;
    }

    public function destroy(Tiket $tiket)
    {
        $tiket->estado = 3;

        $tiket->save();

        return $tiket;
    }

    public function getMesages($tiket)
    {
        return Tiketmensaje::where('tiket_id','=',$tiket)->orderBy('id','desc')->get();
    }

    public function subirArchivo(Request $request, Tiketmensaje $tiket)
    {
        $archivo = $request->file('archivo');

        $name = $tiket->id.'-'.time().'.'.$archivo->getClientOriginalExtension();
        $destino = public_path('recursos/tikets');

        $archivo->move($destino,$name);
        //$tiket->adjunto = $path;

       // $tiket->save();

       $tiket->adjunto = url('/').'/recursos/tikets/'.$name;

       $tiket->save();

        return $tiket->adjunto;
    }

    public function estadoGestion(Tiket $tiket,$estado2)
    {
        $tiket->estado2 = $estado2;

        $tiket->save();

        return $tiket;
    }
}
