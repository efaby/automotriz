<?php
require_once (PATH_MODELOS . "/RepuestoModelo.php");
/**
 * Controlador de Tipo Falla
 */
class RepuestoControlador {
	
	public function listar() {
		$model = new RepuestoModelo();
		$datos = $model->obtenerListadoRepuesto();
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.listado.php";
	}
	
	public function editar(){
		$model = new RepuestoModelo();
		$tipoId = $_GET['id'];
		$tipo = $model->obtenerRepuesto($tipoId);
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.formulario.php";
	}
	
	public function guardar() {
		$repuesto ['id'] = $_POST ['id'];
		$repuesto ['nombre'] = $_POST ['nombre'];
		$repuesto ['codigo'] = $_POST ['codigo'];		
		$repuesto ['cantidad'] = $_POST ['cantidad'];	
		$repuesto ['eliminado'] = 0;
		
		$model = new RepuestoModelo();
		try {
			$datos = $model->guardarRepuesto($repuesto);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new RepuestoModelo();
		$tipoId = $_GET['id'];
		try {
			$datos = $model->eliminarRepuesto($tipoId);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
