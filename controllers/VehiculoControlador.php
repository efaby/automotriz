<?php
require_once (PATH_MODELOS . "/VehiculoModelo.php");
/**
 * Controlador de Vehiculos
 */
class VehiculoControlador {
	
	public function listar() {
		$model = new VehiculoModelo();
		$datos = $model->obtenerListadoVehiculos();
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.listado.php";
	}
	
	public function editar(){
		$model = new VehiculoModelo();
		$vehiculo = $model->obtenerVehiculo();
		$categorias = $model->obtenerTipoVehiculo(0);
		$estados = $model->obtenerEstadoVehiculo();
		$clases = $tipos = $usuarios = array();
		if($vehiculo['id']>0){
			$clases = $model->obtenerTipoVehiculo($vehiculo['categoria_id']);
			$tipos = $model->obtenerTipoVehiculo($vehiculo['clase_id']);
			$usuarios = $model->obtenerConductores($vehiculo['categoria_id']);
		}
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.formulario.php";
	}

	public function loadConductorVehiculo(){
		$opcion = $_POST ['opcion'];
		$model = new VehiculoModelo();
		$items = $model->obtenerConductores($opcion);
		$html ='<option value="" >Seleccione</option>';
		foreach ($items as $dato) {
			$html .='<option value="'.$dato['id'].'" >'.$dato['nombres'].' '.$dato['apellidos'].'</option>';
		}
		
		echo $html;
	}

	public function loadTipoVehiculo(){
		$opcion = $_POST ['opcion'];
		$model = new VehiculoModelo();
		$items = $model->obtenerTipoVehiculo($opcion);
		$html ='<option value="" >Seleccione</option>';
		foreach ($items as $dato) {
			$html .='<option value="'.$dato['id'].'" >'.$dato['nombre'].'</option>';
		}
		
		echo $html;
	}
	
	public function guardar() {
		$vehiculo ['id'] = $_POST ['id'];
		$vehiculo ['tipo_vehiculo_id'] = $_POST ['tipo_vehiculo_id'];
		$vehiculo ['usuario_id'] = $_POST ['usuario_id'];
		$vehiculo ['marca'] = $_POST ['marca'];
		$vehiculo ['modelo'] = $_POST ['modelo'];
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
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new VehiculoModelo();
		try {
			$datos = $model->eliminarVehiculo();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}

	public function listarplan() {
		$model = new VehiculoModelo();
		$datos = $model->obtenerListadoVehiculos();
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.listadoplan.php";
	}
	
}
