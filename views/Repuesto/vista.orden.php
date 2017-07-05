<?php $title = "Listado Vehículos";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Orden de Repuestos</h1>
</div>
<div class="card">
	<div class="card-block">
		<div class="row">	
			<div class="form-group  col-sm-12" align="right">

				<a href="../visualizarPdf/<?php echo $datos['id']?>" target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-file-pdf-o'></i>  Descargar</a>

			</div>
		</div>		
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
		    <thead>
		    <tr>
		    <th colspan="8"></th>
		    <th>No. Solicitud: </th>
		    <th><?php echo $datos['id']?></th>
		    </tr>
		    	<tr>  
				  	<th rowspan="3" colspan="2"  style="text-align:center">
				  		<img src="<?php echo PATH_IMAGES; ?>/espoch.jpg" width="140px" height="130px"/>
				  	</th>
				    <th colspan="6" style="text-align:center">ESPOCH-GADPC</th>
				    <th rowspan="3" colspan="2" style="text-align:center">
				  		<img src="<?php echo PATH_IMAGES; ?>/gobierno.jpg" width="130px" height="130px"/>
				  	</th>				    
				</tr>
				<tr>
				    <th colspan="6" style="text-align:center">SOLICITUD/ORDEN REPUESTO</th>				   
				</tr>
				<tr>
					<th >Solicitado por:</th>
				    <th colspan="3" ><?php echo $datos['nombres'];?> <?php echo $datos['apellidos'];?></th>
				    <th>Fecha Solicitud:</th>
				    <th ><?php echo $datos['fecha'];?></th>
				</tr>
				<tr>
				    <th style="width: 10%">Automotor</th>
				    <th style="width: 10%"><?php $vehiculo = ($datos['tipo_vehiculo_id']==3)?"Vehiculo Pesado": ($datos['tipo_vehiculo_id']>3&&$datos['tipo_vehiculo_id']<9)?"Maquinaria Pesada":"Vehiculo Liviano";  echo $vehiculo; ?></th>
				    <th style="width: 10%"><?php $label = ($datos['tipo_vehiculo_id']>3&&$datos['tipo_vehiculo_id']<9)?"Odometro":"Kilometro"; echo $label; ?></th>
				    <th style="width: 10%"><?php echo $datos['medida_uso']; ?></th>				    
				    <th style="width: 10%">N&uacute;mero:</th>
				    <th style="width: 10%"><?php echo $datos['numero']; ?></th>
				    <th style="width: 10%">Placa:</th>
				    <th style="width: 10%"><?php echo $datos['placa']; ?></th>
				    <th style="width: 10%">A&ntilde;o:</th>
				    <th style="width: 10%"><?php echo $datos['anio']; ?></th>
				    
		  	 	</tr>
		    	<tr>
			    	<th style="text-align:center">C&oacute;digo</th>
				    <th style="text-align:center" colspan="8">Repuesto</th>
				    <th style="text-align:center">Cantidad</th>
				   
			    </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($repuestos as $item) {
		    		echo "<tr><td>".$item['codigo']."</td>";		    		
		    		echo "<td colspan='8'>".$item['nombre']."</td>";
		    		echo "<td style='text-align:center'>".$item['cantidad']."</td></tr>";
		    		 
		    	} ?>
		    	 <?php  if(($_SESSION['SESSION_USER']['tipo_usuario_id']!=2)||($datos['aprobado']==1)): ?>
		    	 <tr>
		    	 	<td>Entregado Por:</td>
		    	 	<td colspan='2'><?php echo $datos['nombreEnt'];?> <?php echo $datos['apellidoEnt'];?></td>
		    	 	<td>Firma:</td>
		    	 	<td></td>
		    	 	<td>Recibido Por:</td>
		    	 	<td colspan='2'><?php echo $datos['nombres'];?> <?php echo $datos['apellidos'];?></td>	
		    	 	<td>Firma:</td>
		    	 	<td></td>	    	 
		    	 </tr>
		    	 <?php endif;  ?>
		    </tbody>
		    
		    </table>
		    <?php  if(($_SESSION['SESSION_USER']['tipo_usuario_id']==2)&&($datos['aprobado']==0)): ?>
		    <form id="frmUsuario1" method="post" action="../aprobarOrden/">
		    <div class="row">

				<input type='hidden' name='id' value="<?php echo $datos['id']; ?>">
					<button type="submit" class="btn btn-success rounded">Aprobar</button>

			</div>
		    </form>
		    <?php endif;  ?>
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
</body>
</html>