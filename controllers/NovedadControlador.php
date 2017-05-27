<?php
require_once (PATH_MODELOS . "/NovedadModelo.php");

class NovedadControlador {
	
	public function ingreso(){
		$model = new NovedadModelo();
		$vehiculos = $model->obtenerVehiculos();
		$message = "";
		require_once PATH_VISTAS."/Novedad/vista.ingreso.php";
	}
	
	public function guardar() {			
		$novedad ['problema'] = $_POST ['problema'];
		$novedad ['causa'] = $_POST ['causa'];
		$novedad ['solucion'] = $_POST ['solucion'];
		$novedad ['vehiculo_id'] = $_POST ['vehiculo_id'];
		//Poner id de Sesion
		//$novedad ['usuario_registra'] = $_SESSION['SESSION_USER']->id;
		$novedad ['usuario_registra'] = 1;
		$novedad ['fecha_ingreso'] = date('Y-m-d');
		
		$model = new NovedadModelo(); 
		try {
			$datos = $model->guardarNovedad( $novedad );
			$_SESSION ['message'] = "Datos almacenados correctamente.";			
			
		} catch ( Exception $e ) {			
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../ingreso/" );
	}
}