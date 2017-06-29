<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Reporte
 * 
 *
 */
class ReporteModelo {
	
	public function obtenerListadoVehiculos($tipo_id=null){
		$model = new BaseModelo();	
		if($tipo_id == null){
			$tipo = $_GET['id'];
		}else{
			$tipo = $tipo_id;
		}			
		$sql = "select v.*, t.nombre as tipo, u.nombres, u.apellidos, e.nombre as estado 
				from vehiculo as v 
				inner join tipo_vehiculo as t on  v.tipo_vehiculo_id = t.id 
				inner join estado_vehiculo as e on  v.estado_vehiculo_id = e.id 
				inner join usuario as u on  v.usuario_id = u.id 
				where v.eliminado = 0 and v.tipo_vehiculo_id = ".$tipo;		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	
	
	public function obtenerTipo($tipo_id=null)
	{
		if($tipo_id == null){
			$tipo = $_GET['id'];
		}else{
			$tipo = $tipo_id;
		}
		$model = new BaseModelo();	
		$sql = "select * from tipo_vehiculo where id = ".$tipo;
		$result = $model->ejecutarSql($sql);
		$resultArray = $model->obtenerCampos($result);
		$resultArray = $resultArray[0];		
		
		return $resultArray;
	}
	
	public function obtenerPreventivos($id){
		$model = new BaseModelo();
		$sql = "SELECT op.*, pm.tarea as actividad, u.nombres, u.apellidos 
				FROM orden_plan as op
				INNER JOIN vehiculo_plan as vp ON op.vehiculo_plan_id = vp.id
				INNER JOIN plan_mantenimiento as pm ON pm.id=vp.plan_mantenimiento_id
				INNER JOIN usuario as u on u.id = op.tecnico_atiende
				where vp.vehiculo_id = ".$id;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerCorrectivos($id){
		$model = new BaseModelo();
		$sql = "select n.*, tf.nombre as actividad, u.nombres, u.apellidos
				from novedad as n
				inner join usuario as u on u.id = n.tecnico_repara
				where n.vehiculo_id = ".$id;
	
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerVehiculo($id)
	{
		$model = new BaseModelo();
		$sql = "select v.*
				from vehiculo as v
				inner join usuario as u on u.id = v.usuario_id
					where v.id = ".$id;
		$result = $model->ejecutarSql($sql);
		$resultArray = $model->obtenerCampos($result);
		$resultArray = $resultArray[0];
		return $resultArray;
	}
	
	
}
