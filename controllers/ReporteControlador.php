<?php
use Dompdf\Options;
use Dompdf\Dompdf;
require_once (PATH_MODELOS . "/ReporteModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");


/**
 * Controlador de Reportes
 */
class ReporteControlador {
	
	public function listar() {
		$model = new ReporteModelo();
		$datos = $model->obtenerListadoVehiculos();
		$tipo = $model->obtenerTipo();
		$message = "";
		require_once PATH_VISTAS."/Reporte/vista.listado.php";
	}
	
	public function obtenerVariables($plan){
		$array = [];
		if ($plan < 4 || $plan >8){
			$array[0] ="Conductor";
			$array[1] = "Kilometros";
			$array[2] = "Odometro(Km)";
		}
		else
		{
			$array[0] ="Operador";
			$array[1] = "Horas";
			$array[2] = "Horómetro(H)";
		}
		return $array;
	}
	
	public function verReporte($id=null){
		if($id == null){
			$arrayId = explode('-', $_GET['id']);
		}
		else{
			$arrayId = explode('-', $id);
		}
		$model = new ReporteModelo();
		$vehiculo = $model->obtenerVehiculo($arrayId[0]);		
		if($arrayId[1]==1){
			$listado = $model->obtenerPreventivos($arrayId[0]);
			$variables = self::obtenerVariables($vehiculo['tipo_vehiculo_id']);
		} else {
			if($arrayId[1]==2){
				$listado = $model->obtenerCorrectivos($arrayId[0]);
				$variables = self::obtenerVariables($vehiculo['tipo_vehiculo_id']);
			} else {
				$listado = $model->obtenerFallas($arrayId[0]);
				$variables = self::obtenerVariables($vehiculo['tipo_vehiculo_id']);			
			}
		}
		if($id == null){
			require_once PATH_VISTAS."/Reporte/vista.listadoReporte.php";
		}else{
			$resul[0] =$listado; 
			$resul[1] =$variables;
			return $resul;
		}
	}
	
	public function visualizarPdf(){
		$arrayId = explode('-', $_GET['id']);
		$array = self::verReporte($_GET['id']);
		$listado =  $array[0];
		$variables =  $array[1];
		$model = new ReporteModelo();
		$vehiculo = $model->obtenerVehiculo($arrayId[0]);
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
						<center><h3>Historial de Mantenimiento ";
						$title = ($arrayId[1] ==1)?"Preventivo": "Correctivo";
		$html .=$title."</h3><table width= 100% border=1>
							<tr>
								<th rowspan='3' style='text-align:center'>
				  					<img src=".PATH_FILES."../images/espoch.jpg width='140px' height='130px'/>				  				
				  				</th>
				    			<th colspan='4' style='text-align:center'>ESPOCH-GADPC</th>
				    			<th rowspan='3' style='text-align:center'>
				  					<img src=".PATH_FILES."../images/gobierno.jpg width='130px' height='130px'/>
				  				</th>	
				    			<th rowspan='2'>".$variables[0]."</th>
				    			<th rowspan='2'>".$vehiculo['nombres']." ".$vehiculo['apellidos']."</th>
							</tr>
							<tr>
				    			<th colspan='4' style='text-align:center'>REGISTRO DE TRABAJO/REPARACIÓN</th>				   
							</tr>
							<tr>
				    			<th colspan='4' style='text-align:center'>".$vehiculo['nombre_vehiculo']."</th>
				    			<th>Año del Automotor</th>
				    			<th>".$vehiculo['anio']."
				    			</th>
		  	 				</tr>
		    				<tr>
			    				<th style='text-align:center'>F. de Creación del Mant.</th>
							    <th style='text-align:center'>".$variables[2]."</th>
							    <th style='text-align:center'>Actividad</th>
							    <th style='text-align:center'>N° Orden <br>de Trabajo</th>
							    <th style='text-align:center'>N° Orden <br>de Repuestas</th>
							    <th style='text-align:center'>Tiempos <br>de Ejecución</th>
							    <th style='text-align:center'>Responsable</th>
							    <th style='text-align:center'>Observación</th>
			    			</tr>";	
					foreach ($listado as $item) {
						$html .="<tr><td style='border-bottom-color: black'>".$item['fecha_emision']."</td>
									 <td style='border-bottom-color: black'>".$item['kilometraje']." " .$variables[1]."</td>
									 <td style='border-bottom-color: black'>".$item['actividad']."</td>
									 <td style='border-bottom-color: black'>".$item['id']."</td>
									 <td style='border-bottom-color: black'> Falta poner".$item['id']."</td>
									 <td style='border-bottom-color: black'>".$item['tiempo_ejecucion']." </td>
									 <td style='border-bottom-color: black'>".$item['nombres']." ".$item['apellidos']."</td>
									 <td style='border-bottom-color: black;border-right-color: black'>".$item['observacion']." </td></tr>";
					}
		$html .="		</table>
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