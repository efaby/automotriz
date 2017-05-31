<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> ModularAdmin - Free Dashboard Theme | HTML Version </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo PATH_IMAGES; ?>/favicon.ico">
        <!-- Place favicon.ico in the root directory -->
        <link href="<?php echo PATH_CSS; ?>/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo PATH_CSS . '/vendor.css';?>">
        <link rel="stylesheet" href="<?php echo PATH_CSS . '/style.css';?>">
        <!-- Theme initialization -->
        <script>

            document.write('<link rel="stylesheet" id="theme-style" href="<?php echo PATH_CSS . '/app-orange.css';?>">');
            
        </script>
    </head>

    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
    			<i class="fa fa-bars"></i>
    		</button> </div>
                    <div class="header-block header-block-search hidden-sm-down">
                        
                    </div>
                    
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('<?php echo PATH_IMAGES; ?>/avatar_m.png')"> </div> <span class="name">
    			      <?php echo $_SESSION['SESSION_USER']['nombres']. ' '. $_SESSION['SESSION_USER']['apellidos']; ?>
    			    </span> </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="../../Seguridad/cambiarContrasena/"> <i class="fa fa-lock icon"></i> Cambio Contraseña </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../Seguridad/cerrarSesion/"> <i class="fa fa-power-off icon"></i> Cerrar Sesión </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                
                                <img src="<?php echo PATH_IMAGES . '/logo.png';?>" alt="Logo">
								 
							</div>
                        </div>
                        <?php $url = $_SERVER["REQUEST_URI"];?>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li class="<?php echo (strpos($url, '/Seguridad/inicio/'))?'active':'';?>">
                                 
                                    <a href="../../Seguridad/inicio/"> <i class="fa fa-home"></i> Inicio </a>
                                </li>
                                <?php if($_SESSION['SESSION_USER']['tipo_usuario_id']==1):?>
                                <li class="<?php echo (strpos($url, '/Usuario/listar/'))?'active':'';?>">
                                    <a href=""> <i class="fa fa-users"></i> Personal <i class="fa arrow"></i> </a>
                                    <ul>
                                    	<li><a href=""> Usuarios <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li><a href="../../Usuario/listar/1" class="level2">Administrador</a></li> 
                                    			<li><a href="../../Usuario/listar/2" class="level2">Secretario</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	<li><a href=""> Conductores <i class="fa arrow arrow1" ></i></a>
                                            <ul>
                                                <li><a href="../../Usuario/listar/3" class="level2">Auto. Liviano</a></li> 
                                                <li><a href="../../Usuario/listar/4" class="level2">Auto. Pesado</a></li> 
                                            </ul>  
                                        </li>      
                                    	<li><a href="../../Usuario/listar/5"> Operadores </a></li>      
                                    	<li><a href="../../Usuario/listar/6"> Técnicos </a></li>                                    	
                                    </ul>                                    	                                  
                                </li>
                                <li class="<?php echo (strpos($url, '/Vehiculo/listar/'))?'active':'';?>">
                                    <a href=""> <i class="fa fa-truck"></i> Automotores <i class="fa arrow"></i> </a>
                                    <ul>                                    	
                                    	<li><a href=""> Auto. Livianos <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li><a href="../../Vehiculo/listar/1" class="level2">Gasolina</a></li> 
                                    			<li><a href="../../Vehiculo/listar/2" class="level2">Diesel</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	<li><a href="../../Vehiculo/listar/3">Auto. Pesados </a></li>      
                                    	<li><a href=""> Maquinaria Pesada <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li><a href="../../Vehiculo/listar/4" class="level2">Rodillo</a></li> 
                                    			<li><a href="../../Vehiculo/listar/5" class="level2">Retroescabadora</a></li> 
                                    			<li><a href="../../Vehiculo/listar/6" class="level2">Cargadora</a></li> 
                                    			<li><a href="../../Vehiculo/listar/7" class="level2">Motoniveladora</a></li> 
                                    			<li><a href="../../Vehiculo/listar/8" class="level2">Buldoser</a></li> 
                                    		</ul>  
                                    	</li>       
                                    	                                   	
                                    </ul>                                    	                                  
                                </li>
                                <?php endif;?>
                                  <?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']>=3)&&($_SESSION['SESSION_USER']['tipo_usuario_id']<=5)):?>
                                 <li class="<?php echo (strpos($url, '/Novedad/ingreso/'))?'active':'';?>">
                                    <a href="../../Novedad/ingreso/"> <i class="fa fa-edit"></i> Novedad </a>                                    
                                </li>
                                <li class="<?php echo (strpos($url, '/Registro/ingreso/'))?'active':'';?>">
                                    <a href="../../Registro/ingreso/"> <i class="fa fa-edit"></i> Registro <?php echo ($_SESSION['SESSION_USER']['tipo_usuario_id']==5)?'Horas':'Kilometros';?></a>                                    
                                </li>
                                <?php endif;?>
                                <?php if($_SESSION['SESSION_USER']['tipo_usuario_id']==1):?>
                                <li class="<?php echo ((strpos($url, '/Plan/listar/')))?'active':'';?>">
                                    <a href=""> <i class="fa fa-book"></i> Planes Mantenimiento <i class="fa arrow"></i> </a>
                                    <ul>
                                    	<li><a href=""> Auto. Livianos <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li><a href="../../Plan/listar/1" class="level2">Gasolina</a></li> 
                                    			<li><a href="../../Plan/listar/2" class="level2">Diesel</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	      
                                    	<li><a href="../../Plan/listar/3"> Auto. Pesados </a></li>      
                                    	<li><a href="../../Plan/listar/4"> Maq. Pesada </a></li>                                    	
                                    </ul>                                    	                                  
                                </li>
                                <li class="<?php echo ((strpos($url, '/Plan1/listar/'))||(strpos($url, '/Vehiculo/listarplan/'))||(strpos($url, '/Novedad/listar/'))||(strpos($url, '/VehiculoPlan/listar/'))||(strpos($url, '/Novedad/ver/')))?'active':'';?>">
                                    <a href=""> <i class="fa fa-cubes"></i> Mantenimientos <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="../../Plan/listar/">
        								Man. Preventivos
        						          </a> </li>                                            
                                        <li> <a href="../../Novedad/listar/">
                                        Man. Correctivos
                                    </a> </li>
                                    </ul>
                                </li>
                                <?php endif;?>
                                <!--  
                                <li>
                                    <a href="forms.html"> <i class="fa fa-pencil-square-o"></i> Forms </a>
                                </li>
                                <li>
                                    <a href=""> <i class="fa fa-desktop"></i> UI Elements <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="buttons.html">
    								Buttons
    							</a> </li>
                                        <li> <a href="cards.html">
    								Cards
    							</a> </li>
                                        <li> <a href="typography.html">
    								Typography
    							</a> </li>
                                        <li> <a href="icons.html">
    								Icons
    							</a> </li>
                                        <li> <a href="grid.html">
    								Grid
    							</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href=""> <i class="fa fa-file-text-o"></i> Pages <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="login.html">
    								Login
    							</a> </li>
                                        <li> <a href="signup.html">
    								Sign Up
    							</a> </li>
                                        <li> <a href="reset.html">
    								Reset
    							</a> </li>
                                        <li> <a href="error-404.html">
    								Error 404 App
    							</a> </li>
                                        <li> <a href="error-404-alt.html">
    								Error 404 Global
    							</a> </li>
                                        <li> <a href="error-500.html">
    								Error 500 App
    							</a> </li>
                                        <li> <a href="error-500-alt.html">
    								Error 500 Global
    							</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="https://github.com/modularcode/modular-admin-html"> <i class="fa fa-github-alt"></i> Theme Docs </a>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                    
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content dashboard-page">
 
		