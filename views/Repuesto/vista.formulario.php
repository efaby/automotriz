<form id="frmUsuario" method="post" action="../guardar/">

<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">C&oacute;digo</label> <input type='text'
			name='codigo' class='form-control'
			value="<?php echo $tipo['codigo']; ?>">

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Nombre</label> <input type='text'
			name='nombre' class='form-control'
			value="<?php echo $tipo['nombre']; ?>">

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

			nombre: {
				message: 'El Nombre no es válido',
				validators: {
					notEmpty: {
						message: 'El Nombre no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
						message: 'Ingrese un Nombre válido.'
					}
				}
			},
			codigo: {
				message: 'El Código no es válido',
				validators: {
					notEmpty: {
						message: 'El Código no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
						message: 'Ingrese un Código válido.'
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