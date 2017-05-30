<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Iniciar Sesión</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_IMAGES; ?>/favicon.ico">
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_CSS; ?>/stylesLogin.css" />

    <!-- Custom Fonts -->
    <link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<section class="container loginContainer" >
		<section class="row">
			<div class="col-xs-12 col-sm-6 left divContainer" >
			
			<?php $url = $_SERVER["REQUEST_URI"];?>
				<form action="<?php echo (strpos($url, '/Seguridad/mostrar/'))?'../validar/':'Seguridad/validar/';?>" role="login" id="frmLogin" method="post">
					<img src="<?php echo PATH_IMAGES; ?>/logo.png" alt="" class="img-responsive" />
				<div class="alert alert-danger fade in alert-dismissable" style="display: none; padding: 6px;" id="mensajeContenedor">
								  <span id="mensajeLogin"></span>
								</div>
								
				<div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" type="text" autofocus class="form-control input-lg">
                                    <span class="glyphicon glyphicon-user"></span>
                                </div>
								
					<div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="contrasena" type="password" value="" class="form-control input-lg">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </div>			
						
					

				<input name="url" type="hidden" value="<?php echo (strpos($url, '/Seguridad/mostrar/'))?'../':'Seguridad/'; ?>">
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-success btn-block" type="submit" id="btnSubmit">
                                <i class="fa fa-sign-in "></i>&nbsp;Ingresar</button>
				</form>
			</div>
			
			<div class="hidden-xs col-sm-6 right">
				<img src="<?php echo PATH_IMAGES; ?>/image1.png" class="img-responsive" alt="" />
			</div>
		</section>
	</section>
	
    <script src="<?php echo PATH_JS; ?>/jquery.min.js" type="text/javascript"></script>
   <script src="<?php echo PATH_JS; ?>/bootstrapValidator.min.js"></script>
<link href="<?php echo PATH_CSS; ?>/bootstrapValidator.min.css" rel="stylesheet"> 
    <script type="text/javascript">
						$(document).ready(function(){
							$('#frmLogin').bootstrapValidator({
						    	message: 'This value is not valid',
								feedbackIcons: {
									validating: 'glyphicon glyphicon-refresh'
								},
								fields: {			
									usuario: {
										message: 'El Usuario no es válido',
										validators: {
													notEmpty: {
														message: 'El Usuario no puede ser vacío.'
													},					
													regexp: {
														regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
														message: 'Ingrese un Usuario válido.'
													}
												}
											},	
									contrasena: {
										message: 'La Contraseña no es válida',
										validators: {
											notEmpty: {
												message: 'La Contraseña no puede ser vacía.'
											},					
											regexp: {
												regexp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9-_ \.]+$/,
												message: 'Ingrese una Contraseña válida.'
											}
										}
									},
													
									
								},
								 submitHandler: function(validator, form, submitButton) {
									 $.post(form.attr('action'), form.serialize(), function(result) {
										 var obj = JSON.parse(JSON.stringify(result));
										 if( obj.band === 1 ){											
											 $("#mensajeLogin").html(obj.data);
									     	 $("#mensajeContenedor").css('display','block');	
										 } else {
											 window.location = obj.data;
										      return false;
										 }
									 }, 'json');					   
								 }
							});


						
						});		
						</script>	
    
    <script>
	<!--
	$(function(){
		$(".left").height( $(".right").height() );
	});
	-->
	</script>

    
</body>

</html>