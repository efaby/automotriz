<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> ModularAdmin - Free Dashboard Theme | HTML Version </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
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
                                    <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')"> </div> <span class="name">
    			      John Doe
    			    </span> </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#"> <i class="fa fa-user icon"></i> Profile </a>
                                    <a class="dropdown-item" href="#"> <i class="fa fa-bell icon"></i> Notifications </a>
                                    <a class="dropdown-item" href="#"> <i class="fa fa-gear icon"></i> Settings </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="login.html"> <i class="fa fa-power-off icon"></i> Logout </a>
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
                                <li class="<?php echo (strpos($url, '/Usuario/listar/'))?'active':'';?>">
                                    <a href="../../Usuario/listar/"> <i class="fa fa-users"></i> Usuarios </a>                                    
                                </li>
                                <li class="<?php echo (strpos($url, '/Vehiculo/listar/'))?'active':'';?>">
                                    <a href="../../Vehiculo/listar/"> <i class="fa fa-truck"></i> Vehículos </a>
                                    
                                </li>
                                
                                <li class="<?php echo ((strpos($url, '/Plan/listar/'))||(strpos($url, '/Vehiculo/listarplan/'))||(strpos($url, '/VehiculoPlan/listar/')))?'active':'';?>">
                                    <a href=""> <i class="fa fa-book"></i> Mantenimiento <i class="fa arrow"></i> </a>
                                    <ul>
                                        <li> <a href="../../Plan/listar/">
        								Planes
        						          </a> </li>
                                            <li> <a href="../../Vehiculo/listarplan/">
        								Asignar
        							</a> </li>
                                    </ul>
                                </li>
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
 
		