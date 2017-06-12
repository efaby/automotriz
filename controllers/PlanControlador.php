<?php
require_once (PATH_MODELOS . "/PlanModelo.php");

class PlanControlador {
	public function listar() {
		$model = new PlanModelo();
		$datos = $model->obtenerListadoPlan();
		$tipo = $model->obtenerTipo();		
		$message = "";
		require_once PATH_VISTAS."/Plan/vista.listado.php";
	}
	
	public function editar(){
		$model = new PlanModelo();	
		$arrayId = explode('-', $_GET['id']);
		$item = $model->obtenerPlan($arrayId[1]);
		$tipo = $arrayId[0];
		$tipoArray = $model->obtenerTipo($tipo);
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
		$plan ['unidad_id'] = $_POST ['tipo'];
		$plan ['unidad_numero'] = $_POST ['unidad_numero'];
		$plan ['alerta_numero'] = $_POST ['alerta_numero'];
		$plan ['tipo_id'] = $_POST ['tipo'];
		
		$model = new PlanModelo();
		try {
			$datos = $model->guardarPlan( $plan );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$_POST ['tipo'] );
		
	}
	
	public function eliminar() {
		$model = new PlanModelo();
		$arrayId = explode('-', $_GET['id']);
		try {
			$datos = $model->eliminarPlan($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}
	
	private function dataready($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
}
