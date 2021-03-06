<form id="frmVehiculo" method="post" action="../guardar/" enctype="multipart/form-data">


<div class="row">
	<div class="form-group  col-sm-6">
		<label class="control-label"><?php if(($tipo<=3)||($tipo>=9)): $title1 = "Conductor"; ?>Conductor<?php else: $title1 = "Operador";?> Operador <?php endif;?></label>
		<select class='form-control' name="usuario_id" id="usuario_id">
			<option value="" >Seleccione</option>
		<?php foreach ($usuarios as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['usuario_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombres']." ".$dato['apellidos'];?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Marca</label>
		<input type='text'
			name='marca' class='form-control'
			value="<?php echo $vehiculo['marca']; ?>">
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Modelo</label>
		<input type='text'
			name='modelo' class='form-control'
			value="<?php echo $vehiculo['modelo']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Número</label> <input type='text'
			name='numero' class='form-control'
			value="<?php echo $vehiculo['numero']; ?>">

	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="control-label">Placa</label> <input type='text'
			name='placa' class='form-control'
			value="<?php echo $vehiculo['placa']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Número Motor</label>
		<input type='text'
			name='numero_motor' class='form-control'
			value="<?php echo $vehiculo['numero_motor']; ?>">

	</div>
</div>
<div class="row">	
	<div class="form-group  col-sm-6">
		<label class="control-label">Número Chasis</label>
		<input type='text'
			name='numero_chasis' class='form-control'
			value="<?php echo $vehiculo['numero_chasis']; ?>">

	</div>
	<div class="form-group col-sm-6">
		<label class="control-label">Año Fabricación</label>
		<input type='text'
			name='anio' class='form-control'
			value="<?php echo $vehiculo['anio']; ?>">
	</div>
</div>
<div class="row">	
	<div class="form-group  col-sm-6">
		<label class="control-label"><?php echo $medida; ?></label>
		<input type='text'
			name='medida_uso' class='form-control'
			value="<?php echo $vehiculo['medida_uso']; ?>">

	</div>
	<div class="form-group  col-sm-6">
		<label class="control-label">Estado</label>
		<select class='form-control' name="estado_vehiculo_id">
			<option value="" >Seleccione</option>
		<?php foreach ($estados as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['estado_vehiculo_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
</div>	
<div class="row">
	<div class="form-group  col-sm-6">
			<label class="control-label">Fotografía del Vehículo</label> 			
			<?php if($vehiculo['url'] != ''):?>
				<input type='file' name='url1' id="url1" class="file">		
				<br>
				<img src="<?php echo PATH_IMAGES."/../files/".$vehiculo['url'];?>" height="150px">
				<input type="hidden" name="fileName" value="<?php echo $vehiculo['url'];?>">
			<?php else :?>
				<input type='file' name='url' id="url" class="file">	
			<?php endif;?>
	</div>	
</div>


	<div class="form-group">
	<input type='hidden' name='id' value="<?php echo $vehiculo['id']; ?>">
	<input type='hidden' name='tipo_vehiculo_id' value="<?php echo $tipo; ?>">
	<input type='hidden' name='conductor' value="<?php echo $vehiculo['usuario_id']; ?>">
		<button type="submit" class="btn btn-success rounded">Guardar</button>
	</div>

</form>

<script type="text/javascript">

$(document).ready(function() {

	

    $('#frmVehiculo').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {	
			usuario_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un <?php echo $title1; ?>'
					}
				}
			},
			estado_vehiculo_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Estado'
					}
				}
			},			
			placa: {
				message: 'La Placa no es válida',
				validators: {
					<?php if($tipo<=3):?>
					notEmpty: {
						message: 'La Placa no puede ser vacía.'
					},	
					<?php endif;?>				
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-]+$/,
						message: 'Ingrese una Placa válida.'
					}
				}
			},	
			numero_motor: {
				message: 'El Número de Motor no es válido',
				validators: {
					notEmpty: {
						message: 'El Número de Motor no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-]+$/,
						message: 'Ingrese un Número de Motor válido.'
					}
				}
			},
			numero_chasis: {
				message: 'El Número de Chasis no es válido',
				validators: {
					notEmpty: {
						message: 'El Número de Chasis no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ -\.]+$/,
						message: 'Ingrese un Número de Chasis válido.'
					}
				}
			},			
			marca: {
				message: 'La Marca no es válida',
				validators: {
					notEmpty: {
						message: 'La Marca no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ -\.]+$/,
						message: 'Ingrese una Marca válida.'
					}
				}
			},
			modelo: {
				message: 'El modelo no es válida',
				validators: {
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ -\.]+$/,
						message: 'Ingrese un Modelo válido.'
					}
				}
			},			
			numero: {
				message: 'El Número no es válido',
				validators: {
					notEmpty: {
						message: 'El Número no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un Número válido.'
					}
				}
			},	
			anio: {
				message: 'El Año no es válido',
				validators: {
					notEmpty: {
						message: 'El Año no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un Año válido.'
					}
				}
			},	
			medida_uso: {
				message: '<?php echo $medida; ?> no es válido',
				validators: {
					notEmpty: {
						message: '<?php echo $medida; ?> no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese <?php echo $medida; ?> que sean válidos.'
					}
				}
			},
			url: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Archivo.'
					},
					file: {
	                    extension: 'jpg,png',
	                    message: 'Seleccione un archivo válido. (jpg,png)'
	                }
				}
			},
			url1: {
				validators: {							
					file: {
	                    extension: 'jpg,png',
	                    message: 'Seleccione un archivo válido. (jpg,png)'
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