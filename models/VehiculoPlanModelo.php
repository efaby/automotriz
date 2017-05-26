<?php
require_once(PATH_MODELOS."/BaseModelo.php");

class VehiculoPlanModelo {

	public function obtenerListadoVehiculoPlan(){
		$activo = $_GET['id'];
		$model = new BaseModelo();
		$sql = "select vp.*, p.tarea, u.nombre as unidad
				from vehiculo_plan as vp
				inner join plan_mantenimiento as p on p.id = vp.plan_mantenimiento_id
				inner join unidad as u on u.id = vp.unidad_id				
				where vp.eliminado = 0 and vp.vehiculo_id = ".$activo;		

		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	
	
	public function obtenerVehiculoNombre(){
		$model = new BaseModelo();
		$activo = $_GET['id'];
		$sql = "SELECT v.id, tv.nombre, v.numero, v.marca, v.modelo 
				FROM vehiculo v
				INNER JOIN tipo_vehiculo tv ON tv.id=v.tipo_vehiculo_id
				WHERE v.id=".$activo;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);		
	}
	
	public function obtenerVehiculoPlan($id)
	{
		$model = new BaseModelo();		
		if($id > 0){
			$sql = "select * from vehiculo_plan where eliminado = 0 and id = ".$id;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$result = $resultArray[0];
						
		} else {
			$result = array('id'=>0,'alerta_numero'=>'', 'unidad_numero'=>'','plan_mantenimiento_id'=>0);			
		}		
		return $result;
	}

	public function obtenerPlanes($id,$plan){
		$model = new BaseModelo();
		$sql = "select id, tarea from plan_mantenimiento 				
				where eliminado = 0 and 
				id not in (select plan_mantenimiento_id from vehiculo_plan where eliminado = 0 and vehiculo_id = ".$id." and plan_mantenimiento_id <> ".$plan.")";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);

	}
	
	public function obtenerUnidad($vehiculoId){
		$model = new BaseModelo();
		$activo = $_GET['id'];
		$sql = "SELECT u.id, u.nombre
				FROM vehiculo v
				INNER JOIN tipo_vehiculo tv ON tv.id=v.tipo_vehiculo_id
				INNER JOIN tipo_vehiculo tv1 ON tv1.id=tv.padre
				INNER JOIN unidad u ON u.id=tv1.padre
				
				WHERE v.id=".$vehiculoId;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function guardarVehiculoPlan($activoPlan)
	{
		if($activoPlan['id']==0){
			$activoPlan['numero_operacion'] = 0;
		}
		$model = new BaseModelo();
		return $model->guardarDatos($activoPlan, 'vehiculo_plan');
	}
	
	public function eliminarVehiculoPlan($activo){
		$sql = "update vehiculo_plan set eliminado = 1 where id = ".$activo;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}

}
