<?php $title = "Orden Plan";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<div class="title-block">
   	<h1 class="title">Ejecución de Tarea de Mantenimiento</h1>
</div>
<div class="card">
	<div class="card-block">
		<form id="frmOrdenPlan" method="post" action="../guardar/" >
			<div class="row">	
				<div class="form-group  col-sm-12" align="center">				
					<label class="control-label"><h3><?php echo $dato['marca'].' No.'.$dato['numero']?></h3></label><br>
					<label class="control-label"><?php echo $dato['vehiculo_nombre']?></label>
				</div>				
			</div>
			
			<div class="row">
				<div class="form-group  col-sm-4">
					<label class="control-label">Frecuencia: </label><?php echo $dato['unidad_numero']?>									
				</div>
				<div class="form-group  col-sm-4">
					<label class="control-label">Tiempo Estimado: </label><?php echo $dato['tiempo_estimado']?>
				</div>
				<div class="form-group  col-sm-4">
					<label class="control-label">Estado de la Vehículo/Maquinaria: </label>
					<?php if ($dato['atendido'] == 0){?>	
						Por Atender
					<?php } else {?>
						Atendido
					<?php }?>
				</div>
			</div>
			<div class="row">
				<div class="form-group  col-sm-12">
					<br><br>
					<label class="control-label">Plan de Mantenimiento: </label><?php echo $dato['plan']?>
				</div>
			</div>	
			<div class="row">
				<div class="form-group  col-sm-4">				
					<label class="control-label">Herramientas:</label><br>
					<?php echo htmlspecialchars_decode($dato['herramientas']);?>					
				</div>				
				<div class="form-group  col-sm-4">				
					<label class="control-label">Materiales:</label><br>
					<?php echo htmlspecialchars_decode($dato['materiales']);?>
				</div>				
				<div class="form-group  col-sm-4">				
					<label class="control-label">Equipo:</label><br>
					<?php echo htmlspecialchars_decode($dato['equipo']);?>
				</div>
			</div>
			<div class="row">
				<div class="form-group  col-sm-12">				
					<label class="control-label">Observaciones:</label><br>
					<?php echo htmlspecialchars_decode($dato['observaciones']);?>					
				</div>
			</div>		
			<div class="row">
				<div class="form-group  col-sm-6">
					<label class="control-label">Tiempo Ejecución:</label>
					<?php if ($dato['atendido'] == 0){?>
					<input type='text' name='tiempo_ejecucion' id='tiempo_ejecucion' class='form-control' value="">
					<?php } else { echo $dato['tiempo_ejecucion']; }?>						
				</div>
			</div>
			<div class="row">
				<div class="form-group  col-sm-6">
					<label class="control-label">Observación:</label>
					<?php if ($dato['atendido'] == 0){?>
					<textarea name='observacion' id='observacion' class='form-control' ></textarea>
					<?php } else { echo htmlspecialchars_decode($dato['observacion']); }?>
				</div>
			</div>
			<?php if ($dato['atendido'] == 0){?>
			<div class="form-group">
				<input type='hidden' name='id' class='form-control' value="<?php echo $dato['id']; ?>">
				<button type="submit" class="btn btn-success rounded">Guardar</button>
			</div>	
			<?php }?>		
		</form>
	</div>	
</div>	
</form>

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
						regexp: /^[0-9]+$/,
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