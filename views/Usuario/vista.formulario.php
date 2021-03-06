<form id="frmUsuario" method="post" action="../guardar/">

<div class="row">


	<div class="form-group col-sm-6">
		<label class="control-label">Número de Identificación</label> <input type='text'
			name='identificacion' class='form-control'
			value="<?php echo $usuario['identificacion']; ?>">

	</div>
	
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Nombres</label> <input type='text'
			name='nombres' class='form-control'
			value="<?php echo $usuario['nombres']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Apellidos</label> <input type='text'
			name='apellidos' class='form-control'
			value="<?php echo $usuario['apellidos']; ?>">

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Dirección</label> <input type='text'
			name='direccion' class='form-control'
			value="<?php echo $usuario['direccion']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Email</label>
		<input type='text'
			name='email' class='form-control'
			value="<?php echo $usuario['email']; ?>">

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Teléfono</label>
		<input type='text'
			name='telefono' class='form-control'
			value="<?php echo $usuario['telefono']; ?>">

	</div>
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Celular</label>
		<input type='text'
			name='celular' class='form-control'
			value="<?php echo $usuario['celular']; ?>">

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Contraseña</label>
		<input type="password"
			name='password' class='form-control'
			value="<?php echo $usuario['password']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Repetir Contraseña</label>
		<input type="password"
			name='password1' class='form-control'
			value="<?php echo $usuario['password1']; ?>">

	</div>
</div>

	<div class="form-group">
	<input type='hidden' name='id' value="<?php echo $usuario['id']; ?>">
	<input type='hidden' name='tipo_usuario_id' value="<?php echo $tipo; ?>">
		<button type="submit" class="btn btn-success rounded">Guardar</button>
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
			identificacion: {
				message: 'El Número de Identificación no es válido',
				validators: {
							notEmpty: {
								message: 'El Número de Identificación no puede ser vacío.'
							},					
							regexp: {
								regexp: /^(?:\+)?\d{10,13}$/,
								message: 'Ingrese un Número de Identificación válido.'
							}
						}
					},
			nombres: {
				message: 'Los Nombres no es válido',
				validators: {
					notEmpty: {
						message: 'El Nombre no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ \.]+$/,
						message: 'Ingrese un Nombre válido.'
					}
				}
			},
			apellidos: {
				message: 'El Apellido no es válido',
				validators: {
					notEmpty: {
						message: 'El Apellido no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ \.]+$/,
						message: 'Ingrese un Apellido válido.'
					}
				}
			},
			telefono: {
				message: 'El Número de Teléfono no es válido',
				validators: {
												
							regexp: {
								regexp: /^(?:\+)?\d{9}$/,
								message: 'Ingrese un Número de Teléfono válido.'
							}
						}
				
			},
			tipo_usuario_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Tipo de Usuario'
					}
				}
			},
			celular: {
				message: 'El Celular de Teléfono no es válido',
				validators: {
												
							regexp: {
								regexp: /^(?:\+)?\d{10}$/,
								message: 'Ingrese un Número de Celular válido.'
							}
						}
				
			},	
			direccion: {
				message: 'La Dirección no es válida',
				validators: {
					notEmpty: {
						message: 'La Dirección no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ ,-\.]+$/,
						message: 'Ingrese una Dirección válido.'
					}
				}
			},	
			usuario: {
				message: 'El Usuario no es válido',
				validators: {
					notEmpty: {
						message: 'El Usuario no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ -\.]+$/,
						message: 'Ingrese un Usuario válido.'
					}
				}
			},	
			password: {
				message: 'La Contraseña no es válida',
				validators: {
					notEmpty: {
						message: 'La Contraseña no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
						message: 'Ingrese una Contraseña válida.'
					}
				}
			},
			password1: {
				validators: {
					notEmpty: {
						message: 'La contraseña no puede ser vacia.'
					},
					identical: {
						field: 'password',
						message: 'La contraseña debe ser la misma'
					}
				}
			},
			email: {
				message: 'El eEmail no es válido',
				validators: {
					
					emailAddress: {
						message: 'Ingrese un Email válido.'
					}
				}
			}
		}
	});

});
</script>
<style>
.col-sm-6, .col-sm-12 {
	padding-right: 0px;
}
</style>