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
        margin-top: 40px;
      }
      .font-size{
          font-size:12px;
      }
  </style>
	<body class="bg-white body">
      {{-- COMIENZA LA HOJA --}}
		<section class="container-fluid mt-7">
            

        <center>
            <img src="{{ asset('images/oneclasslogo.png') }}" height="75">
        </center>
        <center>
            <p class="h6"><b>BONOS Y/O CORTESIAS</b></p>
            <p class="h6"><b>ONE CLASS TRAVEL</b></p>
                <p class="h6"><b>ACLARA:</b></p>
        </center>
        <article class="text-justify font-size">
            <p>
                Que el contrato <b>{{$contrato->sede.$contrato->consecutivo}}</b> a nombre del o la señor (a) <b>{{$contrato->titularNombre}}</b>
                , identificado con 
                @if ($titular->cedula)
                    cedula de identidad número <b>{{$titular->cedula}}</b>,
                @else
                    pasaporte número <b>{{$titular->pasaporte}}</b>,
                @endif                
                domiciliado en la ciudad de <b>{{$titular->ciudad}}</b>, 
                recibe el siguiente certificado de vacaciones, como un beneficio adicional a los servicios contratados en el portafolio <b>ONE CLASS TRAVEL</b>.
            </p>
        </article>
            <center>
                <p>
                    <b>DETALLE</b>
                </p>
            </center>
        <article class="text-justify font-size">
            <p><b>Bonos</b></p>
            <ul style="color:red;">
                @foreach ($bonos as $bono)
                    @if ($bono->cantidad > 0 && $bono->tipo == 0)
                        <li>
                            {{valorEnLetras($bono->cantidad)}} BONO {{$bono->bono}} {{$bono->noches}}
                            NOCHES Y {{$bono->dias}} DIAS DE HOSPEDAJE PARA 
                            {{$bono->personas}} PERSONAS
                        </li>                                        
                    @endif
                @endforeach
            </ul>
            <p>
              <b>Condiciones de uso</b>
            </p>
            <ul>
                <li>CORTESIA O BONO 100% HOSPEDAJE (no incluye alimentos)</li>
                <li>ACOMODACION CUADRUPLE EN HOTELES CONVENIO 2 Y 3 ESTRELLAS</li>
                <li>DERECHOS DE USO. $20 POR PERSONA POR NOCHE</li>
                <li>SOLO TEMPORADA BAJA (aplica otras temporadas sujeto a disponibilidad y a cambio en el valor de derechos de uso.)</li>
                <li>NO ES REDIMIBLE POR DINERO</li>
                <li>RESERVAR MINIMO 60 DIAS DE ANTICIPACION</li>
                <li>NO SE PUEDE CEDER NI TRANSFERIR A TERCERAS PERSONAS (a excepción que sea beneficiario)</li>
                <li>SOLO PARA USO DE TITULARES Y BENEFICIARIOS</li>
                <li>LA VIGENCIA RIGE CON LA MISMA DEL CONTRATO</li>
                <li>NO SE PUEDE UTILIZAR CON OTRA CORTESIA O BONO</li>
            </ul>
            
            @foreach ($bonos as $bono)
                @if ($bono->bono == 'SALINAS' && $bono->cantidad > 0)
                    <p>
                        <est class="font">
                            <b>Nota</b><br>
                            Los derechos de uso del Bono hotel playa dorada son $160, incluidos los alimentos y bebidas. <br>Valido por seis meses a partir de la fecha de emisión.
                        </est>
                    </p>                    
                @endif
            @endforeach
            <p>
                Constancia que se expide a petición de la parte interesada, a los {{substr($contrato->created_at,8,2)}}
                días del mes de {{getMes(substr($contrato->created_at,5,2))}} del {{substr($contrato->created_at,0,4)}}.
            </p>
            <br><br><br>
            <table style="border:none; width:100%;">
                <tr>
                    <td>
                        <hr class="hr">
                        <p><b>ONE CLASS TRAVEL</b></p>
                        <p><b>RUC 0915716443</b></p>
                    </td>
                    <td>
                        <hr class="hr">
                        <p><b>
                            {{ $titular->nombre.' '.$titular->apellido }}    
                        </b></p>
                        <p><b>
                            @if ($titular->cedula)
                                CI NO {{$titular->cedula}}
                            @else
                                PASAPORTE {{$titular->pasaporte}}
                            @endif    
                        </b></p>
                    </td>
                </tr>
            </table>
        </article>
    </section>
	</body>
</html>