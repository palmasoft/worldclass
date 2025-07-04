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
		 return 'enero';
		}else if($id==2){
		 return 'febrero';
		}else if($id==3){
		 return 'marzo';
		}else if($id==4){
		 return 'abril';
		}else if($id==5){
		 return 'mayo';
		}else if($id==6){
		 return 'junio';
		}else if($id==7){
		 return 'julio';
		}else if($id==8){
		 return 'agosto';
		}else if($id==9){
		 return 'septiembre';
		}else if($id==10){
		 return 'octubre';
		}else if($id==11){
		 return 'noviembre';
		}else if($id==12){
		 return 'diciembre';
		}

		return 'mes';
}
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Contrato</title>
  </head>
  <body style="text-align: justify;">
    
    <style>
        .page-break {
            page-break-after: always;
        }

        body {
                margin-top: 1cm;
            }

        header {
                position: fixed;
                top: -60px;
                left: 50px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                text-align: center;
                color: #9E9E9E;
            }

            

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }


        </style>

<header>
        <table style="border-spacing: 0em;">
            <tr>
							@if ($contrato->created_at < '2019-04-05 23:00:00')
								<td  style="text-align: right;"><img class="img-responsive" width="50" height="40" src="{{ asset('images/oneclasslogo.png') }}" alt="Logo" style=" display: block;"></td>									
							@else
								<td  style="text-align: right;"><img class="img-responsive" width="50" height="40" </td>									
							@endif
                <td  style="color: #9E9E9E; position: fixed; top: -10px;left: 30px; right: 0px; text-align: center; width: 640px;">
                    <h5>
                    {{$contrato->one_empresa}} <br>
                    {{$contrato->one_empresa_ruc}} <br>
                    Líneas de Atención
                    </h5>
                </td>
						</tr>
						@php
								$telefonosEm = explode(';',$variables[0]->valor);
								$sucursales = explode(';',$variables[1]->valor);
								$sucursales_t = explode(';',$variables[2]->valor);
								$sucursales_dir = explode(';',$variables[3]->valor);
								$paginasweb = explode(';',$variables[4]->valor);
								$correosEm = explode(';',$variables[5]->valor);
						@endphp
            <tr>
                <td colspan="2" style="color: #9E9E9E;">
                    <div style="position: fixed; top: -10px;left: 30px; right: 0px; text-align: center; width: 640px;">
                        <h5>
													@for ($i = 0; $i < count($sucursales) && $i < count($sucursales_t); $i++)
														{{$sucursales[$i]}} {{$sucursales_t[$i]}} -
													@endfor
													@for ($i = 0; $i < count($paginasweb); $i++)
															{{ $paginasweb[$i] }}
													@endfor
												</h5>
                    </div>
                </td>
            </tr>
        </table>
</header>


<main style="font-size: 11pt;">

    <div style="text-align: center;">
		<h3 style="text-decoration: underline;">
			CONTRATO PARA EL USO DE NOCHES DE ALOJAMIENTO Y PAQUETES 
			TURÍSTICOS CON DESCUENTO

		</h3>
		<div style="text-align: center;">

	        <h3>
			CONTRATO Nº <?php echo strtoupper(@$contrato->sede)."".@$contrato->consecutivo;?>
		    </h3>
	
	    </div>
	
	</div>

<!--	<div style="text-align: center;">

	   	<h3>
			CONTRATO Nº <?php echo strtoupper(@$contrato->sede)."".@$contrato->consecutivo;?>
		</h3>
	
	</div>-->

	<div style="text-align: justify;">
		Conste por el presente documento, un contrato para la asignación de uso y beneficios de descuentos que se otorga al tenor de las siguientes cláusulas:
	
	</div>
<br>
	<div style="text-align: justify;">
		<strong>CLÁUSULA PRIMERA. - COMPARECIENTES: </strong>Comparecen a la celebración del presente contrato, por una parte:
		
	</div>
<br>
	<div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td style="vertical-align: top;">
					<strong style=" margin-right: 0px;">1.1</strong>

        <?php if ($contrato->created_at < '2018-07-31'): ?>
          <td>
            La compañía<strong>WORLDCLASS ECUADOR S.A.</strong>,con Registro Único de Contribuyentes número RUC <strong>0993007080001</strong>, representada legalmente por la señora <strong>ABRIL ANDREYNA MOLINA CARRERO</strong>, mayor de edad, de estado civil soltero, con cedula de ciudadanía número <strong>096237579-6</strong>, domiciliado en la ciudad de Guayaquil, parte que en adelante y para efectos del presente contrato, se podrá denominar <strong>“EL CONTRATISTA”.</strong>
          </td>
        <?php else: ?>

          <td>
          	<strong>{{$contrato->one_representante}}</strong>, 
			mayor de edad, de estado civil soltero, con cédula de identidad número<strong{{$contrato->one_representante_cedula}}</strong>, domiciliado en la ciudad de {{$contrato->one_representante_ciudad}}, parte que en adelante y para efectos del presente contrato, se podrá denominar <strong>“EL CONTRATISTA”.</strong>
          </td>
        <?php endif; ?>

			</tr>
		</table>
		
	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td style="vertical-align: top;" >
				    
			    
					<strong style=" margin-right: 0px;">1.2</strong>
				<td>

					<strong><?php echo strtoupper(@$titular->nombre." ".@$titular->apellido); ?>,</strong> mayor de edad,
					<?php if (@$titular->cedula){ ?> con cédula de identidad número <?php }else{ ?>con pasaporte número
					<?php } ?><strong><?php
					    if(@$titular->cedula){
						 	echo @$titular->cedula;
						}else{
							echo @$titular->pasaporte;
						}
                    ?></strong>, domiciliado en la ciudad de <strong><?php echo strtoupper(@$titular->ciudad);?></strong>, a quien en lo sucesivo podrá denominarse también <strong>“EL CLIENTE"</strong>.
				</td>
				</td>
			</tr>
		</table>
		
	</div>
<br>
	<div style="text-align: justify; ">
		Los comparecientes son capaces legalmente para contratar y obligarse, quienes, de mutuo y común acuerdo, por sus propios derechos, convienen en suscribir el presente contrato.
	
	</div>
<br>
	<div style="text-align: justify;">
		<h3>
			CLÁUSULA SEGUNDA: GLOSARIO DE TÉRMINOS. -
			
		</h3>
		
	</div>	

	<div style="text-align: justify; ">
		En este instrumento y en todos sus anexos o documentos complementarios, las palabras y expresiones que se definen en esta cláusula,
		 tienen el significado que a cada una de ellas se les da a continuación.
	
	</div>
	<br>
	<div style="text-align: justify; ">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">2.1</strong>
					
				</td>

				<td>

				<strong>CONTRATO:</strong> Es el documento escrito, Contrato para la Adquisición de Noches de Alojamiento y Paquetes Turísticos con Descuento.	
				</td>		
			</tr>
		</table>

	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 15px;">2.2</strong>
				</td>


        <?php if ($contrato->created_at < '2018-07-31'): ?>
          <td>
            <strong>CONTRATISTA: WORLDCLASS ECUADOR S.A </strong>,sociedad anónima legalmente constituida bajo las Leyes de la República del Ecuador y debidamente registrada ante el Ministerio de Turismo como Agencia de Viajes/Operadora Turística nacional e internacional. En tal virtud, está autorizada a ejercer, entre otras actividades relacionadas, el diseño, organización, promoción y comercialización de servicios turísticos, tales como planificación y organización de paquetes de servicios de viajes, la mediación en reserva de plazas, venta de boletos aéreos, adquisición y venta de alojamiento. En este caso, es el comercializador del <strong>PORTAFOLIO GOLDEN NIGHT</strong> que adquiere <strong>EL CLIENTE </strong>en virtud del presente contrato.
          </td>

        <?php else: ?>
          <td>
            <strong>CONTRATISTA: {{$contrato->one_empresa}}</strong> sociedad anónima legalmente constituida bajo las Leyes de la República del Ecuador y debidamente registrada ante el Ministerio de Turismo como Agencia de Viajes/Operadora Turística nacional e internacional. En tal virtud, está autorizada a ejercer, entre otras actividades relacionadas, el diseño, organización, promoción y comercialización de servicios turísticos, tales como planificación y organización de paquetes de servicios de viajes, la mediación en reserva de plazas, venta de boletos aéreos, adquisición y venta de alojamiento. En este caso, es el comercializador del <strong>PORTAFOLIO GOLDEN NIGHT</strong> que adquiere <strong>EL CLIENTE </strong>en virtud del presente contrato.
          </td>
        <?php endif; ?>
			</tr>
		</table>
		
	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">2.3</strong>
				</td>
				<td>
					<strong>PARTE O PARTES:</strong> Significa las personas naturales y/o jurídicas firmantes, según sean individual o colectivamente referidas.
				</td>
			</tr>
		</table>
		
	</div>


    <div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 5px;">2.4</strong>
				</td>

				<td>
					<strong>PORTAFOLIO GOLDEN NIGHT:</strong> Conjunto de los servicios de paquetes turísticos y beneficios de descuentos que adquiere <strong>EL CLIENTE</strong> en virtud del presente contrato, detallado en el <strong> ANEXO 2.</strong>
				</td>
			</tr>
		</table>
		
		<div style="margin-left: 20px;text-align: justify;">	
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td style="vertical-align: top;">
					<strong style="margin-right: 5px;">2.4.1</strong>
				</td>

				<td>
					Como beneficio adicional de cortesía por la adquisición del <strong>PORTAFOLIO GOLDEN NIGHT, EL CLIENTE </strong> se hace acreedor a una cantidad de noches de alojamiento para el uso en hoteles de categoría hasta tres estrellas en convenio, en Ecuador.
				</td>
			</tr>

		</table>


	</div>
		


    <div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 10px;">2.5</strong>
				</td>

				<td>
				<strong>CHEQUERA GOLDEN NIGHT:</strong> Talonario de cheques que constituyen el instrumento de canje de los paquetes de noches de alojamiento recibidas por <strong>EL CLIENTE</strong> en el  <strong>PORTAFOLIO GOLDEN NIGHT.</strong> En este talonario se detalla la cantidad de noches de alojamiento recibidas y las condiciones de uso de éstas.
 
				</td>
			</tr>
		</table>
		
	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">2.6</strong>
				</td>

				<td>
					<strong>ANEXOS:</strong> Documentos que forman parte integrante del <strong>CONTRATO</strong> y que <strong>EL CLIENTE</strong> declara conocer y aceptar a cabalidad.
				</td>
			</tr>
		</table>
		
	</div>

    <div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 10px;">2.7</strong>
				</td>

				<td>
					<strong>ANEXO 1:</strong> Documento titulado FORMAS Y CONDICIONES DE USO DE LAS NOCHES DE ALOJAMIENTO RECIBIDAS Y BENEFICIOS DE DESCUENTOS EN SERVICIOS TURÍSTICOS INCLUIDOS EN EL PORTAFOLIO GOLDEN NIGHT. Este documento forma parte integrante del <strong>CONTRATO</strong> y <strong>EL CLIENTE </strong>declara conocerlo y aceptarlo a cabalidad.
				</td>
			</tr>
		</table>
		
	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 10px;">2.8</strong>
				</td>

				<td>
					<strong>ANEXO 2:</strong> Documento titulado BENEFICIOS Y BENEFICIARIOS, donde se detallan los servicios turísticos y porcentajes de descuentos, así como la cantidad de beneficiarios y la cantidad de noches recibidas como beneficio adicional de cortesía. Este documento forma parte integrante del <strong>CONTRATO</strong> y <strong>EL CLIENTE</strong> declara conocerlo y aceptarlo a cabalidad.
				</td>
			</tr>
		</table>

	</div>
	<br>

	<div style="text-align: justify;">
		<h3>
			CLÁUSULA TERCERA: OBJETO. -
		</h3>
	</div>

	<div style="text-align: justify;">
		<strong>EL CLIENTE,</strong> habiendo sido completa y oportunamente instruido sobre las condiciones de este instrumento, adquiere, por convenir a sus intereses, el <strong>PORTAFOLIO GOLDEN NIGHT,</strong> el cual incluye los servicios y beneficios descritos en el <strong>ANEXO 2</strong>. Por su parte,<strong> EL CONTRATISTA</strong> se compromete a proporcionar tales servicios y beneficios según las condiciones estipuladas en este instrumento y sus <strong>ANEXOS.</strong>
		
	
	</div>	
	<br>
	<div style="text-align: justify;center;">
		<h3>
			CLÁUSULA CUARTA: PLAZO DE VIGENCIA Y RENOVACIÓN. -
		</h3>
		
	</div>

	<div style="text-align: justify; ">
		El presente contrato tendrá un plazo de vigencia de <strong><?php echo strtoupper(valorEnLetras(@$contrato->anosOtorgados)); ?>
		<?php if (@$contrato->anosOtorgados > 1) {
			echo " AÑOS";
		}else{
			echo " AÑO";
		} ?> (<?php echo @$contrato->anosOtorgados; ?>)</strong> contados a partir de su suscripción.
		No obstante que el plazo de vigencia del <strong>CONTRATO</strong> comenzará a discurrir desde su suscripción, <strong>El CLIENTE</strong> declara conocer que no podrá hacer uso del <strong>PORTAFOLIO GOLDEN NIGHT</strong> hasta haber cancelado el valor total descrito en la cláusula quinta. Este contrato podrá ser renovado en términos similares, si así lo convinieren las partes hasta <strong>NOVENTA (90)</strong> días antes del vencimiento del plazo indicado previamente. Una vez fenecido el plazo de vigencia y de no existir un acuerdo de renovación según lo establecido en esta cláusula, el contrato se entenderá terminado.
		<br>
		<strong>EL CLIENTE,</strong> reconoce y acepta cumplir de forma obligatoria con <strong>EL CONTRATO</strong> por el plazo previsto en esta cláusula, sin posibilidad de retractarse o de solicitar la devolución de valores entregados.
		
	</div>
	<br>

	<div style="text-align: justify;">
		<h3>
			CLÁUSULA QUINTA: PRECIO Y FORMA DE PAGO. -
		</h3>
		
	</div>

	<div style="text-align: justify;">
		<strong>EL CLIENTE</strong> pagará a <strong>EL CONTRATISTA</strong> por el <strong>PORTAFOLIO GOLDEN NIGHT</strong> descrito en este instrumento, la cantidad de 
		<strong><?php echo strtoupper(valorEnLetras($contrato->valorContrato)); ?> DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA
			 (USD <?php echo @$contrato->valorContrato ?>),</strong> pagaderos de la siguiente manera:
		
	</div>
<br>

<div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">5.1</strong>
				</td>

				<td>
					El valor pactado de <strong><?php echo strtoupper(valorEnLetras($contrato->cuotaInicial)); ?>
						DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA (USD <?php echo @$contrato->cuotaInicial; ?>),</strong> que <strong>EL CONTRATISTA</strong> declara recibir a entera satisfacción a la suscripción de este instrumento.
				</td>
			</tr>
		</table>
	
	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">5.2</strong>
				</td>

				<td>
					El valor pagado a la fecha es, la cantidad de<strong>
					<?php echo strtoupper(valorEnLetras($contrato->pagoInicial)); if ($contrato->pagoInicial <=0.01) {
              echo "CERO";
            }?> DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA (USD <?php echo @$contrato->pagoInicial ?>),</strong>
					 que <strong>EL CONTRATISTA </strong> declara recibir a entera satisfacción a la suscripción de este instrumento.
				</td>
			</tr>
		</table>
    
	</div>
    
	<?php if((@$contrato->saldoFinanciado > 0) && (@$contrato->saldoInicial > 0)){ ?>
			<div style="text-align: justify;center; font-size: 12px;">
		        <table style="text-align: justify;">
		        	<tr style="vertical-align: top;">
				        <td >
							<strong style="margin-right: 0px;">5.3</strong>
						</td>

						<td>
							El saldo de la cuota inicial pactada es la cantidad de<strong>
	                        <?php echo strtoupper(valorEnLetras($contrato->saldoInicial)); ?> DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA
								(USD <?php echo @$contrato->saldoInicial; ?>), </strong>
							 mediante <strong><?php echo @$contrato->numeroCuotasIniciales; ?></strong>
							 dividendos mensuales a ser pagados a partir del día
							 <?php
							 		$date = substr($contrato->fechaPagoInicial,0,10);
									$fecha_det= explode('-', $date);
									echo @$fecha_det[2];
									echo " del ".getMes(@$fecha_det[1]);
									echo " del año ".@$fecha_det[0].".";
							  ?>
						</td>
					</tr>
				</table>
				
			</div>
        
			<div style="text-align: justify;">
		        <table style="text-align: justify;">
			        <tr style="vertical-align: top;">
    			        	<td >
    							<strong style="margin-right: 0px;">5.4</strong>
						</td>

						<td>
							El saldo del valor total por los servicios contratados descritos en la cláusula tercera de este instrumento, es la cantidad de <strong>
								<?php echo strtoupper(valorEnLetras($contrato->saldoFinanciado)); ?> DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA
								(USD <?php echo @$contrato->saldoFinanciado; ?>), </strong>
							 mediante <strong><?php echo @$contrato->numeroCuotasFinanciado; ?></strong>
							 dividendos mensuales a ser pagados a partir del día
							 <?php
                                    $date = substr($contrato->fechaPagoFinanciado,0,10);
									$fecha_det= explode('-', $date);
									echo @$fecha_det[2];
									echo " del ".getMes(@$fecha_det[1]);
									echo " del año ".@$fecha_det[0].".";
							  ?>
						</td>
					</tr>
				</table>
			</div>
			
		<?php }elseif(@$contrato->saldoInicial > 0){ ?>
		
			     <div style="text-align: justify;">
	               	<table style="text-align: justify;">
			                <tr style="vertical-align: top;">
				        <td >
							<strong style="margin-right: 0px;">5.3</strong>
						</td>

						<td>
							El saldo de la cuota inicial pactada es la cantidad de<strong>
								<?php echo strtoupper(valorEnLetras($contrato->saldoInicial)); ?> DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA
								(USD <?php echo @$contrato->saldoInicial; ?>), </strong>
							 mediante <strong><?php echo @$contrato->numeroCuotasIniciales; ?></strong>
							 dividendos mensuales a ser pagados a partir del día
							 <?php
							 		$date = substr($contrato->fechaPagoInicial,0,10);
									$fecha_det= explode('-', $date);
									echo @$fecha_det[2];
									echo " del ".getMes(@$fecha_det[1]);
									echo " del año ".@$fecha_det[0].".";
							  ?>
						</td>
					</tr>
				</table>
				
			</div>
		
		<?php }elseif(@$contrato->saldoFinanciado > 0){ ?>
		    <div style="text-align: justify;">
		        <table style="text-align: justify;">
		        	<tr style="vertical-align: top;">
			        	<td >
							<strong style="margin-right: 0px;">5.3</strong>
						</td>

						<td>
							El saldo del valor total por los servicios contratados descritos en la cláusula tercera de este instrumento, es la cantidad de <strong>
								<?php echo strtoupper(valorEnLetras($contrato->saldoFinanciado)); ?> DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA
								(USD <?php echo @$contrato->saldoFinanciado; ?>), </strong>
							 mediante <strong><?php echo @$contrato->numeroCuotasFinanciado; ?></strong>
							 dividendos mensuales a ser pagados a partir del día
							 <?php
							 		$date = substr($contrato->fechaPagoFinanciado,0,10);
									$fecha_det= explode('-', $date);
									echo @$fecha_det[2];
									echo " del ".getMes(@$fecha_det[1]);
									echo " del año ".@$fecha_det[0].".";
							  ?>
						</td>
					</tr>
				</table>
			</div>
		
		<?php }else{?><?php } ?>
	
	<br><br><br><br>
	<div style="text-align: justify;center; ">
		<h3>
			CLÁUSULA SEXTA: FORMAS Y CONDICIONES DE USO:- 
		</h3>
	
	</div>

	<div style="text-align: justify;center; ">
		<strong>SOBRE TEMPORADAS VACACIONALES Y CALENDARIOS DE AÑOS TURÍSTICOS </strong>

	</div>
	<br>
	<div style="text-align: justify; ">
		<table style="text-align: justify;">
			<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">6.1</strong>
				</td>

				<td>
					Para efectos del <strong>PORTAFOLIO GOLDEN NIGHT</strong>, el año se califica en tres temporadas: alta, media y baja, tal como se establece en los calendarios vacacionales. 
				</td>
			</tr>
		</table>
	
	</div>
	
	<div style="text-align: justify;">
		 <table style="text-align: justify;">
		    <tr style="vertical-align: top;">
			    <td >
					<strong style="margin-right: 0px;">6.2</strong>
				</td>

				<td>
					Para una reserva en temporada alta el número de noches a descontar por alojamiento hotelero será igual sin diferenciar si se trata de una noche entre semana o si se trata de una noche en fin de semana.
				</td>
			</tr>
		</table>
	</div>

    <div style="text-align: justify;">
		<table style="text-align: justify;">
		    <tr style="vertical-align: top;">
			 	<td >
					<strong style="margin-right: -5px;">6.3</strong>
				</td>

				<td>
					Los puentes festivos en el lugar de destino serán considerados como temporada alta contemplado las noches entre semana o fin de semana.
				</td>
			</tr>
		</table>
	
	</div>

	<div style="text-align: justify; ">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
			 	<td >
					<strong style="margin-right: 0px;">6.4</strong>
				</td>
					 
				<!--modificaciones jesus diaz-->
				@if ($contrato->created_at < '2019-05-16 10:00:00')
					<td>
						Para todos los efectos una reserva corresponde a “fin de semana” cuando comprometa las noches viernes y sábado y la noche que anteceda un día festivo en el lugar de destino. Las noches restantes domingo, lunes, martes, miércoles y jueves corresponden al concepto “entre semana”.
					</td>						
				@else
						<td>
							Para todos los efectos una reserva corresponde a “fin de semana” cuando comprometa las noches viernes y sábado y la noche que anteceda un día festivo en el lugar de destino. Las noches restantes domingo, lunes, martes, miércoles y jueves corresponden al concepto “entre semana”.
						</td>
				@endif
		</table>
		
	</div>
	<br>
	<div style="text-align: justify;">
		<strong>FORMAS DE USO DE NOCHE DE ALOJAMIENTO </strong>

	</div>
    <br>
	<div style="text-align: justify;">
		<table style="text-align: justify;">
		    <tr style="vertical-align: top;">
			 	<td >
					<strong style="margin-right: 0px;">6.5</strong>
				</td>

				<td>
					<strong>EL CLIENTE,</strong> durante la vigencia del presente contrato, podrá canjear o adquirir, por semanas completas o en forma fraccionada las noches de alojamiento contratadas a través del <strong>PORTAFOLIO GOLDEN NIGHT,</strong>siempre que haya pagado la totalidad de los valores contemplados en <strong>EL CONTRATO</strong> y cumplido con todas las condiciones determinadas en dicho documento y sus <strong>ANEXOS.</strong>
				</td>
			</tr>
		</table>
		
	</div>
<br>
	<div style="text-align: justify;">
		<h3>
			CLÁUSULA SÉPTIMA: OBLIGACIONES DE EL CONTRATISTA. -
		</h3>
	</div>
   
	<div style="text-align: justify;">
		Durante la vigencia de <strong>EL CONTRATO, EL CONTRATISTA</strong> se obliga a:
	</div>
<br>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">7.1</strong>
				</td>

				<td>
					Garantizar y proporcionar al <strong>CLIENTE</strong> los servicios y beneficios incluidos en el <strong>PORTAFOLIO GOLDEN NIGHT,</strong> siempre que <strong>EL CLIENTE</strong> cumpla con los términos descritos en este instrumento y sus <strong>ANEXOS.</strong>
				</td>
			</tr>
		</table>
	
	</div>
    <div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >

					<strong style="margin-right: 5px;">7.2</strong>
				</td>

				    <td>
			    	    Brindar a <strong>EL CLIENTE</strong> cuando fuere expresamente requerida, información turística actualizada.
				</td>
			</tr>
		</table>
		
	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">7.3</strong>
				</td>

				<td>

					Proporcionar a <strong>EL CLIENTE,</strong> la información necesaria de los medios virtuales de contacto y comunicación tales como página web, correo electrónico, usuario y clave de acceso al sistema informático de ser el caso.
					<!-- modificaciones jesus diaz <strong>Respecto a los beneficiarios.</strong> - El CLIENTE podrá designar -al hacer uso por primera vez del PORTAFOLIO ONE CLASS- a
					 un número máximo de personas que tendrán derecho a las mismas rebajas y beneficios contemplados en el ANEXO 2. EL CONTRATISTA reconoce al CLIENTE la posibilidad
					 de alternar o cambiar uno o más de los beneficiarios designados inicialmente hasta por UNA (1) ocasión al año, pero en ningún caso podrá incluir o agregar más
					 beneficiarios a los determinados en el ANEXO 2. Para que los beneficiarios designados puedan hacer uso del PORTAFOLIO ONE CLASS, EL CONTRATISTA deberá ser
					 informado de la designación o cambio con al menos CUARENTA Y OCHO (48) hora de anticipación a la reserva solicitada.<br><br><div style="color: #9E9E9E;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>-->
				</td>
			</tr>
		</table>

	</div>

	<!-- modificaciones jesus diaz 19/11/2019-->
	<!--<div style="margin-left: 50px;margin-right:50px;text-align: justify;">
		<table style="width:100%;">
			<tr>
				<td style="vertical-align: top;">
					<strong style="margin-right: 20px;">7.4</strong>
				</td>

				<td>
					<strong>Sobre la garantía de mejor precio.</strong> - Si EL CLIENTE encontrase una mejor oferta a nivel de precios en el mercado local o nacional,
					 será la obligación de EL CONTRATISTA garantizar al CLIENTE que él PROVEEDOR.,
					 mejorará dicha oferta siempre y solo si, se cumplan con los siguientes parámetros y condiciones:
				</td>
			</tr>
		</table>
		<br>
	</div>

	<div style="margin-left: 50px;text-align: justify;">
		<table>
			<tr>
				<td style="vertical-align: top;">
					<strong style="margin-right: 20px;">7.5</strong>
				</td>

				<td>
					Previo a acudir a un tercero u agencia de viajes, EL CLIENTE deberá solicitar una cotización al PROVEEDOR.
				</td>
			</tr>
		</table>
	</div><br>

	<div style="margin-left: 50px;text-align: justify;">
		<table>
			<tr>
				<td style="vertical-align: top;">
					<strong style="margin-right: 20px;">7.6</strong>
				</td>

				<td>
					En el evento en que EL CLIENTE no se encuentre conforme con la tarifa ofertada por él PROVEEDOR., éste podrá requerir a un tercero u agencia de viajes,
					 una cotización idéntica, que oferte el mismo servicio con las condiciones y parámetros exactos a los ofertados por el PROVEEDOR: para las mismas fechas de uso, vuelos,
					 horas de partida y arribo, escalas, y/o aerolíneas. Las mismas condiciones aplicarán para cualquier otro servicio ofertado.
				</td>
			</tr>
		</table>
	</div>


	<div style="margin-left: 50px;text-align: justify;">
		<table>
			<tr>
				<td style="vertical-align: top;">
					<strong style="margin-right: 20px;">7.7</strong>
				</td>

				<td>
					Presentar original de una cotización vigente y con disponibilidad debidamente membretada, firmada y sellada por el tercer proveedor o agencia de viajes.
				</td>
			</tr>
		</table>
		<br><br>
	</div>-->
<br>
	<div style="text-align: justify;">
		<h3>
			CLÁUSULA OCTAVA: DERECHOS Y OBLIGACIONES DEL CLIENTE. -
		</h3>
	</div>


	<div style="text-align: justify;">
		Durante la vigencia del <strong>CONTRATO, EL CLIENTE</strong> se obliga a: 
		
	</div>
   <br>
	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">8.1</strong>
				</td>

				<td>
					<strong>RESPECTO A LOS PAGOS.</strong> - Pagar en las fechas previstas los dividendos que componen el saldo del precio pactado según lo previsto en la <strong>CLÁUSULA QUINTA</strong> del presente instrumento.
				</td>
			</tr>
		</table>

	</div>
    
	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">8.2</strong>
				</td>

				<td>
					<strong>RESPECTO AL PLAZO DE VIGENCIA.</strong> - Cumplir de forma obligatoria el <strong>CONTRATO</strong> por el plazo previsto en la <strong>CLÁUSULA CUARTA,</strong> sin posibilidad de retractarse o de solicitar la devolución de valores entregados.
				</td>
			</tr>
		</table>

	</div>
	
	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">8.3</strong>
				</td>

				<td>
					<strong>BENEFICIARIOS SERVICIOS TURÍSTICOS CON DESCUENTO</strong> 
				</td>
			</tr>
		
		</table>
		
	<div style="margin-left: 20px;text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">8.3.1</strong>
				</td>

				<td>
					<strong>EL CLIENTE</strong> podrá designar al hacer uso por primera vez del <strong>PORTAFOLIO GOLDEN NIGHT,</strong> a un número máximo de beneficiarios de <strong><?php echo strtoupper(valorEnLetras($contrato->beneficiarios)); ?></strong> personas que tendrán derecho a hacer uso de los beneficios de descuentos en servicios turísticos descritas en el <strong>CONTRATO.</strong>
				</td>
			</tr>
		</table>
	</div>	

	
	<div style="margin-left: 20px;text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">8.3.2</strong>
				</td>

				<td>
					<strong>EL CONTRATISTA</strong>  reconoce a <strong>EL CLIENTE</strong> la posibilidad de alternar o cambiar uno o más de los beneficiarios designados inicialmente hasta por <strong>UNA (1)</strong> ocasión al año, pero en ningún caso podrá incluir o agregar más beneficiarios a los determinados en el numeral precedente. 
				</td>
			</tr>
		</table>

	</div>
	
	<div style="margin-left: 20px;text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">8.3.3</strong>
				</td>

				<td>
				    Para que los beneficiarios designados puedan hacer uso del <strong>PORTAFOLIO GOLDEN NIGHT, EL CONTRATISTA</strong> deberá ser informada de la designación o cambio con al menos <strong>CUARENTA Y OCHO (48)</strong> hora de anticipación a la reserva solicitada.  
				</td>
			</tr>
		</table>

	</div>
	

		
	</div>
	
		
	</div>
    <div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 10px;">8.4</strong>
				</td>

				<td>
					<strong>SOBRE LA GARANTÍA DE MEJOR PRECIO.</strong> 
				</td>
			</tr>
		</table>
			
			 
	<div style="margin-left: 20px;text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">8.4.1</strong>
				</td>

				<td>
				    Si <strong>EL CLIENTE </strong> encontrase una mejor oferta a nivel de precios en el mercado local o nacional, será la obligación de <strong>EL CONTRATISTA</strong> garantizar al <strong>CLIENTE</strong> que mejorará dicha oferta siempre y solo si, se cumplen con los siguientes parámetros y condiciones:
				</td>
			</tr>
		</table>

	</div>
	
	<div style="margin-left: 20px;text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: -10px;">8.4.2</strong>
				</td>

				<td>
				    Previo a acudir a un tercero u agencia de viajes,<strong> EL CLIENTE</strong> deberá solicitar una cotización a <strong>WORLDCLASS ECUADOR S.A.</strong>
				</td>
			</tr>
		</table>

	</div>

	<div style="margin-left: 20px;text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">8.4.3</strong>
				</td>

				<td>
				    En el evento en que, <strong>EL CLIENTE</strong> no se encuentre conforme con la tarifa ofertada por <strong>WORLDCLASS S.A.,</strong> éste podrá requerir a un tercero u agencia de viajes, una cotización idéntica, que oferte el mismo servicio con las condiciones y parámetros exactos a los ofertados por <strong>WORLDCLASS ECUADOR S.A.,</strong> para las mismas fechas de uso, vuelos, horas de partida y arribo, escalas, y/o aerolíneas. Las mismas condiciones aplicarán para cualquier otro servicio ofertado.
				</td>
			</tr>
		</table>

	</div>
	
	<div style="margin-left: 20px;text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: -10px;">8.4.4</strong>
				</td>

				<td>
				    Presentar original de una cotización vigente y con disponibilidad debidamente membretada, firmada y sellada por el tercer proveedor o agencia de viajes.
				</td>
			</tr>
		</table>

	</div>

	<!--<div>
	    <br><br>
	</div>-->
		<br>

	<div style="text-align: justify;">
		<h3>
			CLÁUSULA NOVENA: TERMINACIÓN DEL CONTRATO. -
		</h3>
	
	</div>


	<div style="text-align: justify;">
		El presente contrato terminará por las siguientes circunstancias: 
		
	</div>
	
<br>
	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 10px;">9.1</strong>
				</td>

				<td>
					Por vencimiento de la vigencia previsto en el presente <strong>CONTRATO;</strong>
				</td>
			</tr>
		</table>

	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 10px;">9.2</strong>
				</td>

				<td>
					Por mutuo acuerdo de las <strong>PARTES;</strong>
				</td>
			</tr>
		</table>

	</div>
	
	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">9.3</strong>
				</td>

				<td>
				Por incumplimiento de parte de <strong>EL CONTRATISTA</strong> de cualquier obligación contenida en el <strong>CONTRATO</strong> y/o sus <strong>ANEXOS;</strong>
				</td>
			</tr>
		</table>

	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 0px;">9.4</strong>
				</td>

				<td>
			Por incumplimiento de parte de<strong> EL CLIENTE</strong>  de cualquier obligación contenida en el <strong>CONTRATO</strong> y/o sus <strong>ANEXOS;</strong>
				</td>
			</tr>
		</table>

	</div>	
	
    <div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
				<td >
					<strong style="margin-right: 10px;">9.5</strong>
				</td>

				<td>
					En caso de mora en el pago de uno o más de los dividendos pactados en el <strong>CONTRATO.</strong>
				</td>
			</tr>
		</table>


	</div>
<br>

	<div style="text-align: justify;">
		<h3>
			CLÁUSULA DÉCIMA: SANCIONES. -
		</h3>
		
	</div>

	<div style="text-align: justify;">
		Las <strong>PARTES </strong> convienen en fijar una suma equivalente al valor total del <strong> CONTRATO </strong> más el 40% calculado sobre este monto a título de <strong>CLÁUSULA PENAL</strong> en el evento en que, alguna de ellas desistiere de continuar con el <strong>CONTRATO</strong> o que incumpla –parcial o totalmente- con cualquiera de las obligaciones en él contenidas o en sus <strong>ANEXOS.</strong>
		 
	</div>
 <br>
	<div style="text-align: justify;">
		<h3>
			CLÁUSULA DÉCIMO PRIMERA: CONTROVERSIAS. –
		</h3>

	</div>
	 
	<div style="text-align: justify;">
		Cualquier dificultad, duda, litigio o cuestión que se suscite con ocasión del presente contrato y sus anexos y reformas, respecto de su existencia o inexistencia, validez o nulidad, cumplimiento o incumplimiento, resolución, interpretación, aplicación, ejecución, terminación o por cualquier otro motivo relacionado directa o indirectamente con el presente contrato o cualquiera de sus anexos y sus reformas, será resuelto por el procedimiento arbitral y se someterá al Tribunal de Arbitraje de la Cámara de Comercio de Guayaquil, conforme a las disposiciones de la Ley de Arbitraje y Mediación vigente. Debiendo destacar que el proceso arbitral será administrado en derecho y confidencial. Las partes renuncian a la jurisdicción ordinaria, se obligan a acatar el laudo arbitral y se comprometen a no interponer ningún tipo de recurso en contra del laudo arbitral. El laudo arbitral será inapelable. La reconvención, de existir, se someterá también a lo dispuesto en la presente cláusula y versará únicamente sobre la causa por la cual se interpuso la demanda inicial. 
	</div>
<br>
		<div style="text-align: justify;center;">
		<h3>
			CLÁUSULA DÉCIMO SEGUNDA: DOMICILIO FÍSICO Y ELECTRÓNICO:
		</h3>
		 
	</div>
	<div style="text-align: justify;">
		Para efectos de comunicaciones o notificaciones las partes señalan como domicilio los siguientes:
	
	</div>

	<div style="text-align: justify;">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
		  	    <td>
					<strong style="margin-right: 0px;">12.1</strong>
				</td>
				<td>
					<strong>WORLDCLASS ECUADOR S.A:</strong> Guayaquil. Av. Carlos Julio Arosemena C.C Albán Borja puerta 2 local 48
				</td>
				<!--<td>
					{{$contrato->one_empresa}}: {{$contrato->one_empresa_direccion}}
				</td>-->
			</tr>
		</table>
 
	</div>

	<div style="text-align: justify; ">
		<table style="text-align: justify;">
		  	<tr style="vertical-align: top;">
		  	    <td>
					<strong style="margin-right: 0px;">12.2</strong>
				</td>

				<td>
					<table>
						<tr>
							<td style="vertical-align: top;">
							CLIENTE:
							</td>

							<td>
								<?php if (@$titular->direccion==''){ ?>
									<?php echo "<b>Email: </b>".@$titular->email; ?>
								<?php }else{ ?>
									<?php echo "<b>Dir: </b>".' '.@$titular->direccion; ?>
 								 	<br>
 								 	<?php echo "<b>Email: </b>".@$titular->email; ?>
								<?php } ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

	</div>
	
	<br>

	<div style="text-align: justify; ">
		<h3>
			CLÁUSULA DÉCIMO TERCERA: ACEPTACIÓN. –
		</h3>
		 


	
		Las <strong>PARTES</strong> afirman y ratifican en todo el contenido de este contrato, firmándolo en unidad de acto y por duplicado, en la ciudad de <?php 
		 echo '<b>'.$contrato->ciudadSede.'</b> a los '.substr($contrato->created_at,8,2).' días del mes de '.getMes(substr($contrato->created_at,5,2)).' del año '.substr($contrato->created_at,0,4); 
		 ?>.<?php if (@$contrato->cotitular > 0) { ?><?php }else{ ?>
    
	<br><br><br><br>
        <br><br>
	
	
    <?php } ?>
	<?php if (@$contrato->cotitular > 0) { ?>
		<table style="width: 50%;">
			<tbody>
				<tr>
					<td style="text-align: center;width: 50%;">
						<hr style="width: 50%;">
						<strong>WORLDCLASS ECUADOR. S.A</strong><br>
						<strong>RUC.0993007080001</strong>
					</td>
				</tr>
			</tbody>
		</table>
		<br>
	<?php } ?>
    
	<table style="width: 100%;">
		<tbody>
			<tr>
	
			    <?php if (@$contrato->cotitular > 0) {

				 }else{?>

				 <td style="text-align: center;width: 50%;">
						<hr style="width: 50%;">
						<strong>WORLDCLASS ECUADOR. S.A</strong><br>
						<strong>RUC.0993007080001</strong>
						
						<br><br>
				</td>
			</tr>	

				 <?php } ?>
				<?php if (@$contrato->cotitular > 0) { ?>
				<td style="text-align: center;width: 50%;text-transform: uppercase;">
					<hr style="width: 50%;">
					<strong style="text-transform: uppercase;"><?php echo strtoupper(@$titular->nombre." ".@$titular->apellido); ?></strong>
					<strong>
						<?php
						 if (!empty(@$titular->cedula)){
						 	print_r("C.I. N.o. ".@$titular->cedula);
						}else{
							print_r("Pasaporte N.o.".@$titular->pasaporte);
						}
					  ?>
					</strong>
				</td>

					<td style="text-align: center;width: 50%;text-transform: uppercase;">
						<hr style="width: 50%;">
						<strong style="text-transform: uppercase;"><?php echo strtoupper(@$cotitular->nombre." ".@$cotitular->apellido); ?></strong><br>
						<strong>
							<?php
							 if (!empty(@$cotitular->cedula)){
							 	print_r("C.I. N.o. ".@$cotitular->cedula);
							}else{
								print_r("Pasaporte N.o.".@$cotitular->pasaporte);
							}
						  ?>
						</strong>
					</td>
				<?php }else{ ?>

				<td style="text-align: center;width: 50%;text-transform: uppercase;">
					<hr style="width: 50%;">
					<strong style="text-transform: uppercase;"><?php echo strtoupper(@$titular->nombre." ".@$titular->apellido); ?></strong><br>
					<strong>
						<?php
						 if (!empty($titular->cedula)){
						 	print_r("C.I. N.o. ".$titular->cedula);
						}else{
							print_r("Pasaporte N.o.".$titular->pasaporte);
						}
					  ?>
					</strong>
				</td>

				<?php } ?>
			</tr>

		</tbody>
	</table>
	
	</div>


	<div class="page-break"></div>

		<div style="text-align: center;font-size: 13px;">

			<h3>
				ANEXO 1
			</h3>
		</div>
	
	<div style="text-align:justify; center; font-size: 13px;">
		<h3>
			<strong>FORMAS Y CONDICIONES DE USO DE LAS NOCHES DE ALOJAMIENTO RECIBIDAS Y BENEFICIOS DE DESCUENTOS EN SERVICIOS TURÍSTICOS QUE ESTÁN INCLUIDOS EN EL PORTAFOLIO GOLDEN NIGHT
 </strong>
		</h3>

	</div>
	

	<div style="text-align: justify;center; font-size: 13px; ">
	<strong>EL CLIENTE</strong> declara conocer y aceptar las formas y condiciones de uso para el <strong>PORTAFOLIO GOLDEN NIGHT</strong> que se detallan a continuación:

		
	</div>
<br>
	<div style="text-align: justify;center; font-size: 13px; ">
		FORMAS DE USO DE NOCHE DE ALOJAMIENTO:

	
	</div>
    <br>
	<!--este lo puse yo jd metodos y procedimientos-->
	<div style="text-align: justify; center; font-size: 13px;">
		<strong>Los métodos y procedimientos para esta finalidad serán los siguientes:</strong>

		<br>
	</div>
	<!-- aqui termina este div q agrege-->
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">1.</strong>
					</td>
	
					<td>
						____
						<strong>USO ACELERADO: EL CLIENTE,</strong> podrá utilizar la cantidad total de noches adquiridas en el <strong>PORTAFOLIO GOLDEN NIGHT</strong> para el máximo número de personas permitidas de acuerdo con la capacidad habitacional máxima establecida con previa reserva y sujeta a disponibilidad.
					</td>
				</tr>
			</table>
		
		</div>
	   
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">2.</strong>
					</td>
	
					<td>
						____
						<strong>FIN DE SEMANA: EL CLIENTE,</strong> podrá utilizar las noches de viernes y sábado y la noche que anteceda un día festivo para el máximo número de personas permitidas de acuerdo con la capacidad habitacional máxima establecida con previa reserva y sujeta a disponibilidad.
					</td>
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">3.</strong>
					</td>
	
					<td>
						____
						<strong>ENTRE SEMANA: EL CLENTE,</strong> podrá utilizar las noches restantes, domingo, lunes, martes, miércoles y que correspondan al concepto “entre semana”. 
					</td>
				</tr>
			</table>
			
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">4.</strong>
					</td>
	
					<td>
						____
						El número de noches a descontar por alojamiento hotelero será igual sin diferenciar noches de entre semana o fines de semana previa reserva y sujeta a disponibilidad.
					</td>
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">5.</strong>
					</td>
	
					<td>
						____
						Una vez utilizadas las noches de alojamiento, <strong>EL CLIENTE </strong> autoriza restar de su inventario de noches el número de éstas.
					</td>
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">6.</strong>
					</td>
	
					<td>
						____
						Las noches adquiridas, se pueden regalar, ceder, vender, heredar, congelar y recargar.
					</td>
				</tr>
			</table>
			
		</div>
	<br>
	
		<div style="text-align: justify;center; font-size: 13px;">
			<strong>RESERVAS NOCHES ADQUIRIDAS:</strong>
			
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">7.</strong>
					</td>
	
					<td>
						____
						Toda reserva para hacer uso de las noches de alojamiento adquiridas deberá ser solicitada por <strong>EL CLIENTE,</strong> con una antelación mínima de 48 horas y máxima de 60 días; sea que ésta se realice en temporada alta, media y/o baja., en el caso de uso de noche para beneficiarios <strong>EL CLIENTE </strong> debe solicitar y gestionar la reserva y el uso de las misma.
					</td>
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">8.</strong>
					</td>
	
					<td>
						____
						Todas las reservas estarán sujetas a disponibilidad de habitación. 
					</td>
				</tr>
			</table>
		
		</div>
		
		<div style="text-align: justify;center; font-size: 13px;">
			<strong>CAPACIDAD DE HABITACIÓN:</strong>
			
		</div>
	    <br> 
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">9.</strong>
					</td>
	
					<td>
						____
						La capacidad máxima establecida de ocupación de habitación es de 4 personas por habitación.
					</td>
				</tr>
			</table>
		</div>
	
		<div style="text-align: justify;center; font-size: 13px;">
			<strong>FORMAS DE USO DE BENEFICIOS DE DESCUENTOS EN SERVICIOS TURÍSTICOS</strong>
			
		</div>
	
		<div style="text-align: justify;center; font-size: 13px;">
			<table style="width:100%;">
				<tr>
					<td >
						Para dar uso a los Beneficios de Descuentos en Servicios Turísticos descritos en el <strong>ANEXO 2</strong> del <strong>CONTRATO, EL CLIENTE</strong> deberá cumplir y observar las siguientes directrices:
					</td>
	
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">10.</strong>
					</td>
	
					<td>
						____
						Toda cotización y/o reserva debe ser solicitada por <strong>EL CLIENTE </strong> por escrito indicando el número de contrato a los correos destinados para este fin, el tiempo de respuesta de la misma es de 24 a 48 horas.
					</td>
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify; margin-top: 0px;">
			<table style="text-align: justify;center; font-size: 13px;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">11.</strong>
					</td>
	
					<td>
						____
						Las cotizaciones realizadas tienen una vigencia de 24 horas establecida y están sujetas a cambios sin previo aviso. Una cotización no garantiza ni implica una reserva.
					</td>
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">12.</strong>
					</td>
	
					<td>
						____
						Los descuentos son aplicados únicamente a las tarifas vigentes de cotizaciones y reservas confirmadas por<strong> EL CLIENTE</strong> en la fecha de estas, en caso de modificaciones, cambios y/o cancelaciones, éstas podrán incurrir en penalidades impuestas por el proveedor del servicio.
					</td>
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">13.</strong>
					</td>
	
					<td>
						____
						Los descuentos que constituyen un beneficio adicional de cortesía a las noches de alojamiento contratadas son aplicados únicamente a las tarifas vigentes de cotizaciones y reservas confirmadas por <strong>EL CLIENTE </strong>en la fecha de estas, en caso de modificaciones, cambios y/o cancelaciones, éstas podrán incurrir en penalidades impuestas por el proveedor del servicio.
					</td>
				</tr>
			</table>
		
		</div>
		<br>
		<div style="text-align: justify;center; font-size: 13px;">
			<strong>SOBRE LOS BONOS Y CORTESÍAS</strong>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">14.</strong>
					</td>
	
					<td>
						____
						Las cortesías y/o bonos promocionales entregados cubren solo estadía y bajo ningún concepto incluyen alimentos ni transporte y se regirán por las condiciones de uso al respaldo de la misma; la cuales no son parte integrante del contrato suscrito.
					</td>
				</tr>
			</table>
	
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">15.</strong>
					</td>
	
					<td>
						____
						Los derechos de uso a pagar para las cortesías y/o bonos promocionales entregados son exclusivamente a cargo del<strong> CLIENTE;</strong> éstos pueden variar según la categoría del hotel y la temporada.
					</td>
				</tr>
			</table>
	
		</div>
		<div style="text-align: justify;center; font-size: 13px;">
			<strong>INTEGRIDAD Y NATURALEZA DEL CONTRATO</strong>
			
		</div>

		<div style="margin-left: 50px;text-align: justify; margin-top:0px;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 0px;">16.</strong>
					</td>
	
					<td>
						____
						Hemos recibido una presentación clara y completa de los servicios y/o descuentos contenidos en el <strong>PORTAFOLIO GOLDEN NIGHT.</strong>
					</td>
				</tr>
			</table>
		
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">17.</strong>
					</td>
	
					<td>
						____
						Es claro que las vías para hacer uso de los servicios y/o beneficios descritos en el <strong>CONTRATO</strong> son las siguientes: correos electrónicos, página web o a través de nuestra línea de servicio al cliente.
					</td>
				</tr>
			</table>
	    
		</div>
	
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 15px;">18.</strong>
					</td>
	
					<td>
					    ____
						Es claro que la atención presencial debe ser solicitada mediante cita previa.
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">19.</strong>
					</td>
	
					<td>
						____
						Es claro que no existe ningún acuerdo verbal entre <strong>EL CONTRATISTA</strong> o alguno de los asesores y <strong>EL CIENTE,</strong> que no esté contenido en <strong>EL CONTRATO.</strong>
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">20.</strong>
					</td>
	
					<td>
						____
						Es claro que el <strong>PORTAFOLIO GOLDEN NIGHT</strong> es producto de una campaña promocional publicitaria que está regida por las leyes ecuatorianas.
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">21.</strong>
					</td>
	
					<td>
						____
						<strong>EL CLIENTE</strong> podrá hacer uso de los beneficios contratados una vez haya pagado el 100% del valor total del <strong>CONTRATO.</strong>
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 15px;">22.</strong>
					</td>
	
					<td>
						____
						Los porcentajes de descuentos que aplican para el<strong> PORTAFOLIO GOLDEN NIGHT </strong>y el mejor precio de garantía, serán solo aplicables contra adquisición de los servicios brindados por <strong>EL CONTRATISTA</strong> y bajo ningún concepto serán retribuibles o exigibles en dinero.
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 10px;">23.</strong>
					</td>
	
					<td>
						____
						Todos los servicios turísticos descritos en <strong>EL CONTRATO</strong> y sus <strong>ANEXOS,</strong> serán operados y proporcionados única y exclusivamente por <strong>EL CONTRATISTA</strong> o por quien ésta designe.
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 8px;">24.</strong>
					</td>
	
					<td>
						____
						Todo pago relacionado con <strong>EL CONTRATO</strong> y los servicios adquiridos, serán en dólares de los Estados Unidos de Norte América.
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 10px;">25.</strong>
					</td>
	
					<td>
						____
						<strong>EL CLIENTE </strong>declara que la venta del Portafolio de servicios <strong>GOLDEN NIGHT</strong> objeto del <strong>CONTRATO</strong> se hizo directamente, es decir,<strong> NO </strong>por correo, catálogo, teléfono u otros medios similares. 
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 5px;">26.</strong>
					</td>
	
					<td>
						____
						<strong>EL CLIENTE </strong>declara haber recibido información adecuada, veraz, clara, oportuna y completa sobre los servicios ofrecidos, así como los descuentos, condiciones de contratación y demás aspectos relevantes de los mismos.
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 0px;">27.</strong>
					</td>
	
					<td>
						____
						<strong>EL CLIENTE </strong>declara haber recibido un trato transparente, equitativo y no discriminatorio o abusivo por parte de <strong>EL CONTRATISTA.</strong>
					</td>
				</tr>
			</table>
			
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 10px;">28.</strong>
					</td>
	
					<td>
						____
						Los descuentos otorgados del portafolio de servicios son aplicados únicamente a las tarifas vigentes de cotizaciones y reservas confirmadas por el cliente en la fecha de las mismas, en caso de modificaciones, cambios y/o cancelaciones estas podrán incurrir en penalidades impuestas por el proveedor del servicio
					</td>
				</tr>
			</table>
		
		</div>
		<div style="margin-left: 50px;text-align: justify;center; font-size: 13px;">
			<table style="text-align: justify;">
				<tr style="vertical-align: top;">
					<td style="vertical-align: top;">
						<strong style="margin-right: 0px;">29.</strong>
					</td>
	
					<td>
						____
						Como prueba de que el presente anexo, ha sido diligenciado en su totalidad de manera libre espontánea y consiente, firmo a continuación.
					</td>
				</tr>
			</table>
			<br><br>
		</div>
		Firmas.

		<br><br>

		<table style="width: 100%;">
			<br><br><br>

			<tbody>
				<tr>
						<?php if (@$contrato->cotitular > 0) {

					 }else{?>

					 <td style="text-align: center;width: 50%;">
							<hr style="width: 50%;">
							<strong>WORLDCLASS ECUADOR. S.A</strong><br>
							<strong>RUC.0993007080001</strong>
						
							
							
					</td>

					 <?php } ?>
					<?php if (@$contrato->cotitular > 0) { ?>
					<td style="text-align: center;width: 50%;text-transform: uppercase;">
						<hr style="width: 50%;">
						<strong style="text-transform: uppercase;"><?php echo strtoupper(@$titular->nombre." ".@$titular->apellido); ?></strong><br>
						<strong>
							<?php
							 if (!empty(@$titular->cedula)){
								 print_r("C.I. N.o. ".@$titular->cedula);
							}else{
								print_r("Pasaporte N.o.".@$titular->pasaporte);
							}
							?>
						</strong>
						
							<strong>EL ADHERENTE</strong><br>
					</td>

						<td style="text-align: center;width: 50%;text-transform: uppercase;">
							<hr style="width: 50%;">
							<strong style="text-transform: uppercase;"><?php echo strtoupper(@$cotitular->nombre." ".@$cotitular->apellido); ?></strong><br>
							<strong>
								<?php
								 if (!empty(@$cotitular->cedula)){
									 print_r("C.I. N.o. ".@$cotitular->cedula);
								}else{
									print_r("Pasaporte N.o.".@$cotitular->pasaporte);
								}
								?>
							</strong>
						</td>
					<?php }else{ ?>

					<td style="text-align: center;width: 50%;text-transform: uppercase;">
						<hr style="width: 50%;">
						<strong style="text-transform: uppercase;"><?php echo strtoupper(@$titular->nombre." ".@$titular->apellido); ?></strong><br>
						<strong>
							<?php
							 if (!empty($titular->cedula)){
								 print_r("C.I. N.o. ".$titular->cedula);
							}else{
								print_r("Pasaporte N.o.".$titular->pasaporte);
							}
							?>
							<br>
								<strong>EL ADHERENTE</strong><br>
						</strong>
					</td>

				<?php } ?>
				</tr>

			</tbody>
		</table>

	<div class="page-break">

    </div>
	<div style="text-align: center; margin-top: 0px;">
		<h3 style="text-decoration: underline;">
			ANEXO 2
		</h3>
	</div>

	<div style="text-align: center;">
		<h3>
			BENEFICIOS Y BENEFICIARIOS
		</h3>
		<br>
	</div>
	<br>

	<div style="text-align: justify;">
		<strong style="text-transform: uppercase;">NOMBRE DEL CLIENTE: <?php print_r(strtoupper($titular->nombre.' '.$titular->apellido)) ?></strong>
		<br>
	</div>
	<br>

	<div style="text-align: justify;">
		<strong>CONTRATO No. <?php print_r($contrato->sede."".$contrato->consecutivo) ?></strong>
		<br>
	</div>
	<br>

	<div style="text-align: justify;">
		<strong>El CLIENTE</strong> tendrá derecho de recibir los siguientes beneficios durante un periodo de
		<strong><?php echo strtoupper(valorEnLetras($contrato->anosOtorgados)); ?>
			<?php
				if ($contrato->anosOtorgados > 1) {
					echo " AÑOS ";
				}else{
					echo " AÑO ";
				}
			?>
		 (<?php echo $contrato->anosOtorgados ?>)</strong>, con un número de beneficiarios máximo de <strong><?php echo strtoupper(valorEnLetras($contrato->beneficiarios)); ?>
	  	<?php
					if ($contrato->beneficiarios > 1) {
						echo " BENEFICIARIOS ";
					}else{
						echo " BENEFICIARIO ";
					}
			?>
			 (<?php echo $contrato->beneficiarios ?>)</strong>, 




			 y una cantidad total de <strong><?php echo strtoupper(valorEnLetras($contrato->noches)); ?>

			 <?php
					if ($contrato->noches > 1) {
						echo " NOCHES ";
					}else{
						echo " NOCHE ";
					}
			?>
			 (<?php echo $contrato->noches ?>)</strong>, por la vigencia del contrato contados a partir de la firma del presente contrato:

		<br><br><br><br>
	</div>

	<div style="text-align: center; text-decoration: underline;">
		<strong>PORTAFOLIO DE SERVICIOS GOLDEN NIGHT</strong>
		<br>
	</div>
	<br>

	<div style="text-align: center;">
		<table style="width: 100%;">
			<tr>
			    <?php if(count($servNaci) > 0){ $i = 0;?>
				<td style="width: 40%;" valign="top">

					<table id="clientes" border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-hover">
        		        <thead>
        		    			<tr>
        		    				<th style="text-align: left;">Servicios Nacionales</th>
        		    			</tr>
        		    		</thead>

        		       <tbody>

        		           <?php foreach($servNaci as $servNaci){ $i++; ?>
        		             <tr>
        		               <td>

        										 <table>
        								 			<tr>
        								 				<td style="vertical-align: top;">
        								 					<strong style="margin-right: 5px;"><?php echo $i.'.'; ?></strong>
        								 				</td>

        								 				<td>
        								 					<?php echo $servNaci->servicio;?>
        								 				</td>
        								 			</tr>
        								 		</table>

        		               </td>
        		             </tr>
        		           <?php } ?>

        		       </tbody>
		            </table>

				</td>
               <?php }else{echo"";} ?>
               <?php if(count($servInter) > 0){ $i = 0;?>
				<td style="width: 60%;" valign="top">

					<table id="clientes" border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-hover">
        		        <thead>
        		    			<tr>
        		    				<th style="text-align: left;">Servicios Internacionales</th>
        		    			</tr>
        		    		</thead>

        		       <tbody>

        		           <?php foreach($servInter as $servInter){ $i++; ?>
        		             <tr>
        		               <td>
        										 <table>
        								 			<tr>
        								 				<td style="vertical-align: top;">
        								 					<strong style="margin-right: 5px;"><?php echo $i.'.'; ?></strong>
        								 				</td>

        								 				<td>
        								 					<?php echo $servInter->servicio;?>
        								 				</td>
        								 			</tr>
        								 		</table>
        		               </td>
        		             </tr>
        		           <?php } ?>

        		       </tbody>
        		      </table>

				</td>
				<?php }else{} ?>
			</tr>
		</table>
		<br>
	</div>
	<br>

	<div style="text-align: justify;">
		<h3>
			Firma:
		</h3>
		<br>
	</div>
	<br>

	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="text-align: center;width: 50%;text-transform: uppercase;">
					<hr style="width: 50%;">
					<strong style="text-transform: uppercase;"><?php print_r(strtoupper($titular->nombre.' '.$titular->apellido)) ?></strong><br>
					<strong>
						<?php
						 if (!empty($titular->cedula)){
							print_r("C.I. N.o. ".$titular->cedula);
						}else{
							print_r("Pasaporte N.o.".$titular->pasaporte);
						}
						?>
					</strong>
				</td>

				<?php if ($contrato->cotitular > 0) { ?>
					<td style="text-align: center;width: 50%;text-transform: uppercase;">
						<hr style="width: 50%;">
						<strong style="text-transform: uppercase;"><?php print_r(strtoupper($cotitular->nombre.' '.$cotitular->apellido)) ?></strong><br>
						<strong>
							<?php
							 if (!empty($cotitular->cedula)){
								print_r("C.I. N.o. ".$cotitular->cedula);
							}else{
								print_r("Pasaporte N.o.".$cotitular->pasaporte);
							}
							?>
						</strong>
					</td>
				<?php } ?>
			</tr>
		</tbody>
	</table>

	<div class="page-break">

    </div>
	<div style="text-align: center;color: #2196F3; margin-top: 0px;">
		<h3>
			WORLDCLASS ECUADOR S.A
		</h3>
	</div>

	<div style="text-align: center;color: #2196F3;">
		<h3>
			¡Cordial Saludo de Bienvenida!
		</h3>
	</div>
	<br>

	<div style="text-align: justify;">
		Para <strong>{{$contrato->one_empresa}}</strong> y su equipo de trabajo es un placer darle la más cordial bienvenida a nuestro <strong>CLUB WORLDCLASS ECUADOR </strong> nos permitimos
		felicitarlos por pertenecer al maravilloso mundo de las vacaciones preferenciales, a través de los servicios que nuestro programa
		<strong>PORTAFOLIO DE SERVICIOS GOLDEN NIGHT</strong> tiene preparado para ustedes. Con el ánimo de poderles atender y responder de manera eficaz e inmediata,
		cualquier servicio requerido por ustedes o alguno de sus beneficiarios ponemos a su disposición nuestros métodos de atención:

		<br><br>
	</div>

	<div style="text-align: center;color: #2196F3;">
		<h5>
			Líneas de atención
		</h5>
	</div>

	<div style="text-align: center;">
			@for ($i = 0; $i < count($telefonosEm); $i++)
					<strong>PBX. </strong>{{$telefonosEm[$i]}}
					<br>
			@endfor
	</div>

    <br>
	<div style="text-align: center;color: #2196F3;">
		<h5>
			Correos
		</h5>
	</div>


	@for ($i = 0; $i < count($correosEm); $i++)
		<div style="text-align: center;">
				{{$correosEm[$i]}}
			</div>		
	@endfor


    <br>
	<div style="text-align: center;color: #2196F3;">
		<h5>
			Pagina web
		</h5>
	</div>
	

	@for ($i = 0; $i < count($paginasweb); $i++)
		<div style="text-align: center;">
			{{ $paginasweb[$i] }}
		</div>			
	@endfor

	<br>
	<div style="text-align: center;color: #2196F3;">
		<h5>
			Dirección
		</h5>
		<center>Av. Carlos Julio Arosemena C.C Alban Borja puerta 2 local 48 junto al almacén DMARY</center>
	</div>

	
	<br><br>

	<div style="text-align: center;color: #2196F3;">
		<h4>
			PARA SOLICITAR UNA RESERVA INGRESE A LA PÁGINA WEB COMO AFILIADO Y DILIGENCIE EL FORMULARIO PARA SU COTIZACION O RESERVA.
			ESTIMADO PARA UNA MAYOR, EFICAZ Y PERSONALIZADA ATENCIÓN RECUERDE SOLICITAR SU CITA PREVIA
		</h4>
		<br>
	</div><br>


</main>

<script type="text/php">
    if (isset($pdf)) {
        $x = 290;
        $y = 750;
        $text = "Página {PAGE_NUM}";
        $font = null;
        $size = 14;
        $color = array(0.5,0.5,0.5);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>

  </body>
</html>
