<?php $title = "Listado Usuarios";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->

<div class="title-block">
    <h1 class="title">Orden de Repuestos</h1>
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
	
		<div class="card-block">
						
			<div class="row">	
				<div class="form-group  col-sm-12 border-div " align="center">				
					<label class="control-label"><h3><?php echo $dato['marca'].' No.'.$dato['numero']?></h3></label><br>
					<label class="control-label"><?php echo $dato['vehiculo_nombre']?></label>
				</div>				
			</div>
			
			<div class="row match-my-cols">
				<div class="form-group  col-sm-4 border-div ">
					<label class="control-label">Frecuencia: </label>
					<div>
						<?php echo $dato['unidad_numero']?>	
					</div>
												
				</div>
				<div class="form-group  col-sm-4 border-div ">
					<label class="control-label">Tiempo Estimado: </label>
					<div>
					<?php echo $dato['tiempo_estimado']?>
					</div>
				</div>
				<div class="form-group  col-sm-4 border-div">
					<label class="control-label">Estado de la Vehículo/Maquinaria: </label>
					<div>
					<?php if ($dato['estado_maquina'] == 0){?>	
						Apagado
					<?php } else {?>
						Prendido
					<?php }?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group  col-sm-12 border-div">
					<label class="control-label">Actividad: </label>
					<div>
					<?php echo $dato['plan']?>
					</div>
				</div>
			</div>	
			<div class="row match-my-cols">
				<div class="form-group  col-sm-4 border-div">				
					<label class="control-label">Herramientas:</label>
					<div>
					<?php echo htmlspecialchars_decode(strip_tags($dato['herramientas'],"<p>"));?>	
					</div>				
				</div>				
				<div class="form-group  col-sm-4 border-div" >				
					<label class="control-label">Materiales:</label>
					<div>
					<?php echo htmlspecialchars_decode(strip_tags($dato['materiales'],"<p>"));?>
					</div>
				</div>				
				<div class="form-group  col-sm-4 border-div">				
					<label class="control-label">Equipo:</label>
					<div>
					<?php echo htmlspecialchars_decode(strip_tags($dato['equipo'],"<p>"));?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group  col-sm-12 border-div">				
					<label class="control-label">Procedimiento:</label>
					<div>
					<?php echo htmlspecialchars_decode(strip_tags($dato['procedimiento'],"<p>"));?>	
					</div>				
				</div>
			</div>	
			<div class="row">
				<div class="form-group  col-sm-12 border-div">				
					<label class="control-label">Nota:</label>
					<div>
					<?php echo htmlspecialchars_decode(strip_tags($dato['observaciones'],"<p>"));?>	
					</div>				
				</div>
			</div>
						
			<div class="row match-my-cols" >
				<div class="form-group  col-sm-12 border-div cellMovil">
					<label class="control-label">T&eacute;cnico:</label>
					
					<?php echo "<div>".$dato['nombres']." ".$dato['apellidos']."</div> </br>"; ?>		
				</div>
			</div>
	</div>	
	
	
		<div class="card-title-block" style="padding-left: 15px;">
			<button class="btn btn-primary rounded" id="modalOpen1" onclick="javascript: loadModal1('<?php echo $iteMan['id'];?>-0')">
				<i class="glyphicon glyphicon-plus"></i> Añadir
			</button>
	    </div>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		    <thead>
			    <tr>
			    	<th>Codigo</th>
				    <th>Nombre</th>
				    <th>Medida</th>
				    <th>Cantidad</th>
				    <th style="text-align: center;">Acciones</th>
			    </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($datos as $item) {
		    		echo "<tr><td>".$item['codigo']."</td>";
		    		echo "<td>".$item['nombre']."</td>";
		    		echo "<td>".$item['medida']."</td>";
		    		echo "<td>".$item['cantidad']."</td>";
		    		$ids = $iteMan['id'] .'-'.$item['id'];
		    		echo "<td align='center'><a href='javascript: loadModal1(\"".$ids."\")' class='btn btn-warning btn-sm rounded' title='Editar' ><i class='fa fa-pencil'></i></a>
							  <a href='javascript:if(confirm(\"Está seguro que desea eliminar el elemento seleccionado?\")){redirect1(\"".$ids."\");}' class='btn rounded btn-danger btn-sm' title='Eliminar'><i class='fa fa-trash'></i></a></td>";
		    	}?>
		    </tbody>
		    </table>
		    <div class="card-block">
			<div class="form-group col-sm-12 border-div">
				<label class="control-label">Observaciones:</label>
				<div id="texto"> <?php echo $iteMan['observacion']; ?>
				</div>	
			</div>	
			</div>
		</div>

	</div>
</div>
<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Repuesto</h3>
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
<link href="<?php echo PATH_CSS; ?>/equal-height-columns.css" rel="stylesheet">

<script type="text/javascript">

	function loadModal1(id){
		$('.modal-body').load('../editarRepuesto/' + id,function(result){
		    $('#confirm-submit').modal({show:true});
		});
	}

	function redirect1(id){
		var url = '../eliminarOrdenRepuesto/' + id;
		location.href = url;
	}

</script>
</body>
</html>