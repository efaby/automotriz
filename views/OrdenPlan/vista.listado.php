<?php $title = "Orden Plan";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Ordenes</h1>
</div>
<?php if (isset($_SESSION['message'])&& ($_SESSION['message'] != '')):?>
	<div class="alert alert-success fade in alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $_SESSION['message'];$_SESSION['message'] = ''?>
	</div>
<?php endif;?>
<div class="row">
	<div class="card">
		<div class="card-block">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				    <thead>
					    <tr>
					    	<th>ID</th>
						    <th>Vehículo/Maq.</th>		    
						    <th>Plan de Mantenimiento</th>
						    <th>Frecuencia de Mantenimiento</th>
						    <th>Fecha de Emisión</th>
						     <th>Fecha de Atención</th>
						     <th>Estado</th>
						    <th style="text-align: center; width: 5%">Acciones</th>
					    </tr>
				    </thead>
				    <tbody>
				    	<?php
				    		if(count($datos) >0){
				    			foreach ($datos as $item) {
					    		echo "<tr><td>".$item['id']."</td>";
					    		echo "<td>".$item['vehiculo_nombre']."</td>"; 
					    		echo "<td>".$item['plan']."</td>";
					    		echo "<td>".$item['numero_operacion']."</td>";
					    		echo "<td>".$item['fecha_emision']."</td>";
					    		echo "<td>".$item['fecha_atencion']."</td>";
					    		echo "<td>";
					    		if ($item['atendido'] == 0) { echo "Por Atender"; }
					    		else{ echo "Atendido";}
					    		echo "</td>";
					    		echo "<td align='center'>";
								if ($item['atendido'] == 0) {
									echo "<a href='../../OrdenPlan/editar/".$item['id']."' class='btn btn-warning btn-sm' title='Editar' ><i class='fa fa-pencil'></i></a>";
								}
								else{
									echo "<a href='../../OrdenPlan/editar/".$item['id']."' class='btn btn-info btn-sm' title='Mostrar' ><i class='fa fa-info-circle'></i></a>";
								}
						    	echo "</td>";
				    		}
				    	}
				    	?>
				    </tbody>
				</table>				
	    	<div>
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