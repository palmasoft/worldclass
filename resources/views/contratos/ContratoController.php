<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contrato;
use App\Sede;
use App\Cliente;
use App\variable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade as PDF;
use App\Legales;
use App\Contratosdos;

class ContratoController extends Controller
{
    public function __construct()
    {
        $this->middleware('has.permission:contrato.store')->only('store');
        $this->middleware('has.permission:contrato.update')->only('update');
        $this->middleware('has.permission:contrato.destroy')->only('destroy');
        $this->middleware('has.permission:contrato.consecutivo')->only('consecutivo');
        $this->middleware('has.permission:contrato.factura')->only('factura');
    }

    public function index()
    {
        return Contrato::get();
    }

    public function store(Request $request)
    {
        $contrato = new Contrato();

        $sede = @Sede::where('sede','=',$request->sede)->get()[0];

        if ($sede) {
            $contrato->sede = $sede->sede;
            $contrato->consecutivo = $sede->consecutivo;
            $contrato->nombreSede = $sede->nombre;
            $contrato->ciudadSede = $sede->ciudad;
            $contrato->direccionSede = $sede->direccion;
            
            $sede->consecutivo++;
            
            $sede->save();
        }

        if($request->ciudadSede){
            $contrato->ciudadSede = $request->ciudadSede;
        }

        $titular = Cliente::find($request->titular);

        if ($titular) {
            $contrato->titular = $titular->id;
            $contrato->titularNombre = $titular->nombre.' '.$titular->apellido;
        }

        if ($request->cotitular > 0) {
            $cotitular = Cliente::find($request->cotitular);

            if ($cotitular) {
                $contrato->cotitular = $cotitular->id;
                $contrato->cotitularNombre = $cotitular->nombre.' '.$cotitular->apellido;
            }
        }

        
        $contrato->anosOtorgados = $request->anosOtorgados;
        $contrato->anosPactados = $request->anosPactados;
        $contrato->gastoLegal = $request->gastoLegal;
        $contrato->xpack = $request->xpack;
        $contrato->servicioInternacional = $request->servicioInternacional;
        $contrato->boordingCard = $request->boordingCard;
        $contrato->valorContrato = $request->valorContrato;
        $contrato->cuotaInicial = $request->cuotaInicial;
        $contrato->pagoInicial = $request->pagoInicial;
        $contrato->fechaPagoInicial = $request->fechaPagoInicial;
        $contrato->saldoInicial = $request->saldoInicial;
        $contrato->numeroCuotasIniciales = $request->numeroCuotasIniciales;
        $contrato->saldoFinanciado = $request->saldoFinanciado;
        $contrato->fechaPagoFinanciado = $request->fechaPagoFinanciado;
        $contrato->numeroCuotasFinanciado = $request->numeroCuotasFinanciado;
        $contrato->beneficiarios = $request->beneficiarios;
        $contrato->estadoContrato = $request->estadoContrato;
        $contrato->estadoComicion = $request->estadoComicion;
        $contrato->creador = Auth::user()->name; 
        $contrato->creadorCargo = User::getRole(Auth::user()->id)->name;
        
        $contrato->tmk = $request->tmk;
        $contrato->club = $request->club;
        $contrato->factura = $request->factura;
        $contrato->fechaEstado = $request->fechaEstado;
        $contrato->otrosServicios = $request->otrosServicios;
        
        $contrato->save();

        return $contrato;
    }

    public function update(Request $request, Contrato $contrato)
    {        
        $contrato->anosOtorgados = $request->anosOtorgados;
        $contrato->anosPactados = $request->anosPactados;
        $contrato->gastoLegal = $request->gastoLegal;
        $contrato->xpack = $request->xpack;
        $contrato->servicioInternacional = $request->servicioInternacional;
        $contrato->boordingCard = $request->boordingCard;
        $contrato->valorContrato = $request->valorContrato;
        $contrato->cuotaInicial = $request->cuotaInicial;
        $contrato->pagoInicial = $request->pagoInicial;
        $contrato->fechaPagoInicial = $request->fechaPagoInicial;
        $contrato->saldoInicial = $request->saldoInicial;
        $contrato->numeroCuotasIniciales = $request->numeroCuotasIniciales;
        $contrato->saldoFinanciado = $request->saldoFinanciado;
        $contrato->fechaPagoFinanciado = $request->fechaPagoFinanciado;
        $contrato->numeroCuotasFinanciado = $request->numeroCuotasFinanciado;
        $contrato->beneficiarios = $request->beneficiarios;
        $contrato->estadoContrato = $request->estadoContrato;
        $contrato->estadoComicion = $request->estadoComicion;
        $contrato->creador = Auth::user()->name; 
        $contrato->creadorCargo = User::getRole(Auth::user()->id)->name;
        
        $contrato->tmk = $request->tmk;
        $contrato->club = $request->club;
        $contrato->factura = $request->factura;
        $contrato->fechaEstado = $request->fechaEstado;
        $contrato->otrosServicios = $request->otrosServicios;
        
        $contrato->save();

        return $contrato;
    }

    public function show(Contrato $contrato)
    {
        return $contrato;
    }

    public function destroy(Contrato $contrato)
    {
        $contrato->delete();
    }

    public function estadoContrato($id)
    {
        $c = Contrato::find($id);

        $estadoFinal = 'CERO';

        $vg = variable::get();

        if((floatval($c->pagoInicial) > 1) && (floatval($c->pagoInicial) < floatval($vg[2]->valor))
          && ( (floatval($c->boordingCard)*floatval($vg[3]->valor) > 0) || (floatval($c->xpack) > 0)
          || (floatval($c->servicioInternacional) > 0)))
        {
          $estadoFinal = "SEPARACION";
       	}elseif($c->pagoInicial == $vg[2]->valor && floatval($c->gastoLegal) > 0){
       	    $estadoFinal = "GASTO LEGAL";
       	}elseif(floatval($c->pagoInicial) >= floatval($c->valorContrato)){
            $estadoFinal = "CASH";
        }else{
       	    @$operacion = (($c->pagoInicial - ($c->gastoLegal+$c->xpack+$c->servicioInternacional+
             ($c->boordingCard*floatval($vg[3]->valor)))) / ($c->anosPactados*floatval($vg[0]->valor))) * 100;

       	    if((floatval(@$operacion) >=0.1) && (floatval(@$operacion) <= 49.9999)){
           	    $estadoFinal = "PEDDING";
           	}elseif(floatval(@$operacion) >=50){
           	    $estadoFinal = "PROCE";
           	}elseif(floatval($c->pagoInicial)==0.00 || floatval(@$operacion) == 0.0000){
           	    $estadoFinal = "CERO";
           	}elseif(floatval(@$operacion) < 0.0000 && (floatval($c->gastoLegal) > 0)){
           	    $estadoFinal = "GASTO LEGAL";
          	}else{
          	    $estadoFinal = "SEPARACION";
            }
              echo @$operacion;
       	}
        
        if ($c->estadoContrato > "A" && $c->estadoContrato != $estadoFinal) {
            $c->fechaEstado = substr(Carbon::now(),0,10);
        }

        $c->estadoContrato = $estadoFinal;
        
        $c->save();
    }

    public function estadoServicio($estado, Contrato $contrato)
    {
        $contrato->estadoServicio = $estado;

        $contrato->save();
    }

    public function consecutivo($consecutivo, Contrato $contrato)
    {
        $contrato->consecutivo = $consecutivo;

        $contrato->save();
    }

    public function factura($factura, Contrato $contrato)
    {
        $contrato->factura = $factura;

        $contrato->save();
    }

    public function legalPdf(Request $request,Contrato $contrato,$pdf)
    {
        $contrato->legal = $pdf;
        $contrato->estadoServicio = '2';

        if ($contrato->saldoFavor > 0) {
            # code...
            $contrato->saldoFavor = $contrato->saldoFavor - $request->devolucion - $request->retencion - $request->canje_total;
        }else{
            $contrato->saldoFavor = $contrato->pagoInicial - $request->devolucion - $request->retencion - $request->canje_total;
        }

        $contrato->save();

        $datos = [
            'contrato' => $contrato,
            'titular' => Cliente::find($contrato->titular),
            'tipo' => $request->tipo,
            'canje_total' => $request->canje_total,
            'retencion' => $request->retencion,
            'devolucion' => $request->devolucion,
            'descripcion' => $request->descripcion,
            'hoy' => substr(Carbon::now(),0,10)
        ];

        $acta = 'Acta'.time().'.pdf';

        
        $pdf = PDF::loadView('documentos.pdf.legal', $datos);
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->save(public_path('documentos/actas').'/'.$acta);

        $legal = new Legales();

        $legal->contrato_id = $contrato->id;
        $legal->acta = $acta;
        $legal->comentario = $request->comentario;

        $legal->save();

        return $legal;
    }

    public function legalsend(Contrato $contrato)
    {
        $codigo = time();

        $datos = [
            'codigo' => $codigo,
            'contrato' => $contrato->sede.$contrato->consecutivo
        ];

        $correosXds = explode(',',Variable::find(9)->valor);

        Mail::send('documentos.email.codigo',$datos,function ($msg) use($correosXds)
        {
            $msg->subject('Codigo de Autorizacion.');
            $msg->to('info@systemsoca.com');
            $msg->cc($correosXds);
        });

        return $codigo;
    }

    public function getLegales($contrato)
    {
        return Legales::where('contrato_id',$contrato)->get();
    }

    public function upContrato(Contrato $contrato,$tipo)
    {
        $servicios1 = ContratoServicio::where("contrato_id",'=',$contrato->id)->where("tipo",'=',1)->get();
        $servicios2 = ContratoServicio::where("contrato_id",'=',$contrato->id)->where("tipo",'=',2)->get();
        $bonos = ContratoBono::where("contrato_id",'=',$contrato->id)->get();

        $titular = Cliente::find($contrato->titular);
        $cotitular = Cliente::find($contrato->cotitular);

        $data = [
            'servNaci' => $servicios1,
            'servInter' => $servicios2,
            'contrato' => $contrato,
            'bonos' => $bonos,
            'titular' => $titular,
            'cotitular' => $cotitular,
        ];

        $nombre = $contrato->sede.time().'.pdf';

        $pdf = PDF::loadView('documentos.pdf.contrato', $data);
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->save(public_path('documentos/replicas').'/'.$nombre);

        $replica = new Contratosdos();

        $replica->replica = $nombre;
        $replica->tipo = $tipo;
        $replica->valorContrato = $contrato->valorContrato;
        $replica->pagoInicial = $contrato->pagoInicial;
        $replica->contrato_id = $contrato->id;

        $replica->save();

        return $replica;
    }

    public function getReplicas($contrato)
    {
        return Contratosdos::where('contrato_id',$contrato)->get();
    }

    public function verificar(Request $request,Contrato $contrato)
    {
        $contrato->verificado = $request->verificado;

        $contrato->save();

        $datos = [
            'puntos' => $request->selected,
            'contrato' => $contrato,
            'comentario' => $request->comentario,
        ];

        $correosXds = explode(',',Variable::find(10)->valor);

        Mail::send('documentos.email.verificacion',$datos,function ($msg) use($correosXds)
        {
            $msg->subject('Verificacion de Contrato.');
            $msg->to('info@systemsoca.com');
            $msg->cc($correosXds);
        });
    }
}
