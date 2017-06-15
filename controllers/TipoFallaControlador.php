<?php
require_once (PATH_MODELOS . "/TipoFallaModelo.php");
/**
 * Controlador de Tipo Falla
 */
class TipoFallaControlador {
	
	public function listar() {
		$model = new TipoFallaModelo();
		$datos = $model->obtenerListadoTipoFalla();
		$message = "";
		require_once PATH_VISTAS."/TipoFalla/vista.listado.php";
	}
	
	public function editar(){
		$model = new TipoFallaModelo();
		$tipoId = $_GET['id'];
		$tipo = $model->obtenerTipoFalla($tipoId);
		$message = "";
		require_once PATH_VISTAS."/TipoFalla/vista.formulario.php";
	}
	
	public function guardar() {
		$tipo ['id'] = $_POST ['id'];
		$tipo ['nombre'] = $_POST ['nombre'];
		$tipo ['descripcion'] = $_POST ['descripcion'];		
		$tipo ['eliminado'] = 0;
		
		$model = new TipoFallaModelo();
		try {
			$datos = $model->guardarTipoFalla($tipo);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new TipoFallaModelo();
		$tipoId = $_GET['id'];
		try {
			$datos = $model->eliminarTipoFalla($tipoId);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
