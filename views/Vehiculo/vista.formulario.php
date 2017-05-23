<form id="frmUsuario" method="post" action="../guardar/">

<div class="row">

	<div class="form-group  col-sm-6">
		<label class="control-label">Categoría</label>
		<select class='form-control' name="categoria_id">
			<option value="" >Seleccione</option>
		<?php foreach ($categorias as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['categoria_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group  col-sm-6">
		<label class="control-label">Clase</label>
		<select class='form-control' name="clase_id">
			<option value="" >Seleccione</option>
		<?php foreach ($clases as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['clase_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
	
</div>
<div class="row">
	<div class="form-group  col-sm-6">
		<label class="control-label">Tipo</label>
		<select class='form-control' name="tipo_vehiculo_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tipos as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['tipo_vehiculo_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group  col-sm-6">
		<label class="control-label">Conductor</label>
		<select class='form-control' name="usuario_id">
			<option value="" >Seleccione</option>
		<?php foreach ($usuarios as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['usuario_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombres']." ".$dato['apellidos'];?></option>
		<?php }?>
		</select>

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Número</label> <input type='text'
			name='numero' class='form-control'
			value="<?php echo $vehiculo['numero']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Placa</label> <input type='text'
			name='placa' class='form-control'
			value="<?php echo $vehiculo['placa']; ?>">

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Marca</label>
		<input type='text'
			name='marca' class='form-control'
			value="<?php echo $vehiculo['marca']; ?>">

	</div>
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Modelo</label>
		<input type='text'
			name='modelo' class='form-control'
			value="<?php echo $vehiculo['modelo']; ?>">

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Número Motor</label>
		<input type='text'
			name='numero_motor' class='form-control'
			value="<?php echo $vehiculo['numero_motor']; ?>">

	</div>
	
	<div class="form-group  col-sm-6">
		<label class="control-label">Número Chasis</label>
		<input type='text'
			name='numero_chasis' class='form-control'
			value="<?php echo $vehiculo['numero_chasis']; ?>">

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-4">
		<label class="control-label">Año Fabricación</label>
		<input type='text'
			name='anio' class='form-control'
			value="<?php echo $vehiculo['anio']; ?>">

	</div>
	
	<div class="form-group  col-sm-4">
		<label class="control-label">Kilometraje / Horas</label>
		<input type='text'
			name='medida_uso' class='form-control'
			value="<?php echo $vehiculo['medida_uso']; ?>">

	</div>
	<div class="form-group  col-sm-4">
		<label class="control-label">Estado</label>
		<select class='form-control' name="estado_vehiculo_id">
			<option value="" >Seleccione</option>
		<?php foreach ($estados as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['estado_vehiculo_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
</div>


	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $usuario['id']; ?>">
		<button type="submit" class="btn btn-success rounded">Guardar</button>
	</div>

</form>

<script type="text/javascript">

$(document).ready(function() {
    $('#frmUsuario').bootstrapValidator({
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