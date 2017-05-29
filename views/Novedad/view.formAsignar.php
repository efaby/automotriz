<form id="frmItem1" method="post" action="../guardarAsignar/" enctype="multipart/form-data">


	<div class="form-group  col-sm-12">
		<label class="control-label">Vehículo</label>
		<div id="texto"> <?php echo $item['marca'] ." ".$item['marca']. " No. ".$item['numero']; ?>
		</div>
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Problema</label>
		<div id="texto"> <?php echo $item['problema']; ?>
		</div>
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Causa</label>
		<div id="texto"> <?php echo $item['causa']; ?>
		</div>
	</div>
	<div class="form-group  col-sm-12">
		<label class="control-label">Solucion</label>
		<div id="texto"> <?php echo $item['solucion']; ?>
		</div>
	</div>
	
	<div class="form-group  col-sm-12">
		<label class="control-label">Asignar Técnico</label>
		<select class='form-control' name="usuario_id" id="usuario_id">
			<option value="" >Seleccione</option>
		<?php foreach ($tecnicos as $dato) { ?>
			<option value="<?php echo $dato->id;?>" ><?php echo $dato['nombres'].' '.$dato['apellidos'];?></option>
		<?php }?>
		</select>

	</div>
	
	<div class="form-group">
	<input type='hidden' name='id' class='form-control' value="<?php echo $item->id; ?>">
		<button type="submit" class="btn btn-success" id="saveAsignar">Guardar</button>
	</div>

</form>

<script type="text/javascript">
$(document).ready(function() {

    $('#frmItem1').formValidation({
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
						message: 'Seleccione un Técnico'
					}
				}
			},
			
		}
	});
});
</script>
