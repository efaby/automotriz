<?php
require_once (PATH_MODELOS . "/NovedadModelo.php");

class NovedadControlador {
	
	public function ingreso(){
		$model = new NovedadModelo();
		$vehiculos = $model->obtenerVehiculos($_SESSION['SESSION_USER']['id']); //id usuario en sesion
		$message = "";
		require_once PATH_VISTAS."/Novedad/vista.ingreso.php";
	}
	
	public function guardar() {			
		$novedad ['problema'] = $_POST ['problema'];
		$novedad ['causa'] = $_POST ['causa'];
		$novedad ['vehiculo_id'] = $_POST ['vehiculo_id'];
		$novedad ['usuario_registra'] = $_SESSION['SESSION_USER']['id'];		
		$novedad ['fecha_ingreso'] = date('Y-m-d');
		
		$model = new NovedadModelo(); 
		try {
			$datos = $model->guardarNovedad( $novedad );
			$_SESSION ['message'] = "Datos almacenados correctamente.";			
			
		} catch ( Exception $e ) {			
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../ingreso/" );
	}

	public function listar() {
		$model = new NovedadModelo();	
		$usuario = 0;
		/* si el usuario que est en sesion es una tecnico se habilit esto
		if($_SESSION['SESSION_USER']->tipo > 1){
			$usuario = $_SESSION['SESSION_USER']->id;
		}*/
		$datos = $model->obtenerlistadoNovedad($usuario);
		$message = "";
		require_once PATH_VISTAS."/Novedad/view.listado.php";
	}
	
	public function asignar(){
		$model = new NovedadModelo();		
		$item = $model->obtenerNovedad();	
		$tecnicos = $model->obtenerTecnicos();		
		require_once PATH_VISTAS."/Novedad/view.formAsignar.php";
	}

	public function ver(){
		$model = new NovedadModelo();
		$item = $model->obtenerNovedad();
		require_once PATH_VISTAS."/Novedad/view.ver.php";
	}
	
	public function guardarAsignar() {
	
		$novedad ['id'] = $_POST ['id'];
		$novedad ['tecnico_asigna'] = $_POST ['usuario_id'];
		$novedad ['solucion'] = $_POST ['solucion'];
		$novedad ['supervisor_id'] = $_SESSION['SESSION_USER']['id'];
	
		$model = new NovedadModelo();
		try {
			$datos = $model->saveNovedad( $novedad );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
			//envio email
			/*
			if(SENDEMAIL){
				$datos = $model->getNovedadById($_POST ['id']);					
				$email = new Email();
				$email->sendNotificacionTecnico($datos->nombres .' '.$datos->apellidos, $datos->email, $datos->maquina, "http://" . $_SERVER['HTTP_HOST'] . PATH_BASE);
			} */
			
				
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
	
	public function reparar(){
		$model = new NovedadModelo();
		$item = $model->obtenerNovedad();			
		require_once PATH_VISTAS."/Novedad/view.formReparar.php";
	}
	
	public function guardarReparar() {

		$novedad ['id'] = $_POST ['id'];
		$novedad ['proceso'] = $_POST ['proceso'];
		$novedad ['elementos'] = $_POST ['elementos'];
		$novedad ['tiempo_ejecucion'] = $_POST ['tiempo_ejecucion'];
		$novedad ['observaciones'] = $_POST ['observacion'];
		$novedad ['tecnico_repara'] = $_SESSION['SESSION_USER']['id']; 
		$novedad ['fecha_atencion'] = date('Y-m-d');
		$novedad ['atendido'] = 1;
	
		$model = new NovedadModelo();
		try {
			$datos = $model->saveNovedad( $novedad );			
			$_SESSION ['message'] = "Datos almacenados correctamente.";
			/*
			// envio email
			if(SENDEMAIL){
				$email = new Email();
				$supervisor = $model->getSupervisorById();
				$novedad = $model->getNovedadById($novedad ['id']);
				$email->sendNotificacionArreglo($supervisor->nombres ." ".$supervisor->apellidos, $supervisor->email, $novedad->maquina ,"http://" . $_SERVER['HTTP_HOST'] . PATH_BASE);
					
			}
			*/
			
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/" );
	}
}