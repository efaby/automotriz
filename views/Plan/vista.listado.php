<?php $title = "Planes Mantenimiento";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="title-block">
    <h1 class="title"> Planes Mantenimiento</h1>
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
			<button class="btn btn-primary rounded" id="modalOpen">
				<i class="glyphicon glyphicon-plus"></i> Añadir
			</button>
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
    				foreach ($datos as $item) {
    					$estado = ($item['estado_maquina'])?'Encendida':'Apagada';
		    			echo "<tr><td>".$item['id']."</td>";
		    			echo "<td>".$item['tarea']."</td>";
		    			echo "<td>".$item['tiempo_ejecucion']."</td>";  		
		    			echo "<td>".$item['nombres']." ".$item['apellidos']."</td>";   
		    			echo "<td>".$estado."</td>";
		    			echo "<td align='center'>
						<a href='javascript: loadModal(".$item['id'].")'' class='btn btn-warning btn-sm' title='Editar' ><i class='fa fa-pencil'></i></a>
						<a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect(".$item['id'].");}' class='btn btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a></td>";		    			
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
				<h3>Plan de Mantemiento</h3>
			</div>

			<div class="modal-body"></div>

		</div>

	</div>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>   
<link href="<?php echo PATH_CSS; ?>/dataTables.bootstrap.css" rel="stylesheet">
<script src="<?php echo PATH_JS; ?>/jquery.dataTables.min.js"></script>
<script src="<?php echo PATH_JS; ?>/dataTables.bootstrap.min.js"></script>
<script src="<?php echo PATH_JS; ?>/table.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrapValidator.min.js"></script>
<script src="<?php echo PATH_JS; ?>/listados.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">