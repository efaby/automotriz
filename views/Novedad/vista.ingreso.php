<?php $title = "Planes Mantenimiento";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="title-block">
    <h1 class="title"> Registro Novedad</h1>
</div>

<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
<div class="alert alert-success fade in alert-dismissable">
	<button type="button" class="close" data-dismiss="alert"aria-hidden="true">&times;</button>
		<?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
</div>
<?php endif;?>
<div class="card">
	<div class="card-block">
<div class="row">	
<form id="frmItem" method="post" action="../guardar/" >
	<div class="form-group  col-sm-12">
		<div class="form-group  col-sm-6 row-padding">
			<label class="control-label">Vehículo/Maquinaria</label>
			<select class='form-control' name="vehiculo_id" id="vehiculo_id">
				<option value="" >Seleccione</option>
				<?php foreach ($vehiculos as $dato) { ?>
				<option value="<?php echo $dato['id'];?>"  ><?php echo $dato['nombre'] ." " .$dato['marca'] ." No. " .$dato['numero'];?></option>
				<?php }?>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6 row-padding">
			<label class="control-label" id="label"> Medida				
			</label> 
			<input type='text' id='numero_ingreso' name='numero_ingreso' class='form-control' value="">					
		</div>	
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6 row-padding" >
			<label class="control-label">Detalle Problema</label>
			<textarea name='problema' id='problema' class='form-control' ></textarea>	
		</div>		
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6 row-padding">
			<label class="control-label">Causa</label>
			<textarea name='causa' id='causa' class='form-control' ></textarea>		
		</div>	
	</div>	
	
	<div class="form-group col-sm-12">
		<input type='hidden' name='id' class='form-control' value="">
		<input type='hidden' name='valor' id="valor" value="0">
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

<script type="text/javascript">
$(document).ready(function() {


	$('#vehiculo_id').change(function(){
		$("#vehiculo_id option:selected").each(function () {
	         opcion=$(this).val();
	         $.post("../obtenerVehiculo/", { id: opcion }, function(data){
		         var result = JSON.parse(data);
		         $("#label").html(""); 
		         $("#label").html("Kilometros");  	
		         if(result.tipo>=4 && result.tipo <= 8){
		        	 $("#label").html("Horas");  	
		         }
		         $("#numero_ingreso").val(result.medida);  	
	         	$("#valor").val(result.medida);
	         	
	         });            
	     });
	});

	
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
			numero_ingreso: {
				validators: {
					notEmpty: {
						message: 'El número de ingreso no puede ser vacío.'
					},
					regexp: {
						regexp: /^[0-9]+$/,
						message: 'Ingrese un número válido.'
					},
					between: {
                        min: 'valor',
                        max: 1000000,
                        message: 'El valor ingresado no puede ser menor que el valor Actual.'
                    }
	
				}
			},		
			problema: {
				message: 'El Problema no es válido',				
				validators: {	notEmpty: {
					 message: 'El Problemao es requerido y no puede ser vacio'
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
																		
									regexp: {
										regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 \.\,\_\-]+$/,
										message: 'Ingrese una Causa válida.'
									}
								}
							},
		}
	});
});
</script>


</body>
</html>