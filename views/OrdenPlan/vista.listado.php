<?php $title = "Ejecución Orden Plan";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Ejecución Ordenes Planes
    <?php
    if(count($tipo_vehiculo) >0){
    	echo $tipo_vehiculo['nombre'];
    }
    ?>
    </h1>
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
			<div class="row">	
				<div class="form-group  col-sm-12" align="right">
					<a href="../visualizarLista/<?php echo $tipo_vehiculo['id']?>" target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-file-pdf-o'></i>  Descargar</a>
				</div>
			</div>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				    <thead>
					    <tr>
					    	<th>ID</th>
						    <th>Vehículo/Maq.</th>		    
						    <th>Actividades</th>
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
				    			$contador=1;
				    			foreach ($datos as $item) {
					    		echo "<tr><td>".$contador."</td>";
					    		echo "<td>".$item['vehiculo_nombre']."</td>"; 
					    		echo "<td>".$item['plan']."</td>";
					    		echo "<td>".$item['frecuencia'];
					    		if ($item['unidad_id'] ==4)  echo " Horas"; else echo " Kilometros";
					    		echo "</td>";
					    		echo "<td>".$item['fecha_emision']."</td>";
					    		echo "<td>".$item['fecha_atencion']."</td>";
					    		echo "<td>";
					    		if ($item['atendido'] == 0) { echo "Por Atender"; }
					    		else{ echo "Atendido";}
					    		echo "</td>";
					    		echo "<td align='center'>";
								if ($item['atendido'] == 0 &&  ($_SESSION['SESSION_USER']['tipo_usuario_id'] == 6)) {
									
									$ordenRepuesto = ($item['repuestoId']>0)?$item['repuestoId']."-0":$item['id']."-1";
									if($item['aprobado']==1){
										echo "<a href='../../OrdenPlan/editar/".$item['id']."-0' class='btn btn-warning btn-sm rounded' title='Editar' ><i class='fa fa-pencil'></i></a>";
									} else {
										echo "<a href='../../Repuesto/ingresoPreventivo/".$ordenRepuesto."' class='btn btn-warning btn-sm rounded' title='Generar Orden Repuesto' ><i class='fa fa-pencil'></i></a>";
										
									}
									
									
									if($item['url']!=''){
										echo "&nbsp;<a href='../downloadFile/".$item['url']."' class='btn btn-info btn-sm rounded' title='Descargar' target='_blank' ><i class='fa fa-file-pdf-o'></i></a>";
									}
								}
								else{
									echo "<a href='../../OrdenPlan/editar/".$item['id']."-1' class='btn btn-info btn-sm rounded' title='Mostrar' ><i class='fa fa-info-circle'></i></a>";
									if($item['url']!=''){
										echo "&nbsp;<a href='../downloadFile/".$item['url']."' class='btn btn-info btn-sm rounded' title='Descargar' target='_blank'><i class='fa fa-file-pdf-o'></i></a>";
									}
									if($_SESSION['SESSION_USER']['tipo_usuario_id'] == 1){
										$ids = $id.'-'.$item['id'];
										echo "&nbsp;<a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect(\"".$ids."\");}' class='btn rounded btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a>";
									}
									
									
								}
						    	echo "</td>";
						    	$contador++;
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