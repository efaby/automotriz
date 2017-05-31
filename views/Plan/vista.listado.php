<?php $title = "Planes Mantenimiento";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="title-block">
    <h1 class="title"> Planes Mantenimiento <?php echo $tipo['nombre']; ?></h1>
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
		<div class="card-title-block">
			<a href='../../Plan/editar/'<?php echo$tipo['id ']?>.'-0'' class='btn btn-primary rounded' title='Añadir' >
				<i class="glyphicon glyphicon-plus"></i> Añadir
			</a>			
	    </div>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">    
	    	<thead>
			    <tr>
			    	<th>ID</th>
				    <th>Tarea</th>
				    <th>Tiempo Ejecución</th>
				    <th>Técnico Asignado</th>		
				    <th>Estado Máquina</th>		     
				    <th style="text-align: center; width: 20%">Acciones</th>
	    		</tr>
    		</thead>
    		<tbody>
    		<?php
    			if( $datos != 0){
    				$contador =1;
    				foreach ($datos as $item) {
    					$estado = ($item['estado_maquina'])?'Encendida':'Apagada';
		    			echo "<tr><td>".$contador."</td>";
		    			echo "<td>".$item['tarea']."</td>";
		    			echo "<td>".$item['tiempo_ejecucion']."</td>";  		
		    			echo "<td>".$item['nombres']." ".$item['apellidos']."</td>";   
		    			echo "<td>".$estado."</td>";
		    			echo "<td align='center'>
						<a href='../../Plan/editar/".$item['id']."' class='btn btn-warning btn-sm' title='Editar' ><i class='fa fa-pencil'></i></a>			  		
						<a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect(".$item['id'].");}' class='btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a></td>";
		    			$contador++;
    				}
    			}?>
    		</tbody>
    	</table>
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
