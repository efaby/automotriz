<?php $title = "Planes Mantenimiento";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>
<div class="title-block">
    <h1 class="title"> Plan de Mantenimiento <?php echo $tipoArray['nombre']; ?></h1>
</div>
<div class="card">
	<div class="card-block">
		<div class="row">
		<form id="frmItem" method="post" action="../guardar/">
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Actividad</label>
				<input type='text'
					name='tarea' class='form-control'
					value="<?php echo $item['tarea']; ?>">
			</div>
		</div>
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Tiempo Ejecución</label>
				<input type='text'
					name='tiempo_ejecucion' class='form-control'
					value="<?php echo $item['tiempo_ejecucion']; ?>">
			</div>
		</div>
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Técnico</label>
				<select class='form-control' name="tecnico_id" id="tecnico_id">
					<option value="" >Seleccione</option>
				<?php
				foreach ($tecnicos as $dato) { ?>
					<option value="<?php echo $dato['id'];?>" <?php if($item['tecnico_id']==$dato['id']):echo "selected"; endif;?> ><?php echo $dato['nombres'].' '.$dato['apellidos'];?></option>
				<?php }?>
				</select>
			</div>
		</div>
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Equipos</label>
				<textarea name='equipo' id='equipo' class='form-control' ><?php echo $item['equipo']; ?></textarea>	
			</div>
		</div>
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Estado Máquina</label><br>
				<label> <input type="radio" name="estado_maquina" value="0" <?php echo ((int)$item['estado_maquina'] === 0)?'checked':''; ?>>Apagada</label>
				 <label> <input type="radio" name="estado_maquina"value="1" <?php echo ((int)$item['estado_maquina'] === 1)?'checked':''; ?>> Encendida</label>
			</div>
		</div>			
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-2 row-padding">
				<label class="control-label">Aplicar Mantenimiento cada:</label>
				<input type='text' name='unidad_numero' class='form-control' value="<?php echo $item['unidad_numero']; ?>">
			</div>
			<div class="form-group  col-sm-1 row-padding">	
				<br><br>
				<?php if ($tipo <4){ ?>
				<b>Kilometros</b>
				<input type='hidden' name='unidad_id' class='form-control' value="1">
				<?php }else{ ?>
				<b>Horas</b>
				<input type='hidden' name='unidad_id' class='form-control' value="2">
				<?php } ?>
			</div>
			<div class="form-group col-sm-2 row-padding">
				<label class="control-label">Alertar cada:</label>
				<input type='text'	name='alerta_numero' class='form-control' value="<?php echo $item['alerta_numero']; ?>">
			</div>
			<div class="form-group col-sm-2 row-padding">
				<br><br><b>
					<?php if ($tipo <4){ ?>
						Kilometros							
					<?php }else{ ?>
						Horas
					<?php } ?>
					 Antes</b>				
			</div>
		</div>
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Materiales</label>
				<textarea name="materiales" id="materiales" rows="10" cols="60">
		        	<?php echo $item['materiales']; ?>
		        </textarea>					
			</div>
		</div>	
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Herramientas</label>
				<textarea name="herramientas" id="herramientas" rows="10" cols="60">
		        	<?php echo $item['herramientas']; ?>
		        </textarea>					
			</div>
		</div>	
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Procedimiento</label>
			 	<textarea name="procedimiento" id="procedimiento" rows="10" cols="60">
		        	<?php echo $item['procedimiento']; ?>
		        </textarea>
			</div>
		</div>	
		<div class="form-group  col-sm-12">
			<div class="form-group  col-sm-6 row-padding">
				<label class="control-label">Nota</label>
				<textarea name="observaciones" id="observaciones" rows="10" cols="60">
		        	<?php echo $item['observaciones']; ?>
		        </textarea>
			</div>
		</div>
		<div class="form-group col-sm-12">
			<input type='hidden' name='id' class='form-control' value="<?php echo $item['id']; ?>">
			<input type='hidden' name='tipo' class='form-control' value="<?php echo $tipo; ?>">
			<button type="submit" class="btn btn-success rounded">Guardar</button>	
		</div>
		</form>
		</div>
	</div>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>  
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>  
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script src="<?php echo PATH_JS; ?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo PATH_JS; ?>/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#frmItem').formValidation({
    	message: 'This value is not valid',
    	excluded: [':disabled'],
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
        	tarea: {
				message: 'La Tarea no es válida',
				validators: {
					notEmpty: {
						message: 'La Tarea no puede ser vacía.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
						message: 'Ingrese una La Tarea válida.'
					}
				}
			},
			tecnico_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Técnico'
					}
				}
			},
			estado_maquina: {
                validators: {
                    notEmpty: {
                        message: 'El Estado de la Máquina no puede ser vacío.'
                    }
                }
            },
			tiempo_ejecucion: {
				message: 'El Tiempo de Ejecución no es válido',
				validators: {
					notEmpty: {
						message: 'El Tiempo de Ejecución no puede ser vacío.'
					},					
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-\:]+$/,
						message: 'Ingrese un Tiempo de Ejecución válido.'
					}
				}
			},
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
			equipo: {
				message: 'El Equipo no es válido.',
	 			validators: {	
					regexp: {
						regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-\,]+$/,
						message: 'Ingrese un Equipo válido.'
					}
				}
			},
			procedimiento: {
                validators: {
                    notEmpty: {
                        message: 'El Procedimiento no puede ser vacío.'
                    },
                    
                }
            },
            observaciones: {
                validators: {
                    notEmpty: {
                        message: 'La nota no puede ser vacía.'
                    },
                    
                }
            },
            herramientas: {
				message: 'Las Herramientas no son válidas.',
				validators: {	
					notEmpty: {
						message: 'Las Herramientas no pueden ser vacías.'
					}
				}
			},
			materiales: {
				message: 'Los Materiales no son válidos.',
				validators: {	
					notEmpty: {
						message: 'Los Materiales no pueden ser vacíos.'
					}
				}
			}
		}
	}).find('[name="procedimiento"], [name="observaciones"], [name="herramientas"], [name="materiales"]')
    .each(function() {
        $(this)
            // Attach an editor to field
            .ckeditor()
            .editor
                .on('change', function(e) {
                    // Revalidate the field that
                    // the current editor is attached to
                    // e.sender.name presents the field name
                    $('#frmItem').formValidation('revalidateField', e.sender.name);
                });
    });
        ;
});


</script>
<style>
.col-sm-6, .col-sm-12 {
	padding-right: 0px;
}
</style>
</body>
</html>
