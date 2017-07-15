<?php
use Dompdf\Options;
use Dompdf\Dompdf;
use Dompdf\FontMetrics;

require_once (PATH_MODELOS . "/ReparacionModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");


class ReparacionControlador {
	
	public function listar(){
		$model = new ReparacionModelo();
		$tipo = $_GET['id'];
		$datos = $model->obtenerReparaciones($tipo,$_SESSION['SESSION_USER']['id']);		
		$message = "";
		require_once PATH_VISTAS."/Reparacion/view.listado.php";
	}
	
	
	
	public function visualizarPdf(){
		$tipo = $_GET ['id'];
		$model = new ReparacionModelo();
		$datos = $model->obtenerReparaciones($tipo,$_SESSION['SESSION_USER']['id']);
		if($tipo == 1) {
			echo " Atendidas";
			$tipo = "Atendidas";
		} else if($tipo == 2){
			echo " Nuevas";
			$tipo = "Nuevas";
		} else {
			echo " Pendientes";
			$tipo = "Pendientes";
		}
		$title = "Listado Reparaciones ".$tipo;
		
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
				    			<th colspan='2' style='text-align:center'>".$title."</th>
							</tr>
				  	  	</table><br>
						<table width= 100%>
							<tr>
						    	<td style='text-align:center'><b>ID</b></td>
							    <td style='text-align:center'><b>Vehículo/Maq.</b></td>
							    <td style='text-align:center'><b>Conductor / Operador</b></td>
							    <td style='text-align:center'><b>Actividad</b></td>
							    <td style='text-align:center'><b>Tipo</b></td>
							    <td style='text-align:center'><b>Estado</b></td>
							</tr>";
		if(count($datos) >0){
			$contador=1;
			foreach ($datos as $item) {
				$html .= "<tr><td>".$contador."</td>";
				$html .= "<td>".$item['marca']." No. ".$item['numero']."</td>";
				$html .= "<td>".$item['nombres']." ".$item['apellidos']."</td>";
				$html .= "<td>".substr ( $item['actividad'] , 0 ,20 )."</td>";
				$html .= "<td>".$item['tipo']."</td>";
				$html .= "<td>".$tipo."</td>";
				
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
}