<?php
require_once(PATH_MODELOS."/BaseModelo.php");


class RegistroModelo {
	public function obtenerVehiculos($userId){
		$model = new BaseModelo();
		$sql = "SELECT v.*, tv.nombre, tv.plan_mantenimiento as plan 
				FROM vehiculo as v
				INNER JOIN tipo_vehiculo as tv ON v.tipo_vehiculo_id = tv.id
				WHERE v.eliminado=0 and usuario_id = ".$userId;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerValidacion($vehiculo_id){
		$model = new BaseModelo();
		$sql = "SELECT medida_uso FROM vehiculo
				where id = ".$vehiculo_id;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function guardarRegistro($registro)
	{
		$model = new BaseModelo();
		return $model->guardarDatos($registro, 'registro');
	}
	
	public function guardarOrdenPlan($orden)
	{
		$model = new BaseModelo();
		return $model->guardarDatos($orden, 'orden_plan');
	}
	

	public function obtenerlistadoNovedad($usuario){
		$model = new BaseModelo();	
		$sql = "select n.*, u.nombres  as nombre_tecnico1, u.apellidos as apellido_tecnico1, u1.nombres  as nombre_tecnico2, u1.apellidos as apellido_tecnico2, v.*, u2.nombres as nombre_usuario, u2.apellidos as apellido_usuario
				from novedad as n
				inner join vehiculo as v on v.id = n.vehiculo_id
				inner join usuario as u2 on u2.id = n.usuario_registra
				left join usuario as u on u.id = n.tecnico_asigna
				left join usuario as u1 on u1.id = n.tecnico_repara
				where (tecnico_asigna = ".$usuario." or 0 = ".$usuario.") order by n.id desc";	

		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	
	
	public function obtenerPlanesbyTipoVehiculo($tipo){		
		$model = new BaseModelo();
		$sql = "select p.*
				from plan_mantenimiento as p
				inner join tipo_vehiculo as t on t.plan_mantenimiento = p.tipo_id
				where p.eliminado = 0 and t.id =".$tipo;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerVehiculoPlanbyPlan($id)
	{
		$model = new BaseModelo();
		$sql = "select * from vehiculo_plan where eliminado = 0 and plan_mantenimiento_id = ".$id;
		$result = $model->ejecutarSql($sql);
		$resultArray = $model->obtenerCampos($result);
		return (count($resultArray)>0)?$resultArray[0]:array('id'=>0);
	}
}