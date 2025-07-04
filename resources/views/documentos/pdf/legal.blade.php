<?php
function valorEnLetras($x)
{
if ($x<0) { $signo = "menos ";}
else      { $signo = "";}
$x = abs ($x);
$C1 = $x;

$G6 = floor($x/(1000000));  // 7 y mas

$E7 = floor($x/(100000));
$G7 = $E7-$G6*10;   // 6

$E8 = floor($x/1000);
$G8 = $E8-$E7*100;   // 5 y 4

$E9 = floor($x/100);
$G9 = $E9-$E8*10;  //  3

$E10 = floor($x);
$G10 = $E10-$E9*100;  // 2 y 1


$G11 = round(($x-$E10)*100,0);  // Decimales
//////////////////////

$H6 = unidades($G6);

if($G7==1 AND $G8==0) { $H7 = "Cien "; }
else {    $H7 = decenas($G7); }

$H8 = unidades($G8);

if($G9==1 AND $G10==0) { $H9 = "Cien "; }
else {    $H9 = decenas($G9); }

$H10 = unidades($G10);

if($G11 < 10) { $H11 = "0".$G11; }
else { $H11 = $G11; }

/////////////////////////////
    if($G6==0) { $I6=" "; }
elseif($G6==1) { $I6="Millón "; }
         else { $I6="Millones "; }

if ($G8==0 AND $G7==0) { $I8=" "; }
         else { $I8="Mil "; }

$I10 = "Pesos ";
$I11 = "/100 M.N. ";

$C3 = @$H6.@$I6.@$H7.@$I7.@$H8.@$I8.@$H9.@$I9.@$H10;

return $C3; //Retornar el resultado

}

function unidades($u)
{
    if ($u==0)  {$ru = " ";}
elseif ($u==1)  {$ru = "Un ";}
elseif ($u==2)  {$ru = "Dos ";}
elseif ($u==3)  {$ru = "Tres ";}
elseif ($u==4)  {$ru = "Cuatro ";}
elseif ($u==5)  {$ru = "Cinco ";}
elseif ($u==6)  {$ru = "Seis ";}
elseif ($u==7)  {$ru = "Siete ";}
elseif ($u==8)  {$ru = "Ocho ";}
elseif ($u==9)  {$ru = "Nueve ";}
elseif ($u==10) {$ru = "Diez ";}

elseif ($u==11) {$ru = "Once ";}
elseif ($u==12) {$ru = "Doce ";}
elseif ($u==13) {$ru = "Trece ";}
elseif ($u==14) {$ru = "Catorce ";}
elseif ($u==15) {$ru = "Quince ";}
elseif ($u==16) {$ru = "Dieciseis ";}
elseif ($u==17) {$ru = "Decisiete ";}
elseif ($u==18) {$ru = "Dieciocho ";}
elseif ($u==19) {$ru = "Diecinueve ";}
elseif ($u==20) {$ru = "Veinte ";}

elseif ($u==21) {$ru = "Veintiun ";}
elseif ($u==22) {$ru = "Veintidos ";}
elseif ($u==23) {$ru = "Veintitres ";}
elseif ($u==24) {$ru = "Veinticuatro ";}
elseif ($u==25) {$ru = "Veinticinco ";}
elseif ($u==26) {$ru = "Veintiseis ";}
elseif ($u==27) {$ru = "Veintisiente ";}
elseif ($u==28) {$ru = "Veintiocho ";}
elseif ($u==29) {$ru = "Veintinueve ";}
elseif ($u==30) {$ru = "Treinta ";}

elseif ($u==31) {$ru = "Treintayun ";}
elseif ($u==32) {$ru = "Treintaydos ";}
elseif ($u==33) {$ru = "Treintaytres ";}
elseif ($u==34) {$ru = "Treintaycuatro ";}
elseif ($u==35) {$ru = "Treintaycinco ";}
elseif ($u==36) {$ru = "Treintayseis ";}
elseif ($u==37) {$ru = "Treintaysiete ";}
elseif ($u==38) {$ru = "Treintayocho ";}
elseif ($u==39) {$ru = "Treintaynueve ";}
elseif ($u==40) {$ru = "Cuarenta ";}

elseif ($u==41) {$ru = "Cuarentayun ";}
elseif ($u==42) {$ru = "Cuarentaydos ";}
elseif ($u==43) {$ru = "Cuarentaytres ";}
elseif ($u==44) {$ru = "Cuarentaycuatro ";}
elseif ($u==45) {$ru = "Cuarentaycinco ";}
elseif ($u==46) {$ru = "Cuarentayseis ";}
elseif ($u==47) {$ru = "Cuarentaysiete ";}
elseif ($u==48) {$ru = "Cuarentayocho ";}
elseif ($u==49) {$ru = "Cuarentaynueve ";}
elseif ($u==50) {$ru = "Cincuenta ";}

elseif ($u==51) {$ru = "Cincuentayun ";}
elseif ($u==52) {$ru = "Cincuentaydos ";}
elseif ($u==53) {$ru = "Cincuentaytres ";}
elseif ($u==54) {$ru = "Cincuentaycuatro ";}
elseif ($u==55) {$ru = "Cincuentaycinco ";}
elseif ($u==56) {$ru = "Cincuentayseis ";}
elseif ($u==57) {$ru = "Cincuentaysiete ";}
elseif ($u==58) {$ru = "Cincuentayocho ";}
elseif ($u==59) {$ru = "Cincuentaynueve ";}
elseif ($u==60) {$ru = "Sesenta ";}

elseif ($u==61) {$ru = "Sesentayun ";}
elseif ($u==62) {$ru = "Sesentaydos ";}
elseif ($u==63) {$ru = "Sesentaytres ";}
elseif ($u==64) {$ru = "Sesentaycuatro ";}
elseif ($u==65) {$ru = "Sesentaycinco ";}
elseif ($u==66) {$ru = "Sesentayseis ";}
elseif ($u==67) {$ru = "Sesentaysiete ";}
elseif ($u==68) {$ru = "Sesentayocho ";}
elseif ($u==69) {$ru = "Sesentaynueve ";}
elseif ($u==70) {$ru = "Setenta ";}

elseif ($u==71) {$ru = "Setentayun ";}
elseif ($u==72) {$ru = "Setentaydos ";}
elseif ($u==73) {$ru = "Setentaytres ";}
elseif ($u==74) {$ru = "Setentaycuatro ";}
elseif ($u==75) {$ru = "Setentaycinco ";}
elseif ($u==76) {$ru = "Setentayseis ";}
elseif ($u==77) {$ru = "Setentaysiete ";}
elseif ($u==78) {$ru = "Setentayocho ";}
elseif ($u==79) {$ru = "Setentaynueve ";}
elseif ($u==80) {$ru = "Ochenta ";}

elseif ($u==81) {$ru = "Ochentayun ";}
elseif ($u==82) {$ru = "Ochentaydos ";}
elseif ($u==83) {$ru = "Ochentaytres ";}
elseif ($u==84) {$ru = "Ochentaycuatro ";}
elseif ($u==85) {$ru = "Ochentaycinco ";}
elseif ($u==86) {$ru = "Ochentayseis ";}
elseif ($u==87) {$ru = "Ochentaysiete ";}
elseif ($u==88) {$ru = "Ochentayocho ";}
elseif ($u==89) {$ru = "Ochentaynueve ";}
elseif ($u==90) {$ru = "Noventa ";}

elseif ($u==91) {$ru = "Noventayun ";}
elseif ($u==92) {$ru = "Noventaydos ";}
elseif ($u==93) {$ru = "Noventaytres ";}
elseif ($u==94) {$ru = "Noventaycuatro ";}
elseif ($u==95) {$ru = "Noventaycinco ";}
elseif ($u==96) {$ru = "Noventayseis ";}
elseif ($u==97) {$ru = "Noventaysiete ";}
elseif ($u==98) {$ru = "Noventayocho ";}
else            {$ru = "Noventaynueve ";}
return $ru; //Retornar el resultado
}

function decenas($d)
{
    if ($d==0)  {$rd = "";}
elseif ($d==1)  {$rd = "Ciento ";}
elseif ($d==2)  {$rd = "Doscientos ";}
elseif ($d==3)  {$rd = "Trescientos ";}
elseif ($d==4)  {$rd = "Cuatrocientos ";}
elseif ($d==5)  {$rd = "Quinientos ";}
elseif ($d==6)  {$rd = "Seiscientos ";}
elseif ($d==7)  {$rd = "Setecientos ";}
elseif ($d==8)  {$rd = "Ochocientos ";}
else            {$rd = "Novecientos ";}
return $rd; //Retornar el resultado
}

function getMes($id){
		if($id==1){
		 return 'Enero';
		}else if($id==2){
		 return 'Febrero';
		}else if($id==3){
		 return 'Marzo';
		}else if($id==4){
		 return 'Abril';
		}else if($id==5){
		 return 'Mayo';
		}else if($id==6){
		 return 'Junio';
		}else if($id==7){
		 return 'Julio';
		}else if($id==8){
		 return 'Agosto';
		}else if($id==9){
		 return 'Septiembre';
		}else if($id==10){
		 return 'Octubre';
		}else if($id==11){
		 return 'Noviembre';
		}else if($id==12){
		 return 'Diciembre';
		}

		return 'mes';
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Documento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	</head>
  <style>
      .body{
        font-family:Arial, Helvetica, sans-serif;
      }
      .font{
        color: red;
      }
      .font2{
        color: blue;
      }
      .hr{
          width: 300px;
          margin-left: 0px;
          background-color:black;
      }
      .page-break {
            page-break-after: always;
        }
      .header{
            position: fixed;
            display: block;
            width: 100%;
            height: 100px;
            top: 0px;
      }
      .footer{
            position: fixed;
            display: block;
            width: 100%;
            height: 100px;
            bottom: 0px;
      }
      .mt-7{
        margin-top: 110px;
      }
      .font-size{
          font-size:12px;
      }
  </style>
	<body class="bg-white body">

    @if (@$tipo == 1)
      {{-- COMIENZA LA HOJA --}}
    <section class="container-fluid mt-7">
        <center>
            <p class="h6"><b>REEMBOLSO POR SERVICIOS</b></p>
            <p class="h6"><b>ONE CLASS TRAVEL</b></p>
                <p class="h6"><b>ACLARA:</b></p>
        </center>
        <article class="text-justify">
            <p>
                Que el contrato <b>{{ $contrato->sede.$contrato->consecutivo }}</b> a nombre del señor (a) <b>{{ $contrato->titularNombre }}</b>, 
              titular 
              @if (@$titular->cedula)
                  de la cedula de identidad C.I. No. {{ $titular->cedula }}
              @else
                    del pasaporte {{ $titular->pasaporte }}     
              @endif
              
              , tiene un acuerdo de <b>REEMBOLSO POR SERVICIOS</b>, 
              por el valor de ${{ @$devolucion }} <b>({{ valorEnLetras(@$devolucion) }} DOLARES(USD))</b>, 
              por concepto de compra de 
              <est class="font">{{ @$descripcion }}</est>, 
              valor a favor que posee cliente, 
              <est class="font2">
                quedando efectivizado satisfactoriamente el CANJE POR SERVICIO con esta compra, 
                por consiguiente se da por finalizada cualquier relación comercial entre el Cliente  
                y la Compañía One Class Travel.
              </est>
            </p>
            <br><br>
            <p>
              Constancia que se expide a petición de la parte interesa, 
              en {{ @$contrato->ciudadSede }} a los {{ substr(@$hoy,8,2) }} días del mes de {{ getMes(substr(@$hoy,5,2)) }} de {{ substr(@$hoy,0,4) }}.
            </p>
            <br><br>
            <p>
                FIRMA:
            </p>
            <br><br>
            <hr class="hr">
            <p><b>{{ $contrato->titularNombre }}</b></p>
            <p><b>
                @if (@$titular->cedula)
                    C.I. No. {{ $titular->cedula }}
                @else
                    Pasaporte {{ $titular->pasaporte }}     
                @endif
            </b></p>
            <p><b>Quedando un saldo a favor ${{  @$contrato->saldoFavor }} para canje por servicio.</b></p>
        </article>
    </section>
        
    @endif



    @if (@$tipo == 2 || $tipo == 3 || $tipo == 4 || $tipo == 5)
        {{-- COMIENZA LA HOJA --}}
		<section class="container-fluid mt-7">
        <center>
            <p class="h6"><b>
                @if (@$tipo == 2 || $tipo == 3)
                        Canje por servicio 
                        @if ($tipo == 2)
                        con
                        @else
                        sin 
                        @endif
                        penalidad
                @endif
                @if ($tipo == 4)
                    Devolución cero
                @endif
                @if ($tipo == 5)
                    Devolución total
                @endif
            </b></p>
                <p class="h6"><b>ACTA DE TERMINACIÓN POR MUTUO ACUERDO</b></p>
        </center>
        <article class="text-justify font-size">
            <br>
            <p>Conste por el presente documento, un 
                <b>ACTA DE TERMINACIÓN POR MUTUO ACUERDO</b> 
                que se otorga al tenor de las siguientes cláusulas y estipulaciones:
            </p>
            <br>
            <p class="h6"><b>CLÁUSULA PRIMERA: INTERVINIENTES.-</b></p>
            <br>
            <p>Comparecen a celebrar la presente <b>ACTA DE TERMINACIÓN DE MUTUO ACUERDO</b>, las siguientes partes:</p>
            <ul>
                <li>
                    <p><b>1.1</b> La empresa <b>ONE CLASS TRAVEL</b>,  debidamente representada por la señora HAYDITH YANINE RUIZ DITTA , en su calidad de Representante Legal ; y por otra parte,</p>
                </li>
                <li>
                    <p><b>1.2</b> El Señor <b>{{ $contrato->titularNombre }}</b>, 
              con 
              @if (@$titular->cedula)
                  cedula de identidad {{ $titular->cedula }}
              @else
                    pasaporte {{ $titular->pasaporte }}     
              @endif 
                        <br>Los comparecientes podrán ser referidos de forma conjunta como LAS PARTES.
                    </p>
                </li>
            </ul>
            <p class="h6"><b>CLÁUSULA SEGUNDA: ANTECEDENTES.-</b></p>
            <br>
            <p>Comparecen a celebrar la presente <b>ACTA DE TERMINACIÓN DE MUTUO ACUERDO</b>, las siguientes partes:</p>
            <ul>
                <li>
                    <p><b>2.1</b> En la ciudad de {{ @$contrato->ciudadSede }}, el día {{ substr(@$hoy,8,2) }} de {{ getMes(substr(@$hoy,5,2)) }} de {{ substr(@$hoy,0,4) }},
                       <b>LAS PARTES</b> de forma voluntaria suscribieron el Contrato de Afiliación a Prestación de Servicios número <b>{{ @$contrato->sede.@$contrato->consecutivo }}</b>
                        por un plazo de vigencia de {{ @$contrato->anosOtorgados }} años.</p>
                </li>
                <li>
                    <p><b>2.2</b> Es la intención de <b>LAS PARTES</b> finiquitar este contrato de forma anticipada en los siguientes términos por convenir a sus intereses.   
                    </p>
                </li>
            </ul>
            <p class="h6"><b>CLÁUSULA TERCERA: TERMINACIÓN DE MUTUO ACUERDO.-</b></p>
            <br>
            <p>
                Con los antecedentes expuestos, <b>LAS PARTES</b> dan por terminado el contrato descrito en la cláusula previa, otorgando el más amplio, cabal, total y formal finiquito respecto de todas y cada una de las acciones legales que pudieran emanar de esta relación, declarando que nada se adeudan recíprocamente y que nada tienen que reclamar ni en el presente ni el futuro.
            </p>
            <br>
            <p class="h6"><b>CLÁUSULA CUARTA: DEVOLUCIÓN DE VALORES.-</b></p>
            <br>
            <p>
              @if ($tipo == 2)
                El Señor <b>{{ strtoupper($contrato->titularNombre) }}</b>, declara que va a recibir de la compañía 
                <b>ONE CLASS TRAVEL</b>, a su entera satisfacción y como parte del acuerdo alcanzado, un canje por 
                servicio que tendrá vigencia de un año a partir de la fecha
            
                de la firma del presente documento, por la cantidad de 
                {{ valorEnLetras(@$devolucion) }} DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA (USD {{ @$devolucion }}),
                después de haber deducido {{ valorEnLetras(@$retencion) }} DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA (USD {{ @$retencion }}),
                  por concepto de gastos financieros (comisión bancaria) y gestión administrativa.
                <br><br>Todo esto asociado a la adquisición inicial de un contrato de USD {{$contrato->valorContrato}}
                habiendo pactado para pago inicial la cantidad de USD {{$contrato->pagoInicial}}.
            @endif 
            @if ($tipo == 3)
                El Señor <b>{{ strtoupper($contrato->titularNombre) }}</b>, declara a recibir de la compañía 
                <b>ONE CLASS TRAVEL</b>, un canje por servicio equivalente al valor cancelado por la 
                adquisición del portafolio y como parte del acuerdo alcanzado, la cantidad de
                <b>{{ valorEnLetras(@$devolucion) }} DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA (USD {{ @$devolucion }})</b>, 
                monto total del precio pactado en el Contrato de Afiliación a Prestación de Servicios
              @endif
              @if ($tipo == 5)
                  El Señor <b>{{ strtoupper($contrato->titularNombre) }}</b>, declara recibir de 
                  <b>ONE CLASS TRAVEL</b>, a su entera satisfacción y como parte del acuerdo alcanzado, la cantidad de
                  <b>{{ valorEnLetras(@$devolucion) }} DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA (USD {{ @$devolucion }})</b>,
                  monto total del precio cancelado como cuota inicial pactado, en el Contrato de Afiliación a 
                  Prestación de Servicios, después de deducir (valor) por comisión bancaria cobrada por la entidad 
                  bancaria receptora de fondos. 
                @endif
                @if ($tipo == 4)
                    El Señor <b>{{ strtoupper($contrato->titularNombre) }}</b>, declara no recibir de la compañía 
                    <b>ONE CLASS TRAVEL</b>, ninguna compensación económica por cuanto el valor cancelado de
                    <b>{{ valorEnLetras(@$devolucion) }} DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA (USD {{ @$devolucion }})</b>,
                    asumirán el gasto administrativo producto de la anulación de contrato. 
                  @endif
            </p>
            <p class="h6"><b>CLÁUSULA QUINTA: DECLARACIONES ESPECIALES.-</b></p>
            <br>
            <ul>
                <li>
                    <p><b>5.1</b> El Señor <b>{{ strtoupper($contrato->titularNombre) }}</b>, 
                      deja constancia que no tiene demanda, denuncia, reclamo y/o queja alguna que presentar, 
                      ni en el presente ni en el futuro, en contra de la empresa <b>ONE CLASS TRAVEL</b>, ni de 
                      sus empresas relacionadas o subsidiarias, y/o en contra de sus representantes legales, 
                      funcionarios, empleados o personeros, a quienes libera de toda responsabilidad civil, penal o de 
                      cualquier tipo y en contra de quienes no se reserva ninguna acción legal, sea ésta administrativa, 
                      judicial, o de cualquier otra índole.</p>
                </li>
                <li>
                    <p>
                        @if (@$tipo == 2 || $tipo == 3 || $tipo == 4)
                            <b>5.2</b> El Señor <p>{{ strtoupper($contrato->titularNombre) }}</p>,  deja expresa constancia 
                            que la empresa <b>ONE CLASS TRAVEL</b>, sus empresas relacionadas o subsidiarias, y/o sus 
                            representantes legales, funcionarios, empleados o personeros, adecuaron su conducta en todo momento a 
                            los mandatos y exigencias establecidos en la Ley, por lo que declara, no haber sido objeto de ningún 
                            hecho ilegal que la pudiere haber perjudicado.  
                        @else
                            <b>5.2</b>De igual manera, El Señor <p>{{ strtoupper($contrato->titularNombre) }}</p>, 
                            acuerda y declara en este acto, que desiste de cualquier demanda, denuncia, reclamo, 
                            queja, sea judicial, administrativa o de cualquier índole o cualquier materia que haya 
                            iniciado en contra de <b>ONE CLASS TRAVEL</b>, sus empresas relacionadas o subsidiarias, 
                            y/o en contra de sus representantes legales, funcionarios, empleados o personeros, 
                            particularmente y sin limitarse a, reclamaciones, demandas o denuncias que pudieren haber 
                            sido presentadas ante la Defensoría del Pueblo, Fiscalía, Juzgados penales o civiles, 
                            Ministerios, etc. Asimismo se compromete, en el evento en que fuere necesario y requerido 
                            por la autoridad competente, a comparecer ante cualquier entidad judicial o administrativa 
                            donde hubiese presentado su demanda, denuncia, reclamo y/o queja, para reconocer la firma 
                            y rúbrica constante en la presente acta o en los escritos de desistimiento correspondientes.
                        @endif
                    </p>
                </li>
            </ul>
            <p class="h6"><b>CLÁUSULA SEXTA: ARBITRAJE.-</b></p>
            <br>
            <p>En caso de existir controversias o  diferencias derivadas de la interpretación o ejecución de esta acta, 
              que no puedan ser resueltas por mutuo acuerdo, las partes renuncian fuero y domicilio y deciden someterse 
              a decisión del Tribunal de Arbitraje de la Cámara de Comercio de Guayaquil, que se sujetará a lo dispuesto 
              por la Ley de Arbitraje y Mediación, el Reglamento del Centro de Arbitraje y Mediación de la Cámara de
               Comercio de Guayaquil y cualquier otra reglamentación que se expida sobre el particular, atendiendo las 
               siguientes normas:</p>
            <ul>
                <li>
                    <p><b>6.1</b> El Tribunal de Arbitraje estará integrado por tres árbitros, que serán seleccionados 
                      conforme lo establecido en la Ley de Arbitraje y Mediación;</p>
                </li>
                <li>
                    <p><b>6.2</b> El proceso arbitral será administrado, en derecho y confidencial.
                    </p>
                </li>
                <li>
                    <p><b>6.3</b> El Tribunal de Arbitraje estará facultado para dictar medidas cautelares, solicitando 
                      el  auxilio de funcionarios públicos, judiciales, policiales y administrativos, sin que sea 
                      necesario acudir a un juez ordinario alguno para tales efectos;
                    </p>
                </li> 
            </ul>
        </article>
    </section>
    <div class="page-break"></div>
    <section class="container-fluid mt-7">
        <article class="text-justify font-size">
            <ul>
                <li>
                    <p><b>6.4</b> El procedimiento arbitral tendrá lugar en las instalaciones del Centro de Arbitraje y 
                      Mediación de la Cámara de Comercio de Guayaquil;
                    </p>
                </li>
            </ul>
            <p>
                Las partes renuncian a la jurisdicción ordinaria, se obligan a acatar el laudo arbitral y se comprometen 
                a no interponer ningún tipo de recurso en contra del laudo arbitral.  El laudo arbitral será inapelable.  
                La reconvención, de existir, se someterá también a lo dispuesto en la presente cláusula y versará 
                únicamente sobre la causa por la cual se interpuso la demanda inicial.
            </p>
            <br>
            <p class="h6"><b>CLÁUSULA SEPTIMA: ACEPTACIÓN.-</b></p>
            <br>
            <p>
                Los comparecientes libre y voluntariamente declaran, que le dan al presente instrumento el 
                <b>carácter de acta transaccional con fuerza de sentencia ejecutoriada de última instancia valedera
                  ante cualquier autoridad y en cualquier instancia</b>, y que se afirman y ratifican en sus
                  declaraciones anteriores y en el texto íntegro de la presente Acta de Terminación de Mutuo 
                  Acuerdo firmándola en unidad de acto en original y dos copias del mismo tenor, contenido y valor, 
                  en la ciudad de 
                  {{ @$contrato->ciudadSede }} el día {{ substr(@$hoy,8,2) }} de {{ getMes(substr(@$hoy,5,2)) }} de {{ substr(@$hoy,0,4) }}.
            
            </p>
            <br><br><br><br><br><br><br>
            <table style="border: none; width:100%;">
                <tr>
                    <td>
                        <p><b>HAYDITH YANINE RUIZ DITTA </b><br>
                        <b>ONE CLASS TRAVEL</b></p>
                    </td>
                    <td>
                        <p><b>{{ strtoupper($contrato->titularNombre) }} </b><br>
                        <b>
                            @if (@$titular->cedula)
                                C.I. No. {{ $titular->cedula }}
                            @else
                                Pasaporte {{ $titular->pasaporte }}     
                            @endif
                        </b></p>
                    </td>
                </tr>
            </table>
        </article>
    </section>
    @endif

	</body>
</html>