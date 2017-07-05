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
				    <th rowspan="2"><?php echo $vehiculo['nombres'];?> <?php echo $vehiculo['apellidos'];?></th>
				</tr>
				<tr>
				    <th colspan="4" style="text-align:center">REGISTRO DE TRABAJO/REPARACIÓN</th>				   
				</tr>
				<tr>
				    <th colspan="4" style="text-align:center"><?php echo $vehiculo['nombre_vehiculo'];?></th>
				    <th>Año del Automotor</th>
				    <th>
				    	<?php echo $vehiculo['anio'];?>
				    </th>
		  	 	</tr>
		    	<tr>
			    	<?php if ($arrayId[1] != 3){
		    			$cols ="";
		    			$colsAct = "";
		    			?>
			    	<th style="text-align:center">F. de Creación del Mant.</th>
			    	<?php } else{?>
			    	<th style="text-align:center" colspan="2">N° de Fallas</th>
			    	<?php $cols ="colspan=2";
			    		  $colsAct = "colspan=3";?>			    	
			    	<?php }?>			    	
				    <th style="text-align:center" <?php echo $cols;?>><?php echo $variables[2];?></th>
				    <th style="text-align:center" <?php echo $colsAct;?>>Actividad</th>
				    <?php if ($arrayId[1] != 3){?>
				    <th style="text-align:center">N° Orden <br>de Trabajo</th>
				    <th style="text-align:center">N° Orden <br>de Repuestas</th>
				    <th style="text-align:center">Tiempos <br>de Ejecución</th>
				    <th style="text-align:center">Responsable</th>
				    <th style="text-align:center">Observación</th>
				    <?php }?>									  
			    </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($listado as $item) {
		    		if ($arrayId[1] != 3){
		    			echo "<tr><td>".$item['fecha_emision']."</td>";		    		
		    			echo "<td>".$item['kilometraje']." " .$variables[1]."</td>";
		    		}
		    		else{
		    			echo "<tr><td colspan=2>".$item['numero_falla']."</td>";
		    			echo "<td colspan=2>".$item['promedio']."</td>";
		    		}
		    		echo "<td ".$colsAct.">".$item['actividad']."</td>";
		    		if ($arrayId[1] != 3){
			    		if ($arrayId[1] ==1){
			    			$url = "../../OrdenPlan/editar/".$item['id']."-1";
			    		}
			    		else{
			    			$url = "../../Novedad/ver/".$item['id'];
			    		}		    		 		    		
			    		echo "<td><a href=".$url.">Ver</a></td>";
			    		echo "<td><a href='../../Repuesto/verOrden/".$item['ordenRepuesto']."'>Ver</td>";
			    		echo "<td>".$item['tiempo_ejecucion']." </td>";
			    		echo "<td>".$item['nombres']." ".$item['apellidos']."</td>";		    		
			    		echo "<td>".$item['observacion']." </td></tr>";
		    		}
		    		else{
		    			echo "<td align=center>
				    			<a href='javascript: loadModal(\"".$item['vehiculo_id']."-".$item['tipo_falla_id']."\")' class='btn btn-info btn-sm rounded' title='Ver' >
				  					<i class='fa fa-file-text-o'></i>
				  				</a>
				  			</td>";
		    		}
		    	}?>
		    </tbody>
		    </table>
		</div>
	</div>
</div>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" 
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width: 1301px;">
		<div class="modal-content" style="width:984px">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Historial de Detalle de Fallas de Mantenimiento</h3>
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