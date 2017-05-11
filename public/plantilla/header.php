<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo PATH_CSS; ?>/google-fonts.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo PATH_CSS; ?>/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo PATH_CSS; ?>/style.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
      </head>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo" style="background: #fff;">
               <img src="<?php echo PATH_IMAGES; ?>/logo.png" alt="" class="img-responsive" style="height: 50px; padding-left: 10px;" />
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav"> 
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $_SESSION['SESSION_USER']['usuario']?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Cuenta</li>

                                  <li>
                                        <a href="../../Seguridad/cambiarContrasena/">
                                        <i class="fa fa-lock fa-fw pull-right"></i>
                                            Cambio Contraseña
                                        </a>
                                        
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a href="../../Seguridad/cerrarSesion/"><i class="fa fa-sign-out fa-fw pull-right"></i> Cerrar Sesión</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="left-side sidebar-offcanvas">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="<?php echo PATH_IMAGES; ?>/avatar_<?php echo $_SESSION['SESSION_USER']['genero']?>.png" class="img-circle" alt="User Image" />
                                </div>
                                <div class="pull-left info">
                                    <p>Hola, <?php echo $_SESSION['SESSION_USER']['nombres']?></p>

                                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                </div>
                            </div>
                            
                            <!-- sidebar menu: : style can be found in sidebar.less -->
                            <?php $url = $_SERVER["REQUEST_URI"];?>
                            
                            <ul class="sidebar-menu">
                            <li class="<?php echo (strpos($url, '/Seguridad/inicio/'))?'active':'';?>">
                                    <a href="../../Seguridad/inicio/">
                                        <i class="fa fa-dashboard"></i> <span>Inicio</span>
                                    </a>
                                </li>
                                <?php if($_SESSION['SESSION_USER']['tipo_usuario_id']==1):?>
                                <li class="<?php echo (strpos($url, '/Usuario/listar/'))?'active':'';?>">
                                    <a href="../../Usuario/listar/">
                                        <i class="fa fa-user"></i> <span>Usuarios</span>
                                    </a>
                                </li>
                                <?php endif;?>
                                <?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']==3)||($_SESSION['SESSION_USER']['tipo_usuario_id']==1)):?>
                                <li class="<?php echo (strpos($url, '/Cliente/listar/'))?'active':'';?>">
                                    <a href="../../Cliente/listar/">
                                        <i class="fa fa-users"></i> <span>Clientes</span>
                                    </a>
                                </li>
								<?php endif;?>
                                <?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']==3)||($_SESSION['SESSION_USER']['tipo_usuario_id']==1)):?>
                                <li class="<?php echo (strpos($url, '/Reparacion/listar/'))?'active':'';?>">
                                    <a href="../../Reparacion/listar/">
                                        <i class="fa fa-list-ul"></i> <span>Reparaciones</span>
                                    </a>
                                </li>
								<?php endif;?>
                                <?php if($_SESSION['SESSION_USER']['tipo_usuario_id']==2):?>
                                <li class="<?php echo (strpos($url, '/Reparacion/listar/'))?'active':'';?>">
                                    <a href="../../Reparacion/listar/">
                                        <i class="fa fa-wrench"></i> <span>Mis reparaciones</span>
                                    </a>
                                </li>
                                <?php endif;?>
                                <?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']==3)||($_SESSION['SESSION_USER']['tipo_usuario_id']==1)):?>
                                <!--   <li class="<?php echo (strpos($url, '/Reportes/listar/'))?'active':'';?>">
                                    <a href="simple.html">
                                        <i class="fa fa-calendar-o"></i> <span>Reportes</span>
                                    </a>
                                </li> -->
								 <?php endif;?>
                            </ul>
                        </section>
                        <!-- /.sidebar -->
                    </aside>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">

		