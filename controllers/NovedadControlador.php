<?php
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;

require_once (PATH_MODELOS . "/NovedadModelo.php");
require_once (PATH_MODELOS . "/VehiculoModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");


class NovedadControlador {
	
	public function ingreso(){
		$model = new NovedadModelo();
		$vehiculos = $model->obtenerVehiculos($_SESSION['SESSION_USER']['id']); //id usuario en sesion
		
		$message = "";
		require_once PATH_VISTAS."/Novedad/vista.ingreso.php";
	}
	
	public function guardar() {			
		$novedad ['problema'] = $_POST ['problema'];
		$novedad ['causa'] = $_POST ['causa'];
		$novedad ['vehiculo_id'] = $_POST ['vehiculo_id'];
		$novedad ['usuario_registra'] = $_SESSION['SESSION_USER']['id'];		
		$novedad ['fecha_ingreso'] = date('Y-m-d');
		$novedad ['tipo_falla_id'] = 0;
		
		$modelVehiculo = new VehiculoModelo();
		
		$vehiculo = $modelVehiculo->obtenerVehiculo($novedad ['vehiculo_id']);
		$novedad ['kilometraje'] = $vehiculo ['medida_uso'];
		
		$model = new NovedadModelo(); 
		try {
			$datos = $model->guardarNovedad( $novedad );
			$_SESSION ['message'] = "Datos almacenados correctamente.";			
			
		} catch ( Exception $e ) {			
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../ingreso/" );
	}

	public function listar() {
		$model = new NovedadModelo();	
		$usuario = 0;
		/* si el usuario que est en sesion es una tecnico se habilit esto */
		if($_SESSION['SESSION_USER']['tipo_usuario_id'] > 1){
			$usuario = $_SESSION['SESSION_USER']['id'];
		}
		$datos = $model->obtenerlistadoNovedad($usuario);
		$message = "";
		require_once PATH_VISTAS."/Novedad/view.listado.php";
	}
	
	public function asignar(){
		$model = new NovedadModelo();		
		$item = $model->obtenerNovedad();	
		$tecnicos = $model->obtenerTecnicos();		
		require_once PATH_VISTAS."/Novedad/view.formAsignar.php";
	}

	public function ver(){
		$model = new NovedadModelo();
		$item = $model->obtenerNovedad();
		require_once PATH_VISTAS."/Novedad/view.ver.php";
	}
	
	public function guardarAsignar() {
	
		$novedad ['id'] = $_POST ['id'];
		$novedad ['tecnico_asigna'] = $_POST ['usuario_id'];
		$novedad ['solucion'] = $_POST ['solucion'];
		$novedad ['supervisor_id'] = $_SESSION['SESSION_USER']['id'];
	
		$model = new NovedadModelo();
		try {
			$datos = $model->saveNovedad( $novedad );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
			//envio email
			/*
			if(SENDEMAIL){
				$datos = $model->getNovedadById($_POST ['id']);					
				$email = new Email();
				$email->sendNotificacionTecnico($datos->nombres .' '.$datos->apellidos, $datos->email, $datos->maquina, "http://" . $_SERVER['HTTP_HOST'] . PATH_BASE);
			} */
			
				
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function reparar(){
		$model = new NovedadModelo();
		$item = $model->obtenerNovedad();	
		$fallas = $model->obtenerFallas();
		require_once PATH_VISTAS."/Novedad/view.formReparar.php";
	}
	
	public function guardarReparar() {

		$novedad ['id'] = $_POST ['id'];
		$novedad ['proceso'] = $_POST ['proceso'];
		$novedad ['elementos'] = $_POST ['elementos'];
		$novedad ['tiempo_ejecucion'] = $_POST ['tiempo_ejecucion'];
		$novedad ['observaciones'] = $_POST ['observacion'];
		$novedad ['tecnico_repara'] = $_SESSION['SESSION_USER']['id']; 
		$novedad ['fecha_atencion'] = date('Y-m-d');
		$novedad ['atendido'] = 1;
		$novedad ['tipo_falla_id'] = $_POST ['tipo_falla_id'];
	
		$model = new NovedadModelo();
		try {
			$datos = $model->saveNovedad( $novedad );			
			$_SESSION ['message'] = "Datos almacenados correctamente.";
			/*
			// envio email
			if(SENDEMAIL){
				$email = new Email();
				$supervisor = $model->getSupervisorById();
				$novedad = $model->getNovedadById($novedad ['id']);
				$email->sendNotificacionArreglo($supervisor->nombres ." ".$supervisor->apellidos, $supervisor->email, $novedad->maquina ,"http://" . $_SERVER['HTTP_HOST'] . PATH_BASE);
					
			}
			*/
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function visualizarPdf(){
		$novedad = $_GET ['id'];
		$model = new NovedadModelo();
		$item = $model->obtenerNovedad($novedad);
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
						<center><h3>Mantenimiento Correctivo</h3></center>
						<table width= 100%>
							<tr>
								<td colspan=2 align=center><b>DESCRIPCIÓN</b></td>
							</tr>
							<tr>
								<td width='25%'><b>Vehículo</b></td>
								<td>".$item['marca']. " No. ".$item['numero']."
							</tr>
							<tr>
								<td width='25%'><b>Detalle Problema</b></td>
								<td>".$item['problema']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Causa</b></td>
								<td>".$item['causa']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Falla T&eacute;cnica</b></td>
								<td>".$item['falla']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Solución</b></td>
								<td>".$item['solucion']."</td>		
							</tr>
							<tr>
								<td width='25%'><b>Técnico Asignado</b></td>
								<td>".$item['nombre_tecnico1'] ." ".$item['apellido_tecnico1']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Estado</b></td>
								<td>";
					$html .=($item['atendido']==1)?"Cerrado":"Abierto";
					$html .="</td></tr>
							<tr>
								<td width='25%'><b>Proceso</b></td>
								<td>".$item['proceso']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Elementos</b></td>
								<td>".$item['elementos']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Observación</b></td>
								<td>".$item['observaciones']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Técnico Reparador</b></td>
								<td>".$item['nombre_tecnico2'] ." ".$item['apellido_tecnico2']."</td>
							</tr>		
						</table>
					</body>
			</html>";
						
			$options = new Options();
			$options->set('isHtml5ParserEnabled', true);
			$dompdf = new Dompdf($options);
				
			$dompdf->load_html($html);
			$dompdf->render();
			$canvas = $dompdf->get_canvas();
			$font = FontMetrics::getFont("helvetica", "bold");
			$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0)); //header
			$canvas->page_text(270, 770, "Copyright © 2017 - SAM - W&L", $font, 6, array(0,0,0)); //footer
			$dompdf->stream('novedad', array("Attachment"=>false));
	}
}