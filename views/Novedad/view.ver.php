<?php $title = "Ver Novedad";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="title-block">
    <h1 class="title">Mantenimiento Correctivo</h1>
</div>
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success fade in alert-dismissable">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">&times;</button>
								  <?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
								</div>
		<?php  endif; ?>
<div class="card">
<div class="card-block">


	<div class="form-group  col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Vehículo</label>
		<div id="texto"> <?php echo $item['marca'] ." ".$item['marca']. " No. ".$item['numero'] ; ?>
		</div>
	</div>
	</div>	
	
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Problema</label>
		<div id="texto"> <?php echo $item['problema']; ?>
		</div>
	</div>		
	</div>
	
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Causa</label>
		<div id="texto"> <?php echo $item['causa']; ?>
		</div>	
	</div>	
	</div>
	
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Solución</label>
		<div id="texto"> <?php echo $item['solucion']; ?>
		</div>
	</div>		
	</div>
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Técnico Asignado</label>
		<div id="texto"> <?php echo $item['nombre_tecnico1'] ." ".$item['apellido_tecnico1']; ?>
		</div>
	</div>		
	</div>
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Estado</label>
		<div id="texto"> <?php echo ($item['atendido']==1)?'Cerrado':'Abierto'; ?></div>
	</div>
	</div>
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Proceso</label>
		<div id="texto"> <?php echo $item['proceso']; ?>
		</div>
	</div>		
	</div>
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Elementos</label>
		<div id="texto"> <?php echo $item['elementos']; ?>
		</div>
	</div>		
	</div>
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Observación</label>
		<div id="texto"> <?php echo $item['observaciones']; ?>
		</div>
	</div>		
	</div>
	<div class="form-group col-sm-12">
	<div class="form-group  col-sm-6 row-padding">
		<label class="control-label">Técnico Reparador</label>
		<div id="texto"> <?php echo $item['nombre_tecnico2'] ." ".$item['apellido_tecnico2']; ?>
		</div>
	</div>		
	</div>

	<div class="form-group col-sm-12">
	<a href="../listar/" class="btn btn-info rounded"  >
			Regresar
		</a>
</div>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>





</body>
</html>