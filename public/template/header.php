<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Mantenimiento Automotriz </title>
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
                        <?php 
                        $url = $_SERVER["REQUEST_URI"];
                        
                        function valideUrl($url,$link){
                        	$pos = strpos($url, $link);
                        	return (strcmp(substr ($url, $pos),$link) === 0);         		
                        }
                        function valideUrlOpen($url,$link,$ids){
                        	$resp = false;
                        	foreach ($ids as $id){
                        		if(valideUrl($url, $link.$id)){
                        			$resp =  true;
                        		}
                        	}
                        	return $resp;
                        }
                        
                        ?>
                        <nav class="menu">
                            <ul class="nav metismenu" id="sidebar-menu">
                                <li class="<?php echo (strpos($url, '/Seguridad/inicio/')!==false)?'active':'';?>">
                                 
                                    <a href="../../Seguridad/inicio/"> <i class="fa fa-home"></i> Inicio </a>
                                </li>
                                <?php if($_SESSION['SESSION_USER']['tipo_usuario_id']==1):?>
                                <li class="<?php echo (strpos($url, '/Usuario/listar/')!==false)?'open':'';?>">
                                    <a href=""> <i class="fa fa-users"></i> Personal <i class="fa arrow"></i> </a>
                                    <ul>
                                    	<li class="<?php echo (valideUrlOpen($url,'/Usuario/listar/',array(1,2)))?'open':'';?>">
                                    	<a href=""> Usuarios <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Usuario/listar/1'))?'active':'';?>"><a href="../../Usuario/listar/1" class="level2">Administrador</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Usuario/listar/2'))?'active':'';?>"><a href="../../Usuario/listar/2" class="level2">Secretario</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	<li class="<?php echo (valideUrlOpen($url,'/Usuario/listar/',array(3,4)))?'open':'';?>">
                                    	<a href=""> Conductores <i class="fa arrow arrow1" ></i></a>
                                            <ul>
                                                <li class="<?php echo (valideUrl($url, '/Usuario/listar/3'))?'active':'';?>"><a href="../../Usuario/listar/3" class="level2">V. Liviano</a></li> 
                                                <li class="<?php echo (valideUrl($url, '/Usuario/listar/4'))?'active':'';?>"><a href="../../Usuario/listar/4" class="level2">V. Pesado</a></li> 
                                            </ul>  
                                        </li>      
                                    	<li class="<?php echo (valideUrl($url, '/Usuario/listar/5'))?'active':'';?>"><a href="../../Usuario/listar/5"> Operadores </a></li>      
                                    	<li class="<?php echo (valideUrl($url, '/Usuario/listar/6'))?'active':'';?>"><a href="../../Usuario/listar/6"> Técnicos </a></li>                                    	
                                    </ul>                                    	                                  
                                </li>
                                <li class="<?php echo (strpos($url, '/Vehiculo/listar/')!==false)?'open':'';?>">
                                    <a href=""> <i class="fa fa-truck"></i> Automotores <i class="fa arrow"></i> </a>
                                    <ul>                                    	
                                    	<li class="<?php echo (valideUrlOpen($url,'/Vehiculo/listar/',array(1,9,11,12)))?'open':'';?>">
                                    	<a href=""> A. Livianos Gasolina<i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/1'))?'active':'';?>"><a href="../../Vehiculo/listar/1" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/9'))?'active':'';?>"><a href="../../Vehiculo/listar/9" class="level2">Camioneta 4x4</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/11'))?'active':'';?>"><a href="../../Vehiculo/listar/11" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/12'))?'active':'';?>"><a href="../../Vehiculo/listar/12" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>
                                    	<li class="<?php echo (valideUrlOpen($url,'/Vehiculo/listar/',array(2,10,13,14)))?'open':'';?>">
                                    	<a href=""> A. Livianos Diesel<i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/2'))?'active':'';?>"><a href="../../Vehiculo/listar/2" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/10'))?'active':'';?>"><a href="../../Vehiculo/listar/10" class="level2">Camioneta 4x4</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/13'))?'active':'';?>"><a href="../../Vehiculo/listar/13" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/14'))?'active':'';?>"><a href="../../Vehiculo/listar/14" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/3'))?'active':'';?>"><a href="../../Vehiculo/listar/3">Auto. Pesados </a></li>      
                                    	<li class="<?php echo (valideUrlOpen($url,'/Vehiculo/listar/',array(4,5,6,7,8)))?'open':'';?>">
                                    	<a href=""> Maquinaria Pesada <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/4'))?'active':'';?>"><a href="../../Vehiculo/listar/4" class="level2">Rodillo</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/5'))?'active':'';?>"><a href="../../Vehiculo/listar/5" class="level2">Retroexcavadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/6'))?'active':'';?>"><a href="../../Vehiculo/listar/6" class="level2">Cargadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/7'))?'active':'';?>"><a href="../../Vehiculo/listar/7" class="level2">Motoniveladora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Vehiculo/listar/8'))?'active':'';?>"><a href="../../Vehiculo/listar/8" class="level2">Bulldozer</a></li> 
                                    		</ul>  
                                    	</li>       
                                    	                                   	
                                    </ul>                                    	                                  
                                </li>
                                <li class="<?php echo ((strpos($url, '/Plan/listar/')!==false)||(strpos($url, '/Plan/editar/'))!==false)?'open':'';?>">
                                    <a href=""> <i class="fa fa-book"></i> Plan Mantenimiento <i class="fa arrow"></i> </a>
                                    <ul>
                                    	<li class="<?php echo (valideUrlOpen($url,'/Plan/listar/',array(1,9,11,12))|| valideUrlOpen($url,'/Plan/editar/',array(1,9,11,12)))?'open':'';?>">
                                    	<a href=""> V. Livianos Gasolina <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                      			<li class="<?php echo (valideUrl($url, '/Plan/listar/1') || valideUrl($url, '/Plan/editar/1'))?'active':'';?>"><a href="../../Plan/listar/1" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/9') || valideUrl($url, '/Plan/editar/9'))?'active':'';?>"><a href="../../Plan/listar/9" class="level2">Camioneta 4x4</a></li>
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/11') || valideUrl($url, '/Plan/editar/11'))?'active':'';?>"><a href="../../Plan/listar/11" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/12') || valideUrl($url, '/Plan/editar/12'))?'active':'';?>"><a href="../../Plan/listar/12" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>
                                    	<li class="<?php echo (valideUrlOpen($url,'/Plan/listar/',array(2,10,13,14))|| valideUrlOpen($url,'/Plan/editar/',array(2,10,13,14)))?'open':'';?>">
                                    	<a href=""> V. Livianos Diesel <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/2') || valideUrl($url, '/Plan/editar/2'))?'active':'';?>"><a href="../../Plan/listar/2" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/10') || valideUrl($url, '/Plan/editar/10'))?'active':'';?>"><a href="../../Plan/listar/10" class="level2">Camioneta 4x4</a></li>
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/13') || valideUrl($url, '/Plan/editar/13'))?'active':'';?>"><a href="../../Plan/listar/13" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/14') || valideUrl($url, '/Plan/editar/14'))?'active':'';?>"><a href="../../Plan/listar/14" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	      
                                    	<li class="<?php echo (valideUrl($url, '/Plan/listar/3') || valideUrl($url, '/Plan/editar/3'))?'active':'';?>"><a href="../../Plan/listar/3"> Auto. Pesados </a></li>      
                                    	<li class="<?php echo (valideUrlOpen($url,'/Plan/listar/',array(4,5,6,7,8))|| valideUrlOpen($url,'/Plan/editar/',array(4,5,6,7,8)))?'open':'';?>">
                                    	<a href=""> Maquinaria Pesada <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/4') || valideUrl($url, '/Plan/editar/4'))?'active':'';?>"><a href="../../Plan/listar/4" class="level2">Rodillo</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/5') || valideUrl($url, '/Plan/editar/5'))?'active':'';?>"><a href="../../Plan/listar/5" class="level2">Retroescabadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/6') || valideUrl($url, '/Plan/editar/6'))?'active':'';?>"><a href="../../Plan/listar/6" class="level2">Cargadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/7') || valideUrl($url, '/Plan/editar/7'))?'active':'';?>"><a href="../../Plan/listar/7" class="level2">Motoniveladora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Plan/listar/8') || valideUrl($url, '/Plan/editar/8'))?'active':'';?>"><a href="../../Plan/listar/8" class="level2">Bulldozer</a></li> 
                                    		</ul>  
                                    	</li>                                	
                                    </ul>                                    	                                  
                                </li>
                                <li class="<?php echo ((strpos($url, '/Reporte/listar/')!==false) || (strpos($url, '/Reporte/verReporte')!==false))?'open':'';?>">
                                    <a href=""> <i class="fa fa-list-alt"></i> Reportes <i class="fa arrow"></i> </a>
                                    <ul>                                    	
                                    	<li class="<?php echo (valideUrlOpen($url,'/Reporte/listar/',array(1,9,11,12))|| valideUrlOpen($url,'/Reporte/verReporte/',array(1,9,11,12)))?'open':'';?>">
                                    	<a href=""> A. Livianos Gasolina<i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/1') || valideUrl($url, '/Reporte/verReporte/1'))?'active':'';?>"><a href="../../Reporte/listar/1" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/9') || valideUrl($url, '/Reporte/verReporte/9'))?'active':'';?>"><a href="../../Reporte/listar/9" class="level2">Camioneta 4x4</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/11') || valideUrl($url, '/Reporte/verReporte/11'))?'active':'';?>"><a href="../../Reporte/listar/11" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/12') || valideUrl($url, '/Reporte/verReporte/12'))?'active':'';?>"><a href="../../Reporte/listar/12" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>
                                    	<li class="<?php echo (valideUrlOpen($url,'/Reporte/listar/',array(2,10,13,14))|| valideUrlOpen($url,'/Reporte/verReporte/',array(2,10,13,14)))?'open':'';?>">
                                    	<a href=""> A. Livianos Diesel<i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/2') || valideUrl($url, '/Reporte/verReporte/2'))?'active':'';?>"><a href="../../Reporte/listar/2" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/10') || valideUrl($url, '/Reporte/verReporte/10'))?'active':'';?>"><a href="../../Reporte/listar/10" class="level2">Camioneta 4x4</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/13') || valideUrl($url, '/Reporte/verReporte/13'))?'active':'';?>"><a href="../../Reporte/listar/13" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/14') || valideUrl($url, '/Reporte/verReporte/14'))?'active':'';?>"><a href="../../Reporte/listar/14" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	<li class="<?php echo (valideUrl($url, '/Reporte/listar/3') || valideUrl($url, '/Reporte/verReporte/3'))?'active':'';?>"><a href="../../Reporte/listar/3">Auto. Pesados </a></li>      
                                    	<li class="<?php echo (valideUrlOpen($url,'/Reporte/listar/',array(4,5,6,7,8))|| valideUrlOpen($url,'/Reporte/verReporte/',array(4,5,6,7,8)))?'open':'';?>"> 
                                    	<a href=""> Maquinaria Pesada <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/4') || valideUrl($url, '/Reporte/verReporte/4'))?'active':'';?>"><a href="../../Reporte/listar/4" class="level2">Rodillo</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/5') || valideUrl($url, '/Reporte/verReporte/5'))?'active':'';?>"><a href="../../Reporte/listar/5" class="level2">Retroescabadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/6') || valideUrl($url, '/Reporte/verReporte/6'))?'active':'';?>"><a href="../../Reporte/listar/6" class="level2">Cargadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/7') || valideUrl($url, '/Reporte/verReporte/7'))?'active':'';?>"><a href="../../Reporte/listar/7" class="level2">Motoniveladora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Reporte/listar/8') || valideUrl($url, '/Reporte/verReporte/8'))?'active':'';?>"><a href="../../Reporte/listar/8" class="level2">Bulldozer</a></li> 
                                    		</ul>  
                                    	</li>       
                                    	                                   	
                                    </ul>                                    	                                  
                                </li>
                                
                                <?php endif;?>
                                  <?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']>=3)&&($_SESSION['SESSION_USER']['tipo_usuario_id']<=5)):?>
                                 <li class="<?php echo (strpos($url, '/Novedad/ingreso/')!==false)?'active':'';?>">
                                    <a href="../../Novedad/ingreso/"> <i class="fa fa-edit"></i> Novedad </a>                                    
                                </li>
                                <li class="<?php echo (strpos($url, '/Registro/ingreso/')!==false)?'active':'';?>">
                                    <a href="../../Registro/ingreso/"> <i class="fa fa-edit"></i> Registro <?php echo ($_SESSION['SESSION_USER']['tipo_usuario_id']==5)?'Horomotero (H)':'Odomentro (Km)';?></a>                                    
                                </li>
                                <?php endif;?>
                                
                                
                                 <?php if(($_SESSION['SESSION_USER']['tipo_usuario_id']==1)||($_SESSION['SESSION_USER']['tipo_usuario_id']==6)):?>
                                <li class="<?php echo ((strpos($url, '/OrdenPlan/listar/')!==false)||(strpos($url, '/OrdenPlan/editar/')!==false))?'open':'';?>"> 
                                    <a href=""> <i class="fa fa-cubes"></i> Man. Preventivos <i class="fa arrow"></i> </a>
                                    <ul>
                                    	<li class="<?php echo (valideUrlOpen($url,'/OrdenPlan/listar/',array(1,9,11,12))|| valideUrlOpen($url,'/OrdenPlan/editar/',array(1,9,11,12)))?'open':'';?>">
                                    	<a href=""> V. Livianos Gasolina <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/1') || valideUrl($url, '/OrdenPlan/editar/1'))?'active':'';?>"><a href="../../OrdenPlan/listar/1" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/9') || valideUrl($url, '/OrdenPlan/editar/9'))?'active':'';?>"><a href="../../OrdenPlan/listar/9" class="level2">Camioneta 4x4</a></li>
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/11') || valideUrl($url, '/OrdenPlan/editar/11'))?'active':'';?>"><a href="../../OrdenPlan/listar/11" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/12') || valideUrl($url, '/OrdenPlan/editar/12'))?'active':'';?>"><a href="../../OrdenPlan/listar/12" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>
                                    	<li class="<?php echo (valideUrlOpen($url,'/OrdenPlan/listar/',array(2,10,13,14))|| valideUrlOpen($url,'/OrdenPlan/editar/',array(2,10,13,14)))?'open':'';?>">
                                    	<a href=""> V. Livianos Diesel <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/2') || valideUrl($url, '/OrdenPlan/editar/2'))?'active':'';?>"><a href="../../OrdenPlan/listar/2" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/10') || valideUrl($url, '/OrdenPlan/editar/10'))?'active':'';?>"><a href="../../OrdenPlan/listar/10" class="level2">Camioneta 4x4</a></li>
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/13') || valideUrl($url, '/OrdenPlan/editar/13'))?'active':'';?>"><a href="../../OrdenPlan/listar/13" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/14') || valideUrl($url, '/OrdenPlan/editar/14'))?'active':'';?>"><a href="../../OrdenPlan/listar/14" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	      
                                    	<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/3') || valideUrl($url, '/OrdenPlan/listar/3'))?'active':'';?>"><a href="../../OrdenPlan/listar/3"> Auto. Pesados </a></li>      
                                    	<li class="<?php echo (valideUrlOpen($url,'/OrdenPlan/listar/',array(4,5,6,7,8))|| valideUrlOpen($url,'/OrdenPlan/editar/',array(4,5,6,7,8)))?'open':'';?>">
                                    	<a href=""> Maquinaria Pesada <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/4') || valideUrl($url, '/OrdenPlan/editar/4'))?'active':'';?>"><a href="../../OrdenPlan/listar/4" class="level2">Rodillo</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/5') || valideUrl($url, '/OrdenPlan/editar/5'))?'active':'';?>"><a href="../../OrdenPlan/listar/5" class="level2">Retroescabadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/6') || valideUrl($url, '/OrdenPlan/editar/6'))?'active':'';?>"><a href="../../OrdenPlan/listar/6" class="level2">Cargadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/7') || valideUrl($url, '/OrdenPlan/editar/7'))?'active':'';?>"><a href="../../OrdenPlan/listar/7" class="level2">Motoniveladora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/OrdenPlan/listar/8') || valideUrl($url, '/OrdenPlan/editar/8'))?'active':'';?>"><a href="../../OrdenPlan/listar/8" class="level2">Bulldozer</a></li> 
                                    		</ul>  
                                    	</li>                                	
                                    </ul>
                                    
                                  </li>  
                                  <li class="<?php echo ((strpos($url, '/Novedad/listar/')!==false)||(strpos($url, '/Novedad/ver/')!==false))?'open':'';?>">
                                    <a href=""> <i class="fa fa-calendar"></i> Man. Correctivos <i class="fa arrow"></i> </a>
                                    <ul>
                                    	<li class="<?php echo (valideUrlOpen($url,'/Novedad/listar/',array(1,9,11,12)))?'open':'';?>">
                                    	<a href=""> V. Livianos Gasolina <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/1'))?'active':'';?>"><a href="../../Novedad/listar/1" class="level2 ">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/9'))?'active':'';?>"><a href="../../Novedad/listar/9" class="level2">Camioneta 4x4</a></li>
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/11'))?'active':'';?>"><a href="../../Novedad/listar/11" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/12'))?'active':'';?>"><a href="../../Novedad/listar/12" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>
                                    	<li class="<?php echo (valideUrlOpen($url,'/Novedad/listar/',array(2,10,13,14)))?'open':'';?>">
                                    	<a href=""> V. Livianos Diesel <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/2'))?'active':'';?>"><a href="../../Novedad/listar/2" class="level2">Camioneta 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/10'))?'active':'';?>"><a href="../../Novedad/listar/10" class="level2">Camioneta 4x4</a></li>
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/13'))?'active':'';?>"><a href="../../Novedad/listar/13" class="level2">SUV 4x2</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/14'))?'active':'';?>"><a href="../../Novedad/listar/14" class="level2">SUV 4x4</a></li> 
                                    		</ul>  
                                    	</li>    
                                    	      
                                    	<li class="<?php echo (valideUrl($url, '/Novedad/listar/3'))?'active':'';?>"><a href="../../Novedad/listar/3"> Auto. Pesados </a></li>      
                                    	<li class="<?php echo (valideUrlOpen($url,'/Novedad/listar/',array(4,5,6,7,8)))?'open':'';?>">
                                    	<a href=""> Maquinaria Pesada <i class="fa arrow arrow1" ></i></a>
                                    		<ul>
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/4'))?'active':'';?>"><a href="../../Novedad/listar/4" class="level2">Rodillo</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/5'))?'active':'';?>"><a href="../../Novedad/listar/5" class="level2">Retroescabadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/6'))?'active':'';?>"><a href="../../Novedad/listar/6" class="level2">Cargadora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/7'))?'active':'';?>"><a href="../../Novedad/listar/7" class="level2">Motoniveladora</a></li> 
                                    			<li class="<?php echo (valideUrl($url, '/Novedad/listar/8'))?'active':'';?>"><a href="../../Novedad/listar/8" class="level2">Bulldozer</a></li> 
                                    		</ul>  
                                    	</li>                                	
                                    </ul>
                                    
                                </li>
                                <?php endif;?>
                                <?php if($_SESSION['SESSION_USER']['tipo_usuario_id']==1):?>
                                <li class="<?php echo (strpos($url, '/TipoFalla/listar/')!==false)?'active':'';?>">
                                    <a href="../../TipoFalla/listar/"> <i class="fa fa-th-list"></i> Tipos Fallas </a>                                    
                                </li>
                                <?php endif;?>
                                <?php if($_SESSION['SESSION_USER']['tipo_usuario_id']==2):?>
                                <li class="<?php echo (strpos($url, '/MedidaRepuesto/listar/')!==false)?'active':'';?>">
                                    <a href="../../MedidaRepuesto/listar/"> <i class="fa fa-edit"></i> Medidas Repuestos </a>                                    
                                </li>
                                <li class="<?php echo (strpos($url, '/Repuesto/listar/')!==false)?'active':'';?>">
                                    <a href="../../Repuesto/listar/"> <i class="fa fa-edit"></i> Repuestos </a>                                    
                                </li>
                                <li class="<?php echo (strpos($url, '/Repuesto/listarOrden/')!==false||(strpos($url, '/Repuesto/verOrden/')!==false))?'active':'';?>"> 
                                    <a href="../../Repuesto/listarOrden/"> <i class="fa fa-edit"></i> Ordenes Repuestos </a>                                    
                                </li>
                                <?php endif;?>

                            </ul>
                        </nav>
                    </div>
                    
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content dashboard-page">
 
		