<?php $title = "Bienvenido";?>
<?php include_once PATH_TEMPLATE.'/header.php';?>

<!-- Main row -->
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-truck fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $clientes;?></div>
						<div>Automotores!</div>
					</div>
				</div>
			</div>
			<?php if($_SESSION['SESSION_USER']['tipo_usuario_id']==1):?>
			<a href="../../Vehiculo/listar/1">			
				<div class="panel-footer">
					<span class="pull-left">Ver Detalles</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
			<?php else: ?>
			<div class="panel-footer">
					<span class="pull-left">Ver Detalles</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			<?php endif;?>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-laptop fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $atendidos; ?></div>
						<div>Atendidos!</div>
					</div>
				</div>
			</div>
			<?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']==1)||($_SESSION['SESSION_USER']['tipo_usuario_id']==6)):?>
			<a href="../../Reparacion/listar/1">
				<div class="panel-footer">
					<span class="pull-left">Ver Detalles</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
			<?php else: ?>
			<div class="panel-footer">
					<span class="pull-left">Ver Detalles</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			<?php endif;?>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-copy fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $nuevos?></div>
						<div>Nuevos!</div>
					</div>
				</div>
			</div>
			<?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']==1)||($_SESSION['SESSION_USER']['tipo_usuario_id']==6)):?>
			<a href="../../Reparacion/listar/2">
				<div class="panel-footer">
					<span class="pull-left">Ver Detalles</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
			<?php else: ?>
			<div class="panel-footer">
					<span class="pull-left">Ver Detalles</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			<?php endif;?>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-support fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $pendientes; ?></div>
						<div>Pendientes!</div>
					</div>
				</div>
			</div>
			<?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']==1)||($_SESSION['SESSION_USER']['tipo_usuario_id']==6)):?>
			<a href="../../Reparacion/listar/0">
				<div class="panel-footer">
					<span class="pull-left">View Details</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
			<?php else: ?>
			<div class="panel-footer">
					<span class="pull-left">Ver Detalles</span> <span
						class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			<?php endif;?>
		</div>
	</div>
</div>
<div class="row">
<div class=" col-md-12" >
<img src="<?php echo PATH_IMAGES; ?>/banner22.jpg" alt="" class="img-responsive" style="width: 100%; margin-top: 20px;"  />
</div>
</div>
<?php include_once PATH_TEMPLATE.'/footer.php';?>             
</body>
</html>
               