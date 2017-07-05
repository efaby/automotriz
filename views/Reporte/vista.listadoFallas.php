<!-- Main row -->
<div class="card">
	<div class="card-block">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
		    <thead>
		    	<tr>
			    	<th style="text-align:center">F. de Creación del Mant.</th>
			    	<th style="text-align:center"><?php echo $variables[2];?></th>
				    <th style="text-align:center">Actividad</th>
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
		    			echo "<td>".$item['tiempo_ejecucion']." </td>";
			    		echo "<td>".$item['nombres']." ".$item['apellidos']."</td>";		    		
			    		echo "<td>".$item['observacion']." </td></tr>";
		    	}?>
		    </tbody>
		    </table>
		</div>
	</div>
</div>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script> 
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>
<script src="<?php echo PATH_JS; ?>/listados.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
</body>
</html>