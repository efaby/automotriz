<form id="frmItem" method="post" action="../guardar/">
	<div class="form-group  col-sm-12">
		<label class="control-label">Plan de Mantenimiento</label>
		<select class='form-control' name="plan_mantenimiento_id">
			<option value="" >Seleccione</option>
		<?php foreach ($planes as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($item['plan_mantenimiento_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['tarea'];?></option>
		<?php }?>
		</select>

	</div>

	<div class="form-group  col-sm-12">
		<label class="control-label">Aplicar Mantenimiento cada:</label>
		<div class="form-group  col-sm-12" style="margin-bottom: 0px">
			<div class="form-group  col-sm-4" style="margin-bottom: 0px">
			<input type='text'
			name='unidad_numero' class='form-control'
			value="<?php echo $item['unidad_numero']; ?>">
			</div>
		<div class="form-group  col-sm-8">
		<h5><b><?php echo $unidad[0]['nombre']; ?> </b></h5>
		</div>
	</div>
	</div>
	
	<div class="form-group  col-sm-12">
		<label class="control-label">Alertar cada:</label>
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-4">
			<input type='text'
			name='alerta_numero' class='form-control'
			value="<?php echo $item['alerta_numero']; ?>">
			</div>
			<div class="form-group  col-sm-8">
			<label class="control-label" id="antes">
				<h5><b><?php echo $unidad[0]['nombre']; ?> Antes</b></h5>
			</label>
		</div>
	</div>
	</div>

	
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item['id']; ?>">
	<input type='hidden' name='vehiculo_id' class='form-control' value="<?php echo $vehiculo_id; ?>">
	<input type='hidden' name='unidad_id' class='form-control' value="<?php echo $unidad[0]['id']; ?>">
		<button type="submit" class="btn btn-success">Guardar</button>
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
			unidad_numero: {
				message: 'El valor ingresado no es válido',
				validators: {
					notEmpty: {
						message: 'El valor ingresado no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un valor válido.'
					}
				}
			},
			alerta_numero: {
				message: 'El valor de la alerta no es válido',
				validators: {
					notEmpty: {
						message: 'El valor de la alerta no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un valor de la alerta válido.'
					},
					between: {
                         min: 0,
                         max: 'unidad_numero',
                         message: 'La alerta no puede ser mayor al valor de mantenimiento'
                     }
				}
			},
			plan_mantenimiento_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Plan'
					}
				}
			},
			
			
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