<?php $title = "Listado Usuarios";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Administración Ordenes Repuestos</h1>
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
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		    <thead>
			    <tr>
			    	<th>Vehiculo</th>
				    <th>T&eacute;cnico</th>
				    <th>Mantenimiento</th>
				    <th>Fecha</th>
				    <th style="text-align: center; width: 15%;">Acciones</th>
			    </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($datos as $item) {
		    		echo "<tr><td>No. ".$item['numero']." ".$item['marca']." - ".$item['modelo']."</td>";
		    		echo "<td>".$item['nombres']." ".$item['apellidos']."</td>";
		    		$mantenimiento = ($item['tipo']==1)?"Preventivo":"Correctivo";
		    		echo "<td>".$mantenimiento."</td>";		 
		    		echo "<td>".$item['fecha']."</td>";
		    		if($item['aprobado']==0){
		    			echo "<td align='center'><a href='../verOrden/".$item['id']."' class='btn btn-warning btn-sm rounded' title='Aprobar' ><i class='fa fa-pencil'></i></a>
							 ";
		    		} else {
		    			echo "<td align='center'><a href='../verOrden/".$item['id']."' class='btn btn-info btn-sm rounded' title='Ver' ><i class='fa fa-info-circle'></i></a>
							 ";
		    		}
		    		
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


</body>
</html>