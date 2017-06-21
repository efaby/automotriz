<?php
use Dompdf\Options;
use Dompdf\Dompdf;
require_once (PATH_MODELOS . "/PlanModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");


class PlanControlador {
	public function listar() {
		$model = new PlanModelo();
		$datos = $model->obtenerListadoPlan();
		$tipo = $model->obtenerTipo();		
		$message = "";
		require_once PATH_VISTAS."/Plan/vista.listado.php";
	}
	
	public function editar(){
		$model = new PlanModelo();	
		$arrayId = explode('-', $_GET['id']);
		$item = $model->obtenerPlan($arrayId[1]);
		$tipo = $arrayId[0];
		$tipoArray = $model->obtenerTipo($tipo);
		$tecnicos = $model->obtenerTecnicos();	
		require_once PATH_VISTAS."/Plan/vista.formulario.php";
	}
	
	public function guardar() {
		$plan ['id'] = $_POST ['id'];
		$plan ['tarea'] = $_POST ['tarea'];
		$plan ['tiempo_ejecucion'] = $_POST ['tiempo_ejecucion'];
		$plan ['estado_maquina'] = $_POST ['estado_maquina'];
		$plan ['herramientas'] = $_POST ['herramientas'];
		$plan ['materiales'] = $_POST ['materiales'];	
		$plan ['equipo'] = $_POST ['equipo'];
		$plan ['procedimiento'] = $this->dataready($_POST ['procedimiento']);
		$plan ['observaciones'] = $this->dataready($_POST ['observaciones']);
		$plan ['tecnico_id'] = $_POST ['tecnico_id'];
		$plan ['unidad_id'] = $_POST ['tipo'];
		$plan ['unidad_numero'] = $_POST ['unidad_numero'];
		$plan ['alerta_numero'] = $_POST ['alerta_numero'];
		$plan ['tipo_id'] = $_POST ['tipo'];
		
		$model = new PlanModelo();
		try {
			$datos = $model->guardarPlan( $plan );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$_POST ['tipo'] );
		
	}
	
	public function eliminar() {
		$model = new PlanModelo();
		$arrayId = explode('-', $_GET['id']);
		try {
			$datos = $model->eliminarPlan($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}
	
	private function dataready($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	public function visualizarPdf(){
		$tipo_id = $_GET ['id'];
		$model = new PlanModelo();
		$datos = $model->obtenerListadoPlan($tipo_id);
		$tipo = $model->obtenerTipo($tipo_id);		
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
						<center><h3>Listado de Planes de Mantenimiento<br>".$tipo['descripcion']."</h3></center>
						<table width= 100%>
							 <tr>
						    	<td><b>ID</b></td>
							    <td><b>Actividades</b></td>
							    <td><b>Tiempo Ejecución</b></td>
								<td><b>Técnico Asignado</b></td>
							    <td><b>Estado Máquina</b></td>
							</tr>";
		$contador =1;
		foreach ($datos as $item) {
			$estado = ($item['estado_maquina'])?'Encendida':'Apagada';
			$html .= "<tr><td>".$contador."</td>
						  <td>".$item['tarea']."</td>
						  <td>".$item['tiempo_ejecucion']."</td>
						  <td>".$item['nombres']." ".$item['apellidos']."</td>
						  <td>".$estado."</td></tr>";
			$contador++;
		}
		$html .="</table>
					</body>
				</html>";
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
	
		$dompdf->load_html($html);
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", null, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", null, 6, array(0,0,0)); //footer
		$dompdf->stream('vehiculo', array("Attachment"=>false));
	}
}
