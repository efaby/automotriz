
<?php $title = "Mantenimiento Correctivo";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="title-block">
    <h1 class="title">Listado Reparaciones 
     <?php
     $id = $tipo;
    if($tipo == 1) {
    	echo " Atendidas";
    	$tipo = "Atendidas";
    } else if($tipo == 2){
    	echo " Nuevas";
    	$tipo = "Nuevas";
    } else {
    	echo " Pendientes";
    	$tipo = "Pendientes";
    }
    ?>   
    </h1>
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
			<a href="../visualizarPdf/<?php echo $id; ?>" target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-file-pdf-o'></i>  Descargar</a>
		</div>
	</div>
	<div class="table-responsive">

	<table class="table table-striped table-bordered table-hover" id="dataTables-example1">
    <thead>
	    <tr>
	    	<th>ID</th>	  
		    <th>Vehículo</th>
		    <th>Conductor / Operario</th>	
		    <th>Actividad</th>
		    <th>Tipo</th>
		    <th>Estado</th>
		    
	    </tr>
    </thead>
    <tbody>
    	<?php
    		$contador=1;
    		foreach ($datos as $item) {
    		echo "<tr><td>".$contador."</td>";   		
    		echo "<td>".$item['marca']." No. ".$item['numero']."</td>";
            echo "<td>".$item['nombres']." ".$item['apellidos']."</td>";    	
            echo "<td>".substr ( $item['actividad'] , 0 ,20 )."</td>";
    		echo "<td>".$item['tipo']."</td>";
    		echo "<td>".$tipo."</td>";    		
	    	echo "</td>";

    		$contador++;
    	}?>
    </tbody>
    </table>
</div>
</div>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">


</body>
</html>