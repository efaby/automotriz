<?php
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;
require_once (PATH_MODELOS . "/OrdenPlanModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");
require_once (PATH_HELPERS. "/File.php");


class OrdenPlanControlador {
	public function listar($cod = null) {
		$model = new OrdenPlanModelo();
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
		$tipo_vehiculo = $model->obtenerTipoVehiculo($id)[0];
		$datos = $model->obtenerOrdenes(null, null,$usuario, $id);
		$message = "";
		if ($cod == null){
			require_once PATH_VISTAS."/OrdenPlan/vista.listado.php";
		}else{
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
							th{
							   border:1px solid #ccc; padding:1px;
							   font-size:9pt;
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
								<th rowspan='2' style='text-align:center'>
				  					<img src=".PATH_FILES."../images/espoch.jpg width='100px' height='100px'/>
				  				</th>
				    			<th colspan='2' style='text-align:center'>ESPOCH-GADPC</th>
				    			<th rowspan='2' style='text-align:center'>
				  					<img src=".PATH_FILES."../images/gobierno.jpg width='100px' height='100px'/>
				  				</th>				    			
							</tr>
				  			<tr>
				    			<th colspan='2' style='text-align:center'>Ejecución Ordenes Planes<br>";
				    			if(count($tipo_vehiculo) >0){
				    				$html .= $tipo_vehiculo['nombre'];
				    			}
				    		$html .="</th>
							</tr>				    		
				  	  	</table><br>
						
				
						<table width= 100%>
							<tr>
						    	<td style='text-align:center'><b>ID</b></td>
							    <td style='text-align:center'><b>Vehículo/Maq.</b></td>		    
							    <td style='text-align:center'><b>Actividades</b></td>
							    <td style='text-align:center'><b>Frecuencia de Mantenimiento</b></td>
							    <td style='text-align:center'><b>Fecha de Emisión</b></td>
							    <td style='text-align:center'><b>Fecha de Atención</b></td>
							    <td style='text-align:center'><b>Estado</b></td>
							</tr>";
						if(count($datos) >0){
							$contador=1;
							foreach ($datos as $item) {
							$html .="<tr><td>".$contador."</td>";
							$html .= "<td>".$item['vehiculo_nombre']."</td>";
							$html .= "<td>".$item['plan']."</td>";
							$html .= "<td>".$item['frecuencia'];
							if ($item['unidad_id'] ==4)  $html .= " Horas"; else $html .= " Kilometros";
							$html .= "</td>";
								$html .= "<td>".$item['fecha_emision']."</td>";
								$html .= "<td>".$item['fecha_atencion']."</td>";
								$html .= "<td>";
							if ($item['atendido'] == 0) { echo "Por Atender"; }
							else{ $html .= "Atendido";}
							$html .= "</td></tr>";
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
	
	public function editar(){
		$arrayId = explode('-', $_GET['id']);
		$model = new OrdenPlanModelo();
		$usuario = 0;
		$dato = $model->obtenerOrdenes($arrayId[0], $arrayId[1],$usuario,0)[0];
		$tipo_vehiculo = $model->obtenerTipoVehiculo($dato['tipo_vehiculo_id'])[0];
		
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
		$orden ['kilometraje'] = $_POST ['kilometraje'];
	
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
						<table width= 100%>
							<tr>
								<td align=center><img src=".PATH_FILES."../images/espoch.jpg width='100px' height='100px'/></td> 
								<td align=center colspan=2>
										<h3 class='title'>Tarea de Mantenimiento</h3>
										<label class='control-label'>
											<h3>".$dato['marca']." No.".$dato['numero']."</h3>
										</label>
										<label class='control-label'>". $dato['vehiculo_nombre']."</label></td>
								<td align=center><img src=".PATH_FILES."../images/gobierno.jpg width='100px' height='100px'/></td>				
							</tr>
						</table><br>			
						<table width= 100%>				
							<tr>
								<td style='vertical-align: top'> <b>Frecuencia: </b><br><br>".$dato['unidad_numero']." </td>								
								<td style='vertical-align: top'> <b>Tiempo Estimado: </b><br><br>".$dato['tiempo_estimado']."</td>
								<td style='vertical-align: top'> <b>Estado de la Vehículo/Maquinaria: </b><br><br>".$atendido."</td>
								<td style='vertical-align: top'> <b>N° de Orden: </b><br><br>".$dato['id']."</td>
							</tr>
							<tr>
								<td colspan=4 > <b>Actividad: </b><br><br>".$dato['plan']."
							</tr>
							<tr>
								<td style='vertical-align: top'><b>Herramientas: </b><br>".htmlspecialchars_decode($dato['herramientas'])." </td>								
								<td colspan=2 style='vertical-align: top'><b>Materiales: </b><br>".htmlspecialchars_decode($dato['materiales'])."</td>
								<td style='vertical-align: top'><b>Equipo: </b><br>".htmlspecialchars_decode($dato['equipo'])."</td>
							</tr>
							<tr>
								<td colspan=4><b>Procedimiento: </b><br>".htmlspecialchars_decode($dato['procedimiento'])."</td>
							</tr>
							<tr>
								<td colspan=4> <b>Nota: </b><br>".htmlspecialchars_decode($dato['observaciones'])."</td>
							</tr>
							<tr>
								<td colspan=2> <b>Tiempo Ejecución: </b><br><br>".$tiempo." </td>								
								<td colspan=2> <b>T&eacute;cnico Asignado: </b><br><br>".$dato['nombres']." ".$dato['apellidos']."</td>
							</tr>
							<tr>
								<td colspan=4 > <b>Observación: </b><br><br>".htmlspecialchars_decode($dato['observacion'])."</td>
							</tr>
							<tr>
								<td colspan=2 ><b>Técnico Reparador: </b><br><br>".$dato['nombre_repara']." ".$dato['apellido_repara']."</td>
								<td colspan=2 ><b>Técnico Supervisor: </b><br><br>".$dato['nombre_supervisor']." ".$dato['apellido_supervisor']."</td>			
							</tr>
							<tr>
								<td colspan=2 ><b>Firma: </b><br><br><br><br></td>
								<td colspan=2 ><b>Firma: </b><br><br><br><br></td>	
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
	
	public function downloadFile(){
		$nombre = $_GET['id'];
		$upload = new File();
		return $upload->downloadPdf($nombre);
	}
	
	public function eliminar() {
		$model = new OrdenPlanModelo();
		$arrayId = explode('-', $_GET['id']);
		try {
			$datos = $model->eliminarOrden($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}
	
}