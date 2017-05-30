<?php
require_once (PATH_MODELOS . "/VehiculoModelo.php");
/**
 * Controlador de Vehiculos
 */
class VehiculoControlador {
	
	public function listar() {
		$model = new VehiculoModelo();
		$datos = $model->obtenerListadoVehiculos();
		$tipo = $model->obtenerTipo();
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.listado.php";
	}
	
	public function editar(){
		$model = new VehiculoModelo();
		$arrayId = explode('-', $_GET['id']);
		$vehiculo = $model->obtenerVehiculo($arrayId[1]);
		$tipo = $arrayId[0];
		$usuarios = $model->obtenerConductores($tipo);
		$medida = "Kilometros";
		if($tipo>3){
			$medida = "Horas";
		}		
		$estados = $model->obtenerEstadoVehiculo();		
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.formulario.php";
	}

	
	public function guardar() {
		$vehiculo ['id'] = $_POST ['id'];
		$vehiculo ['tipo_vehiculo_id'] = $_POST ['tipo_vehiculo_id'];
		$vehiculo ['usuario_id'] = $_POST ['usuario_id'];
		$vehiculo ['marca'] = $_POST ['marca'];
		$vehiculo ['estado_vehiculo_id'] = $_POST ['estado_vehiculo_id'];
		$vehiculo ['numero'] = $_POST ['numero'];
		$vehiculo ['placa'] = $_POST ['placa'];
		$vehiculo ['anio'] = $_POST ['anio'];
		$vehiculo ['numero_motor'] = $_POST ['numero_motor'];	
		$vehiculo ['numero_chasis'] = $_POST ['numero_chasis'];
		$vehiculo ['medida_uso'] = $_POST ['medida_uso'];
		$model = new VehiculoModelo();
		try {
			$datos = $model->guardarVehiculo( $vehiculo );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$_POST ['tipo_vehiculo_id'] );
	}
	
	public function eliminar() {
		$model = new VehiculoModelo();
		$arrayId = explode('-', $_GET['id']);
		try {
			$datos = $model->eliminarVehiculo($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}

	public function listarplan() {
		$model = new VehiculoModelo();

		$datos = $model->obtenerListadoVehiculos();
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.listadoplan.php";
	}
	
}
