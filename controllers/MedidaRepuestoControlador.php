<?php
require_once (PATH_MODELOS . "/MedidaRepuestoModelo.php");
/**
 * Controlador de Tipo Falla
 */
class MedidaRepuestoControlador {
	
	public function listar() {
		$model = new MedidaRepuestoModelo();
		$datos = $model->obtenerMedidasRepuestos();
		$message = "";
		require_once PATH_VISTAS."/MedidaRepuesto/vista.listado.php";
	}
	
	public function editar(){
		$model = new MedidaRepuestoModelo();
		$tipoId = $_GET['id'];
		$tipo = $model->obtenerMedidaRepuesto($tipoId);
		$message = "";
		require_once PATH_VISTAS."/MedidaRepuesto/vista.formulario.php";
	}
	
	public function guardar() {
		$tipo ['id'] = $_POST ['id'];
		$tipo ['nombre'] = $_POST ['nombre'];		
		$tipo ['eliminado'] = 0;
		
		$model = new MedidaRepuestoModelo();
		try {
			$datos = $model->guardarMedidaRepuesto($tipo);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function eliminar() {
		$model = new MedidaRepuestoModelo();
		$tipoId = $_GET['id'];
		try {
			$datos = $model->eliminarMedidaRepuesto($tipoId);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
}
