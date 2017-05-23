<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Vehiculos
 * 
 *
 */
class VehiculoModelo {
	
	public function obtenerListadoVehiculos(){
		$model = new BaseModelo();		
		$sql = "select v.*, t.nombre as tipo, u.nombres, u.apellidos, e.nombre as estado 
				from vehiculo as v 
				inner join tipo_vehiculo as t on  v.tipo_vehiculo_id = t.id 
				inner join estado_vehiculo as e on  v.estado_vehiculo_id = e.id 
				inner join usuario as u on  v.usuario_id = u.id 
				where v.eliminado = 0";		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	
	
	public function obtenerVehiculo()
	{
		$id = $_GET['id'];
		$model = new BaseModelo();	
		if($id > 0){
			$sql = "select v.*, c.padre as categoria_id, c.id as clase_id 
					from vehiculo as v
					inner join tipo_vehiculo as t on t.id = v.tipo_vehiculo_id
					inner join tipo_vehiculo as c on c.id = t.padre					
					where v.id = ".$id;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
				
		} else {
			$resultArray = Array ( 'id' => '' ,'categoria_id' => 0,'clase_id' => 0,'tipo_vehiculo_id' => 0,'estado_vehiculo_id' => 0,'placa' => '','marca' => '','modelo' => '','numero' => '','anio' => '', 'numero_motor' => '','numero_chasis' => '', 'medida_uso' => '');
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
	
	public function obtenerConductores($conductor){
		$conductor = $conductor + 2;
		$model = new BaseModelo();
		$sql = "select u.id, u.nombres, u.apellidos
				from usuario as u
				where u.tipo_usuario_id = ".$conductor;
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
	
	public function eliminarVehiculo(){
		$vehiculo = $_GET['id'];
		$sql = "update vehiculo set eliminado = 1 where id = ".$vehiculo;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}

}
