<?php
require_once(PATH_MODELOS."/BaseModelo.php");

class PlanModelo {

	public function obtenerListadoPlan(){
		$tipo = $_GET['id'];
		$model = new BaseModelo();
		$sql = "select p.*, u.nombres, u.apellidos from plan_mantenimiento as p	
				inner join usuario as u on u.id = p.tecnico_id
				where p.eliminado = 0 and tipo_id=".$tipo;		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);		
	}
	
	public function obtenerTipo()
	{
		$tipo = $_GET['id'];
		$model = new BaseModelo();
		if($tipo <> 4){
			$sql = "select * from tipo_vehiculo where plan_mantenimiento = ".$tipo;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];			
		}	
		else{
			$resultArray['plan_mantenimiento'] = 4;
			$resultArray['nombre'] ="Maquinaria Pesada"; 
		}
		return $resultArray;
	}	
	
	public function obtenerPlan($plan)
	{
		$model = new BaseModelo();		
		if($plan > 0){
			$sql = "select p.* from plan_mantenimiento as p where p.eliminado = 0 and p.id = ".$plan;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];			
		} else {
			$resultArray = array('id'=>0,'tarea'=>'','tiempo_ejecucion'=>'','estado_maquina'=>'', 'herramientas' =>'', 'equipo' =>'',  'materiales' =>'', 'procedimiento' =>'',  'observaciones' =>'', 'tecnico_id' => 0,'unidad_numero'=>'','alerta_numero'=>'');			
		}
		return $resultArray;
	}
	
	public function guardarPlan($plan)
	{
		$model = new BaseModelo();
		return $model->guardarDatos($plan,'plan_mantenimiento');
	}
	
	public function eliminarPlan(){
		$plan = $_GET['id'];
		$sql = "update plan_mantenimiento set eliminado = 1 where id = ".$plan;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}

	public function obtenerTecnicos(){
		$model = new BaseModelo();
		$sql = "select u.id, u.nombres, u.apellidos from usuario as u where u.eliminado = 0 and u.tipo_usuario_id = 2";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
}