<?php $title = "Orden Plan";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<div class="title-block">
   	<h1 class="title">Ejecución de Tarea de Mantenimiento
   	 <?php
    if(count($tipo_vehiculo) >0){
    	echo $tipo_vehiculo['nombre'];
    }
    ?>   
   	</h1>
</div>
<div class="card">
	<div class="card-block">
		<form id="frmOrdenPlan" method="post" action="../guardar/" >
			<div class="row">	
				<div class="form-group  col-sm-12" align="right">
					<a href="../visualizarPdf/<?php echo $dato['id']?>" target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-file-pdf-o'></i>  Descargar</a>
				</div>
			</div>						
			<div class="row">	
				<div class="form-group  col-sm-4 border-div " align="center">
				  		<img src="<?php echo PATH_IMAGES; ?>/espoch.jpg" width="140px" height="130px"/>
				</div>				  	
				<div class="form-group  col-sm-4 border-div" align="center" style="height: 162px;">				
					<label class="control-label"><h3><?php echo $dato['marca'].' No.'.$dato['numero']?></h3></label><br>
					<label class="control-label"><?php echo $dato['vehiculo_nombre']?></label>
				</div>
				<div class="form-group  col-sm-4 border-div " align="center">
				  		<img src="<?php echo PATH_IMAGES; ?>/gobierno.jpg" width="130px" height="130px"/>
				</div>				
			</div>
			
			<div class="row match-my-cols">
				<div class="form-group  col-sm-4 border-div ">
					<label class="control-label">Frecuencia: </label>
					<div>
						<?php echo $dato['unidad_numero']?>	
					</div>
												
				</div>
				<div class="form-group  col-sm-4 border-div ">
					<label class="control-label">Tiempo Estimado: </label>
					<div>
					<?php echo $dato['tiempo_estimado']?>
					</div>
				</div>
				<div class="form-group  col-sm-4 border-div">
					<label class="control-label">Estado de la Vehículo/Maquinaria: </label>
					<div>
					<?php if ($dato['estado_maquina'] == 0){?>	
						Apagado
					<?php } else {?>
						Prendido
					<?php }?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group  col-sm-12 border-div">
					<label class="control-label">Actividad: </label>
					<div>
					<?php echo $dato['plan']?>
					</div>
				</div>
			</div>	
			<div class="row match-my-cols">
				<div class="form-group  col-sm-4 border-div">				
					<label class="control-label">Herramientas:</label>
					<div>
					<?php echo htmlspecialchars_decode($dato['herramientas']);?>	
					</div>				
				</div>				
				<div class="form-group  col-sm-4 border-div" >				
					<label class="control-label">Materiales:</label>
					<div>
					<?php echo htmlspecialchars_decode($dato['materiales']);?>
					</div>
				</div>				
				<div class="form-group  col-sm-4 border-div">				
					<label class="control-label">Equipo:</label>
					<div>
					<?php echo htmlspecialchars_decode($dato['equipo']);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group  col-sm-12 border-div">				
					<label class="control-label">Procedimiento:</label>
					<div>
					<?php echo htmlspecialchars_decode($dato['procedimiento']);?>	
					</div>				
				</div>
			</div>	
			<div class="row">
				<div class="form-group  col-sm-12 border-div">				
					<label class="control-label">Nota:</label>
					<div>
					<?php echo htmlspecialchars_decode($dato['observaciones']);?>	
					</div>				
				</div>
			</div>
						
			<div class="row match-my-cols" >
				<div class="form-group  col-sm-6 border-div">
					<label class="control-label">Tiempo Ejecución:</label>
					<?php if (($dato['atendido'] == 0)&&($ban==0)){?>
					<input type='text' name='tiempo_ejecucion' id='tiempo_ejecucion' class='form-control' value="">
					<?php } else { if($dato['atendido'] == 0){ echo "<div>Por Atender</div> "; } else {  echo "<div>".$dato['tiempo_ejecucion']."</div>"; }}?>						
				</div>
				<div class="form-group  col-sm-6 border-div cellMovil">
					<label class="control-label">T&eacute;cnico:</label>
					
					<?php echo "<div>".$dato['nombres']." ".$dato['apellidos']."</div> </br>"; ?>		
				</div>
			</div>
			<div class="row ">
				<div class="form-group  col-sm-12 border-div">
					<label class="control-label">Observación:</label>
					<?php if (($dato['atendido'] == 0)&&($ban==0)){?>
					<textarea name='observacion' id='observacion' class='form-control' ></textarea>
					<?php } else { echo "<div>".htmlspecialchars_decode($dato['observacion'])."</div> "; }?>
				</div>
			</div>
			<div class="row ">
				<div class="form-group  col-sm-6 border-div">
					<label class="control-label">Técnico Reparador:</label>
					<div>
						<?php echo $dato['nombre_repara']." ".$dato['apellido_repara'];?>
					</div>
				</div>
				<div class="form-group  col-sm-6 border-div">
					<label class="control-label">Técnico Supervisor:</label>
					<div>
						<?php echo $dato['nombre_repara']." ".$dato['apellido_repara'];?>
					</div>
				</div>
			</div>
			<?php if (($dato['atendido'] == 0)&&($ban==0)){?>
			<div class="form-group" style="margin-top: 15px;">
				<input type='hidden' name='id' class='form-control' value="<?php echo $dato['id']; ?>">
				<input type='hidden' name='tipo' class='form-control' value="<?php echo $dato['tipo_vehiculo_id']; ?>">
				<input type='hidden' name='kilometraje' class='form-control' value="<?php echo $dato['medida_uso']; ?>">
				<button type="submit" class="btn btn-success rounded">Guardar</button>
				<a href="../listar/<?php echo $dato['tipo_vehiculo_id'];?>" class="btn btn-info rounded"  >
			Regresar
		</a>
			</div>	
			<?php } else { ?>	
			<div class="form-group" style="margin-top: 15px;">
				<a href="../listar/<?php echo $dato['tipo_vehiculo_id'];?>" class="btn btn-info rounded"  >
			Regresar
		</a>
			</div>
			<?php } ?>		
		</form>
	</div>	
</div>	
<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
<link href="<?php echo PATH_CSS; ?>/equal-height-columns.css" rel="stylesheet">

<script type="text/javascript">
$(document).ready(function() {	
    $('#frmOrdenPlan').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
			tiempo_ejecucion: {
				message: 'El Tiempo de Ejecucion no es válido',
				validators: {
					notEmpty: {
						message: 'El Tiempo de Ejecucion no puede ser vacío.'
					},
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-\:]+$/,
						message: 'Ingrese un Tiempo de Ejecución válido.'
					}
				}
			},
			observacion: {
				message: 'La observación no es válida',
				validators: {												
					regexp: {
							regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
								message: 'Ingrese una Observación válida.'
					}
				}
			}
		}
	});
});
</script>
<style>
#frmItem .col-sm-6, #frmItem .col-sm-12 {
	padding-right: 0px;
	padding-left: 0px;
}
</style>