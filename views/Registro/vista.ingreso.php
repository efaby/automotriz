<?php $title = "Registro";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="title-block">
    <h1 class="title"> Registro <?php if (($vehiculos[0]['plan'] < 4)||($vehiculos[0]['plan'] > 8)){ ?>  Odometro - Kilometraje <?php } else { ?> Hormotero - Horas<?php }?></h1>
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
		<div class="form-group  col-sm-6 row-padding" >
			<label class="control-label">Fecha de Registro</label>		
			<input type='text'
			name='fecha_registro' id='fecha_registro' class='form-control'
			value="">		
		</div>		
	</div>
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6 row-padding">
		<label class="control-label" id="kilometros">		
		</label> <br>
			<label class="control-label">
				<?php if (($vehiculos[0]['plan'] < 4)||($vehiculos[0]['plan'] > 8)){ ?> 
					Kilometros					
				<?php $texto = "Kilometros"; } else {?>
					Horas	
				<?php $texto = "Horas"; } ?>
			</label> 
			<input type='text' id='numero_ingreso' name='numero_ingreso' class='form-control' value="">					
		</div>	
	</div>	
	
	<div class="form-group col-sm-12">
		<input type='hidden' name='tipo' class='form-control' value="<?php echo $vehiculos[0]['plan'];?>">
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
<script src="<?php echo PATH_JS; ?>/jquery-ui.min.js"></script>
<script src="<?php echo PATH_JS; ?>/calendar.js"></script>	
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/jquery-ui.min.css">


<script type="text/javascript">
$(document).ready(function() {
	jQuery( "#fecha_registro" ).datepicker({  
		dateFormat: "yy-mm-dd",
		maxDate: new Date(),
		onClose: function(selectedDate) {
	        $( "#datepicker" ).datepicker( "option", "minDate", selectedDate );
	        $('#frmItem').formValidation('revalidateField', 'fecha_registro');
	      }  		
	});

	$('#vehiculo_id').change(function(){
		$("#vehiculo_id option:selected").each(function () {
	         opcion=$(this).val();
	         $.post("../obtenerVehiculo/", { id: opcion }, function(data){
	         	$("#kilometros").html("Su <?php echo $texto;?> actual es: " + data);
	         	if("<?php echo $texto;?>"=="Horas"){
		         	data = 0;
	         	}
	         	$("#valor").val(data);
	         	
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
			fecha_fin: {
	        	 validators: {
					 notEmpty: {
						 message: 'La fecha de registro es requerida y no puede ser vacia'
					 },
					 date: {
						 format: 'YYYY-MM-DD',
		                 message: 'La fecha de registro no es válida.'
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
                        message: 'El valor de <?php echo $texto;?> no puede ser menor que el valor Actual.'
                    }
	
				}
			}				
		}
	});
});
</script>


</body>
</html>