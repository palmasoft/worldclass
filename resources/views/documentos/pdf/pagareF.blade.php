<?php

/* Asi funciona
$numero = 13041111.22;
$cambio = valorEnLetras($numero);


echo "numero = $numero";
echo "<br>";
echo "cambio = $cambio";
*/


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
?>

<?php
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
<html>
<head>
	<title>PAGARÉ F</title>

	<style>
      body {
        font-size: 12px;
      }
		#pagare tr {
			background-color: #eee;
		}
		#pagare tr:nth-child(2) {
		    background-color: #eee;
		}
		#pagare tr:nth-child(even) {
		    background-color: #eee;
		}

		#pagare tr:nth-child(odd) {
		    background-color: #fff;
		}
	</style>
</head>
<body style="text-align: justify;">

	<div style="text-align: center;">
		<h3 style="text-decoration: underline;">
			PAGARÉ A LA ORDEN
		</h3>
	</div>

	<div style="text-align: center;">
		<h3>
			POR US $ <strong style="text-decoration: underline;"><?php print_r($contrato->saldoFinanciado) ?></strong>
		</h3>

	</div>

	<div style="text-align: justify;">
		Debo y pagaré incondicionalmente a la orden de <strong>WORLDCLASS ECUADOR, S.A.</strong>, en esta ciudad o en el lugar donde se me reconvenga,
		 la cantidad de <strong><?php echo strtoupper(valorEnLetras($contrato->saldoFinanciado)); ?> DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA
			 (USD $ <?php print_r($contrato->saldoFinanciado) ?>)</strong>,
		  obligándome incondicionalmente a pagarla a los vencimientos de los plazos constantes en este Pagaré a la Orden:
		<br><br>
		La cantidad antes mencionada me obligo a pagarla en cada uno de los vencimientos sucesivos:
		<br><br>
	</div>

  <center>
    <table>
            <tr>

                  <?php $intqq=1;
                  if (count(@$pagare)<13) {
                    ?>
                    <td>
                      <table id="pagare" style="width: 100%;"  class="table table-bordered">
                  		<thead>
                  			<tr>
                  				<th width="100px;">No. de cuota</th>
                  				<th>Valor USA</th>
                  				<th>Vencimiento</th>
                  			</tr>
                  		</thead>
                  		<tbody>
                  			<?php
                  			foreach($pagare as $rass){
                  			?>
                  				<tr>
                  					<td><center><?php echo $intqq; ?></center></td>
  					                <td><center><?php echo $rass->saldo; ?></center></td>
  					                <td><center><?php echo $rass->fecha; ?></center></td>
                  				</tr>
                  			<?php
                        $intqq++;
                  			}?>
                  		</tbody>
                  	</table>
                    </td>
                    <?php
                  }else{
                    ?>
                    <td style="vertical-align: top;padding: 20px;">
                      <table id="pagare" style="width: 100%;"  class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="100px;">No. de cuota</th>
                          <th>Valor USA</th>
                          <th>Vencimiento</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $intqq2=0;
                        foreach($pagare as $rass){
                            if ($intqq2 < count(@$pagare)/2) {
                              ?>
                              <tr>
                                <td><center><?php echo $intqq; ?></center></td>
                                <td><center><?php echo $rass->saldo; ?></center></td>
                                <td><center><?php echo $rass->fecha; ?></center></td>
                              </tr>
                              <?php
                              $intqq++;
                            }
                            $intqq2++;
                        }?>
                      </tbody>
                    </table>
                    </td>
                    <td style="vertical-align: top; padding: 20px;">
                      <table id="pagare" style="width: 100%;"  class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="100px;">No. de cuota</th>
                          <th>Valor USA</th>
                          <th>Vencimiento</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $intqq2=0;
                        foreach($pagare as $rass){
                            if ($intqq2>=count(@$pagare)/2) {
                              ?>
                              <tr>
                                <td><center><?php echo $intqq; ?></center></td>
                                <td><center><?php echo @$rass->saldo; ?></center></td>
                                <td><center><?php echo @$rass->fecha; ?></center></td>
                              </tr>
                              <?php
                              $intqq++;;
                            }
                            $intqq2++;
                        }?>
                      </tbody>
                    </table>
                    </td>
                    <?php

                  }
                   ?>



            <tr>

    </table>
  </center>

	<br>

	<div style="text-align: justify;">
		En caso de mora en el pago de cualquiera de las cuotas antes señaladas o de parte de alguna de ellas,
		 pagaré desde su vencimiento hasta su total cancelación, sobre los valores no pagados,
		  la tasa de interés de mora que haya dispuesto la autoridad gubernamental competente y que se halle vigente a la respectiva fecha de vencimiento. Además,
			 pagaré todos los gastos judiciales, extrajudiciales y honorarios profesionales que ocasione el cobro, bastando para determinar el monto de tales gastos,
			 la sola aseveración del acreedor.

		En el evento de incurrir en mora en el pago de las obligaciones antes mencionadas o de parte de ellas,
		 reconozco el derecho del acreedor, para la aceleración o anticipación de las cuotas que no estuvieren vencidas,
		  quedando el acreedor facultado para declarar de plazo vencido todas las obligaciones cuyo vencimiento se hubiere anticipado.

		En caso de juicio hago una renuncia general de domicilio y quedo expresamente sometido a los Jueces competentes de esta ciudad de Guayaquil o del lugar en que se me reconvenga,
		 en la vía ejecutiva; obligándome irrevocablemente al fiel cumplimiento de lo aquí estipulado. Exímase al acreedor de este Pagaré a la Orden,
		  de su presentación al suscriptor del mismo, para su visto bueno o para el pago, así como de realizar avisos de vencimiento o de protesto por falta de pago.

            <br>
            <?php 
            echo $contrato->ciudadSede.' '.substr($contrato->created_at,8,2).' de '.getMes(substr($contrato->created_at,5,2)).' del '.substr($contrato->created_at,0,4); 
            ?>
	</div>

	<br><br>
	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="text-align: center;width: 50%;">
					<hr style="width: 50%;">
					<strong style="text-transform: uppercase;"><?php print_r($titular->nombre.' '.$titular->apellido) ?></strong><br>
					<strong>
						<?php
						 if (!empty($titular->cedula)){
						 	print_r("C.I. N.o. ".$titular->cedula."<br>");
							print_r('<br>'.$titular->direccion.'<br>');
							print_r($titular->email);
						}else{
							print_r(strtoupper("Pasaporte N.o.".$titular->pasaporte."<br>"));
							print_r($titular->direccion."<br>");
							print_r($titular->email);
						}
					  ?>
					</strong>
				</td>
				<?php if ($contrato->cotitular > 0) { ?>
					<td style="text-align: center;width: 50%;">
						<hr style="width: 50%;">
						<strong style="text-transform: uppercase;"><?php print_r($cotitular->nombre.' '.$cotitular->apellido) ?></strong><br>
						<strong>
							<?php
							 if (!empty($cotitular->cedula)){

								print_r($cotitular->email);
							}else{

								print_r($cotitular->email);
							}
						  ?>
						</strong>
					</td>
				<?php } ?>
			</tr>
		</tbody>
	</table>


</body>
</html>
