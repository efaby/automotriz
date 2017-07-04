<?php $title = "Listado Usuarios";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Orden de Repuestos</h1>
</div>

<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
		<div class="alert alert-success fade in alert-dismissable">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">&times;</button>
								  <?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
								</div>
		<?php endif;?>
<div class="card">
	<div class="card-block">
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
		<label class="control-label">Detalle Problema</label>
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
		<label class="control-label">Falla T&eacute;cnica</label>
		<div id="texto"> <?php echo $item['falla']; ?>
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
		
	</div>
						
			
	</div>	
	
	
		<div class="card-title-block" style="padding-left: 15px;">
			<button class="btn btn-primary rounded" id="modalOpen1" onclick="javascript: loadModal1('<?php echo $iteMan['id'];?>-0')">
				<i class="glyphicon glyphicon-plus"></i> Añadir
			</button>
	    </div>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		    <thead>
			    <tr>
			    	<th>Codigo</th>
				    <th>Nombre</th>
				    <th>Cantidad</th>
				    <th style="text-align: center;">Acciones</th>
			    </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($datos as $item) {
		    		echo "<tr><td>".$item['codigo']."</td>";
		    		echo "<td>".$item['nombre']."</td>";
		    		echo "<td>".$item['cantidad']."</td>";		
		    		$ids = $iteMan['id'] .'-'.$item['id'];
		    		echo "<td align='center'><a href='javascript: loadModal1(\"".$ids."\")' class='btn btn-warning btn-sm rounded' title='Editar' ><i class='fa fa-pencil'></i></a>
							  <a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect1(\"".$ids."\");}' class='btn rounded btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a></td>";
		    	}?>
		    </tbody>
		    </table>
		</div>

	</div>
</div>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Repuesto</h3>
			</div>

			<div class="modal-body"></div>

		</div>

	</div>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>  
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script> 
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>

<script src="<?php echo PATH_JS; ?>/listados.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">

<script type="text/javascript">

	function loadModal1(id){
		$('.modal-body').load('../editarRepuesto/' + id,function(result){
		    $('#confirm-submit').modal({show:true});
		});
	}

	function redirect1(id){
		var url = '../eliminarOrdenRepuesto/' + id;
		location.href = url;
	}

</script>
</body>
</html>