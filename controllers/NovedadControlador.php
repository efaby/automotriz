<?php
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;

require_once (PATH_MODELOS . "/NovedadModelo.php");
require_once (PATH_MODELOS . "/VehiculoModelo.php");
require_once (PATH_MODELOS . "/RegistroModelo.php");
require_once (PATH_MODELOS . "/OrdenPlanModelo.php");
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
		$novedad ['kilometraje'] = $_POST ['numero_ingreso'];
		
		
		$model = new NovedadModelo(); 
		try {
			$datos = $model->guardarNovedad( $novedad );
			$_SESSION ['message'] = "Datos almacenados correctamente.";			
			
		} catch ( Exception $e ) {			
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../ingreso/" );
	}

	public function obtenerVehiculo(){
		$id = $_POST['id'];
		$model = new RegistroModelo();
		$medida_uso = $model->obtenerValidacion($id);
		$result = array('medida'=>0, 'tipo'=>0);
		
		if(count($medida_uso)>0){
			$result['medida'] = $medida_uso[0]['medida_uso'];
			$result['tipo'] = $medida_uso[0]['tipo_vehiculo_id'];
		} 
		echo json_encode($result);
	}
	
	public function listar($cod = null) {
		$model = new NovedadModelo();
		$modelOrdenPlan = new OrdenPlanModelo();
		$usuario = 0;
		/* si el usuario que est en sesion es una tecnico se habilit esto */
		if($_SESSION['SESSION_USER']['tipo_usuario_id'] > 1){
			$usuario = $_SESSION['SESSION_USER']['id'];
		}
		if ($cod == null){
			$id = $_GET['id'];
		}else{
			$id = $cod;
		}
		$datos = $model->obtenerlistadoNovedad($usuario,$id);
		
		$tipo_vehiculo = $modelOrdenPlan->obtenerTipoVehiculo($id)[0];
		$message = "";
		if ($cod == null){
			require_once PATH_VISTAS."/Novedad/view.listado.php";
		}
		else{
			$array = [];
			$array[0] = $datos;
			$array[1] = $tipo_vehiculo;
			return $array;
		}
	}
	
	public function visualizarLista(){
		$id = $_GET['id'];
		$array = self::listar($id);
		$tipo_vehiculo = $array[1];
		$datos = $array[0];
		
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
		   					<h3 class='title'>Mantenimiento Correctivo ";
		if(count($tipo_vehiculo) >0){
			$html .= $tipo_vehiculo['nombre'];
		}
		$html .="			</h3>
						</div>
						<table width= 100%>
							<tr>
						    	<td style='text-align:center'><b>ID</b></td>
							    <td style='text-align:center'><b>Vehículo/Maq.</b></td>
							    <td style='text-align:center'><b>Conductor</b></td>
							    <td style='text-align:center'><b>Problema</b></td>
							    <td style='text-align:center'><b>Ingreso</b></td>
							    <td style='text-align:center'><b>Atención</b></td>
								<td style='text-align:center'><b>Estado</b></td>
							</tr>";
			if(count($datos) >0){
				$contador=1;
				foreach ($datos as $item) {
				$html .= "<tr><td>".$contador."</td>";
					$html .= "<td>".$item['marca']." No. ".$item['numero']."</td>";
					$html .= "<td>".$item['nombre_usuario']." ".$item['apellido_usuario']."</td>";
					$html .= "<td>".substr ( $item['problema'] , 0 ,20 )."</td>";
					$html .= "<td>".$item['fecha_ingreso']."</td>";
					$html .= "<td>".$item['fecha_atencion']."</td>";
					$estado = ($item['atendido']==1)?'Cerrado':'Abierto';
					$html .= "<td>".$estado."</td></tr>";
					$contador++;
					}
				}
		$html .="</table>
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
	
	public function asignar(){
		$model = new NovedadModelo();		
		$item = $model->obtenerNovedad();	
		$tecnicos = $model->obtenerTecnicos();		
		require_once PATH_VISTAS."/Novedad/view.formAsignar.php";
	}

	public function ver(){
		$id = $_GET['id'];
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
		header ( "Location: ../listar/".$_POST ['tipo'] );
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
		header ( "Location: ../listar/".$_POST ['tipo'] );
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
						<table width= 100%>
							<tr>
								<td width='25%'>
									<img src=".PATH_FILES."../images/espoch.jpg width='140px' height='130px'/>
								</td>
								<td>
									<h3>Mantenimiento Correctivo ".$item['tipo_vehiculo']."</h3>
								</td>
								<td width='25%'>
									<img src=".PATH_FILES."../images/gobierno.jpg width='130px' height='130px'/>		
								</td>
							</tr>
							<tr>
								<td colspan=3 align=center><b>DESCRIPCIÓN</b></td>
							</tr>
							<tr>
								<td width='25%'><b>Vehículo</b></td>
								<td colspan=2>".$item['marca']. " No. ".$item['numero']."
							</tr>
							<tr>
								<td width='25%'><b>Detalle Problema</b></td>
								<td colspan=2>".$item['problema']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Causa</b></td>
								<td colspan=2>".$item['causa']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Falla T&eacute;cnica</b></td>
								<td colspan=2>".$item['falla']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Solución</b></td>
								<td colspan=2>".$item['solucion']."</td>		
							</tr>
							<tr>
								<td width='25%'><b>Técnico Asignado</b></td>
								<td colspan=2>".$item['nombre_tecnico1'] ." ".$item['apellido_tecnico1']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Estado</b></td>
								<td colspan=2>";
					$html .=($item['atendido']==1)?"Cerrado":"Abierto";
					$html .="</td></tr>
							<tr>
								<td width='25%'><b>Proceso</b></td>
								<td colspan=2>".$item['proceso']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Elementos</b></td>
								<td colspan=2>".$item['elementos']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Observación</b></td>
								<td colspan=2>".$item['observaciones']."</td>
							</tr>
							<tr>
								<td width='25%'><b>Técnico Reparador</b></td>
								<td colspan=2>".$item['nombre_tecnico2'] ." ".$item['apellido_tecnico2']."</td>
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
			$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", null, 6, array(0,0,0)); //header
			$canvas->page_text(270, 770, "Copyright © 2017", null, 6, array(0,0,0)); //footer
			$dompdf->stream('novedad', array("Attachment"=>false));
	}
}