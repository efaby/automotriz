<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Vehiculos
 * 
 *
 */
class VehiculoModelo {
	
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
	
	public function obtenerVehiculo($id)
	{
		$model = new BaseModelo();	
		if($id > 0){
			$sql = "select v.* 
					from vehiculo as v				
					where v.id = ".$id;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
				
		} else {
			$resultArray = Array ( 'id' => '','tipo_vehiculo_id' => 0,'usuario_id' => 0,'estado_vehiculo_id' => 0,'placa' => '','marca' => '','modelo' => '','numero' => '','anio' => '', 'numero_motor' => '','numero_chasis' => '', 'medida_uso' => '', 'url' => '');
		}
		
		return $resultArray;
	}
	
	public function obtenerTipoVehiculo($padre){
		$model = new BaseModelo();		
		$sql = "select t.id, t.nombre 
				from tipo_vehiculo as t
				where padre = ".$padre;		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerConductores($tipo){
		
		$model = new BaseModelo();
		$sql = "select u.id, u.nombres, u.apellidos
				from usuario as u
				inner join tipo_vehiculo as t on u.tipo_usuario_id = t.tipo_conductor
				where u.eliminado=0 and u.vehiculos < 2 and  t.id = ".$tipo;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerConductor($vehiculo){
	
		$model = new BaseModelo();
		$sql = "select u.id, u.nombres, u.apellidos
				from usuario as u
				inner join vehiculo as v on v.usuario_id = u.id
				where v.id = ".$vehiculo;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerEstadoVehiculo(){
		$model = new BaseModelo();
		return $model->obtenerCatalogo("estado_vehiculo");
	}
	
	public function guardarVehiculo($vehiculo){
		$model = new BaseModelo();
		return $model->guardarDatos($vehiculo, 'vehiculo');
	}
	
	public function eliminarVehiculo($vehiculo){
		$sql = "update vehiculo set eliminado = 1 where id = ".$vehiculo;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
		
		$sql = "update novedad set eliminado = 1 where vehiculo_id = ".$vehiculo;
		$result = $model->ejecutarSql($sql);
		$sql = "update mantenimiento_respuestos set eliminado = 1 where tipo = 2 and 
				mantenimiento_id in (select id from novedad where vehiculo_id = ".$vehiculo.")";
		$result = $model->ejecutarSql($sql);
		
		$sql = "update orden_plan set eliminado = 1 where vehiculo_plan_id in (select id from vehiculo_plan where vehiculo_id = ".$vehiculo.")";
		$result = $model->ejecutarSql($sql);
		$sql = "update mantenimiento_respuestos set eliminado = 1 
				where tipo = 1 and mantenimiento_id in (select op.id from orden_plan as op
                inner join vehiculo_plan as vp on op.vehiculo_plan_id = vp.id 
                where vp.vehiculo_id = ".$vehiculo.")";
		$result = $model->ejecutarSql($sql);
		
	}
	
	public function updateUsuario($usuarioId,$item){	
		$sql = "update usuario set vehiculos = vehiculos ".$item." where id = ".$usuarioId;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}

}
