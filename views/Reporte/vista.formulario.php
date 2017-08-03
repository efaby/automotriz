<form id="frmItem" method="get" action="../<?php echo $action; ?>">
<div class="row">
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6 row-padding" >
			<label class="control-label">Fecha de Inicio</label>		
			<input type='text'
			name='fecha_inicio' id='fecha_inicio' class='form-control'
			value="">		
		</div>		
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-12">
		<div class="form-group  col-sm-6 row-padding" >
			<label class="control-label">Fecha de Fin</label>		
			<input type='text'
			name='fecha_fin' id='fecha_fin' class='form-control'
			value="">		
		</div>		
	</div>
</div>
<div class="row">	
	<div class="form-group col-sm-12">	
		<button type="submit" class="btn btn-success rounded">Ver Reporte</button>
	</div>
</div>
</form>
     
<script src="<?php echo PATH_JS; ?>/jquery-ui.min.js"></script>
<script src="<?php echo PATH_JS; ?>/calendar.js"></script>	
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo PATH_CSS; ?>/jquery-ui.min.css">


<script type="text/javascript">
$(document).ready(function() {
	jQuery( "#fecha_inicio" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_fin" ).datepicker( "option", "minDate", selectedDate );
	        $('#frmItem').formValidation('revalidateField', 'fecha_inicio');
	      }  		
	});
    
	jQuery( "#fecha_fin" ).datepicker({  
		dateFormat: "yy-mm-dd",
		onClose: function( selectedDate ) {
	        $( "#fecha_inicio" ).datepicker( "option", "maxDate", selectedDate );
	        $('#frmItem').formValidation('revalidateField', 'fecha_fin');
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
	
			fecha_inicio: {
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
			 
	        fecha_fin: {
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
