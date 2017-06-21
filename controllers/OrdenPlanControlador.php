<?php
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
require_once (PATH_MODELOS . "/OrdenPlanModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");


class OrdenPlanControlador {
	public function listar() {
		$model = new OrdenPlanModelo();
		$usuario = 0;
		/* si el usuario que est en sesion es una tecnico se habilit esto */
		if($_SESSION['SESSION_USER']['tipo_usuario_id'] > 1){
			$usuario = $_SESSION['SESSION_USER']['id'];
		}
		$id = $_GET['id'];
		$datos = $model->obtenerOrdenes(null, null,$usuario, $id);
		$message = "";
		require_once PATH_VISTAS."/OrdenPlan/vista.listado.php";
	}
	
	public function editar(){
		$arrayId = explode('-', $_GET['id']);
		$model = new OrdenPlanModelo();
		$usuario = 0;
		$dato = $model->obtenerOrdenes($arrayId[0], $arrayId[1],$usuario,0)[0];
		$ban = $arrayId[1];
		$message = "";		
		require_once PATH_VISTAS."/OrdenPlan/vista.formulario.php";		
	}
	
	public function guardar() {	
		$orden ['id'] = $_POST ['id'];
		$orden ['observacion'] = $_POST ['observacion'];
		$orden ['tiempo_ejecucion'] = $_POST ['tiempo_ejecucion'];
		$orden ['fecha_atencion'] = date('Y-m-d');
		$orden ['tecnico_atiende'] = $_SESSION['SESSION_USER']['id'];
		$orden ['atendido'] = 1;
	
		$model = new OrdenPlanModelo();
		try {
			$datos = $model->guardarOrdenPlan($orden);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
				
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$_POST ['tipo'] );					
	}
	
	public function visualizarPdf(){
		$orden = $_GET ['id'];
		$model = new OrdenPlanModelo();
		$usuario = 0;
		$dato = $model->obtenerOrdenes($orden,null,$usuario,0)[0];
		$atendido = ($dato['estado_maquina']==0)?'Apagado':'Prendido';
		$tiempo = ($dato['atendido']==0)?'Por Atender':$dato['tiempo_ejecucion'];
		$html ="<html>
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
						<div class='title-block' align='center'>
		   					<h3 class='title'>Tarea de Mantenimiento</h3>
						</div>
						<table width= 100%>
							<tr>
								<td colspan=3 align=center><label class='control-label'><h3>".$dato['marca']." No.".$dato['numero']."</h3></label>
										<label class='control-label'>". $dato['vehiculo_nombre']."</label></td>
							</tr>
							<tr>
								<td style='vertical-align: top'> <b>Frecuencia: </b><br><br>".$dato['unidad_numero']." </td>								
								<td style='vertical-align: top'> <b>Tiempo Estimado: </b><br><br>".$dato['tiempo_estimado']."</td>
								<td style='vertical-align: top'> <b>Estado de la Vehículo/Maquinaria: </b><br><br>".$atendido."</td>
							</tr>
							<tr>
								<td colspan=3 > <b>Actividad: </b><br><br>".$dato['plan']."
							</tr>
							<tr>
								<td style='vertical-align: top'><b>Herramientas: </b><br>".htmlspecialchars_decode($dato['herramientas'])." </td>								
								<td style='vertical-align: top'><b>Materiales: </b><br>".htmlspecialchars_decode($dato['materiales'])."</td>
								<td style='vertical-align: top'><b>Equipo: </b><br>".htmlspecialchars_decode($dato['equipo'])."</td>
							</tr>
							<tr>
								<td colspan=3 > <b>Procedimiento: </b><br><br>".htmlspecialchars_decode($dato['procedimiento'])."</td>
							</tr>
							<tr>
								<td colspan=3 > <b>Nota: </b><br><br>".htmlspecialchars_decode($dato['observaciones'])."</td>
							</tr>
							<tr>
								<td> <b>Tiempo Ejecución: </b><br><br>".$tiempo." </td>								
								<td colspan=2 > <b>T&eacute;cnico: </b><br><br>".$dato['nombres']." ".$dato['apellidos']."</td>
							</tr>
							<tr>
								<td colspan=3 > <b>Observación: </b><br><br>".htmlspecialchars_decode($dato['observacion'])."
							</tr>
						</table>
						
			</body></html>";

		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
				
		$dompdf->load_html($html);
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", null, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", null, 6, array(0,0,0)); //footer
		$dompdf->stream('orden'.$dato['id'], array("Attachment"=>false));		
	}
}