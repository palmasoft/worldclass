<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Si de Uso</title>
  </head>
  <body>

    <div style="text-align: center;">
  		<h2 style="text-decoration: underline;">
  			OTRO SI
  		</h2>
  		<br>
  	</div>

  	<div style="text-align: center;">
  		<h3 style="text-decoration: underline;">
  			WORLDCLASS ECUADOR S.A
  		</h3>
  		<br>
  	</div>

  	<div style="text-align: center;">
  		<h3 style="text-decoration: underline;">
  			ACLARA:
  		</h3>
  		<br>
  	</div>


  	<div style="text-align: justify;">
  		Que el contrato <strong><?php print_r(@$contrato->sede."".@$contrato->consecutivo) ?></strong> a nombre del señor (a)
  		  <strong style="text-transform: uppercase;"><?php print_r(@$titular->nombre." ".@$titular->apellido); ?>,</strong>
  			identificado

  			<?php if (!empty(@$titular->cedula)) { ?>
  				con cédula de identidad número
  		 <?php }else{ ?>
  			 con pasaporte número
  		 <?php } ?>
  		 <strong>
  			 <?php
  				if (!empty(@$titular->cedula)){
  				 print_r(@$titular->cedula);
  			 }else{
  				 print_r(strtoupper(@$titular->pasaporte));
  			 }
  			 ?>,</strong> podrá hacer uso de los beneficios de descuento en servicios turísticos, una vez haya pagado la cuota inicial pactada del valor total del 
  			<strong>PORTAFOLIO GOLDEN NIGHT.</strong>

  		<br>
  		<?php echo @$texto;?>

  		<br><br><br><br><br><br><br>
  	</div>

  	<?php if (@$contrato->cotitular > 0) { ?>
  		<table style="width: 50%;">
  			<tbody>
  				<tr>
  					<td style="text-align: center;width: 50%;">
  						<hr style="width: 50%;">
  						<strong>WORLDCLASS ECUADOR S.A </strong><br>
  						<strong>RUC. 0993007080001</strong>
  					</td>
  				</tr>
  			</tbody>
  		</table>
  		<br><br><br><br><br>
  	<?php } ?>


  	<table style="width: 100%;">
  		<tbody>
  			<tr>
  				<td style="text-align: center;width: 50%;">
  					<hr style="width: 50%;">
  					<strong style="text-transform: uppercase;"><?php print_r(@$titular->nombre.' '.@$titular->apellido) ?></strong><br>
  					<strong>
  						<?php
  						 if (!empty(@$titular->cedula)){
  						 	print_r("C.I. N.o. ".@$titular->cedula);
  						}else{

  							print_r(strtoupper("Pasaporte N.o.".@$titular->pasaporte));
  						}
  					  ?>
  					</strong>
  				</td>
  				<?php if (!empty(@$cotitular->nombre)) { ?>
  					<td style="text-align: center;width: 50%;">
  						<hr style="width: 50%;">
  						<strong style="text-transform: uppercase;"><?php print_r(@$cotitular->nombre.' '.@$cotitular->apellido) ?></strong><br>
  						<strong>
  							<?php
  							 if (!empty(@$cotitular->cedula)){
  							 	print_r("C.I. N.o. ".@$cotitular->cedula);
  							}else{
  								print_r(strtoupper("Pasaporte N.o.".@$cotitular->pasaporte));
  							}
  						  ?>
  						</strong>
  					</td>
  				<?php }else{ ?>
  					<td style="text-align: center;width: 50%;">
  						<hr style="width: 50%;">
  						<strong>WORLDCLASS ECUADOR S.A </strong><br>
  						<strong>RUC. 0993007080001</strong>
  					</td>

  				<?php } ?>
  			</tr>
  		</tbody>
  	</table>
  	<br><br><br><br><br><br><br>

  </body>
</html>