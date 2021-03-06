<form id="frmItem" method="post" action="../guardarReparar/" enctype="multipart/form-data">

	<div class="form-group  col-sm-12">
		<label class="control-label">Vehículo</label>
		<div id="texto"> <?php echo $item['marca'] ." ".$item['marca']. " No. ".$item['numero']; ?>
		</div>
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Tipo Falla</label>
		<div id="texto"> <?php echo $item['falla']; ?>
		</div>
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Detalle Problema</label>
		<div id="texto"> <?php echo $item['problema']; ?>
		</div>
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Causa</label>
		<div id="texto"> <?php echo $item['causa']; ?>
		</div>
	</div>	
	<div class="form-group  col-sm-12">
		<label class="control-label">Solución</label>
		<div id="texto"> <?php echo $item['solucion']; ?>
		</div>
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Falla T&eacute;cnica</label>
		<select class='form-control' name="tipo_falla_id" id="tipo_falla_id">
			<option value="" >Seleccione</option>
		<?php foreach ($fallas as $dato) { ?>
			<option value="<?php echo $dato['id'];?>" ><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group col-sm-12">	
		<label class="control-label">Proceso</label>
		<textarea name='proceso' id='proceso' class='form-control' ></textarea>	
			
	</div>
	
	<div class="form-group col-sm-12">	
		<label class="control-label">Elementos</label>
		<textarea name='elementos' id='elementos' class='form-control' ></textarea>		
			
	</div>
	<div class="form-group  col-sm-12">

		<label class="control-label">Tiempo ejecución</label>
		<input type='text'
			name='tiempo_ejecucion' id='tiempo_ejecucion' class='form-control'
			value="">

	</div>
	<div class="form-group col-sm-12">	
		<label class="control-label">Observación</label>
		<textarea name='observacion' id='observacion' class='form-control' ></textarea>	
		
	</div>
	
		
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item['ids']; ?>">
	<input type='hidden' name='tipo' class='form-control' value="<?php echo $item['tipo_vehiculo_id']; ?>">
		<button type="submit" class="btn btn-success rounded" id="saveReparar">Guardar</button>
	</div>

</form>

<script type="text/javascript">
$(document).ready(function() {

    $('#frmItem').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
			proceso: {
				message: 'El Proceso no es válido',
				validators: {	
					notEmpty: {
						message: 'El Proceso no puede ser vacío.'
					},												
							regexp: {
								regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
								message: 'Ingrese un proceso válido.'
							}
						}
					},
					tipo_falla_id: {
						validators: {
							notEmpty: {
								message: 'Seleccione una Falla'
							}
						}
					},		
					elementos: {
						message: 'Los Elementos no son válidos',
						validators: {	
							notEmpty: {
								message: 'La Causa no puede ser vacía.'
							},												
									regexp: {
										regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
										message: 'Ingrese los Elementos válidos.'
									}
								}
							},
							observacion: {
								message: 'La observación no es válido',
								validators: {												
											regexp: {
												regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
												message: 'Ingrese una Observación válida.'
											}
										}
									},
									tiempo_ejecucion: {
										message: 'El Tiempo de Ejecucion no es válido',
										validators: {
											notEmpty: {
												message: 'El Tiempo de Ejecucion no puede ser vacío.'
											},					
											regexp: {
												regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-\:]+$/,
												message: 'Ingrese un Tiempo de Ejecucion válido.'
											}
										}
									},
			
		}
	});
});
</script>
