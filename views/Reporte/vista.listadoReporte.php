<?php $title = "Listado Vehículos";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Historial de Mantenimiento <?php if ($arrayId[1] ==1) echo "Preventivo"; else echo "Correctivo";?></h1>
</div>
<div class="card">
	<div class="card-block">
		<div class="row">	
			<div class="form-group  col-sm-12" align="right">
				<?php if (count($listado)>0){?>
				<a href="../visualizarPdf/<?php echo $arrayId[0]."-".$arrayId[1]?>" target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-file-pdf-o'></i>  Descargar</a>
				<?php }?>
			</div>
		</div>		
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
		    <thead>
		    	<tr>  
				  	<th rowspan="3" style="text-align:center">
				  		<img src="<?php echo PATH_IMAGES; ?>/espoch.jpg" width="140px" height="130px"/>
				  	</th>
				    <th colspan="4" style="text-align:center">ESPOCH-GADPC</th>
				    <th rowspan="3"style="text-align:center">
				  		<img src="<?php echo PATH_IMAGES; ?>/gobierno.jpg" width="130px" height="130px"/>
				  	</th>	
				    <th rowspan="2"><?php echo $variables[0];?></th>
				    <th rowspan="2"><?php echo $listado[0]['pers_nombres'];?> <?php echo $listado[0]['pers_apellidos'];?></th>
				</tr>
				<tr>
				    <th colspan="4" style="text-align:center">REGISTRO DE TRABAJO/REPARACIÓN</th>				   
				</tr>
				<tr>
				    <th colspan="4" style="text-align:center"><?php echo $listado[0]['nombre_vehiculo'];?></th>
				    <th>Año del Automotor</th>
				    <th>
				    	<?php echo $listado[0]['anio'];?>
				    </th>
		  	 	</tr>
		    	<tr>
			    	<th style="text-align:center">F. de Creación del Mant.</th>
				    <th style="text-align:center"><?php echo $variables[2];?></th>
				    <th style="text-align:center">Actividad</th>
				    <th style="text-align:center">N° Orden <br>de Trabajo</th>
				    <th style="text-align:center">N° Orden <br>de Repuestas</th>
				    <th style="text-align:center">Tiempos <br>de Ejecución</th>
				    <th style="text-align:center">Responsable</th>
				    <th style="text-align:center">Observación</th>
			    </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($listado as $item) {
		    		echo "<tr><td>".$item['fecha_emision']."</td>";		    		
		    		echo "<td>".$item['kilometraje']." " .$variables[1]."</td>";
		    		echo "<td>".$item['actividad']."</td>";
		    		echo "<td><a href=''>".$item['id']."</a></td>";
		    		echo "<td> Falta poner".$item['id']."</td>";
		    		echo "<td>".$item['tiempo_ejecucion']." </td>";
		    		echo "<td>".$item['nombres']." ".$item['apellidos']."</td>";		    		
		    		echo "<td>".$item['observacion']." </td></tr>";
		    	}?>
		    </tbody>
		    </table>
		</div>
	</div>
</div>

<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script> 
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>
</body>
</html>