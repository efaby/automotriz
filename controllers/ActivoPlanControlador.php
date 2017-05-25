<?php
require_once (PATH_MODELOS . "/ActivoPlanModelo.php");


class ActivoPlanControlador {
	
	public function listar() {
		$model = new ActivoPlanModelo();
		$datos = $model->obtenerListadoActivoPlan();
		$activo = $model->obtenerActivoNombre();
		$message = "";
		require_once PATH_VISTAS."/ActivoPlan/vista.listado.php";
	}
	
	public function editar(){
		$model = new ActivoPlanModelo();
		$arrayId = explode('-', $_GET['id']);
		$item = $model->obtenerActivoPlan($arrayId[1]);
		$frecuencias = $model->getFrecuencias();
		$planes = $model->getPlanes($arrayId[0],$item->plan_mantenimiento_id);
		$partes = $model->getPartes($arrayId[0]);
		$activo_id = $arrayId[0];
		$message = "";		
		require_once PATH_VIEWS."/ActivoPlan/vista.formulario.php";
	}
	
/*	public function guardar() {
		
		$activoPlan ['id'] = $_POST ['id'];
		$activoPlan ['plan_mantenimiento_id'] = $_POST ['plan_mantenimiento_id'];
		$activoPlan ['activo_fisico_id'] = $_POST ['activo_fisico_id'];
		$activoPlan ['frecuencia_numero'] = $_POST ['frecuencia_numero'];
		$activoPlan ['frecuencia_id'] = $_POST ['frecuencia_id'];
		$activoPlan ['fecha_registro'] = date('Y-m-d');
		$activoPlan ['fecha_inicio'] = date('Y-m-d');
		$activoPlan ['alerta_numero'] = $_POST ['alerta_numero'];
		$activoPlan ['parte_maquina_id'] = $_POST ['parte_maquina_id'];
		
		$model = new ActivoPlanModel();
		try {
			$datos = $model->saveActivoPlan( $activoPlan );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$_POST ['activo_fisico_id'] );
	}
	
	public function eliminar() {
		$arrayId = explode('-', $_GET['id']);
		$model = new ActivoPlanModel();
		try {
			$datos = $model->delActivoPlan($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}*/
	
}
