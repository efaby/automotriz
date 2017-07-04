<form id="frmUsuario" method="post" action="../guardarOrdenRepuesto/">

<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Repuesto</label> 
		
		<select class='form-control' name="repuesto_id" id="repuesto_id">
			<option value="" >Seleccione</option>
		<?php foreach ($repuestos as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($tipo['repuesto_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Cantidad</label> <input type='text'
			name='cantidad' class='form-control'
			value="<?php echo $tipo['cantidad']; ?>">

	</div>
</div>

<div class="row">
	<div class="form-group col-sm-6">
	<input type='hidden' name='id' value="<?php echo $tipo['id']; ?>"> 
	<input type='hidden' name='item_id' value="<?php echo $mant; ?>"> 
		<button type="submit" class="btn btn-success rounded">Guardar</button>
	</div>
</div>
</form>

<script type="text/javascript">

$(document).ready(function() {
    $('#frmUsuario').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			

			repuesto_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Repuesto'
					}
				}
			},
			cantidad: {
				validators: {
					notEmpty: {
						message: 'La cantidad no puede ser vacía.'
					},
					regexp: {
						regexp: /^[0-9]+$/,
						message: 'La cantidad dese se número válido.'
					}	
				}
			},	
			
					
		}
	});

});
</script>
<style>
.col-sm-6, .col-sm-12 {
	padding-right: 0px;
}
</style>