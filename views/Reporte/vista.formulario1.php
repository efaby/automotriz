<form id="frmItem" method="get" action="../<?php echo $action; ?>" target="_blank">
<div class="row">
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6 row-padding" >
			<label class="control-label">Fecha de Inicio</label>		
			<input type='text'
			name='fecha_inicio1' id='fecha_inicio1' class='form-control'
			value="">		
		</div>		
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6 row-padding" >
			<label class="control-label">Fecha de Fin</label>		
			<input type='text'
			name='fecha_fin1' id='fecha_fin1' class='form-control'
			value="">		
		</div>		
	</div>
</div>
<div class="row">	
	<div class="form-group col-sm-12">	
		<button type="submit" class="btn btn-success rounded" id="boton" onclick="location.reload();">Ver Reporte</button>
	</div>
</div>
</form>
     
<script src="<?php echo PATH_JS; ?>/jquery-ui.min.js"></script>
<script src="<?php echo PATH_JS; ?>/calendar.js"></script>	
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/jquery-ui.min.css">


<script type="text/javascript">
$(document).ready(function() {
	jQuery( "#fecha_inicio1" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_fin1" ).datepicker( "option", "minDate", selectedDate );
	        $('#frmItem').formValidation('revalidateField', 'fecha_inicio1');
	      }  		
	});
    
	jQuery( "#fecha_fin1" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_inicio1" ).datepicker( "option", "maxDate", selectedDate );
	        $('#frmItem').formValidation('revalidateField', 'fecha_fin1');
	      }  		
	});

	
	
	$('#frmItem').formValidation({
    	message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {			
	
			fecha_inicio1: {
				 validators: {
					 notEmpty: {
						 message: 'La fecha de inicio es requerida y no puede ser vacia'
					 },
					 date:{	 
						    format: 'YYYY-MM-DD',
		                    message: 'La fecha de inicio no es válida.'				                    
					 },
					 							 
				 }
			 },
			 
	        fecha_fin1: {
	        	 validators: {
					 notEmpty: {
						 message: 'La fecha de fin es requerida y no puede ser vacia'
					 },
					 date: {
						 format: 'YYYY-MM-DD',
		                 message: 'La fecha de fin no es válida.'
					 }							 
				 }
	        },		
		}
	});
});
</script>
