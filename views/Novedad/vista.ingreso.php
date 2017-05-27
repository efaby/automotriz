<?php $title = "Planes Mantenimiento";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-12">
    	<h1 class="page-header">Registro Novedad</h1>
   	</div>
</div>
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
<div class="alert alert-success fade in alert-dismissable">
	<button type="button" class="close" data-dismiss="alert"aria-hidden="true">&times;</button>
		<?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
</div>
<?php endif;?>
<div class="row">	
<form id="frmItem" method="post" action="../guardar/" >
	<div class="form-group  col-sm-12">
		<div class="form-group  col-sm-6">
			<label class="control-label">Vehículo/Maquinaria</label>
			<select class='form-control' name="vehiculo_id" id="vehiculo_id">
				<option value="" >Seleccione</option>
				<?php foreach ($vehiculos as $dato) { ?>
				<option value="<?php echo $dato['id'];?>"  ><?php echo $dato['nombre'];?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6">
			<label class="control-label">Problema</label>
			<textarea name='problema' id='problema' class='form-control' ></textarea>	
		</div>		
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6">
			<label class="control-label">Causa</label>
			<textarea name='causa' id='causa' class='form-control' ></textarea>		
		</div>	
	</div>	
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6">
			<label class="control-label">Solución</label>
			<textarea name='solucion' id='solucion' class='form-control' ></textarea>	
		</div>		
	</div>	
	<div class="form-group">
		<input type='hidden' name='id' class='form-control' value="">
		<button type="submit" class="btn btn-success">Guardar</button>
	</div>
</form>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

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
			vehiculo_id: {
				validators: {
					notEmpty: {
						message: 'Seleccione un Vehículo/Maquinaria'
					}
				}
			},			
			
			problema: {
				message: 'El Problema no es válido',
				validators: {	
					notEmpty: {
						message: 'El Problema no puede ser vacío.'
					},												
							regexp: {
								regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
								message: 'Ingrese un problema válido.'
							}
						}
					},	
			causa: {
				message: 'La Causa no es válida',
			    validators: {	
							notEmpty: {
								message: 'La Causa no puede ser vacía.'
							},												
									regexp: {
										regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
										message: 'Ingrese una Causa válida.'
									}
								}
							},
							solucion: {
								message: 'La Solución no es válido',
								validators: {												
											regexp: {
												regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
												message: 'Ingrese una Solución válida.'
											}
										}
									},
									laboratorio_id: {
														validators: {
															notEmpty: {
																message: 'Seleccione un Laboratorio'
															}
														}
													},
		}
	});
});
</script>


</body>
</html>