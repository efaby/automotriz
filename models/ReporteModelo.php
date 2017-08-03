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
		$sql = "SELECT op.*, pm.tarea as actividad, u.nombres, u.apellidos, v.anio, 
				tv.plan_mantenimiento, mr.id as ordenRepuesto
				FROM orden_plan as op
				INNER JOIN vehiculo_plan as vp ON op.vehiculo_plan_id = vp.id
				INNER JOIN vehiculo as v ON v.id = vp.vehiculo_id	
				INNER JOIN tipo_vehiculo as tv ON tv.id = v.tipo_vehiculo_id
				INNER JOIN plan_mantenimiento as pm ON pm.id=vp.plan_mantenimiento_id
				INNER JOIN usuario as u on u.id = op.tecnico_atiende				
				inner join mantenimiento_respuestos as mr on mr.mantenimiento_id = op.id
				where vp.vehiculo_id = ".$id;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerCorrectivos($id){
		$model = new BaseModelo();
		$sql = "select n.*, n.fecha_ingreso as fecha_emision, n.observaciones as observacion,tf.nombre as actividad, u.nombres, u.apellidos, v.anio,tv.nombre as nombre_vehiculo,
				tv.plan_mantenimiento, mr.id as ordenRepuesto
				from novedad as n
				inner join usuario as u on u.id = n.tecnico_repara
				inner join tipo_falla as tf ON  tf.id=n.tipo_falla_id  
				INNER JOIN vehiculo as v ON v.id = n.vehiculo_id
				INNER JOIN tipo_vehiculo as tv ON tv.id = v.tipo_vehiculo_id			
				inner join mantenimiento_respuestos as mr on mr.mantenimiento_id = n.id
				where n.vehiculo_id = ".$id;
		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	
	
	public function obtenerVehiculo($id)
	{
		$model = new BaseModelo();
		$sql = "select v.*, tv.nombre as nombre_vehiculo, u.nombres, u.apellidos
				from vehiculo as v
				inner join usuario as u on u.id = v.usuario_id
				INNER JOIN tipo_vehiculo as tv ON tv.id = v.tipo_vehiculo_id	
					where v.id = ".$id;
		$result = $model->ejecutarSql($sql);
		$resultArray = $model->obtenerCampos($result);
		$resultArray = $resultArray[0];
		return $resultArray;
	}
	
	public function obtenerFallas($id,$general = false, $fecha_inicio, $fecha_fin){

		$model = new BaseModelo();
		$where = "where vehiculo_id = ".$id;
		$vehiculo = ", vehiculo_id";
		$sql1 = "";
		if($general){
			$sql1 = " inner join vehiculo as v on v.id =  n.vehiculo_id ";
			$where = "where tipo_vehiculo_id = ".$id;
			$vehiculo = "";
		}
		
		$sql = "SELECT tipo_falla_id,tf.nombre as actividad ".$vehiculo.",0 as promedio,				
				count(n.id) as numero_falla
				FROM novedad as n
				inner join tipo_falla as tf ON  tf.id=n.tipo_falla_id ";		
		$sql .= $sql1.$where. " and n.fecha_atencion >= '".$fecha_inicio."' and n.fecha_atencion <= '".$fecha_fin."' group by tipo_falla_id";

		$result = $model->ejecutarSql($sql);
		$resultArray = $model->obtenerCampos($result);
		$resultado = [];
		
		foreach ($resultArray as $res){
			$sql = "SELECT kilometraje 
					FROM novedad as n ";
			
			if($general){
				$sql .= " inner join vehiculo as v on v.id =  n.vehiculo_id ";
				$where = "where tipo_vehiculo_id = ".$id;
			} else {
				$where = "where vehiculo_id = ".$res['vehiculo_id'];
			}
			$sql .= $where . "	and n.tipo_falla_id=".$res['tipo_falla_id'];
			$resultKilo = $model->ejecutarSql($sql);
			$resultKiloArray = $model->obtenerCampos($resultKilo);
			$contador = 0;
			$acumulador = 0;
			if ($res['numero_falla'] > 1){
				for ($i = 0; $i< $res['numero_falla']; $i++) {				
					if(isset($resultKiloArray[$i+1])){					
						$acumulador += ($resultKiloArray[$i+1]['kilometraje'] -$resultKiloArray[$i]['kilometraje']); 
						$contador++;
					}
				}
				$res['promedio'] = ($acumulador /$contador);
			}
			else{
				$res['promedio'] = $resultKiloArray[0]['kilometraje'];
			}
			$resultado[] = $res;
		}		
		return $resultado;
	}
	
	public function obtenerDetalleFallas($vehiculo_id, $tipo_falla_id) {
		$model = new BaseModelo();
		$sql = "select n.*, n.fecha_ingreso as fecha_emision, n.observaciones as observacion,tf.nombre as actividad, u.nombres, u.apellidos, v.anio,tv.nombre as nombre_vehiculo,
				tv.plan_mantenimiento, mr.id as ordenRepuesto,tipo_vehiculo_id
				from novedad as n
				LEFT JOIN usuario as u on u.id = n.tecnico_repara
				LEFT JOIN tipo_falla as tf ON  tf.id=n.tipo_falla_id
				LEFT JOIN vehiculo as v ON v.id = n.vehiculo_id
				INNER JOIN tipo_vehiculo as tv ON tv.id = v.tipo_vehiculo_id
				LEFT JOIN mantenimiento_respuestos as mr on mr.mantenimiento_id = n.id
				where n.vehiculo_id = ".$vehiculo_id ." and tf.id=".$tipo_falla_id;	
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	
}
