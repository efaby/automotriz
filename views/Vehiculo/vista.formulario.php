<form id="frmVehiculo" method="post" action="../guardar/">

<div class="row">

	<div class="form-group  col-sm-6">
		<label class="control-label">Categoría</label>
		<select class='form-control' name="categoria_id" id="categoria_id">
			<option value="" >Seleccione</option>
		<?php foreach ($categorias as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['categoria_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group  col-sm-6">
		<label class="control-label">Clase</label>
		<select class='form-control' name="clase_id" id="clase_id">
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
		<select class='form-control' name="tipo_vehiculo_id" id="tipo_vehiculo_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tipos as $dato) { ?>
			<option value="<?php echo $dato['id'];?>"  <?php if($vehiculo['tipo_vehiculo_id']==$dato['id']):echo "selected"; endif;?>><?php echo $dato['nombre'];?></option>
		<?php }?>
		</select>

	</div>
	<div class="form-group  col-sm-6">
		<label class="control-label">Conductor</label>
		<select class='form-control' name="usuario_id" id="usuario_id">
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
	<input type='hidden' name='id' class='form-control' value="<?php echo $vehiculo['id']; ?>">
		<button type="submit" class="btn btn-success rounded">Guardar</button>
	</div>

</form>

<script type="text/javascript">

$(document).ready(function() {

	$("#categoria_id").change(function () {
        $("#categoria_id option:selected").each(function () {
	        opcion=$(this).val();
	        $.post("../loadTipoVehiculo/", { opcion: opcion }, function(data){
	        	$("#clase_id").html(data);
	        	$("#tipo_vehiculo_id").html('<option value="" >Seleccione</option>');
	        });  

	        $.post("../loadConductorVehiculo/", { opcion: opcion }, function(data){
	        	$("#usuario_id").html(data);
	        });          
     });
	});

	$("#clase_id").change(function () {
        $("#clase_id option:selected").each(function () {
	        opcion=$(this).val();
	        $.post("../loadTipoVehiculo/", { opcion: opcion }, function(data){
	        	$("#tipo_vehiculo_id").html(data);
	        });            
     });
	});


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
						message: 'Seleccione un Conductor'
					}
				}
			},
			categoria_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione una Categoría'
					}
				}
			},
			clase_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione una Clase'
					}
				}
			},
			tipo_vehiculo_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Tipo'
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
					notEmpty: {
						message: 'La Placa no puede ser vacía.'
					},					
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
			modelo: {
				message: 'El Modelo no es válido',
				validators: {
					notEmpty: {
						message: 'El Modelo no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9_ -\.]+$/,
						message: 'Ingrese un Modelo válido.'
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
				message: 'El  Kilometraje / Horas no es válido',
				validators: {
					notEmpty: {
						message: 'El Kilometraje / Horas no puede ser vacío.'
					},					
					regexp: {
						regexp: /^\d*$/,
						message: 'Ingrese un Kilometraje / Horas válido.'
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