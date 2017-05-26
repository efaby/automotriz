<?php
require_once (PATH_MODELOS . "/VehiculoPlanModelo.php");


class VehiculoPlanControlador {
	
	public function listar() {
		$model = new VehiculoPlanModelo();
		$datos = $model->obtenerListadoVehiculoPlan();
		$vehiculo = $model->obtenerVehiculoNombre();
		$message = "";
		require_once PATH_VISTAS."/VehiculoPlan/vista.listado.php";
	}
	
	public function editar(){
		$model = new VehiculoPlanModelo();
		$arrayId = explode('-', $_GET['id']);
		$item = $model->obtenerVehiculoPlan($arrayId[1]);		
		$planes = $model->obtenerPlanes($arrayId[0],$item['plan_mantenimiento_id']);
		$vehiculo_id = $arrayId[0];
		$unidad = $model->obtenerUnidad($vehiculo_id);
		$message = "";		
		require_once PATH_VISTAS."/VehiculoPlan/vista.formulario.php";
	}
	
	public function guardar() {
		
		$activoPlan ['id'] = $_POST ['id'];
		$activoPlan ['plan_mantenimiento_id'] = $_POST ['plan_mantenimiento_id'];
		$activoPlan ['vehiculo_id'] = $_POST ['vehiculo_id'];
		$activoPlan ['unidad_numero'] = $_POST ['unidad_numero'];
		$activoPlan ['fecha_registro'] = date('Y-m-d');
		$activoPlan ['fecha_inicio'] = date('Y-m-d');
		$activoPlan ['alerta_numero'] = $_POST ['alerta_numero'];
		$activoPlan ['unidad_id'] = $_POST ['unidad_id'];
		
		$model = new VehiculoPlanModelo();
		try {
			$datos = $model->guardarVehiculoPlan( $activoPlan );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$_POST ['vehiculo_id'] );
	}
	
	public function eliminar() {
		$arrayId = explode('-', $_GET['id']);
		$model = new VehiculoPlanModelo();
		try {
			$datos = $model->eliminarVehiculoPlan($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}
	
}
