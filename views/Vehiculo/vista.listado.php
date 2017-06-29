<?php $title = "Listado Vehículos";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Administración de <?php echo $tipo['descripcion']; ?></h1>
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
		<div class="row">	
			<div class="form-group  col-sm-12" align="right">
				<?php if (count($datos)>0){?>
				<a href="../visualizarPdf/<?php echo $tipo['id']?>" target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-file-pdf-o'></i>  Descargar</a>
				<?php }?>
			</div>
		</div>
		<div class="card-title-block">
			<button class="btn btn-primary rounded" id="modalOpen1" onclick="javascript: loadModal('<?php echo  $tipo['id'].'-0';?>')">
				<i class="glyphicon glyphicon-plus"></i> Añadir
			</button>
	    </div>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		    <thead>
			    <tr>
			    	<th>Número</th>
				    <th>Tipo</th>
				    <th>Marca</th>
				    <th>Modelo</th>
				    <th>Placa</th>
				    <th>Conductor</th>
				    <th>Estado</th>
				    <th style="text-align: center;">Acciones</th>
			    </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($datos as $item) {
		    		echo "<tr><td>".$item['numero']."</td>";
		    		echo "<td>".$item['tipo']."</td>";
		    		echo "<td>".$item['marca']."</td>";
		    		echo "<td>".$item['modelo']."</td>";
		    		echo "<td>".$item['placa']."</td>";
		    		echo "<td>".$item['nombres']." ".$item['apellidos']."</td>";
		    		echo "<td>".$item['estado']." </td>";
		    		$id = $tipo['id']."-".$item['id'];
		    		echo "<td align='center'><a href='javascript: loadModal(\"".$id."\")' class='btn btn-warning btn-sm rounded' title='Editar' ><i class='fa fa-pencil'></i></a>
							  <a href='../visualizarFicha/".$id."' target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-info-circle'></i></a>
							  <a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect(\"".$id."\");}' class='btn rounded btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a></td>";
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
				<h3><?php echo $tipo['nombre']; ?></h3>
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


</body>
</html>