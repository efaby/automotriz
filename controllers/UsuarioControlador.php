<?php
require_once (PATH_MODELOS . "/UsuarioModelo.php");
/**
 * Controlador de Usuarios
 */
class UsuarioControlador {
	
	public function listar() {
		$model = new UsuarioModelo();
		$datos = $model->obtenerListadoUsuarios();
		$tipo = $model->obtenerTipo();
		$message = "";
		require_once PATH_VISTAS."/Usuario/vista.listado.php";
	}
	
	public function editar(){
		$model = new UsuarioModelo();
		$arrayId = explode('-', $_GET['id']);
		$usuario = $model->obtenerUsuario($arrayId[1]);
		$tipo = $arrayId[0];
		$message = "";
		require_once PATH_VISTAS."/Usuario/vista.formulario.php";
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
		header ( "Location: ../listar/".$_POST ['tipo_usuario_id'] );
	}
	
	public function eliminar() {
		$model = new UsuarioModelo();
		$arrayId = explode('-', $_GET['id']);
		try {
			$datos = $model->eliminarUsuario($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}
	
}
