<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Carbon\Carbon;
use App\Sede;
use App\Contrato;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\ContratoServicio;
use App\ContratoBono;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\ContratoCuota;
use App\Clienteprod;
use App\ContratoEnunciado;
use App\variable;
use App\Cargo;
use App\Empleado;
use Artisan;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function contrato($contrato)
    {
        return view('contratos.contrato',['contrato'=>$contrato]);
    }

    public function contratos()
    {
        $contratos = Contrato::orderBy('id','desc')->paginate(15);

        $datos = [
            'contratos' => $contratos,
            'sedes' => Sede::get()
        ];

        return view('contratos.contratos',$datos);
    }

    public function contratosb($busqueda)
    {
        $bus = explode('|',$busqueda);

        $contratos = Contrato::orderBy('id','desc');
        
        if (@$bus[5] && @$bus[5] != '') {
            # code...
            $contratos = $contratos->where(DB::raw("CONCAT(sede,consecutivo)"),'LIKE','%'.$bus[5].'%')
                                   ->orWhere('titularNombre','LIKE','%'.$bus[5].'%')
                                   ->orWhere('cotitularNombre','LIKE','%'.$bus[5].'%');
        }else {
            if (@$bus[0] && @$bus[0] != '') {
                # code...
                $contratos = $contratos->where('sede',$bus[0]);
            }
            if (@$bus[1] && @$bus[1] != '') {
                # code...
                $contratos = $contratos->where('created_at','>=',$bus[1]);
            }
            if (@$bus[2] && @$bus[2] != '') {
                # code...
                $contratos = $contratos->where('created_at','<=',$bus[2].' 23:59:59');
            }
            if (@$bus[3] && @$bus[3] != '') {
                # code...
                $contratos = $contratos->where('estadoContrato',$bus[3]);
            }
            if (@$bus[4] || @$bus[4] == 0) {
                # code...
                $contratos = $contratos->where('estadoServicio',$bus[4]);
            }
        }

        $datos = [
            'contratos' => $contratos->paginate(15),
            'sedes' => Sede::get(),
            'sede' => @$bus[0],
        ];

        return view('contratos.contratos',$datos);
    }

    public function cartera($contrato)
    {
        return view('contratos.cartera',['contrato'=>$contrato]);
    }

    public function carteras()
    {
        $contratos = Contrato::orderBy('id','desc')->paginate(15);

        $datos = [
            'contratos' => $contratos,
            'sedes' => Sede::get()
        ];

        return view('contratos.carteras',$datos);
    }

    public function carterasb($busqueda)
    {
        $bus = explode('|',$busqueda);

        $contratos = Contrato::orderBy('id','desc');
        
        if (@$bus[5] && @$bus[5] != '') {
            # code...
            $contratos = $contratos->where(DB::raw("CONCAT(sede,consecutivo)"),'LIKE','%'.$bus[5].'%')
                                   ->orWhere('titularNombre','LIKE','%'.$bus[5].'%')
                                   ->orWhere('cotitularNombre','LIKE','%'.$bus[5].'%');
        }else {
            if (@$bus[0] && @$bus[0] != '') {
                # code...
                $contratos = $contratos->where('sede',$bus[0]);
            }
            if (@$bus[1] && @$bus[1] != '') {
                # code...
                $contratos = $contratos->where('created_at','>=',$bus[1]);
            }
            if (@$bus[2] && @$bus[2] != '') {
                # code...
                $contratos = $contratos->where('created_at','<=',$bus[2].' 23:59:59');
            }
            if (@$bus[3] && @$bus[3] != '') {
                # code...
                $contratos = $contratos->where('estadoContrato',$bus[3]);
            }
            if (@$bus[4] || @$bus[4] == 0) {
                # code...
                $contratos = $contratos->where('estadoServicio',$bus[4]);
            }
        }

        $datos = [
            'contratos' => $contratos->paginate(15),
            'sedes' => Sede::get(),
            'sede' => @$bus[0],
        ];

        return view('contratos.carteras',$datos);
    }

    public function crearInvitado()
    {
        return view('invitados.crear');
    }

    public function editarInvitado($cliente)
    {
        return view('invitados.editar',['invitado'=>$cliente]);
    }

    public function crearcontrato($cliente=0)
    {
        return view('contratos.nuevo',['invitado'=>$cliente]);
    }

    public function configuracion()
    {
        return view('configuracion');
    }

    public function invitados($tipo,$sede = '')
    {
        $invitados = [];

        if ($tipo == 'hoy') {
            $invitados = Cliente::where('tipo','=',1)->where('sede','=',$sede)
                                ->where('fechaCita','=',substr(Carbon::now(),0,10))
                                ->where('estadoCita','<>','LI')
                                ->where(function ($query) {
                                        $query->whereNull('confirmacion')
                                              ->orWhere(function ($query) {
                                                            $query->where('confirmacion','<>','CA')
                                                                ->where('confirmacion','<>','LI');
                                                        });
                                        })
                                ->orderBy('fechaCita', 'desc')
                                ->paginate(15);
        } else if ($tipo == 'pasadas'){
            $invitados = Cliente::where('tipo','=',1)->where('sede','=',$sede)
                                ->where('fechaCita','<',substr(Carbon::now(),0,10))
                                ->where('estadoCita','<>','LI')
                                ->where(function ($query) {
                                        $query->whereNull('estadoCita')
                                              ->orWhere(function ($query) {
                                                            $query->where('confirmacion','<>','CA')
                                                                ->where('confirmacion','<>','LI');
                                                        });
                                        })
                                ->orderBy('fechaCita', 'desc')
                                ->paginate(15);
        } else if ($tipo == 'proximas'){
            $invitados = Cliente::where('tipo','=',1)->where('sede','=',$sede)
                                ->where('fechaCita','>',substr(Carbon::now(),0,10))
                                ->where('estadoCita','<>','LI')
                                ->where(function ($query) {
                                        $query->whereNull('estadoCita')
                                              ->orWhere(function ($query) {
                                                            $query->where('confirmacion','<>','CA')
                                                                ->where('confirmacion','<>','LI');
                                                        });
                                        })
                                ->orderBy('fechaCita', 'desc')
                                ->paginate(15);
        } else if ($tipo == 'listanegra'){            
            $invitados = Cliente::where('tipo','=',1)->where('sede','=',$sede)
                                ->where(function ($query) {
                                        $query->where('estadoCita','=','LI')
                                              ->orWhere('confirmacion','=','LI');
                                    })
                                ->orderBy('fechaCita', 'desc')
                                ->paginate(15);
        } else if ($tipo == 'canceladas'){
            $invitados = Cliente::where('tipo','=',1)->where('sede','=',$sede)
                                ->where(function ($query) {
                                        $query->where('estadoCita','=','CA')
                                              ->orWhere('confirmacion','=','CA');
                                    })
                                ->orderBy('fechaCita', 'desc')
                                ->paginate(15);
        }
        $dato = [
            'tipo' => $tipo,
            'invitados' => $invitados,
            'acompanante' => null,
            'acompanantes' => array(),
            'sede' => $sede,            
            'sedes' => Sede::get()
        ];

        foreach ($invitados as $row) {
            $compa = @Cliente::where('id','=',$row->acompanante)->get()[0];

            if ($compa) {
                array_push($dato['acompanantes'],$compa);
            }
        }

        return view('invitados.todo',$dato);
    }

    public function cargos()
    {
        return view('empleados.cargos');
    }

    public function empleados()
    {
        return view('empleados.empleados');
    }

    public function roles()
    {
        return view('roles');
    }

    public function usuarios()
    {
        return view('usuarios');
    }

    public function nomina()
    {
        return view('nomina');
    }

    public function afiliados($busqueda='')
    {
        $bus = explode('|',$busqueda);        

        $contratos = Contrato::join('clientes','clientes.id','=','contratos.titular')
                            ->where('clientes.user_id','>',0)
                            ->select('contratos.*')
                            ->orderBy('contratos.id','desc');
        
        if (count($bus) == 6) {
            # code...
            if (@$bus[5] && @$bus[5] != '') {
                # code...
                $contratos = $contratos->where(DB::raw("CONCAT(contratos.sede,contratos.consecutivo)"),'LIKE','%'.$bus[5].'%')
                                       ->orWhere('contratos.titularNombre','LIKE','%'.$bus[5].'%')
                                       ->orWhere('contratos.cotitularNombre','LIKE','%'.$bus[5].'%')
                                       ->orWhere('clientes.cedula','LIKE','%'.$bus[5].'%')
                                       ->orWhere('clientes.pasaporte','LIKE','%'.$bus[5].'%')
                                       ->orWhere('clientes.celular','LIKE','%'.$bus[5].'%')
                                       ->orWhere('clientes.telefono','LIKE','%'.$bus[5].'%');
            }else {
                if (@$bus[0] && @$bus[0] != '') {
                    # code...
                    $contratos = $contratos->where('contratos.sede',$bus[0]);
                }
                if (@$bus[1] && @$bus[1] != '') {
                    # code...
                    $contratos = $contratos->where('contratos.created_at','>=',$bus[1]);
                }
                if (@$bus[2] && @$bus[2] != '') {
                    # code...
                    $contratos = $contratos->where('contratos.created_at','<=',$bus[2].' 23:59:59');
                }
                if (@$bus[3] && @$bus[3] != '') {
                    # code...
                    $contratos = $contratos->where('contratos.estadoContrato',$bus[3]);
                }
                if (@$bus[4] || @$bus[4] == 0) {
                    # code...
                    $contratos = $contratos->where('contratos.estadoServicio',$bus[4]);
                }
            }
        }

        $datos = [
            'contratos' => $contratos->paginate(15),
            'sedes' => Sede::get(),
            'sede' => @$bus[0],
        ];

        return view('servicio.afiliados',$datos);
    }
    public function tiketsCliente($id)
    {
        $cliente = Cliente::find($id);

        $datos = [
            'cliente' =>  $cliente
        ];

        return view('servicio.tikets',$datos);
    }

    public function productosCliente($id)
    {       
        $datos = [
            'cliente' =>  Cliente::find($id),
            'contrato' => Contrato::where('titular',$id)->first()
        ];

        return view('servicio.productos',$datos);
    }




    

    public function misServicios()
    {
        $cliente = User::getCliente(Auth::user()->id);
        $contratos = Contrato::where('titular','=',$cliente->id)->first();

        $datos = [
            'cliente' =>  $cliente,
            'contratos' => $contratos  
        ];

        return view('afiliado.servicios',$datos);
    }

    public function reportesexcel()
    {
        $datos = [
            'sedes' => Sede::get(),
            'cargos' => Cargo::get(),
            'empleados' => Empleado::get()
        ];

        return view('reportesexcel',$datos);
    }

    public function misTikets()
    {
        $cliente = User::getCliente(Auth::user()->id);

        $datos = [
            'cliente' =>  $cliente,
        ];

        return view('afiliado.tikets',$datos);
    }

    public function whatsapp()
    {
        return view('afiliado.whatsapp');
    }

    public function foro()
    {
        return view('servicio.foro');
    }


    public function pdflegal(Contrato $contrato)
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

        $pdf = PDF::loadView('documentos.pdf.legal', $data);
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream('legal.pdf');
    }



    public function pdfcontrato(Contrato $contrato)
    {
        $servicios1 = ContratoServicio::where("contrato_id",'=',$contrato->id)->where("tipo",'=',1)->get();
        $servicios2 = ContratoServicio::where("contrato_id",'=',$contrato->id)->where("tipo",'=',2)->get();
        $bonos = ContratoBono::where("contrato_id",'=',$contrato->id)->get();

        $titular = Cliente::find($contrato->titular);
        $cotitular = Cliente::find($contrato->cotitular);

        $enunciados = ContratoEnunciado::where('contrato_id',$contrato->id)->get();
        $variables = variable::where('id','>',21)->get();

        $data = [
            'servNaci' => $servicios1,
            'servInter' => $servicios2,
            'contrato' => $contrato,
            'bonos' => $bonos,
            'titular' => $titular,
            'cotitular' => $cotitular,
            'enunciados' => $enunciados,
            'variables' => $variables,
        ];

        $pdf = PDF::loadView('documentos.pdf.contrato', $data);
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream('contrato.pdf');
    }

    public function pdfcertificadovacaciones(Contrato $contrato)
    {
        $bonos = ContratoBono::where("contrato_id",'=',$contrato->id)->get();

        $titular = Cliente::find($contrato->titular);
        $cotitular = Cliente::find($contrato->cotitular);

        $data = [
            'contrato' => $contrato,
            'bonos' => $bonos,
            'titular' => $titular,
            'cotitular' => $cotitular,
        ];

        $pdf = PDF::loadView('documentos.pdf.vacaciones', $data);
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream('vacaciones.pdf');
    }
    
    public function pdfpagare1(Contrato $contrato)
    {
        $titular = Cliente::find($contrato->titular);
        $cotitular = Cliente::find($contrato->cotitular);

        $pagare = ContratoCuota::where('contrato_id',$contrato->id)->where('tipo',1)->get();

        $data = [
            'contrato' => $contrato,
            'titular' => $titular,
            'cotitular' => $cotitular,
            'pagare' => $pagare,
        ];

        $pdf = PDF::loadView('documentos.pdf.pagareI', $data);
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream('pagareI.pdf');
    }
    
    public function pdfpagare2(Contrato $contrato)
    {
        $titular = Cliente::find($contrato->titular);
        $cotitular = Cliente::find($contrato->cotitular);

        $pagare = ContratoCuota::where('contrato_id',$contrato->id)->where('tipo',2)->get();

        $data = [
            'contrato' => $contrato,
            'titular' => $titular,
            'cotitular' => $cotitular,
            'pagare' => $pagare,
        ];

        $pdf = PDF::loadView('documentos.pdf.pagareF', $data);
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream('pagareF.pdf');
    }
    
    public function pdfsiuso(Contrato $contrato)
    {
        $titular = Cliente::find($contrato->titular);
        $cotitular = Cliente::find($contrato->cotitular);

        $data = [
            'contrato' => $contrato,
            'titular' => $titular,
            'cotitular' => $cotitular,
            'texto' => '',
        ];

        $pdf = PDF::loadView('documentos.pdf.siUso', $data);
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream('siUso.pdf');
    }
    
    public function pdfsivigencia(Contrato $contrato)
    {
        $titular = Cliente::find($contrato->titular);
        $cotitular = Cliente::find($contrato->cotitular);

        $data = [
            'contrato' => $contrato,
            'titular' => $titular,
            'cotitular' => $cotitular,
            'texto' => '',
        ];

        $pdf = PDF::loadView('documentos.pdf.siVigencia', $data);
        $pdf->getDomPDF()->set_option("enable_php", true);

        return $pdf->stream('siVigencia.pdf');
    }
     public function limpiarCache()
    {
        $exitCode = Artisan::call('config:clear');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:cache');
        $exitCode = Artisan::call('optimize');
        $exitCode = Artisan::call('route:cache');
        $exitCode = Artisan::call('route:clear');
        $exitCode = Artisan::call('view:clear');
        return 'DONE SUCCESSFULLY'; //Return anything
    }
}
