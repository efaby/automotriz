<?php $title = "Listado Vehículos";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Orden de Repuestos</h1>
</div>
<div class="card">
	<div class="card-block">
		<div class="row">	
			<div class="form-group  col-sm-12" align="right">

				<a href="../visualizarPdf/<?php echo $datos['id']?>" target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-file-pdf-o'></i>  Descargar</a>

			</div>
		</div>		
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
		    <thead>
		    <tr>
		    <th colspan="8"></th>
		    <th>No. Solicitud: </th>
		    <th><?php echo $datos['id']?></th>
		    </tr>
		    	<tr>  
				  	<th rowspan="3" colspan="2"  style="text-align:center">
				  		<img src="<?php echo PATH_IMAGES; ?>/espoch.jpg" width="140px" height="130px"/>
				  	</th>
				    <th colspan="6" style="text-align:center">ESPOCH-GADPC</th>
				    <th rowspan="3" colspan="2" style="text-align:center">
				  		<img src="<?php echo PATH_IMAGES; ?>/gobierno.jpg" width="130px" height="130px"/>
				  	</th>				    
				</tr>
				<tr>
				    <th colspan="6" style="text-align:center">SOLICITUD/ORDEN REPUESTO</th>				   
				</tr>
				<tr>
					<th >Solicitado por:</th>
				    <th colspan="3" ><?php echo $datos['nombres'];?> <?php echo $datos['apellidos'];?></th>
				    <th>Fecha Solicitud:</th>
				    <th ><?php echo $datos['fecha'];?></th>
				</tr>
				<tr>
				    <th style="width: 10%">Automotor</th>
				    <th style="width: 10%"><?php $vehiculo = ($datos['tipo_vehiculo_id']==3)?"Vehiculo Pesado": ($datos['tipo_vehiculo_id']>3&&$datos['tipo_vehiculo_id']<9)?"Maquinaria Pesada":"Vehiculo Liviano";  echo $vehiculo; ?></th>
				    <th style="width: 10%"><?php $label = ($datos['tipo_vehiculo_id']>3&&$datos['tipo_vehiculo_id']<9)?"Odometro":"Kilometro"; echo $label; ?></th>
				    <th style="width: 10%"><?php echo $datos['medida_uso']; ?></th>				    
				    <th style="width: 10%">N&uacute;mero:</th>
				    <th style="width: 10%"><?php echo $datos['numero']; ?></th>
				    <th style="width: 10%">Placa:</th>
				    <th style="width: 10%"><?php echo $datos['placa']; ?></th>
				    <th style="width: 10%">A&ntilde;o:</th>
				    <th style="width: 10%"><?php echo $datos['anio']; ?></th>
				    
		  	 	</tr>
		  	 	<?php 
		  	 	$colspan = 7;
		  	 	$row1 = '';
		  	 	if(($_SESSION['SESSION_USER']['tipo_usuario_id']==2)&&($datos['aprobado']==0)){
		  	 		$colspan = 6;
		  	 		$row1 = '<th style="text-align:center">Existente</th>';
		  	 	}
		  	 	
		  	 	?>
		    	<tr>
			    	<th style="text-align:center">C&oacute;digo</th>
				    <th style="text-align:center" colspan="<?php echo $colspan ; ?>">Repuesto</th>
				    <th style="text-align:center">Medida</th>
				    <th style="text-align:center">Cantidad</th>
				   <?php echo $row1; ?>
			    </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($repuestos as $item) {
		    		echo "<tr><td>".$item['codigo']."</td>";		    		
		    		echo "<td colspan='$colspan'>".$item['nombre']."</td>";
		    		echo "<td >".$item['medida']."</td>";
		    		echo "<td style='text-align:center'>".$item['pedido']."</td>";
		    		if(($_SESSION['SESSION_USER']['tipo_usuario_id']==2)&&($datos['aprobado']==0)){
		    			$style = '';
		    			$disable = '';
		    			if($item['pedido']>$item['cantidad']){
		    				$style = 'color: red;';
		    				$disable = "disabled";
		    			}
		    			echo $row = "<td style='text-align:center; $style'>".$item['cantidad']."</td>";
		    		}
					echo "</tr>";
		    		
		    		 
		    	} ?>
		    	 <?php  if(($_SESSION['SESSION_USER']['tipo_usuario_id']!=2)||($datos['aprobado']==1)): ?>
		    	 <tr>
		    	 	<td>Entregado Por:</td>
		    	 	<td colspan='2'><?php echo $datos['nombreEnt'];?> <?php echo $datos['apellidoEnt'];?></td>
		    	 	<td>Firma:</td>
		    	 	<td></td>
		    	 	<td>Recibido Por:</td>
		    	 	<td colspan='2'><?php echo $datos['nombres'];?> <?php echo $datos['apellidos'];?></td>	
		    	 	<td>Firma:</td>
		    	 	<td></td>	    	 
		    	 </tr>
		    	 <?php endif;  ?>
		    </tbody>
		    
		    </table>
		    <?php  if(($_SESSION['SESSION_USER']['tipo_usuario_id']==2)&&($datos['aprobado']==0)): ?>
		    <form id="frmUsuario1" method="post" action="../aprobarOrden/">
		    <div class="row">

				<input type='hidden' name='id' value="<?php echo $datos['id']; ?>">
					<button type="submit" class="btn btn-success rounded <?php echo $disable; ?>">Aprobar</button>
				<a  class="btn btn-primary rounded" id="modalOpen1" href="javascript: loadModal1('<?php echo $datos['id'];?>')">
						Observaci&oacute;n
					</a>
			</div>
		    </form>
		    <?php endif;  ?>
		</div>
	</div>
</div>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Observaciones</h3>
			</div>

			<div class="modal-body">
				<form id="frmUsuario" method="post" action="../guardarObservacion/">

					<div class="row">
						<div class="form-group col-sm-12">
							<label class="control-label">Observaci&oacute;n</label> 
							<textarea name='observacion' id='observacion' class='form-control' ><?php echo $datos['observacion'];?></textarea>	
					
						</div>
					</div>
					<div class="row">
					<div class="form-group col-sm-6">
					<input type='hidden' name='id' value="<?php echo $datos['id']; ?>">
						<button type="submit" class="btn btn-success rounded">Guardar</button>
					</div>
				</div>
				</form>
			</div>

		</div>

	</div>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script> 
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>
<script type="text/javascript">

	function loadModal1(id){		
		$('#confirm-submit').modal({show:true});
	}

	$(document).ready(function() {

	    $('#frmItem1').formValidation({
	    	message: 'This value is not valid',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {			
				
				observacion: {
					message: 'La Observacion no es válida',
				    validators: {	
																			
										regexp: {
											regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
											message: 'Ingrese una Observacion válida.'
										}
									}
								},
				
			}
		});
	});

</script>

</body>
</html>