<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Cliente;
use Carbon\Carbon;
use App\Contrato;
use App\ContratoCuota;
use App\ContratoPago;
use App\Comentario;
use App\Sede;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Empleado;
use App\variable;
use App\Tarjeta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DocumentosExcel extends Controller
{
    private $borderStyle = array(
        'borders' => array(
            'outline' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '000000'),
            ),
        ),
    );
    private $borderStyle2 = array(
        'borders' => array(
            'outline' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '000000'),
            ),
        ),
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => "aaddff"],
        ],
    );
    private $borderStyle4 = array(
        'borders' => array(
            'outline' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '000000'),
            ),
        ),
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => "55aa77"],
        ],
    );
    private $borderStyle5 = array(
        'borders' => array(
            'outline' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '000000'),
            ),
        ),
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => "55ff77"],
        ],
    );
    private $borderStyle6 = array(
        'borders' => array(
            'outline' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '000000'),
            ),
        ),
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => "ff6677"],
        ],
    );
    private $borderStyle3 = array(
        'borders' => array(
            'outline' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                'color' => array('rgb' => '000000'),
            ),
        ),
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'color' => ['rgb' => "ddaadd"],
        ],
    );

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manifiesto($sedeX)
    {
        $hoy = substr(Carbon::now(),0,10);

        $sede = @Sede::where('sede',$sedeX)->get()[0];
        $invitados = Cliente::where('tipo',1)->where('sede',$sedeX)->where('fechaCita',$hoy)->get();
        $contratos = Contrato::where('sede',$sedeX)->where('created_at',$hoy)->get();
        $globales = variable::get();

        $mes_vta = @Contrato::where('sede',$sedeX)->where('created_at','LIKE',substr($hoy,0,7))->select(DB::raw('SUM(valorContrato) as total'))->get()[0]->total;
        $cash_vta = @Contrato::where('sede',$sedeX)->where('created_at','LIKE',substr($hoy,0,7))->select(DB::raw('SUM(pagoInicial) as total'))->get()[0]->total;

        $jefeSala = "One Class";
        if (count($invitados) > 0) {
            foreach ($invitados as $row) {
                $q = @Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                               ->where('participantes.cargo_id',3)
                               ->where('participantes.cliente_id',$row->id)
                               ->select('empleados.nombre','empleados.apellido')
                               ->get()[0];
    
                if ($q) {
                    $jefeSala = $q->nombre.' '.$q->apellido;
                    break;
                }                
            }
        }
        if (count($contratos) > 0 && $jefeSala == "One Class") {
            foreach ($contratos as $row) {
                $q = @Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                               ->where('participantes.cargo_id',3)
                               ->where('participantes.cliente_id',$row->titular)
                               ->select('empleados.nombre','empleados.apellido')
                               ->get()[0];
    
                if ($q) {
                    $jefeSala = $q->nombre.' '.$q->apellido;
                    break;
                }                
            }
        }
        

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);

        $sheet->mergeCells('D2:J2');
        $sheet->getStyle('D2:J2')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D2",$sede->nombre);

        $sheet->mergeCells('D3:F3');
        $sheet->getStyle('D3:F3')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D3","Fecha:");
        $sheet->mergeCells('D4:F4');
        $sheet->getStyle('D4:F4')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D4","Sala:");
        $sheet->mergeCells('D5:F5');
        $sheet->getStyle('D5:F5')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D5","Jefe de Sala:");
        $sheet->mergeCells('D6:F6');
        $sheet->getStyle('D6:F6')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D6",User::getRole(Auth::user()->id)->name.":");

        $sheet->mergeCells('G3:J3');
        $sheet->getStyle('G3:J3')->applyFromArray($this->borderStyle);
        $sheet->setCellValue("G3",$hoy);
        $sheet->mergeCells('G4:J4');
        $sheet->getStyle('G4:J4')->applyFromArray($this->borderStyle);
        $sheet->setCellValue("G4",$sedeX);
        $sheet->mergeCells('G5:J5');
        $sheet->getStyle('G5:J5')->applyFromArray($this->borderStyle);
        $sheet->setCellValue("G5",$jefeSala);
        $sheet->mergeCells('G6:J6');
        $sheet->getStyle('G6:J6')->applyFromArray($this->borderStyle);
        $sheet->setCellValue("G6",Auth::user()->name);

        $sheet->setCellValue("A11","NRO.");
        $sheet->setCellValue("B11","INVITADO");
        $sheet->setCellValue("C11","ACOMPAÑANTE");
        $sheet->setCellValue("D11","PREOFESIÓN");
        $sheet->setCellValue("E11","ESTADO CIVIL");
        $sheet->setCellValue("F11","EDAD");
        $sheet->setCellValue("G11","DOC");
        $sheet->setCellValue("H11","LINER");
        $sheet->setCellValue("I11","CLOSER 1");
        $sheet->setCellValue("J11","CLOSER 2");
        $sheet->setCellValue("K11","CALIF.");
        $sheet->setCellValue("L11","CTO.");
        $sheet->setCellValue("M11","BOARDING.");
        $sheet->setCellValue("N11","VTA.");
        $sheet->setCellValue("O11","CASH.");
        $sheet->setCellValue("P11","%");
        $sheet->setCellValue("Q11","COD.");

        $sheet->getStyle('A11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('B11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('C11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('D11')->applyFromArray($this->borderStyle3);

        $sheet->getStyle('E11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('F11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('G11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('H11')->applyFromArray($this->borderStyle3);

        $sheet->getStyle('I11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('J11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('K11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('L11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('M11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('N11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('O11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('P11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('Q11')->applyFromArray($this->borderStyle3);

        $linea = 12;
        $nro = 0;

        $calf1 = 0;
        $calf2 = 0;
        $calf3 = 0;
        $calf4 = 0;
        $calf5 = 0;
        
        $calfCM = 0;

        $totalVtas = 0;
        $totalCash = 0;
        $totalBoor = 0;

        if ($contratos) {
            foreach ($contratos as $con) {
                $nro++;
            
                if($con->estadoServicio < 2){
                    $totalVtas+=$con->valorContrato;
                    $totalCash+=$con->pagoInicial;
                    $totalBoor+=($con->boordingCard*$globales[3]->valor);
                }
            
                $liner = "";
                $closer1 = "";
                $closer2 = "";
                $tgs = "";
                $profecion = "";
                $estadoCivil = "";
                $edad = "";
                $calificacion = "";
            
                $tgs1 = Tarjeta::where("cliente_id",$con->titular)->get();
                $tgs2 = Tarjeta::where("cliente_id",$con->cotitular)->get();
            
                $titular = Cliente::find($con->titular);
                $cotitular = Cliente::find($con->cotitular);
            
                $profecion = $titular->ocupacion;
                $estadoCivil = $titular->estadoCivil;
                $edad = $titular->edad;
                $calificacion = $titular->calificacion;
            
                    $calf1++;
            
                if ($cotitular) {
                    $profecion .= " / ".$cotitular->ocupacion;
                    $estadoCivil .= " / ".$cotitular->estadoCivil;
                    $edad .= " / ".$cotitular->edad;
                    $calificacion .= " / ".$cotitular->calificacion;
                }
            
                foreach ($tgs1 as $tg) {
                    if ($tg->tarjeta == 'DINNERS') {
                    $tgs.="-DN";
                    }else if ($tg->tarjeta == 'VISA') {
                    $tgs.="-VS";
                    }else if ($tg->tarjeta == 'MASTER CARD') {
                    $tgs.="-MC";
                    }else if ($tg->tarjeta == 'AMERICAN EXPRES') {
                    $tgs.="-AE";
                    }else if ($tg->tarjeta == 'AMERICAN') {
                    $tgs.="-AM";
                    }else if ($tg->tarjeta == 'DISCOVER') {
                    $tgs.="-DS";
                    }else if ($tg->tarjeta == 'ALIA') {
                    $tgs.="-AL";
                    }else {
                    $tgs.="-".$tg->tarjeta;
                    }
                }
                $tgs.=" / ";
                foreach ($tgs2 as $tg) {
                    if ($tg->tarjeta == 'DINNERS') {
                    $tgs.="-DN";
                    }else if ($tg->tarjeta == 'VISA') {
                    $tgs.="-VS";
                    }else if ($tg->tarjeta == 'MASTER CARD') {
                    $tgs.="-MC";
                    }else if ($tg->tarjeta == 'AMERICAN EXPRES') {
                    $tgs.="-AE";
                    }else if ($tg->tarjeta == 'AMERICAN') {
                    $tgs.="-AM";
                    }else if ($tg->tarjeta == 'DISCOVER') {
                    $tgs.="-DS";
                    }else if ($tg->tarjeta == 'ALIA') {
                    $tgs.="-AL";
                    }else {
                    $tgs.="-".$tg->tarjeta;
                    }
                }

                $linerQ = @Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                                    ->where('participantes.cargo_id',1)
                                    ->where('participantes.cliente_id',$con->titular)
                                    ->select('empleados.nombre','empleados.apellido')
                                    ->get()[0];
                if($linerQ){
                    $liner = $linerQ->nombre.' '.$linerQ->apellido;
                }

                $closerQ = Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                                    ->where('participantes.cargo_id',2)
                                    ->where('participantes.cliente_id',$con->titular)
                                    ->select('empleados.nombre','empleados.apellido')
                                    ->get();
                if (@$closerQ[0]) {
                    $closer1 = $closerQ[0]->nombre.' '.$closerQ[0]->apellido;
                }
                if (@$closerQ[1]) {
                    $closer2 = $closerQ[1]->nombre.' '.$closerQ[1]->apellido;
                }
            
                $sheet->setCellValue("A".$linea,$nro);
                $sheet->setCellValue("B".$linea,$con->titularNombre);
                $sheet->setCellValue("C".$linea,$con->cotitularNombre);
                $sheet->setCellValue("D".$linea,$profecion);
                $sheet->setCellValue("E".$linea,$estadoCivil);
                $sheet->setCellValue("F".$linea,$edad);
                $sheet->setCellValue("G".$linea,$tgs);
                $sheet->setCellValue("H".$linea,$liner);
                $sheet->setCellValue("I".$linea,$closer1);
                $sheet->setCellValue("J".$linea,$closer2);
                $sheet->setCellValue("K".$linea,"Q");
                $sheet->setCellValue("L".$linea,$con->sede.$con->consecutivo);
                $sheet->setCellValue("M".$linea,$con->boordingCard * $globales[3]->valor);
                $sheet->setCellValue("N".$linea,$con->valorContrato);
                $sheet->setCellValue("O".$linea,$con->pagoInicial);
                $sheet->setCellValue("P".$linea,"");
                $sheet->setCellValue("Q".$linea,$con->tmk);
            
                if($con->estadoServicio >= 2){
                    $sheet->setCellValue("K".$linea,$calificacion);
                    $sheet->setCellValue("O".$linea,"CM");
                    $calf1--;
                    $calfCM++;
                    if ($calificacion == 'Q') {
                        $calf1++;
                    }else if ($calificacion == 'TC') {
                        $calf2++;
                    }else if ($calificacion == 'NQ') {
                        $calf3++;
                    }else if ($calificacion == 'NT') {
                        $calf4++;
                    }
                }
            
                if($con->estadoServicio < 2){
                    $sheet->getStyle('A'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('B'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('C'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('D'.$linea)->applyFromArray($this->borderStyle5);
                
                    $sheet->getStyle('E'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('F'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('G'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('H'.$linea)->applyFromArray($this->borderStyle5);
                
                    $sheet->getStyle('I'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('J'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('K'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('L'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('M'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('N'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('O'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('P'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('Q'.$linea)->applyFromArray($this->borderStyle5);
                    }else{
                    $sheet->getStyle('A'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('B'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('C'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('D'.$linea)->applyFromArray($this->borderStyle6);
                
                    $sheet->getStyle('E'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('F'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('G'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('H'.$linea)->applyFromArray($this->borderStyle6);
                
                    $sheet->getStyle('I'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('J'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('K'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('L'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('M'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('N'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('O'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('P'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('Q'.$linea)->applyFromArray($this->borderStyle6);
                }
            
                $linea++;
            }
        }    
        
        if ($invitados) {
            foreach ($invitados as $con) {
                if($con->calificacion){
                    $nro++;
                
                
                    $liner = "";
                    $closer1 = "";
                    $closer2 = "";
                    $tgs = "";
                    $profecion = "";
                    $estadoCivil = "";
                    $edad = "";
                    $calificacion = "";
                
                    $tgs1 = Tarjeta::where("cliente_id",$con->id)->get();
                    $tgs2 = Tarjeta::where("cliente_id",$con->acompanante)->get();
                
                    $aco = Cliente::find($con->acompanante);
                
                    $profecion = $con->ocupacion;
                    $estadoCivil = $con->estadoCivil;
                    $edad = $con->edad;
                    $calificacion = $con->calificacion;
                
                    if ($con->calificacion == 'Q') {
                        $calf1++;
                    }else if ($con->calificacion == 'TC') {
                        $calf2++;
                    }else if ($con->calificacion == 'NQ') {
                        $calf3++;
                    }else if ($con->calificacion == 'NT') {
                        $calf4++;
                    }
                
                    if ($aco) {
                        $profecion .= " / ".$aco->ocupacion;
                        $estadoCivil .= " / ".$aco->estadoCivil;
                        $edad .= " / ".$aco->edad;
                        $calificacion .= " / ".$aco->calificacion;
                    }
                
                    foreach ($tgs1 as $tg) {
                        if ($tg->tarjeta == 'DINNERS') {
                        $tgs.=", DN";
                        }else if ($tg->tarjeta == 'VISA') {
                        $tgs.=", VS";
                        }else if ($tg->tarjeta == 'MASTER CARD') {
                        $tgs.=", MC";
                        }else if ($tg->tarjeta == 'AMERICAN EXPRES') {
                        $tgs.=", AE";
                        }else if ($tg->tarjeta == 'AMERICAN') {
                        $tgs.=", AM";
                        }else if ($tg->tarjeta == 'DISCOVER') {
                        $tgs.=", DS";
                        }else if ($tg->tarjeta == 'ALIA') {
                        $tgs.=", AL";
                        }else {
                        $tgs.=", ".$tg->tarjeta;
                        }
                
                        if ($tg->subtipo == 'BLACK') {
                        $tgs.="-BL ";
                        }else if ($tg->subtipo == 'SIGNATURE') {
                        $tgs.="-SG ";
                        }else if ($tg->subtipo == 'DORADA') {
                        $tgs.="-DR ";
                        }else if ($tg->subtipo == 'PLATINIUM') {
                        $tgs.="-PL ";
                        }else if ($tg->subtipo == 'TITANIUM') {
                        $tgs.="-TN ";
                        }else {
                        $tgs.="-".$tg->subtipo." ";
                        }
                    }
                    $tgs.=" / ";
                    foreach ($tgs2 as $tg) {
                        if ($tg->tarjeta == 'DINNERS') {
                        $tgs.=", DN";
                        }else if ($tg->tarjeta == 'VISA') {
                        $tgs.=", VS";
                        }else if ($tg->tarjeta == 'MASTER CARD') {
                        $tgs.=", MC";
                        }else if ($tg->tarjeta == 'AMERICAN EXPRES') {
                        $tgs.=", AE";
                        }else if ($tg->tarjeta == 'AMERICAN') {
                        $tgs.=", AM";
                        }else if ($tg->tarjeta == 'DISCOVER') {
                        $tgs.=", DS";
                        }else if ($tg->tarjeta == 'ALIA') {
                        $tgs.=", AL";
                        }else {
                        $tgs.=", ".$tg->tarjeta;
                        }
                
                        if ($tg->subtipo == 'BLACK') {
                        $tgs.="-BL ";
                        }else if ($tg->subtipo == 'SIGNATURE') {
                        $tgs.="-SG ";
                        }else if ($tg->subtipo == 'DORADA') {
                        $tgs.="-DR ";
                        }else if ($tg->subtipo == 'PLATINIUM') {
                        $tgs.="-PL ";
                        }else if ($tg->subtipo == 'TITANIUM') {
                        $tgs.="-TN ";
                        }else {
                        $tgs.="-".$tg->subtipo." ";
                        }
                    }
                
                    $linerQ = @Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                                    ->where('participantes.cargo_id',1)
                                    ->where('participantes.cliente_id',$con->id)
                                    ->select('empleados.nombre','empleados.apellido')
                                    ->get()[0];
                    if($linerQ){
                        $liner = $linerQ->nombre.' '.$linerQ->apellido;
                    }

                    $closerQ = Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                                        ->where('participantes.cargo_id',2)
                                        ->where('participantes.cliente_id',$con->id)
                                        ->select('empleados.nombre','empleados.apellido')
                                        ->get();
                    if (@$closerQ[0]) {
                        $closer1 = $closerQ[0]->nombre.' '.$closerQ[0]->apellido;
                    }
                    if (@$closerQ[1]) {
                        $closer2 = $closerQ[1]->nombre.' '.$closerQ[1]->apellido;
                    }

                    //if ($con->calificacion != 'NT'){
                    $sheet->setCellValue("A".$linea,$nro);
                    $sheet->setCellValue("B".$linea,$con->nombre." ".$con->apellido);
                    $sheet->setCellValue("C".$linea,@$aco->nombre." ".@$aco->apellido);
                    $sheet->setCellValue("D".$linea,$profecion);
                    $sheet->setCellValue("E".$linea,$estadoCivil);
                    $sheet->setCellValue("F".$linea,$edad);
                    $sheet->setCellValue("G".$linea,$tgs);
                    $sheet->setCellValue("H".$linea,$liner);
                    $sheet->setCellValue("I".$linea,$closer1);
                    $sheet->setCellValue("J".$linea,$closer2);
                    $sheet->setCellValue("K".$linea,$calificacion);
                    $sheet->setCellValue("L".$linea,"");
                    $sheet->setCellValue("M".$linea,"");
                    $sheet->setCellValue("N".$linea,"");
                    $sheet->setCellValue("O".$linea,"");
                    $sheet->setCellValue("P".$linea,"");
                    $sheet->setCellValue("Q".$linea,$con->codigo);
                
                    $sheet->getStyle('A'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('B'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('C'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('D'.$linea)->applyFromArray($this->borderStyle);
                
                    $sheet->getStyle('E'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('F'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('G'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('H'.$linea)->applyFromArray($this->borderStyle);
                
                    $sheet->getStyle('I'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('J'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('K'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('L'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('M'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('N'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('O'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('P'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('Q'.$linea)->applyFromArray($this->borderStyle);
                
                    $linea++;
                }else{
                    $nro++;
                }
            }
        }

        $sheet->setCellValue("C8","CITAS");
        $sheet->setCellValue("D8","TOURS");
        $sheet->setCellValue("E8","TC");
        $sheet->setCellValue("F8","NT");
        $sheet->setCellValue("G8","Q");
        $sheet->setCellValue("H8","NQ");
        $sheet->setCellValue("I8","VOL. VTAS");
        $sheet->setCellValue("J8","VOL. CASH");

        $sheet->setCellValue("C9",$nro);
        $sheet->setCellValue("D9",$calf1+$calf2+$calf3+$calf4+$calfCM);
        $sheet->setCellValue("E9",$calf2);
        $sheet->setCellValue("F9",$calf4);
        $sheet->setCellValue("G9",$calf1);
        $sheet->setCellValue("H9",$calf3);
        $sheet->setCellValue("I9",$totalVtas);
        $sheet->setCellValue("J9",$totalCash);


        $sheet->getStyle('C9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('D9')->applyFromArray($this->borderStyle);

        $sheet->getStyle('E9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('F9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('G9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('H9')->applyFromArray($this->borderStyle);

        $sheet->getStyle('I9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('J9')->applyFromArray($this->borderStyle);

        $sheet->getStyle('C8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('D8')->applyFromArray($this->borderStyle);

        $sheet->getStyle('E8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('F8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('G8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('H8')->applyFromArray($this->borderStyle);

        $sheet->getStyle('I8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('J8')->applyFromArray($this->borderStyle);

        $sheet->setCellValue("K5","VOL. VTAS");
        $sheet->setCellValue("L5","VOL. CASH");
        $sheet->setCellValue("K6",$totalVtas);
        $sheet->setCellValue("L6",$totalCash);

        $sheet->getStyle('K5')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('L5')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('K6')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('L6')->applyFromArray($this->borderStyle4);

        $sheet->setCellValue("M5","VOL. VTAS Menos BOARDING");
        $sheet->setCellValue("M6","VOL. CASH Menos BOARDING");
        $sheet->setCellValue("N5",$totalVtas - $totalBoor);
        $sheet->setCellValue("N6",$totalCash - $totalBoor);

        $sheet->getStyle('M5')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('M6')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('N5')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('N6')->applyFromArray($this->borderStyle4);

        $sheet->setCellValue("M8","VOL. VTAS Mes");
        $sheet->setCellValue("M9","VOL. CASH Mes");

        $sheet->setCellValue("N8",$mes_vta);
        $sheet->setCellValue("N9",$cash_vta);


        $sheet->getStyle('M8')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('M9')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('N8')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('N9')->applyFromArray($this->borderStyle4);



        $writer = new Xlsx($spreadsheet);

        if(file_exists(base_path()."\\public\\documentos\\manifiesto\\manifiesto_".$sedeX.".xlsx"))
        {
            unlink(base_path()."\\public\\documentos\\manifiesto\\manifiesto_".$sedeX.".xlsx");
        }
        
        $writer->save("./documentos/manifiesto/manifiesto_".$sedeX.".xlsx");

        return redirect(url("documentos/manifiesto/manifiesto_".$sedeX.".xlsx"));
    }

    public function enviamanifiesto(Request $request,$sedeX)
    {
        $hoy = substr(Carbon::now(),0,10);

        $sede = @Sede::where('sede',$sedeX)->get()[0];
        $invitados = Cliente::where('tipo',1)->where('sede',$sedeX)->where('fechaCita',$hoy)->get();
        $contratos = Contrato::where('sede',$sedeX)->where('created_at',$hoy)->get();
        $globales = variable::get();

        $mes_vta = @Contrato::where('sede',$sedeX)->where('created_at','LIKE',substr($hoy,0,7))->select(DB::raw('SUM(valorContrato) as total'))->get()[0]->total;
        $cash_vta = @Contrato::where('sede',$sedeX)->where('created_at','LIKE',substr($hoy,0,7))->select(DB::raw('SUM(pagoInicial) as total'))->get()[0]->total;

        $jefeSala = "One Class";
        if (count($invitados) > 0) {
            foreach ($invitados as $row) {
                $q = @Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                               ->where('participantes.cargo_id',3)
                               ->where('participantes.cliente_id',$row->id)
                               ->select('empleados.nombre','empleados.apellido')
                               ->get()[0];
    
                if ($q) {
                    $jefeSala = $q->nombre.' '.$q->apellido;
                    break;
                }                
            }
        }
        if (count($contratos) > 0 && $jefeSala == "One Class") {
            foreach ($contratos as $row) {
                $q = @Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                               ->where('participantes.cargo_id',3)
                               ->where('participantes.cliente_id',$row->titular)
                               ->select('empleados.nombre','empleados.apellido')
                               ->get()[0];
    
                if ($q) {
                    $jefeSala = $q->nombre.' '.$q->apellido;
                    break;
                }                
            }
        }
        

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);

        $sheet->mergeCells('D2:J2');
        $sheet->getStyle('D2:J2')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D2",$sede->nombre);

        $sheet->mergeCells('D3:F3');
        $sheet->getStyle('D3:F3')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D3","Fecha:");
        $sheet->mergeCells('D4:F4');
        $sheet->getStyle('D4:F4')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D4","Sala:");
        $sheet->mergeCells('D5:F5');
        $sheet->getStyle('D5:F5')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D5","Jefe de Sala:");
        $sheet->mergeCells('D6:F6');
        $sheet->getStyle('D6:F6')->applyFromArray($this->borderStyle2);
        $sheet->setCellValue("D6",User::getRole(Auth::user()->id)->name.":");

        $sheet->mergeCells('G3:J3');
        $sheet->getStyle('G3:J3')->applyFromArray($this->borderStyle);
        $sheet->setCellValue("G3",$hoy);
        $sheet->mergeCells('G4:J4');
        $sheet->getStyle('G4:J4')->applyFromArray($this->borderStyle);
        $sheet->setCellValue("G4",$sedeX);
        $sheet->mergeCells('G5:J5');
        $sheet->getStyle('G5:J5')->applyFromArray($this->borderStyle);
        $sheet->setCellValue("G5",$jefeSala);
        $sheet->mergeCells('G6:J6');
        $sheet->getStyle('G6:J6')->applyFromArray($this->borderStyle);
        $sheet->setCellValue("G6",Auth::user()->name);

        $sheet->setCellValue("A11","NRO.");
        $sheet->setCellValue("B11","INVITADO");
        $sheet->setCellValue("C11","ACOMPAÑANTE");
        $sheet->setCellValue("D11","PREOFESIÓN");
        $sheet->setCellValue("E11","ESTADO CIVIL");
        $sheet->setCellValue("F11","EDAD");
        $sheet->setCellValue("G11","DOC");
        $sheet->setCellValue("H11","LINER");
        $sheet->setCellValue("I11","CLOSER 1");
        $sheet->setCellValue("J11","CLOSER 2");
        $sheet->setCellValue("K11","CALIF.");
        $sheet->setCellValue("L11","CTO.");
        $sheet->setCellValue("M11","BOARDING.");
        $sheet->setCellValue("N11","VTA.");
        $sheet->setCellValue("O11","CASH.");
        $sheet->setCellValue("P11","%");
        $sheet->setCellValue("Q11","COD.");

        $sheet->getStyle('A11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('B11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('C11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('D11')->applyFromArray($this->borderStyle3);

        $sheet->getStyle('E11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('F11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('G11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('H11')->applyFromArray($this->borderStyle3);

        $sheet->getStyle('I11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('J11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('K11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('L11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('M11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('N11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('O11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('P11')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('Q11')->applyFromArray($this->borderStyle3);

        $linea = 12;
        $nro = 0;

        $calf1 = 0;
        $calf2 = 0;
        $calf3 = 0;
        $calf4 = 0;
        $calf5 = 0;
        
        $calfCM = 0;

        $totalVtas = 0;
        $totalCash = 0;
        $totalBoor = 0;

        if ($contratos) {
            foreach ($contratos as $con) {
                $nro++;
            
                if($con->estadoServicio < 2){
                    $totalVtas+=$con->valorContrato;
                    $totalCash+=$con->pagoInicial;
                    $totalBoor+=($con->boordingCard*$globales[3]->valor);
                }
            
                $liner = "";
                $closer1 = "";
                $closer2 = "";
                $tgs = "";
                $profecion = "";
                $estadoCivil = "";
                $edad = "";
                $calificacion = "";
            
                $tgs1 = Tarjeta::where("cliente_id",$con->titular)->get();
                $tgs2 = Tarjeta::where("cliente_id",$con->cotitular)->get();
            
                $titular = Cliente::find($con->titular);
                $cotitular = Cliente::find($con->cotitular);
            
                $profecion = $titular->ocupacion;
                $estadoCivil = $titular->estadoCivil;
                $edad = $titular->edad;
                $calificacion = $titular->calificacion;
            
                    $calf1++;
            
                if ($cotitular) {
                    $profecion .= " / ".$cotitular->ocupacion;
                    $estadoCivil .= " / ".$cotitular->estadoCivil;
                    $edad .= " / ".$cotitular->edad;
                    $calificacion .= " / ".$cotitular->calificacion;
                }
            
                foreach ($tgs1 as $tg) {
                    if ($tg->tarjeta == 'DINNERS') {
                    $tgs.="-DN";
                    }else if ($tg->tarjeta == 'VISA') {
                    $tgs.="-VS";
                    }else if ($tg->tarjeta == 'MASTER CARD') {
                    $tgs.="-MC";
                    }else if ($tg->tarjeta == 'AMERICAN EXPRES') {
                    $tgs.="-AE";
                    }else if ($tg->tarjeta == 'AMERICAN') {
                    $tgs.="-AM";
                    }else if ($tg->tarjeta == 'DISCOVER') {
                    $tgs.="-DS";
                    }else if ($tg->tarjeta == 'ALIA') {
                    $tgs.="-AL";
                    }else {
                    $tgs.="-".$tg->tarjeta;
                    }
                }
                $tgs.=" / ";
                foreach ($tgs2 as $tg) {
                    if ($tg->tarjeta == 'DINNERS') {
                    $tgs.="-DN";
                    }else if ($tg->tarjeta == 'VISA') {
                    $tgs.="-VS";
                    }else if ($tg->tarjeta == 'MASTER CARD') {
                    $tgs.="-MC";
                    }else if ($tg->tarjeta == 'AMERICAN EXPRES') {
                    $tgs.="-AE";
                    }else if ($tg->tarjeta == 'AMERICAN') {
                    $tgs.="-AM";
                    }else if ($tg->tarjeta == 'DISCOVER') {
                    $tgs.="-DS";
                    }else if ($tg->tarjeta == 'ALIA') {
                    $tgs.="-AL";
                    }else {
                    $tgs.="-".$tg->tarjeta;
                    }
                }

                $linerQ = @Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                                    ->where('participantes.cargo_id',1)
                                    ->where('participantes.cliente_id',$con->titular)
                                    ->select('empleados.nombre','empleados.apellido')
                                    ->get()[0];
                if($linerQ){
                    $liner = $linerQ->nombre.' '.$linerQ->apellido;
                }

                $closerQ = Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                                    ->where('participantes.cargo_id',2)
                                    ->where('participantes.cliente_id',$con->titular)
                                    ->select('empleados.nombre','empleados.apellido')
                                    ->get();
                if (@$closerQ[0]) {
                    $closer1 = $closerQ[0]->nombre.' '.$closerQ[0]->apellido;
                }
                if (@$closerQ[1]) {
                    $closer2 = $closerQ[1]->nombre.' '.$closerQ[1]->apellido;
                }
            
                $sheet->setCellValue("A".$linea,$nro);
                $sheet->setCellValue("B".$linea,$con->titularNombre);
                $sheet->setCellValue("C".$linea,$con->cotitularNombre);
                $sheet->setCellValue("D".$linea,$profecion);
                $sheet->setCellValue("E".$linea,$estadoCivil);
                $sheet->setCellValue("F".$linea,$edad);
                $sheet->setCellValue("G".$linea,$tgs);
                $sheet->setCellValue("H".$linea,$liner);
                $sheet->setCellValue("I".$linea,$closer1);
                $sheet->setCellValue("J".$linea,$closer2);
                $sheet->setCellValue("K".$linea,"Q");
                $sheet->setCellValue("L".$linea,$con->sede.$con->consecutivo);
                $sheet->setCellValue("M".$linea,$con->boordingCard * $globales[3]->valor);
                $sheet->setCellValue("N".$linea,$con->valorContrato);
                $sheet->setCellValue("O".$linea,$con->pagoInicial);
                $sheet->setCellValue("P".$linea,"");
                $sheet->setCellValue("Q".$linea,$con->tmk);
            
                if($con->estadoServicio >= 2){
                    $sheet->setCellValue("K".$linea,$calificacion);
                    $sheet->setCellValue("O".$linea,"CM");
                    $calf1--;
                    $calfCM++;
                    if ($calificacion == 'Q') {
                        $calf1++;
                    }else if ($calificacion == 'TC') {
                        $calf2++;
                    }else if ($calificacion == 'NQ') {
                        $calf3++;
                    }else if ($calificacion == 'NT') {
                        $calf4++;
                    }
                }
            
                if($con->estadoServicio < 2){
                    $sheet->getStyle('A'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('B'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('C'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('D'.$linea)->applyFromArray($this->borderStyle5);
                
                    $sheet->getStyle('E'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('F'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('G'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('H'.$linea)->applyFromArray($this->borderStyle5);
                
                    $sheet->getStyle('I'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('J'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('K'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('L'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('M'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('N'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('O'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('P'.$linea)->applyFromArray($this->borderStyle5);
                    $sheet->getStyle('Q'.$linea)->applyFromArray($this->borderStyle5);
                    }else{
                    $sheet->getStyle('A'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('B'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('C'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('D'.$linea)->applyFromArray($this->borderStyle6);
                
                    $sheet->getStyle('E'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('F'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('G'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('H'.$linea)->applyFromArray($this->borderStyle6);
                
                    $sheet->getStyle('I'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('J'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('K'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('L'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('M'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('N'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('O'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('P'.$linea)->applyFromArray($this->borderStyle6);
                    $sheet->getStyle('Q'.$linea)->applyFromArray($this->borderStyle6);
                }
            
                $linea++;
            }
        }    
        
        if ($invitados) {
            foreach ($invitados as $con) {
                if($con->calificacion){
                    $nro++;
                
                
                    $liner = "";
                    $closer1 = "";
                    $closer2 = "";
                    $tgs = "";
                    $profecion = "";
                    $estadoCivil = "";
                    $edad = "";
                    $calificacion = "";
                
                    $tgs1 = Tarjeta::where("cliente_id",$con->id)->get();
                    $tgs2 = Tarjeta::where("cliente_id",$con->acompanante)->get();
                
                    $aco = Cliente::find($con->acompanante);
                
                    $profecion = $con->ocupacion;
                    $estadoCivil = $con->estadoCivil;
                    $edad = $con->edad;
                    $calificacion = $con->calificacion;
                
                    if ($con->calificacion == 'Q') {
                        $calf1++;
                    }else if ($con->calificacion == 'TC') {
                        $calf2++;
                    }else if ($con->calificacion == 'NQ') {
                        $calf3++;
                    }else if ($con->calificacion == 'NT') {
                        $calf4++;
                    }
                
                    if ($aco) {
                        $profecion .= " / ".$aco->ocupacion;
                        $estadoCivil .= " / ".$aco->estadoCivil;
                        $edad .= " / ".$aco->edad;
                        $calificacion .= " / ".$aco->calificacion;
                    }
                
                    foreach ($tgs1 as $tg) {
                        if ($tg->tarjeta == 'DINNERS') {
                        $tgs.=", DN";
                        }else if ($tg->tarjeta == 'VISA') {
                        $tgs.=", VS";
                        }else if ($tg->tarjeta == 'MASTER CARD') {
                        $tgs.=", MC";
                        }else if ($tg->tarjeta == 'AMERICAN EXPRES') {
                        $tgs.=", AE";
                        }else if ($tg->tarjeta == 'AMERICAN') {
                        $tgs.=", AM";
                        }else if ($tg->tarjeta == 'DISCOVER') {
                        $tgs.=", DS";
                        }else if ($tg->tarjeta == 'ALIA') {
                        $tgs.=", AL";
                        }else {
                        $tgs.=", ".$tg->tarjeta;
                        }
                
                        if ($tg->subtipo == 'BLACK') {
                        $tgs.="-BL ";
                        }else if ($tg->subtipo == 'SIGNATURE') {
                        $tgs.="-SG ";
                        }else if ($tg->subtipo == 'DORADA') {
                        $tgs.="-DR ";
                        }else if ($tg->subtipo == 'PLATINIUM') {
                        $tgs.="-PL ";
                        }else if ($tg->subtipo == 'TITANIUM') {
                        $tgs.="-TN ";
                        }else {
                        $tgs.="-".$tg->subtipo." ";
                        }
                    }
                    $tgs.=" / ";
                    foreach ($tgs2 as $tg) {
                        if ($tg->tarjeta == 'DINNERS') {
                        $tgs.=", DN";
                        }else if ($tg->tarjeta == 'VISA') {
                        $tgs.=", VS";
                        }else if ($tg->tarjeta == 'MASTER CARD') {
                        $tgs.=", MC";
                        }else if ($tg->tarjeta == 'AMERICAN EXPRES') {
                        $tgs.=", AE";
                        }else if ($tg->tarjeta == 'AMERICAN') {
                        $tgs.=", AM";
                        }else if ($tg->tarjeta == 'DISCOVER') {
                        $tgs.=", DS";
                        }else if ($tg->tarjeta == 'ALIA') {
                        $tgs.=", AL";
                        }else {
                        $tgs.=", ".$tg->tarjeta;
                        }
                
                        if ($tg->subtipo == 'BLACK') {
                        $tgs.="-BL ";
                        }else if ($tg->subtipo == 'SIGNATURE') {
                        $tgs.="-SG ";
                        }else if ($tg->subtipo == 'DORADA') {
                        $tgs.="-DR ";
                        }else if ($tg->subtipo == 'PLATINIUM') {
                        $tgs.="-PL ";
                        }else if ($tg->subtipo == 'TITANIUM') {
                        $tgs.="-TN ";
                        }else {
                        $tgs.="-".$tg->subtipo." ";
                        }
                    }
                
                    $linerQ = @Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                                    ->where('participantes.cargo_id',1)
                                    ->where('participantes.cliente_id',$con->id)
                                    ->select('empleados.nombre','empleados.apellido')
                                    ->get()[0];
                    if($linerQ){
                        $liner = $linerQ->nombre.' '.$linerQ->apellido;
                    }

                    $closerQ = Empleado::join('participantes','empleados.id','=','participantes.empleado_id')
                                        ->where('participantes.cargo_id',2)
                                        ->where('participantes.cliente_id',$con->id)
                                        ->select('empleados.nombre','empleados.apellido')
                                        ->get();
                    if (@$closerQ[0]) {
                        $closer1 = $closerQ[0]->nombre.' '.$closerQ[0]->apellido;
                    }
                    if (@$closerQ[1]) {
                        $closer2 = $closerQ[1]->nombre.' '.$closerQ[1]->apellido;
                    }

                    //if ($con->calificacion != 'NT'){
                    $sheet->setCellValue("A".$linea,$nro);
                    $sheet->setCellValue("B".$linea,$con->nombre." ".$con->apellido);
                    $sheet->setCellValue("C".$linea,@$aco->nombre." ".@$aco->apellido);
                    $sheet->setCellValue("D".$linea,$profecion);
                    $sheet->setCellValue("E".$linea,$estadoCivil);
                    $sheet->setCellValue("F".$linea,$edad);
                    $sheet->setCellValue("G".$linea,$tgs);
                    $sheet->setCellValue("H".$linea,$liner);
                    $sheet->setCellValue("I".$linea,$closer1);
                    $sheet->setCellValue("J".$linea,$closer2);
                    $sheet->setCellValue("K".$linea,$calificacion);
                    $sheet->setCellValue("L".$linea,"");
                    $sheet->setCellValue("M".$linea,"");
                    $sheet->setCellValue("N".$linea,"");
                    $sheet->setCellValue("O".$linea,"");
                    $sheet->setCellValue("P".$linea,"");
                    $sheet->setCellValue("Q".$linea,$con->codigo);
                
                    $sheet->getStyle('A'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('B'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('C'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('D'.$linea)->applyFromArray($this->borderStyle);
                
                    $sheet->getStyle('E'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('F'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('G'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('H'.$linea)->applyFromArray($this->borderStyle);
                
                    $sheet->getStyle('I'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('J'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('K'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('L'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('M'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('N'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('O'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('P'.$linea)->applyFromArray($this->borderStyle);
                    $sheet->getStyle('Q'.$linea)->applyFromArray($this->borderStyle);
                
                    $linea++;
                }else{
                    $nro++;
                }
            }
        }

        $sheet->setCellValue("C8","CITAS");
        $sheet->setCellValue("D8","TOURS");
        $sheet->setCellValue("E8","TC");
        $sheet->setCellValue("F8","NT");
        $sheet->setCellValue("G8","Q");
        $sheet->setCellValue("H8","NQ");
        $sheet->setCellValue("I8","VOL. VTAS");
        $sheet->setCellValue("J8","VOL. CASH");

        $sheet->setCellValue("C9",$nro);
        $sheet->setCellValue("D9",$calf1+$calf2+$calf3+$calf4+$calfCM);
        $sheet->setCellValue("E9",$calf2);
        $sheet->setCellValue("F9",$calf4);
        $sheet->setCellValue("G9",$calf1);
        $sheet->setCellValue("H9",$calf3);
        $sheet->setCellValue("I9",$totalVtas);
        $sheet->setCellValue("J9",$totalCash);


        $sheet->getStyle('C9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('D9')->applyFromArray($this->borderStyle);

        $sheet->getStyle('E9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('F9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('G9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('H9')->applyFromArray($this->borderStyle);

        $sheet->getStyle('I9')->applyFromArray($this->borderStyle);
        $sheet->getStyle('J9')->applyFromArray($this->borderStyle);

        $sheet->getStyle('C8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('D8')->applyFromArray($this->borderStyle);

        $sheet->getStyle('E8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('F8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('G8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('H8')->applyFromArray($this->borderStyle);

        $sheet->getStyle('I8')->applyFromArray($this->borderStyle);
        $sheet->getStyle('J8')->applyFromArray($this->borderStyle);

        $sheet->setCellValue("K5","VOL. VTAS");
        $sheet->setCellValue("L5","VOL. CASH");
        $sheet->setCellValue("K6",$totalVtas);
        $sheet->setCellValue("L6",$totalCash);

        $sheet->getStyle('K5')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('L5')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('K6')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('L6')->applyFromArray($this->borderStyle4);

        $sheet->setCellValue("M5","VOL. VTAS Menos BOARDING");
        $sheet->setCellValue("M6","VOL. CASH Menos BOARDING");
        $sheet->setCellValue("N5",$totalVtas - $totalBoor);
        $sheet->setCellValue("N6",$totalCash - $totalBoor);

        $sheet->getStyle('M5')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('M6')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('N5')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('N6')->applyFromArray($this->borderStyle4);

        $sheet->setCellValue("M8","VOL. VTAS Mes");
        $sheet->setCellValue("M9","VOL. CASH Mes");

        $sheet->setCellValue("N8",$mes_vta);
        $sheet->setCellValue("N9",$cash_vta);


        $sheet->getStyle('M8')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('M9')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('N8')->applyFromArray($this->borderStyle4);
        $sheet->getStyle('N9')->applyFromArray($this->borderStyle4);



        $writer = new Xlsx($spreadsheet);

        if(file_exists(base_path()."\\public\\documentos\\manifiesto\\manifiesto_".$sedeX.".xlsx"))
        {
            unlink(base_path()."\\public\\documentos\\manifiesto\\manifiesto_".$sedeX.".xlsx");
        }
        
        $writer->save("./documentos/manifiesto/manifiesto_".$sedeX.".xlsx");

        $datosMail = [
            'sede' => $sede,
            'items' => $request->items,
            'factura' => $request->factura,
            'total' => $request->total,
        ];

        $correosXds = explode(',',Variable::find(8)->valor);

        Mail::send('documentos.email.manifiesto',$datosMail,function ($msg) use($sedeX,$correosXds)
        {
            $msg->subject('Codigo de Autorizacion.');
            $msg->to('info@systemsoca.com');
            $msg->cc($correosXds);
            $msg->attach(base_path()."\\public\\documentos\\manifiesto\\manifiesto_".$sedeX.".xlsx");
        });
    }

    public function embudo(Request $request)
    {
        if(file_exists(base_path()."\\public\\documentos\\embudo1.xlsx"))
        {
            unlink(base_path()."\\public\\documentos\\embudo1.xlsx");
        }

        $archivo = $request->file('archivo');

        $name = 'embudo1.xlsx';
        $destino = public_path('documentos');

        $archivo->move($destino,$name);

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(url('/documentos/embudo1.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();

        for ($i=0; $i < $request->filas; $i++) {
            $nombre = $spreadsheet->getActiveSheet()->getCell($request->nombre.$i)->getValue();

            $celCol = explode(',',$request->celular);
            $telCol = explode(',',$request->telefono);

            $celular=[];
            $telefono=[];

            foreach($celCol as $row){
                array_push($celular,$spreadsheet->getActiveSheet()->getCell($row.$i)->getValue());
            }
            foreach($telCol as $row){
                array_push($telefono,$spreadsheet->getActiveSheet()->getCell($row.$i)->getValue());
            }

            $q = Cliente::where(DB::raw("CONCAT(nombre,' ',apellido)",'LIKE',$nombre));

            foreach($celular as $row){
                if($row != '' || $row != null){
                    $q = $q->where(DB::raw("REPLACE(REPLACE(celular,' ',''),'-','')",'LIKE',str_replace(' ','',str_replace('-','',$row))));
                }
            }

            foreach($telefono as $row){
                if($row != '' || $row != null){
                    $q = $q->where(DB::raw("REPLACE(REPLACE(telefono,' ',''),'-','')",'LIKE',str_replace(' ','',str_replace('-','',$row))));
                }
            }


            $q = $q->first();

            if (@$q->tipo) {
                $sheet->getStyle('A'.$i.':I'.$i)->applyFromArray($this->borderStyle2);
            }
        }


        $writer = new Xlsx($spreadsheet);

        if(file_exists(base_path()."\\public\\documentos\\embudo2.xlsx"))
        {
            unlink(base_path()."\\public\\documentos\\embudo2.xlsx");
        }

        $writer->save("./documentos/embudo2.xlsx");

        return redirect('/documentos/embudo2.xlsx');
    }

    public function carteraDiaria(){
        $hoy = substr(Carbon::now(),0,10);

        $contratos = Contrato::join('contrato_cuotas','contrato_cuotas.contrato_id','=','contratos.id')
                        ->where('contrato_cuotas.fecha',$hoy)
                        ->select('contratos.*')
                        ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        
        $sheet->mergeCells('A1:L1');
        $sheet->mergeCells('A2:L2');
        $sheet->mergeCells('A3:L3');
        $sheet->mergeCells('A4:L4');
        
        $sheet->getStyle('A5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('B5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('C5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('D5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('E5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('F5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('G5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('H5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('I5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('J5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('K5')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('L5')->applyFromArray($this->borderStyle3);
        
        $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2:L2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:L3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A4:L4')->getAlignment()->setHorizontal('center');
        
        
        $sheet->getStyle('A5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('H5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('I5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('J5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('K5')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('L5')->getAlignment()->setHorizontal('center');
        
        $sheet->setCellValue("A1","ONE CLASS TRAVEL");
        $sheet->setCellValue("A2","CUENTAS POR COBRAR");
        $sheet->setCellValue("A3","FECHA ".$hoy);

        $sheet->setCellValue("A5","FECHA");
        $sheet->setCellValue("B5","CONTRATO");
        $sheet->setCellValue("C5","CLIENTE");
        $sheet->setCellValue("D5","VALOR DEL CTO");
        $sheet->setCellValue("E5","CASH");
        $sheet->setCellValue("F5","PAGOS");
        $sheet->setCellValue("G5","SALDO A COBRAR");
        $sheet->setCellValue("H5","FECHA DE VENCIMIENTO");
        $sheet->setCellValue("I5","ESTATUS");
        $sheet->setCellValue("J5","COMENTARIOS");
        $sheet->setCellValue("K5","TELEFONOS");
        $sheet->setCellValue("L5","CORREO");
            


        $indice = 6;

        if (@$contratos){
            foreach ($contratos as $con){

                $estadoContrato = "";

                if ($con->estadoServicio == '0') {
                    $estadoContrato = "ACTIVO";
                }else if ($con->estadoServicio == '1') {
                    $estadoContrato = "INACTIVO";
                }else if ($con->estadoServicio == '2') {
                    $estadoContrato = "ANULADO";
                }else if ($con->estadoServicio == '3') {
                    $estadoContrato = "ANULADO C.M.";
                }else if ($con->estadoServicio == '4') {
                    $estadoContrato = "ANULADO E.D.";
                }
                
                $saldo = ContratoCuota::where('contrato_id',$con->id)
                                    ->where('fecha','<=',$hoy)
                                    ->where('saldo','>',0)
                                    ->select(DB::raw('SUM(saldo) as saldoTotal'))
                                    ->first()
                                    ->saldoTotal;
                        
                $pagos =  ContratoPago::where('contrato_id',$con->id)
                                    ->where('created_at','<=',$hoy.' 23:59:59')
                                    ->where('valor','>',0)
                                    ->select(DB::raw('SUM(valor) as valorTotal'))
                                    ->first()
                                    ->valorTotal;
                                    
                
                $comentariosAr = Comentario::where('cliente_id',$con->titular)
                                    ->where('created_at','LIKE','%'.$hoy.'%')
                                    ->where('lugar','CARTERA')
                                    ->get();

                $comentarios = '';

                if($comentariosAr){
                    foreach($comentariosAr as $comen){
                        $comentarios .= $comen->comentario.' / ';
                    }
                }
                        
                $titular = Cliente::find($con->titular);
                $cotitular = Cliente::find($con->cotitular);

                $status = 'Pendiente';
                        
                if($saldo <= 0){
                    $status = 'Pagado';
                }

                $sheet->setCellValue("A".$indice,substr($con->created_at,0,10));
                $sheet->setCellValue("B".$indice,$con->sede.$con->consecutivo.' / '.$estadoContrato);
                $sheet->setCellValue("C".$indice,$con->titularNombre);
                $sheet->setCellValue("D".$indice,$con->valorContrato);
                $sheet->setCellValue("E".$indice,$con->pagoInicial);
                $sheet->setCellValue("F".$indice,$pagos);
                $sheet->setCellValue("G".$indice,$saldo);
                $sheet->setCellValue("H".$indice,$hoy);
                $sheet->setCellValue("I".$indice,$status);
                $sheet->setCellValue("J".$indice,$comentarios);
                $sheet->setCellValue("K".$indice,$titular->celular.' '.$titular->telefono.' / '.@$cotitular->celular.' '.@$cotitular->telefono);
                $sheet->setCellValue("L".$indice,$titular->email.' '.$titular->email2.' / '.@$cotitular->email.' '.@$cotitular->email2);
                        
                $sheet->getStyle('A'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('B'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('C'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('D'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('E'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('F'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('G'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('H'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('I'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('J'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('K'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('L'.$indice)->applyFromArray($this->borderStyle);
                $indice++;
            }
        }


        $sheet->mergeCells("A$indice:E$indice");
        $sheet->getStyle("A$indice:E$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("A$indice:E$indice")->getAlignment()->setHorizontal('center');
        
        $sheet->getStyle("F$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("F$indice")->getAlignment()->setHorizontal('center');
        
        
        $sheet->getStyle("G$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("G$indice")->getAlignment()->setHorizontal('center');
        
        $sheet->setCellValue("A$indice","TOTAL:");
        
        if($indice > 6){
            $sheet->setCellValue("F$indice","=SUM(F6:F".($indice-1).")");
            $sheet->setCellValue("G$indice","=SUM(G6:G".($indice-1).")");
        }


        $writer = new Xlsx($spreadsheet);

        if(file_exists(base_path()."\\public\\documentos\\informeDiario.xlsx"))
        {
            unlink(base_path()."\\public\\documentos\\informeDiario.xlsx");
        }

        $writer->save("./documentos/informeDiario.xlsx");

        return redirect('/documentos/informeDiario.xlsx');
    }

    public function carteramensual(){
        $hoy = substr(Carbon::now(),0,10);
        $mes = substr(Carbon::now(),0,7);

        $contratos = Contrato::join('contrato_cuotas','contrato_cuotas.contrato_id','=','contratos.id')
                        ->where('contrato_cuotas.fecha','LIKE','%'.$mes.'%')
                        ->select('contratos.*')
                        ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);

        $sheet->mergeCells('A7:B7');
        $sheet->mergeCells('C7:C8');
        $sheet->mergeCells('D7:D8');
        $sheet->mergeCells('E7:E8');
        $sheet->mergeCells('F7:F8');
        $sheet->mergeCells('G7:G8');
        $sheet->mergeCells('H7:H8');
        $sheet->mergeCells('I7:O7');
        $sheet->mergeCells('P7:P8');
        $sheet->mergeCells('Q7:Q8');
        
        $sheet->getStyle('A7:B7')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('C7:C8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('D7:D8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('E7:E8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('F7:F8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('G7:G8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('H7:H8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('I7:O7')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('P7:P8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('Q7:Q8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('A8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('B8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('I8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('J8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('K8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('L8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('M8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('N8')->applyFromArray($this->borderStyle3);
        $sheet->getStyle('O8')->applyFromArray($this->borderStyle3);
        
        $sheet->getStyle('A7:B7')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C7:C8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D7:D8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E7:E8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F7:F8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('G7:G8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('H7:H8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('I7:O7')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('P7:P8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('Q7:Q8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('I8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('J8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('K8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('L8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('M8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('N8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('O8')->getAlignment()->setHorizontal('center');
        
        $sheet->setCellValue("A1","ONE CLASS TRAVEL");
        $sheet->setCellValue("A2","RUC 0992991291001");
        $sheet->setCellValue("A3","CENTRO COMERCIAL ALBAN BORJA LOCAL 74 P1");
        $sheet->setCellValue("A4","Detalle de Antigüedad de Cartera");
        $sheet->setCellValue("A5","Al (En U.S. dólares)");

        $sheet->setCellValue("A7","CLIENTE");
        $sheet->setCellValue("A8","NOMBRE");
        $sheet->setCellValue("B8","CONTRATO");
        $sheet->setCellValue("C7","AÑOS DE CONTRATO");
        $sheet->setCellValue("D7","FECHA DE CONTRATO");
        $sheet->setCellValue("E7","FECHA DE VENCIMIENTO DE CONTRATO");
        $sheet->setCellValue("F7","MESES DE GRACIA");
        $sheet->setCellValue("G7","FECHA DE INICIO DE COBRO");
        $sheet->setCellValue("H7","SALDO POR VENCER");
        $sheet->setCellValue("I7","VENCIDO");
        $sheet->setCellValue("I8","30 DIAS");
        $sheet->setCellValue("J8","60 DIAS");
        $sheet->setCellValue("K8","90 DIAS");
        $sheet->setCellValue("L8","120 DIAS");
        $sheet->setCellValue("M8","180 DIAS");
        $sheet->setCellValue("N8","360 DIAS");
        $sheet->setCellValue("O8",">360 DIAS");
        $sheet->setCellValue("P7","TOTAL VENCIDO");
        $sheet->setCellValue("Q7","TOTAL CARTERA");
        $indice = 9;

        if (@$contratos){
            foreach ($contratos as $con){

                $estadoContrato = "";

                if ($con->estadoServicio == '0') {
                    $estadoContrato = "ACTIVO";
                }else if ($con->estadoServicio == '1') {
                    $estadoContrato = "INACTIVO";
                }else if ($con->estadoServicio == '2') {
                    $estadoContrato = "ANULADO";
                }else if ($con->estadoServicio == '3') {
                    $estadoContrato = "ANULADO C.M.";
                }else if ($con->estadoServicio == '4') {
                    $estadoContrato = "ANULADO E.D.";
                }
                
                $fechaFinal = date(substr($con->created_at,0,10));
                $nuevafecha = strtotime ( '+ '.$con->anosOtorgados.' years' , strtotime ( $fechaFinal ) ) ;
                $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
                        
                $fechaPrimerPago = @ContratoCuota::where('contrato_id',$con->id)->first()->fecha;
                $saldoPorVencer = @ContratoCuota::where('contrato_id',$con->id)->where('fecha','>=',$hoy)->first()->saldo;
                $cuotasVencidas = @ContratoCuota::where('contrato_id',$con->id)->where('fecha','<',$hoy)->where('saldo','>',0)->get();
                        
                $fechainicialM = @Carbon::createFromFormat('Y-m-d',substr($con->created_at,0,10));
                $fechafinalM = Carbon::createFromFormat('Y-m-d',substr($fechaPrimerPago,0,10));
                        
                $diferencia = $fechainicialM->diff($fechafinalM);
                        
                $meses = ( $diferencia->y * 12 ) + $diferencia->m;
                        
                $vencido1=0.0;
                $vencido2=0.0;
                $vencido3=0.0;
                        
                $vencido4=0.0;
                $vencido5=0.0;
                $vencido6=0.0;
                $vencido7=0.0;

                foreach($cuotasVencidas as $cuota){
                    $fechainicialM = Carbon::createFromFormat('Y-m-d',substr($cuota->fecha,0,10));
                    $fechafinalM = Carbon::now();
                            
                    $diferencia = $fechainicialM->diff($fechafinalM);
                            
                    if($diferencia->m < 1){
                        $vencido1+=$cuota->saldo;
                    }else if($diferencia->m < 2){
                        $vencido2+=$cuota->saldo;
                    }else if($diferencia->m < 3){
                        $vencido3+=$cuota->saldo;
                    }else if($diferencia->m < 4){
                        $vencido4+=$cuota->saldo;
                    }else if($diferencia->m < 6){
                        $vencido5+=$cuota->saldo;
                    }else if($diferencia->y < 1){
                        $vencido6+=$cuota->saldo;
                    }else{
                        $vencido7+=$cuota->saldo;
                    }
                }

                $sheet->setCellValue("A".$indice,$con->titularNombre);
                $sheet->setCellValue("B".$indice,$con->sede.$con->consecutivo);
                $sheet->setCellValue("C".$indice,$con->anosOtorgados);
                $sheet->setCellValue("D".$indice,substr($con->created_at,0,10));
                $sheet->setCellValue("E".$indice,$nuevafecha);
                $sheet->setCellValue("F".$indice,$meses." Meses");
                $sheet->setCellValue("G".$indice,$fechaPrimerPago);
                $sheet->setCellValue("H".$indice,$saldoPorVencer);
                $sheet->setCellValue("I".$indice,$vencido1);
                $sheet->setCellValue("J".$indice,$vencido2);
                $sheet->setCellValue("K".$indice,$vencido3);
                $sheet->setCellValue("L".$indice,$vencido4);
                $sheet->setCellValue("M".$indice,$vencido5);
                $sheet->setCellValue("N".$indice,$vencido6);
                $sheet->setCellValue("O".$indice,$vencido7);
                $sheet->setCellValue("P".$indice,$vencido1 + $vencido2 + $vencido3 + $vencido4 + $vencido5 + $vencido6 + $vencido7);
                $sheet->setCellValue("Q".$indice,$con->pagoInicial);
                        
                $sheet->getStyle('A'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('B'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('C'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('D'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('E'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('F'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('G'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('H'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('I'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('J'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('K'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('L'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('M'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('N'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('O'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('P'.$indice)->applyFromArray($this->borderStyle);
                $sheet->getStyle('Q'.$indice)->applyFromArray($this->borderStyle);

                    $indice++;
            }
        }


        $sheet->mergeCells("A$indice:G$indice");
        $sheet->getStyle("A$indice:G$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("A$indice:G$indice")->getAlignment()->setHorizontal('center');
            
        $sheet->getStyle("H$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("H$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("I$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("I$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("J$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("J$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("K$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("K$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("L$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("L$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("M$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("M$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("N$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("N$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("O$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("O$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("P$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("P$indice")->getAlignment()->setHorizontal('center');
            
            
        $sheet->getStyle("Q$indice")->applyFromArray($this->borderStyle3);
        $sheet->getStyle("Q$indice")->getAlignment()->setHorizontal('center');

        $sheet->setCellValue("A$indice","TOTAL:");
            
        if($indice > 9){
            $sheet->setCellValue("H$indice","=SUM(H9:H".($indice-1).")");
            $sheet->setCellValue("I$indice","=SUM(I9:I".($indice-1).")");
            $sheet->setCellValue("J$indice","=SUM(J9:J".($indice-1).")");
            $sheet->setCellValue("K$indice","=SUM(K9:K".($indice-1).")");
            $sheet->setCellValue("L$indice","=SUM(L9:L".($indice-1).")");
            $sheet->setCellValue("M$indice","=SUM(M9:M".($indice-1).")");
            $sheet->setCellValue("N$indice","=SUM(N9:N".($indice-1).")");
            $sheet->setCellValue("O$indice","=SUM(O9:O".($indice-1).")");
            $sheet->setCellValue("P$indice","=SUM(P9:P".($indice-1).")");
            $sheet->setCellValue("Q$indice","=SUM(Q9:Q".($indice-1).")");
        }


        $writer = new Xlsx($spreadsheet);

        if(file_exists(base_path()."\\public\\documentos\\informeMensual.xlsx"))
        {
            unlink(base_path()."\\public\\documentos\\informeMensual.xlsx");
        }

        $writer->save("./documentos/informeMensual.xlsx");

        return redirect('/documentos/informeMensual.xlsx');
    }
}
