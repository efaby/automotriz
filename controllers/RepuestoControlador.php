<?php

use Dompdf\Options;
use Dompdf\Dompdf;

require_once (PATH_MODELOS . "/RepuestoModelo.php");
require_once (PATH_MODELOS . "/OrdenPlanModelo.php");
require_once (PATH_MODELOS . "/NovedadModelo.php");

require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");

/**
 * Controlador de Tipo Falla
 */
class RepuestoControlador {
	
	public function listar() {
		$model = new RepuestoModelo();
		$datos = $model->obtenerListadoRepuesto();
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.listado.php";
	}
	
	public function editar(){
		$model = new RepuestoModelo();
		$tipoId = $_GET['id'];
		$tipo = $model->obtenerRepuesto($tipoId);
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.formulario.php";
	}
	
	public function guardar() {
		$repuesto ['id'] = $_POST ['id'];
		$repuesto ['nombre'] = $_POST ['nombre'];
		$repuesto ['codigo'] = $_POST ['codigo'];		
		$repuesto ['cantidad'] = $_POST ['cantidad'];	
		$repuesto ['eliminado'] = 0;
		
		$model = new RepuestoModelo();
		try {
			$datos = $model->guardarRepuesto($repuesto);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new RepuestoModelo();
		$tipoId = $_GET['id'];
		try {
			$datos = $model->eliminarRepuesto($tipoId);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	//////////  Ordenes
	
	public function listarOrden() {
		$model = new RepuestoModelo();
		$datos = $model->obtenerListadoOrdenes();
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.listadoOrden.php";
	}
	
	
	public function verOrden() {
		$model = new RepuestoModelo();
		$orden = $_GET['id'];
		$datos = $model->obtenerOrden($orden);
		$datos = $datos[0];
		$repuestos = $model->obtenerOrdenRepuesto($orden);
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.orden.php";
	}
	
	public function aprobarOrden() {
		$orden = $_POST ['id'];
		$usuario = $_SESSION['SESSION_USER']['id'];
		$model = new RepuestoModelo();
		try {
			$datos = $model->aprobarOrden($orden,$usuario);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listarOrden/" );
	}
	
	// ingreso
	
	public function ingresoPreventivo(){
		$arrayId = explode('-', $_GET['id']);
		$tipo = 1;
		$model = new RepuestoModelo();
		$iteMan = $model->obtenerMantenimientoRepuesto($arrayId[0],$arrayId[1],$tipo);
		
		$datos = $model->obtenerListadoRepuestoOrden($iteMan['id']);
		$model = new OrdenPlanModelo();
		$dato = $model->obtenerOrdenes($iteMan['mantenimiento_id'], 0, 0, 0)[0];
		require_once PATH_VISTAS."/Repuesto/vista.ingresoPreventivo.php";
		
	}
	
	public function ingresoCorrectivo(){
		$arrayId = explode('-', $_GET['id']);
		$tipo = 2;
		$model = new RepuestoModelo();
		$iteMan = $model->obtenerMantenimientoRepuesto($arrayId[0],$arrayId[1],$tipo);	
		$datos = $model->obtenerListadoRepuestoOrden($iteMan['id']);
		$model = new NovedadModelo();
		
		$item = $model->obtenerNovedad($iteMan['mantenimiento_id']);
		require_once PATH_VISTAS."/Repuesto/vista.ingresoCorrectivo.php";
	
	}
	
	public function editarRepuesto(){
		$model = new RepuestoModelo();
		$arrayId = explode('-', $_GET['id']);
		$mant = $arrayId[0];
		$tipo = $model->obtenerRepuestoOrden($arrayId[1]);
		$repuestos = $model->obtenerListadoRepuesto();
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.formularioRepuesto.php";
	}
	
	public function guardarOrdenRepuesto() {
		$ordenRepuesto ['mantenimineto_respuesto_id'] = $_POST ['item_id'];
		$ordenRepuesto ['repuesto_id'] = $_POST ['repuesto_id'];
		$ordenRepuesto ['cantidad'] = $_POST ['cantidad'];
		$ordenRepuesto ['id'] = $_POST ['id'];
		
		$model = new RepuestoModelo();
		$mant = $model->obtenerMantenimientoRepuestoSimple($_POST ['item_id']);
		try {
			$datos = $model->guardarOrdenRepuesto($ordenRepuesto);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		if($mant['tipo']==1){
			header ( "Location: ../ingresoPreventivo/".$_POST ['item_id']."-0" );
		} else {
			header ( "Location: ../ingresoCorrectivo/".$_POST ['item_id']."-0" );
		}
		
	}
	
	public function eliminarOrdenRepuesto() {
		$model = new RepuestoModelo();
		$arrayId = explode('-', $_GET['id']);
		$mant = $model->obtenerMantenimientoRepuestoSimple($arrayId[0]);
		try {
			$datos = $model->eliminarRepuestoOrden($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		if($mant['tipo']==1){
			header ( "Location: ../ingresoPreventivo/".$arrayId[0]."-0" );
		} else {
			header ( "Location: ../ingresoCorrectivo/".$arrayId[0]."-0" );
		}
	}
	
	public function visualizarPdf(){
		$model = new RepuestoModelo();
		$orden = $_GET['id'];
		$datos = $model->obtenerOrden($orden);
		$datos = $datos[0];
		$repuestos = $model->obtenerListadoRepuesto($orden);
		$label = ($datos['tipo_vehiculo_id']>3&&$datos['tipo_vehiculo_id']<9)?"Odometro":"Kilometro";
		$vehiculo = ($datos['tipo_vehiculo_id']==3)?"Vehiculo Pesado": ($datos['tipo_vehiculo_id']>3&&$datos['tipo_vehiculo_id']<9)?"Maquinaria Pesada":"Vehiculo Liviano";
		$html="<html>
					<head>
						<link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'/>
						<style>
							body {
							margin: 20px 20px 20px 50px;
							}
							table{
								border-collapse: collapse; width: 100%;
							}
							td{
								border:1px solid #ccc; padding:1px;
								font-size:9pt;
							}
						</style>
					</head>
					<body>
						<center><h3>Orden de Repuesto</h3>";
					$html .=	'<table width= 100% border=1>
							<thead>
		    <tr>
		    <th colspan="8"></th>
		    <th>No. Solicitud: </th>
		    <th>'.$datos['id'].'</th>
		    </tr>
		    	<tr>  
				  	<th rowspan="3" colspan="2"  style="text-align:center">
				  		<img src="'.PATH_FILES.'../images/espoch.jpg" width="140px" height="130px"/>
				  	</th>
				    <th colspan="6" style="text-align:center">ESPOCH-GADPC</th>
				    <th rowspan="3" colspan="2" style="text-align:center">
				  		<img src="'.PATH_FILES.'../images/gobierno.jpg" width="130px" height="130px"/>
				  	</th>				    
				</tr>
				<tr>
				    <th colspan="6" style="text-align:center">SOLICITUD/ORDEN REPUESTO</th>				   
				</tr>
				<tr>
					<th >Solicitado por:</th>
				    <th colspan="3" >'.$datos['nombres'].' '.$datos['apellidos'].'</th>
				    <th>Fecha Solicitud:</th>
				    <th >'.$datos['fecha'].'</th>
				</tr>
				<tr>
				    <th style="width: 10%">Automotor</th>
				    <th style="width: 10%">'.$vehiculo.'</th>
				    <th style="width: 10%">'.$label.'</th>
				    <th style="width: 10%">'.$datos['medida_uso'].'</th>				    
				    <th style="width: 10%">N&uacute;mero:</th>
				    <th style="width: 10%">'.$datos['numero'].'</th>
				    <th style="width: 10%">Placa:</th>
				    <th style="width: 10%">'.$datos['placa'].'</th>
				    <th style="width: 10%">A&ntilde;o:</th>
				    <th style="width: 10%">'.$datos['anio'].'</th>
				    
		  	 	</tr>
		    	<tr>
			    	<th style="text-align:center">C&oacute;digo</th>
				    <th style="text-align:center" colspan="8">Repuesto</th>
				    <th style="text-align:center">Cantidad</th>
				   
			    </tr>
		    </thead>
		    <tbody>';
				    		
					foreach ($repuestos as $item) {
						$html .= "<tr><td>".$item['codigo']."</td>";
						$html .= "<td colspan='8'>".$item['nombre']."</td>";
						$html .= "<td style='text-align:center'>".$item['cantidad']."</td></tr>";
						 
					}
		$html .= "		
				<tr>
		    	 	<td>Entregado Por:</td>
		    	 	<td colspan='2'>".$datos['nombreEnt']." ".$datos['apellidoEnt']."</td>
		    	 	<td>Firma:</td>
		    	 	<td></td>
		    	 	<td>Recibido Por:</td>
		    	 	<td colspan='2'>".$datos['nombres']." ".$datos['apellidos']."</td>	
		    	 	<td>Firma:</td>
		    	 	<td></td>	    	 
		    	 </tr>
				 </tbody>				
				</table>
					</body>
				</html>";
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
	
		$dompdf->load_html($html);
		$dompdf->set_paper ('a4','landscape');
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", null, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", null, 6, array(0,0,0)); //footer
		$dompdf->stream('reporte', array("Attachment"=>false));
	}
	
}
