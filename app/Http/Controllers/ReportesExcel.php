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
use App\Cargo;
use Illuminate\Support\Facades\Auth;
use App\Empleado;
use App\variable;
use App\Tarjeta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReportesExcel extends Controller
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

    public function reporte(Request $request)
    {
        $sede = @$request->sede; 
        $fecha1 = @$request->fecha1;
        $fecha2 = @$request->fecha2;
        $cargo = @$request->cargo;
        $empleado = @$request->empleado;
        $indice = 2;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        ////////////////////////////////////////////////

        if ($request->tipo == 1) {
            $contratos = Contrato::where("id",">",0);

            if ($sede) {
                $contratos = $contratos->where("sede",$sede);
            }
            if ($fecha1) {
                $contratos = $contratos->where("created_at",">=",$fecha1);
            }
            if ($fecha2) {
                $contratos = $contratos->where("created_at","<=",$fecha2." 23:59:59");
            }

            $contratos = $contratos->select('sede','estadoServicio',
            'consecutivo',
            'estadoContrato',
            'anosPactados',
            'anosOtorgados',
            'valorContrato',
            'pagoInicial',
            'created_at',
            'titularNombre',
            'cotitularNombre',
            'cuotaInicial',
            'saldoInicial',
            'saldoFinanciado',
            'fechaPagoInicial',
            'fechaPagoFinanciado',
            'numeroCuotasIniciales',
            'numeroCuotasFinanciado')->orderBy('created_at','desc')->limit(1700)->get();

            $sheet->getStyle('A1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('B1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('C1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('D1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('E1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('F1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('G1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('H1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('I1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('J1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('K1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('L1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('M1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('N1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('O1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('P1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('Q1')->applyFromArray($this->borderStyle);

            
            $sheet->setCellValue("A1","Contrato");
            $sheet->setCellValue("B1","Estado Servicio");
            $sheet->setCellValue("C1","A. Pactados");
            $sheet->setCellValue("D1","A. Otorgados");
            $sheet->setCellValue("E1","Valor");
            $sheet->setCellValue("F1","Pago Inicial");
            $sheet->setCellValue("G1","Fecha de Creacion");
            $sheet->setCellValue("H1","Titular");
            $sheet->setCellValue("I1","Cotitular");
            $sheet->setCellValue("J1","Cuota Inicial");
            $sheet->setCellValue("K1","Saldo Inicial");
            $sheet->setCellValue("L1","Saldo Financiado");
            $sheet->setCellValue("M1","Fecha de pago de la primera cuota Inicial");
            $sheet->setCellValue("N1","Fecha de pago de la primera cuota Financiada");
            $sheet->setCellValue("O1","Numero de cuotas Iniciales");
            $sheet->setCellValue("P1","Numero de cuotas Financiadas");
            $sheet->setCellValue("Q1","Estado del Contrato");

            if ($contratos) {
                foreach ($contratos as $con) {
                    $estado = "";

                    if ($con->estadoServicio == 0) {
                        $estado = "ACTIVO";
                    }else if ($con->estadoServicio == 1) {
                        $estado = "INACTIVO";
                    }else if ($con->estadoServicio == 2) {
                        $estado = "ANULADO";
                    }else if ($con->estadoServicio == 3) {
                        $estado = "ANULADO CM";
                    }else if ($con->estadoServicio == 4) {
                        $estado = "ANULADO ED";
                    }

                    $sheet->setCellValue("A".$indice,$con->sede.$con->consecutivo);
                    $sheet->setCellValue("B".$indice,$estado);
                    $sheet->setCellValue("C".$indice,$con->anosPactados);
                    $sheet->setCellValue("D".$indice,$con->anosOtorgados);
                    $sheet->setCellValue("E".$indice,$con->valorContrato);
                    $sheet->setCellValue("F".$indice,$con->pagoInicial);
                    $sheet->setCellValue("G".$indice,$con->created_at);
                    $sheet->setCellValue("H".$indice,$con->titularNombre);
                    $sheet->setCellValue("I".$indice,$con->cotitularNombre);
                    $sheet->setCellValue("J".$indice,$con->cuotaInicial);
                    $sheet->setCellValue("K".$indice,$con->saldoInicial);
                    $sheet->setCellValue("L".$indice,$con->saldoFinanciado);
                    $sheet->setCellValue("M".$indice,$con->fechaPagoInicial);
                    $sheet->setCellValue("N".$indice,$con->fechaPagoFinanciado);
                    $sheet->setCellValue("O".$indice,$con->numeroCuotasIniciales);
                    $sheet->setCellValue("P".$indice,$con->numeroCuotasFinanciado);
                    $sheet->setCellValue("Q".$indice,$con->estadoContrato);
                    
                    $indice++;
                }
            }
        }

        ////////////////////////////////////////////////

        if ($request->tipo == 2) {
            $contratos = Contrato::join("clientes","clientes.id","=","contratos.titular")->where("contratos.id",">",0);

            if ($sede) {
                $contratos = $contratos->where("contratos.sede",$sede);
            }
            if ($fecha1) {
                $contratos = $contratos->where("contratos.created_at",">=",$fecha1);
            }
            if ($fecha2) {
                $contratos = $contratos->where("contratos.created_at","<=",$fecha2." 23:59:59");
            }

            $contratos = $contratos->select(DB::raw("CONCAT(contratos.sede,contratos.consecutivo) AS contrato"),
                                        "contratos.titularNombre",
                                        "contratos.cotitularNombre",
                                        "clientes.celular",
                                        "clientes.telefono",
                                        "clientes.email",
                                        "clientes.email2"
                                    )
                                    ->orderBy('contratos.created_at','desc')->get();

            $sheet->getStyle('A1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('B1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('C1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('D1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('E1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('F1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('G1')->applyFromArray($this->borderStyle);

            
            $sheet->setCellValue("A1","Contrato");
            $sheet->setCellValue("B1","Tiutular");
            $sheet->setCellValue("C1","Cotitular");
            $sheet->setCellValue("D1","celular");
            $sheet->setCellValue("E1","telefono");
            $sheet->setCellValue("F1","email");
            $sheet->setCellValue("G1","email2");

            if ($contratos) {
                foreach ($contratos as $con) {
                    
                    $sheet->setCellValue("A".$indice,$con->contrato);
                    $sheet->setCellValue("B".$indice,$con->titularNombre);
                    $sheet->setCellValue("C".$indice,$con->cotitularNombre);
                    $sheet->setCellValue("D".$indice,$con->celular);
                    $sheet->setCellValue("E".$indice,$con->telefono);
                    $sheet->setCellValue("F".$indice,$con->email);
                    $sheet->setCellValue("G".$indice,$con->email2);
                    
                    $indice++;
                }
            }
        }

        ////////////////////////////////////////////////

        if ($request->tipo == 3) {
            $invitados = Cliente::where("tipo","<",3);

            if ($sede) {
                $invitados = $invitados->where("sede",$sede);
            }
            if ($fecha1) {
                $invitados = $invitados->where(function ($query){
                    $query->where("created_at",">=",$fecha1)
                        ->orWhere("fechaCita",">=",$fecha1);
                });
            }
            if ($fecha2) {
                $invitados = $invitados->where(function ($query){
                    $query->where("created_at","<=",$fecha2." 23:59:59")
                        ->orWhere("fechaCita","<=",$fecha2);
                });
            }

            $invitados = $invitados->select(
                DB::raw("CONCAT(nombre,' ',apellido) AS nombre"),
                'created_at',
                'fechaCita',
                'horaCita',
                'acompanante',
                'id',
                'estadoCita',
                'sede',
                'celular',
                'telefono',
                'email',
                'email2',
                'tmk',
                'tipo'
            )->orderBy('created_at','desc')->limit(1700)->get();

            $sheet->getStyle('A1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('B1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('C1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('D1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('E1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('F1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('G1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('H1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('I1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('J1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('K1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('L1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('M1')->applyFromArray($this->borderStyle);

            
            $sheet->setCellValue("A1","Creado en");
            $sheet->setCellValue("B1","Fecha de Cita");
            $sheet->setCellValue("C1","Hora de Cita");
            $sheet->setCellValue("D1","Sede");
            $sheet->setCellValue("E1","Estado");
            $sheet->setCellValue("F1","TMK");
            $sheet->setCellValue("G1","Nombre");
            $sheet->setCellValue("H1","Acompañante");
            $sheet->setCellValue("I1","Celular");
            $sheet->setCellValue("J1","Telefono");
            $sheet->setCellValue("K1","Email");
            $sheet->setCellValue("L1","Email 2");
            $sheet->setCellValue("M1","Contrato");

            if ($invitados) {
                foreach ($invitados as $con) {
                    $acompanante = Cliente::find($con->acompanante);
                    $contrato = Contrato::where('titular',$con->id)
                                        ->orWhere('cotitular',$con->id)
                                        ->first();

                    $sheet->setCellValue("A".$indice,$con->created_at);
                    $sheet->setCellValue("B".$indice,$con->fechaCita);
                    $sheet->setCellValue("C".$indice,$con->horaCita);
                    $sheet->setCellValue("D".$indice,$con->sede);
                    $sheet->setCellValue("E".$indice,$con->estadoCita);
                    $sheet->setCellValue("F".$indice,$con->tmk);
                    $sheet->setCellValue("G".$indice,$con->nombre);
                    $sheet->setCellValue("H".$indice,@$acompanante->nombre.' '.@$acompanante->apellido);
                    $sheet->setCellValue("I".$indice,$con->celular);
                    $sheet->setCellValue("J".$indice,$con->telefono);
                    $sheet->setCellValue("K".$indice,$con->email);
                    $sheet->setCellValue("L".$indice,$con->email2);
                    $sheet->setCellValue("M".$indice,@$contrato->sede.@$contrato->consecutivo);
                    
                    $indice++;
                }
            }
        }

        ////////////////////////////////////////////////

        if ($request->tipo == 4) {
            $contratos = Contrato::join("participantes","participantes.cliente_id","=","contratos.titular")
                                ->join("cargos","cargos.id","=","participantes.cargo_id")
                                ->join("empleados","empleados.id","=","participantes.empleado_id")
                                ->where("contratos.id",">",0);

            if ($sede) {
                $contratos = $contratos->where("contratos.sede",$sede);
            }
            if ($fecha1) {
                $contratos = $contratos->where("contratos.created_at",">=",$fecha1);
            }
            if ($fecha2) {
                $contratos = $contratos->where("contratos.created_at","<=",$fecha2." 23:59:59");
            }
            if ($cargo) {
                $contratos = $contratos->where("participantes.cargo_id",$cargo);
            }
            if ($empleado) {
                $contratos = $contratos->where("participantes.empleado_id",$empleado);
            }

            $contratos = $contratos->select(
                                        DB::raw("CONCAT(contratos.sede,contratos.consecutivo) AS contrato"),
                                        DB::raw("CONCAT(empleados.nombre,' ',empleados.apellido) AS empleado"),
                                        "contratos.titularNombre",
                                        "contratos.cotitularNombre",
                                        "empleados.cedula",
                                        "empleados.pasaporte",
                                        "cargos.nombre AS cargo",
                                        "contratos.anosOtorgados",
                                        'contratos.estadoContrato',
                                        'contratos.anosPactados',
                                        'contratos.valorContrato',
                                        'contratos.pagoInicial',
                                        'contratos.created_at',
                                        'contratos.estadoServicio'
                                    )
                                    ->orderBy('contratos.created_at','desc')->get();

            $sheet->getStyle('A1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('B1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('C1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('D1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('E1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('F1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('G1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('H1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('I1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('J1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('K1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('L1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('M1')->applyFromArray($this->borderStyle);

            
            $sheet->setCellValue("A1","Cargo");
            $sheet->setCellValue("B1","Empleado");
            $sheet->setCellValue("C1","Cedula / Pasaporte");
            $sheet->setCellValue("D1","Contrato");
            $sheet->setCellValue("E1","A. Otorgados");
            $sheet->setCellValue("F1","A. Pactados");
            $sheet->setCellValue("G1","Valor Total");
            $sheet->setCellValue("H1","Pago Inicial");
            $sheet->setCellValue("I1","Est. Contrato");
            $sheet->setCellValue("J1","Est. Servicio");
            $sheet->setCellValue("K1","Fecha de Creacion");
            $sheet->setCellValue("L1","Titular");
            $sheet->setCellValue("M1","Cotitular");

            if ($contratos) {
                foreach ($contratos as $con) {
                    $estado = "";

                    if ($con->estadoServicio == 0) {
                        $estado = "ACTIVO";
                    }else if ($con->estadoServicio == 1) {
                        $estado = "INACTIVO";
                    }else if ($con->estadoServicio == 2) {
                        $estado = "ANULADO";
                    }else if ($con->estadoServicio == 3) {
                        $estado = "ANULADO CM";
                    }else if ($con->estadoServicio == 4) {
                        $estado = "ANULADO ED";
                    }

                    $sheet->setCellValue("A".$indice,$con->cargo);
                    $sheet->setCellValue("B".$indice,$con->empleado);
                    $sheet->setCellValue("C".$indice,$con->cedula.' / '.$con->pasaporte);
                    $sheet->setCellValue("D".$indice,$con->contrato);
                    $sheet->setCellValue("E".$indice,$con->anosOtorgados);
                    $sheet->setCellValue("F".$indice,$con->anosPactados);
                    $sheet->setCellValue("G".$indice,$con->valorContrato);
                    $sheet->setCellValue("H".$indice,$con->pagoInicial);
                    $sheet->setCellValue("I".$indice,$con->estadoContrato);
                    $sheet->setCellValue("J".$indice,$estado);
                    $sheet->setCellValue("K".$indice,$con->created_at);
                    $sheet->setCellValue("L".$indice,$con->titularNombre);
                    $sheet->setCellValue("M".$indice,$con->cotitularNombre);
                    
                    $indice++;
                }
            }
        }

        ////////////////////////////////////////////////

        if ($request->tipo == 5) {
            $empleados = Cargo::join("empleado_cargos","empleado_cargos.cargo_id","=","cargos.id")
                                ->join("empleados","empleados.id","=","empleado_cargos.empleado_id")
                                ->where("cargos.id",">",0);
            if ($fecha1) {
                $empleados = $empleados->where("empleados.created_at",">=",$fecha1);
            }
            if ($fecha2) {
                $empleados = $empleados->where("empleados.created_at","<=",$fecha2." 23:59:59");
            }

            $empleados = $empleados->select(
                                        "cargos.nombre AS cargo",
                                        "empleados.nombre",
                                        "empleados.apellido",
                                        "empleados.cedula",
                                        "empleados.pasaporte",
                                        "empleados.codigo1",
                                        "empleados.codigo2"
                                    )
                                    ->orderBy('cargos.created_at','desc')->get();

            $sheet->getStyle('A1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('B1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('C1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('D1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('E1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('F1')->applyFromArray($this->borderStyle);
            $sheet->getStyle('G1')->applyFromArray($this->borderStyle);

            
            $sheet->setCellValue("A1","Cargo");
            $sheet->setCellValue("B1","Nombre");
            $sheet->setCellValue("C1","Apellido");
            $sheet->setCellValue("D1","Cedula");
            $sheet->setCellValue("E1","Pasaporte");
            $sheet->setCellValue("F1","Cod. TMK");
            $sheet->setCellValue("G1","Cod. OPC");

            if ($empleados) {
                foreach ($empleados as $con) {
                    
                    $sheet->setCellValue("A".$indice,$con->cargo);
                    $sheet->setCellValue("B".$indice,$con->nombre);
                    $sheet->setCellValue("C".$indice,$con->apellido);
                    $sheet->setCellValue("D".$indice,$con->cedula);
                    $sheet->setCellValue("E".$indice,$con->pasaporte);
                    $sheet->setCellValue("F".$indice,$con->codigo1);
                    $sheet->setCellValue("G".$indice,$con->codigo2);
                    
                    $indice++;
                }
            }
        }

        ////////////////////////////////////////////////
        
        
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

        $writer = new Xlsx($spreadsheet);

        if(file_exists(base_path()."\\public\\documentos\\manifiesto\\informe.xlsx"))
        {
            unlink(base_path()."\\public\\documentos\\manifiesto\\informe.xlsx");
        }
        
        $writer->save("./documentos/manifiesto/informe.xlsx");

        return redirect(url("documentos/manifiesto/informe.xlsx"));
    }
}
