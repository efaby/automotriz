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
		$datos = $model->obtenerOrdenes(null, null,$usuario);
		$message = "";
		require_once PATH_VISTAS."/OrdenPlan/vista.listado.php";
	}
	
	public function editar(){
		$arrayId = explode('-', $_GET['id']);
		$model = new OrdenPlanModelo();
		$usuario = 0;
		$dato = $model->obtenerOrdenes($arrayId[0], $arrayId[1],$usuario)[0];
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
		header ( "Location: ../listar/" );					
	}
	
	public function visualizarPdf(){
		$orden = $_GET ['id'];
		$model = new OrdenPlanModelo();
		$usuario = 0;
		$dato = $model->obtenerOrdenes($orden,null,$usuario)[0];
		
		$html ="<div class='title-block' align='center'>
   					<h3 class='title'>Ejecución de Tarea de Mantenimiento</h3>
				</div>
				<div class='card'>
					<div class='card-block'>
						<div class='row'>	
							<div class='form-group  col-sm-12 border-div' align='center'>				
								<label class='control-label'><h3>".$dato['marca']." No.".$dato['numero']."</h3></label><br>
								<label class='control-label'>". $dato['vehiculo_nombre']."</label>
							</div>				
						</div>
						<div class='row match-my-cols'>
							<div class='form-group  col-sm-4 border-div'>
								<label class='control-label'>Frecuencia: </label>
							<div>".
							 $dato['unidad_numero']."	
						</div>				
					</div>
					<div class='form-group  col-sm-4 border-div '>
					<label class='control-label'>Tiempo Estimado: </label>
					<div>".
					$dato['tiempo_estimado']."
					</div>
				</div>
				<div class='form-group  col-sm-4 border-div'>
					<label class='control-label'>Estado de la Vehículo/Maquinaria: </label>
					<div>";
					if ($dato['atendido'] == 0){	
			$html .=" Por Atender";						
					} else {
			$html .=" Atendido";
					}
			$html .= "</div>
				</div>
			</div>
			<div class='row'>
				<div class='form-group  col-sm-12 border-div'>
					<label class='control-label'>Plan de Mantenimiento: </label>
					<div>".$dato['plan']."
					</div>
				</div>
			</div>	
			<div class='row match-my-cols'>
				<div class='form-group  col-sm-4 border-div'>				
					<label class='control-label'>Herramientas:</label>
					<div>".
					htmlspecialchars_decode($dato['herramientas'])."	
					</div>				
				</div>				
				<div class='form-group  col-sm-4 border-div'>				
					<label class='control-label'>Materiales:</label>
					<div>".
					htmlspecialchars_decode($dato['materiales'])."
					</div>
				</div>				
				<div class='form-group  col-sm-4 border-div'>				
					<label class='control-label'>Equipo:</label>
					<div>".
					htmlspecialchars_decode($dato['equipo'])."
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='form-group  col-sm-12 border-div'>				
					<label class='control-label'>Observaciones:</label>
					<div>".
					htmlspecialchars_decode($dato['observaciones'])."	
					</div>				
				</div>
			</div>		
			<div class='row match-my-cols'>
				<div class='form-group  col-sm-6 border-div'>
					<label class='control-label'>Tiempo Ejecución:</label>
					<div>".$dato['tiempo_ejecucion']."</div>
				</div>
				<div class='form-group  col-sm-6 border-div cellMovil'>
					<label class='control-label'>T&eacute;cnico:</label>					
					<div>".$dato['nombres']." ".$dato['apellidos']."</div> </br>		
				</div>
			</div>
			<div class='row'>
				<div class='form-group  col-sm-12 border-div'>
					<label class='control-label'>Observación:</label>
				<div>".htmlspecialchars_decode($dato['observacion'])."</div> 
			</div>
			</div>
			</div>	
		</div>";
				
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
				
		$dompdf->load_html($html);
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", null, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017 - SAM - W&L", null, 6, array(0,0,0)); //footer
		$dompdf->stream('orden'.$dato['id'], array("Attachment"=>false));		
	}
}