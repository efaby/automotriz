<?php
require_once (PATH_MODELOS . "/OrdenPlanModelo.php");

class OrdenPlanControlador {
	public function listar() {
		$model = new OrdenPlanModelo();
		$datos = $model->obtenerOrdenes(null);
		$message = "";
		require_once PATH_VISTAS."/OrdenPlan/vista.listado.php";
	}
	
	public function editar(){
		$id = $_GET['id'];
		$model = new OrdenPlanModelo();
		$dato = $model->obtenerOrdenes($id)[0];
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
}