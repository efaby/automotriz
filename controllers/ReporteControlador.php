<?php
use Dompdf\Options;
use Dompdf\Dompdf;
require_once (PATH_MODELOS . "/ReporteModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");


/**
 * Controlador de Vehiculos
 */
class ReporteControlador {
	
	public function listar() {
		$model = new ReporteModelo();
		$datos = $model->obtenerListadoVehiculos();
		$tipo = $model->obtenerTipo();
		$message = "";
		require_once PATH_VISTAS."/Reporte/vista.listado.php";
	}
	
	public function verReporte(){
		$arrayId = explode('-', $_GET['id']);
		$model = new ReporteModelo();
		$vehiculo = $model->obtenerVehiculo($arrayId[0]);
		
		if($arrayId[1]==1){
			$listado = $model->obtenerPreventivos($arrayId[0]);
		} else {
			if($arrayId[1]==2){
				$listado = $model->obtenerCorrectivos($arrayId[0]);
			} else {
				
			}
		}
		
		require_once PATH_VISTAS."/Reporte/vista.listadoReporte.php";
	}
	
}