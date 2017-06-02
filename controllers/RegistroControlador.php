<?php
require_once (PATH_MODELOS . "/RegistroModelo.php");
require_once (PATH_MODELOS . "/VehiculoModelo.php");
require_once (PATH_MODELOS . "/VehiculoPlanModelo.php");

class RegistroControlador {
	
	/**
	 * Obtiene vehículos o maquinarias dado del id de sesión 
	 */
	public function ingreso(){
		$model = new RegistroModelo();
		$vehiculos = $model->obtenerVehiculos($_SESSION['SESSION_USER']['id']); //id usuario en sesion
		$message = "";
		require_once PATH_VISTAS."/Registro/vista.ingreso.php";
	}
	
	/**
	 * 
	 * Obtiene el guardado de horometro
	 * 
	 */
	public function guardar() {
		$registro ['vehiculo_id'] = $_POST ['vehiculo_id'];
		$registro ['usuario_registra'] = $_SESSION['SESSION_USER']['id'];
		$registro ['numero'] = $numero =  $_POST ['numero_ingreso'];
		$registro ['fecha'] = $_POST ['fecha_registro'];
		$registro ['fecha_ingreso'] = date('Y-m-d');
		$tipo = $_POST ['tipo'];
		
		$modelVehiculo = new VehiculoModelo();
		$vehiculo = $modelVehiculo->obtenerVehiculo($_POST ['vehiculo_id']);
		$model = new RegistroModelo();
		try {
			$datos = $model->guardarRegistro( $registro );	
			if($tipo < 4){ // kilometros
				$numero = $vehiculo['medida_uso'] - $numero;
			}
			$vehiculo['medida_uso'] = $vehiculo['medida_uso'] + $numero;
			$modelVehiculo->guardarVehiculo($vehiculo);
				
			$planes = $model->obtenerPlanesbyTipoVehiculo($vehiculo['tipo_vehiculo_id']);
			$modelVehiculoPlan = new VehiculoPlanModelo();
			foreach ($planes as $plan) {
				$planVehiculo = $model->obtenerVehiculoPlanbyPlan($plan['id']);	
				if($planVehiculo['id']>0){
					$numero = $planVehiculo['numero_operacion'] + $numero;
				} else {
					$planVehiculo['fecha_inicio'] = date('Y-m-d');
					$planVehiculo['vehiculo_id'] = $_POST ['vehiculo_id'];
					$planVehiculo['plan_mantenimiento_id'] = $plan['id'];
				}
				$planVehiculo['fecha_registro'] = date('Y-m-d');
				$planVehiculo['numero_operacion'] = $numero;
	
				$vpid = $modelVehiculoPlan->guardarVehiculoPlan($planVehiculo);	
				if($planVehiculo['numero_operacion'] >= ($plan['unidad_numero']-$plan['alerta_numero'])){
					$ordenPlan['vehiculo_plan_id'] = $vpid;
					$ordenPlan['fecha_emision'] = date('Y-m-d');
					$ordenPlan['tecnico_asignado'] = $plan['tecnico_id'];
				}	
			}
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
		header ( "Location: ../ingreso/" );
	}		
}