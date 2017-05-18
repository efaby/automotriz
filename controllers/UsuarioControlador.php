<?php
require_once (PATH_MODELOS . "/UsuarioModelo.php");
/**
 * Controlador de Usuarios
 */
class UsuarioControlador {
	
	public function listar() {
		$model = new UsuarioModelo();
		$datos = $model->obtenerListadoUsuarios();
		$message = "";
		require_once PATH_VISTAS."/Usuario/vista.listado.php";
	}
	
	public function editar(){
		$model = new UsuarioModelo();
		$usuario = $model->obtenerUsuario();
		$tipos = $model->obtenerTipoUsuario();
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
