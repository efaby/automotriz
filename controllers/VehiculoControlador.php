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
			$usuarios = $model->obtenerConductores($vehiculo['usuario_id']);
		}
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.formulario.php";
	}
	
	public function guardar() {
		$usuario ['id'] = $_POST ['id'];
		$usuario ['identificacion'] = $_POST ['identificacion'];
		$usuario ['nombres'] = $_POST ['nombres'];
		$usuario ['apellidos'] = $_POST ['apellidos'];
		$usuario ['direccion'] = $_POST ['direccion'];
		$usuario ['tipo_usuario_id'] = $_POST ['tipo_usuario_id'];
		$usuario ['telefono'] = $_POST ['telefono'];
		$usuario ['password'] = $_POST ['password'];
		$usuario ['email'] = $_POST ['email'];
		$usuario ['celular'] = $_POST ['celular'];	
		$usuario ['usuario'] = $_POST ['identificacion'];
		$model = new UsuarioModelo();
		try {
			$datos = $model->guardarUsuario( $usuario );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new UsuarioModelo();
		try {
			$datos = $model->eliminarUsuario();
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
