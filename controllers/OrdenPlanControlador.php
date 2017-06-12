<?php
require_once (PATH_MODELOS . "/OrdenPlanModelo.php");

class OrdenPlanControlador {
	public function listar() {
		$model = new OrdenPlanModelo();
		$usuario = 0;
		/* si el usuario que est en sesion es una tecnico se habilit esto */
		if($_SESSION['SESSION_USER']['tipo_usuario_id'] > 1){
			$usuario = $_SESSION['SESSION_USER']['id'];
		}
		$datos = $model->obtenerOrdenes(null, null,$usuario);
		$message = "";
		require_once PATH_VISTAS."/OrdenPlan/vista.listado.php";
	}
	
	public function editar(){
		$arrayId = explode('-', $_GET['id']);
		$model = new OrdenPlanModelo();
		$usuario = 0;
		$dato = $model->obtenerOrdenes($arrayId[0], $arrayId[1],$usuario)[0];
		$ban = $arrayId[1];
		$message = "";		
		require_once PATH_VISTAS."/OrdenPlan/vista.formulario.php";		
	}
	
	public function guardar() {	
		$orden ['id'] = $_POST ['id'];
		$orden ['observacion'] = $_POST ['observacion'];
		$orden ['tiempo_ejecucion'] = $_POST ['tiempo_ejecucion'];
		$orden ['fecha_atencion'] = date('Y-m-d');
		$orden ['tecnico_atiende'] = $_SESSION['SESSION_USER']['id'];
		$orden ['atendido'] = 1;
	
		$model = new OrdenPlanModelo();
		try {
			$datos = $model->guardarOrdenPlan($orden);
			$_SESSION ['message'] = "Datos almacenados correctamente.";
				
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );					
	}	
}