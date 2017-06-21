<?php
require_once (PATH_MODELOS . "/RegistroModelo.php");
require_once (PATH_MODELOS . "/VehiculoModelo.php");
require_once (PATH_MODELOS . "/VehiculoPlanModelo.php");
require_once (PATH_MODELOS . "/OrdenPlanModelo.php");

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
	
	public function obtenerVehiculo(){
		$id = $_POST['id'];
		$model = new RegistroModelo();
		$medida_uso = $model->obtenerValidacion($id);
		if(count($medida_uso)>0){
			$medida_uso = $medida_uso[0]['medida_uso'];
		} else {
			$medida_uso = 0;
		}
		
		echo $medida_uso;
	}
	
	public function validarKiloHora($vehiculo_id, $kilo_hora){
		$model = new RegistroModelo();
		$medida_uso = $model->obtenerValidacion($vehiculo_id, $kilo_hora);
		$mensaje = null;
		if($kilo_hora > $medida_uso){
			$mensaje = "es mayor que ". $medida_uso;
		}
		return mensaje;
	}
	
	
	/**
	 * 
	 * Obtiene el guardado de horometro
	 * 
	 */
	public function guardar() {
		$registro ['vehiculo_id'] = $_POST ['vehiculo_id'];
		$registro ['usuario_registro'] = $_SESSION['SESSION_USER']['id'];
		$registro ['numero_ingreso'] = $numero =  $_POST ['numero_ingreso'];
		$registro ['fecha'] = $_POST ['fecha_registro'];
		$registro ['fecha_registro'] = date('Y-m-d');
		$tipo = $registro ['tipo'] = $_POST ['tipo'];
		$modelVehiculo = new VehiculoModelo();
		$vehiculo = $modelVehiculo->obtenerVehiculo($_POST ['vehiculo_id']);
		
		$model = new RegistroModelo();
		try {
			$datos = $model->guardarRegistro($registro);
			
			if(($tipo < 4)||($tipo > 8)){ // kilometros
				$numero = $numero  - $vehiculo['medida_uso'];
					
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
				if($vpid==0){
					$vpid = $planVehiculo['id'];
				}
				if($planVehiculo['numero_operacion'] >= ($plan['unidad_numero']-$plan['alerta_numero'])){
					$modelOrdenPlan = new OrdenPlanModelo();
					$ordenPlan = $modelOrdenPlan->obtenerOrdenPlan($vpid, $plan['tecnico_id']);
					if(count($ordenPlan) == 0){
						$ordenPlan['vehiculo_plan_id'] = $vpid;
						$ordenPlan['fecha_emision'] = date('Y-m-d');
						$ordenPlan['tecnico_asignado'] = $plan['tecnico_id'];					
						$modelOrdenPlan->guardarOrdenPlan($ordenPlan);
					}
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