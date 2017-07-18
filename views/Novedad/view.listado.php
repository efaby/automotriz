
<?php $title = "Mantenimiento Correctivo";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="title-block">
    <h1 class="title">Mantenimiento Correctivo
     <?php
    if(count($tipo_vehiculo) >0){
    	echo $tipo_vehiculo['nombre'];
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
			<a href="../visualizarLista/<?php echo $tipo_vehiculo['id']?>" target='_blank' class='btn btn-info btn-sm' title='Descargar' ><i class='fa fa-file-pdf-o'></i>  Descargar</a>
		</div>
	</div>
	<div class="table-responsive">

	<table class="table table-striped table-bordered table-hover" id="dataTables-example1">
    <thead>
	    <tr>
	    	<th>ID</th>	  
		    <th>Vehículo</th>
		    <th>Conductor / Operario</th>	
		    <th>Problema</th>
		    <th>Ingreso</th>
		    <th>Atención</th>
		    <th>Estado</th>
		    <th style="text-align: center; width: 20%">Acciones</th>
	    </tr>
    </thead>
    <tbody>
    	<?php
    		$contador=1;
    		foreach ($datos as $item) {
    		echo "<tr><td>".$contador."</td>";   		
    		echo "<td>".$item['marca']." No. ".$item['numero']."</td>";
            echo "<td>".$item['nombre_usuario']." ".$item['apellido_usuario']."</td>";    	
            echo "<td>".substr ( $item['problema'] , 0 ,20 )."</td>";
    		echo "<td>".$item['fecha_ingreso']."</td>";
    		echo "<td>".$item['fecha_atencion']."</td>";
    		$estado = ($item['atendido']==1)?'Cerrado':'Abierto';
    		echo "<td>".$estado."</td>";
    		$tecnico = ($item['atendido'] == 1)?'disabled':'';
    		$repara = ($item['tecnico_repara'] > 0)?'disabled':'';
    		if($_SESSION['SESSION_USER']['tipo_usuario_id'] == 1){
    			$ids = $id.'-'.$item['ids'];
    			echo "<td align='center'>
					<a href='../ver/".$item['ids']."' class='btn btn-info rounded btn-sm' title='Ver Problema' ><i class='fa fa-info-circle '></i></a>
					<a href='javascript: loadModalAction(".$item['ids'].",\"asignar\")' class='btn btn-warning rounded btn-sm ".$tecnico."' title='Asignar Técnico' ><i class='fa fa-user'></i></a>					
					<a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect(\"".$ids."\");}' class='btn rounded btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a>	
				</td>";
    		} else {
	    		echo "<td align='center'>				
					<a href='../ver/".$item['ids']."' class='btn btn-info rounded btn-sm' title='Ver Problema' ><i class='fa fa-info-circle '></i></a>	";				
    		
	    		$ordenRepuesto = ($item['repuestoId']>0)?$item['repuestoId']."-0":$item['ids']."-1";
	    		if($item['aprobado']==1){
	    			echo "<a href='javascript: loadModalAction(".$item['ids'].",\"reparar\")' class='btn btn-warning rounded btn-sm ".$repara."' title='Atender' ><i class='fa fa-edit'></i></a>";
	    		} else {
	    			echo "<a href='../../Repuesto/ingresoCorrectivo/".$ordenRepuesto."' class='btn btn-warning btn-sm rounded' title='Generar Orden Repuesto' ><i class='fa fa-pencil'></i></a>";
	    		
	    		}
	    			
	    		echo "</td>";
    		
    		}
    		$contador++;
    	}?>
    </tbody>
    </table>
</div>
</div>
</div>
<div class="modal fade" id="atenderNovedad" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3 id="titles"></h3>
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
<script src="<?php echo PATH_JS; ?>/formValidation.js"></script>
<script src="<?php echo PATH_JS; ?>/bootstrap.js"></script>
<script src="<?php echo PATH_JS; ?>/currentList.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet">
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables-example1').DataTable({
    	 	order: [[ 0, "desc" ]],
            responsive: true,
            lengthChange: false,
            // iDisplayLength: 2,
            info: false,
            oLanguage: {
           	sProcessing:     "Procesando...",
            sLengthMenu:     "Mostrar _MENU_ registros",
            sZeroRecords:    "No se encontraron resultados",
            sEmptyTable:     "Ningún dato disponible en esta tabla",
            sInfo:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix:    "",
            sSearch:         "Buscar:",
            sUrl:            "",
            sInfoThousands:  ",",
            sLoadingRecords: "Cargando...",
           
            oPaginate: {
            sFirst:    "Primero",
            sLast:     "Último",
            sNext:     "Siguiente",
            sPrevious: "Anterior"
            },
    fnInfoCallback: null,
            }
    });
});
</script>

</body>
</html>