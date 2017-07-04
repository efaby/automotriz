<?php
require_once (PATH_MODELOS . "/RepuestoModelo.php");
require_once (PATH_MODELOS . "/OrdenPlanModelo.php");
require_once (PATH_MODELOS . "/NovedadModelo.php");

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
	
	//////////  Ordenes
	
	public function listarOrden() {
		$model = new RepuestoModelo();
		$datos = $model->obtenerListadoOrdenes();
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.listadoOrden.php";
	}
	
	
	public function verOrden() {
		$model = new RepuestoModelo();
		$orden = $_GET['id'];
		$datos = $model->obtenerOrden($orden);
		$datos = $datos[0];
		$repuestos = $model->obtenerListadoRepuesto($orden);
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.orden.php";
	}
	
	public function aprobarOrden() {
		$orden = $_POST ['id'];
		$usuario = $_SESSION['SESSION_USER']['id'];
		$model = new RepuestoModelo();
		try {
			$datos = $model->aprobarOrden($orden,$usuario);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listarOrden/" );
	}
	
	// ingreso
	
	public function ingresoPreventivo(){
		$arrayId = explode('-', $_GET['id']);
		$tipo = 1;
		$model = new RepuestoModelo();
		$iteMan = $model->obtenerMantenimientoRepuesto($arrayId[0],$arrayId[1],$tipo);
		
		$datos = $model->obtenerListadoRepuestoOrden($iteMan['id']);
		$model = new OrdenPlanModelo();
		$dato = $model->obtenerOrdenes($iteMan['mantenimiento_id'], 0, 0, 0)[0];
		require_once PATH_VISTAS."/Repuesto/vista.ingresoPreventivo.php";
		
	}
	
	public function ingresoCorrectivo(){
		$arrayId = explode('-', $_GET['id']);
		$tipo = 2;
		$model = new RepuestoModelo();
		$iteMan = $model->obtenerMantenimientoRepuesto($arrayId[0],$arrayId[1],$tipo);	
		$datos = $model->obtenerListadoRepuestoOrden($iteMan['id']);
		$model = new NovedadModelo();
		$item = $model->obtenerNovedad();
		require_once PATH_VISTAS."/Repuesto/vista.ingresoCorrectivo.php";
	
	}
	
	public function editarRepuesto(){
		$model = new RepuestoModelo();
		$arrayId = explode('-', $_GET['id']);
		$mant = $arrayId[0];
		$tipo = $model->obtenerRepuestoOrden($arrayId[1]);
		$repuestos = $model->obtenerListadoRepuesto();
		$message = "";
		require_once PATH_VISTAS."/Repuesto/vista.formularioRepuesto.php";
	}
	
	public function guardarOrdenRepuesto() {
		$ordenRepuesto ['mantenimineto_respuesto_id'] = $_POST ['item_id'];
		$ordenRepuesto ['repuesto_id'] = $_POST ['repuesto_id'];
		$ordenRepuesto ['cantidad'] = $_POST ['cantidad'];
		$ordenRepuesto ['id'] = $_POST ['id'];
		
		$model = new RepuestoModelo();
		$mant = $model->obtenerMantenimientoRepuestoSimple($_POST ['item_id']);
		try {
			$datos = $model->guardarOrdenRepuesto($ordenRepuesto);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		if($mant['tipo']==1){
			header ( "Location: ../ingresoPreventivo/".$_POST ['item_id']."-0" );
		} else {
			header ( "Location: ../ingresoCorrectivo/".$_POST ['item_id']."-0" );
		}
		
	}
	
	public function eliminarOrdenRepuesto() {
		$model = new RepuestoModelo();
		$arrayId = explode('-', $_GET['id']);
		$mant = $model->obtenerMantenimientoRepuestoSimple($arrayId[0]);
		try {
			$datos = $model->eliminarRepuestoOrden($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		if($mant['tipo']==1){
			header ( "Location: ../ingresoPreventivo/".$arrayId[0]."-0" );
		} else {
			header ( "Location: ../ingresoCorrectivo/".$arrayId[0]."-0" );
		}
	}
	
	
	
}
