<?php
require_once (PATH_MODELOS . "/PlanModelo.php");

class PlanControlador {
	public function listar() {
		$model = new PlanModelo();
		$datos = $model->obtenerListadoPlan();
		$message = "";
		require_once PATH_VISTAS."/Plan/vista.listado.php";
	}
	
	public function editar(){
		$model = new PlanModelo();		
		$item = $model->obtenerPlan();	
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
		
		
		$model = new PlanModelo();
		try {
			$datos = $model->guardarPlan( $plan );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new PlanModelo();
		try {
			$datos = $model->eliminarPlan();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	private function dataready($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
}
