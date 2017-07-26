<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Tipo Falla
 * 
 *
 */
class RepuestoModelo {
	

	public function obtenerListadoRepuesto(){
		$model = new BaseModelo();		
		$sql = "select * from repuestos where eliminado = 0 ";		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	

	public function obtenerRepuesto($tipo){
		$model = new BaseModelo();	
		if($tipo > 0){
			$sql = "select * from repuestos where id = ".$tipo;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
				
		} else {
			$resultArray = Array ( 'id' => '' ,'nombre' => '','codigo' => '','cantidad' => 0);
		}
		return $resultArray;
	}
	
	public function guardarRepuesto($repuesto){
		$model = new BaseModelo();
		return $model->guardarDatos($repuesto, 'repuestos');
	}
	
	public function eliminarRepuesto($repuesto){		
		$sql = "update repuestos set eliminado = 1 where id = ".$repuesto;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}

	
	public function obtenerListadoOrdenes(){
		$model = new BaseModelo();
		$sql = "select mr.id, mr.fecha, mr.aprobado, mr.tipo, v.numero, v.marca, v.modelo, u.nombres, u.apellidos 
				from mantenimiento_respuestos as mr
				inner join vehiculo as v on mr.vehiculo_id = v.id
				inner join usuario as u on u.id = mr.tecnico_id
				where mr.eliminado = 0
				order by mr.aprobado, fecha desc ";

		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	
	public function obtenerOrden($orden){
		$model = new BaseModelo();
		$sql = "select mr.id, mr.aprobado, mr.fecha, mr.tipo, mr.observacion, v.medida_uso, v.numero, v.placa, v.anio, v.tipo_vehiculo_id, u.nombres, u.apellidos,u1.nombres as nombreEnt, u1.apellidos as apellidoEnt 
				from mantenimiento_respuestos as mr
				inner join vehiculo as v on mr.vehiculo_id = v.id
				inner join usuario as u on u.id = mr.tecnico_id
				left join usuario as u1 on u1.id = mr.usuario_id
				where mr.id = ".$orden;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerOrdenRepuesto($orden){
		$model = new BaseModelo();
		$sql = "select r.*, or1.cantidad as pedido 
			from orden_repuesto as or1 
			inner join repuestos as r on or1.repuesto_id = r.id 
			where or1.mantenimineto_respuesto_id = ".$orden;

		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function aprobarOrden($orden, $usuario){
		$sql = "update mantenimiento_respuestos set aprobado = 1, usuario_id = ".$usuario." where id = ".$orden;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
		$repuestos = $this->obtenerListadoRepuestoOrden($orden);
		foreach ($repuestos as $item){
			$sql = "update repuestos set cantidad = cantidad - ".$item['cantidad']." where id = ".$item['repuesto_id'];			
			$result = $model->ejecutarSql($sql);
		}	
		
	}
	
	public function guardarObservacion($orden, $observacion){
		$sql = "update mantenimiento_respuestos set observacion = '".$observacion."' where id = ".$orden;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}
	
	public function obtenerMantenimientoRepuesto($orden,$insert,$tipo){
		$model = new BaseModelo();
		
		if($insert==1){
			
			$sql = "select mr.* from mantenimiento_respuestos as mr
				where mr.eliminado = 0 and mantenimiento_id=".$orden." and tipo = ".$tipo;
			$result = $model->ejecutarSql($sql);
			$mo = $model->obtenerCampos($result);
			
			if(count($mo) > 0 ){
				$orden = $mo[0]['id'];
			} else {
				$vehiculoId = 0;
				if($tipo==1){
					$sql = "select op.tecnico_asignado as tecnico
						from orden_plan as op
						where op.id = ".$orden;
					$sql1 = "select vp.vehiculo_id
						from orden_plan as op
							inner join vehiculo_plan as vp on vp.id = op.vehiculo_plan_id
						where op.id = ".$orden;

					$result = $model->ejecutarSql($sql1);
					$vp = $model->obtenerCampos($result);
					$vehiculoId = $vp[0]['vehiculo_id'];
				} else {
					$sql = "select n.tecnico_asigna as tecnico, n.vehiculo_id
				from novedad as n
				where n.id = ".$orden;
				}
				$result = $model->ejecutarSql($sql);
				$vp = $model->obtenerCampos($result);
					
				$obj['tipo'] = $tipo;
				$obj['mantenimiento_id'] = $orden;
				$obj['tecnico_id'] = $vp[0]['tecnico'];
				$vehiculoId = ($vehiculoId>0)?$vehiculoId:$vp[0]['vehiculo_id'];
				$obj['vehiculo_id'] = $vehiculoId;
				$obj['fecha'] = date('Y-m-d');
				$obj['aprobado'] = 0;
				$orden = $model->guardarDatos($obj, 'mantenimiento_respuestos');
			}
						
			
		}		
		
		$sql = "select mr.* from mantenimiento_respuestos as mr
				where id=".$orden;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result)[0];
		
		
	}
	
	
	public function obtenerMantenimientoRepuestoSimple($orden){
		$model = new BaseModelo();
		$sql = "select mr.* from mantenimiento_respuestos as mr
				where id=".$orden;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result)[0];
	}
	
	public function guardarOrdenRepuesto($repuesto){
		$model = new BaseModelo();
		return $model->guardarDatos($repuesto, 'orden_repuesto');
	}
	
	public function obtenerListadoRepuestoOrden($id){
		$model = new BaseModelo();
		$sql = "select or1.id, or1.cantidad, r.codigo, r.nombre, or1.repuesto_id  
				from orden_repuesto as or1
				inner join repuestos as r on r.id = or1.repuesto_id
				where mantenimineto_respuesto_id = ".$id;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerRepuestoOrden($tipo){
		$model = new BaseModelo();
		if($tipo > 0){
			$sql = "select * from orden_repuesto where id = ".$tipo;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
	
		} else {
			$resultArray = Array ( 'id' => '' ,'repuesto_id' => '','cantidad' => 0);
		}
		return $resultArray;
	}
	
	public function eliminarRepuestoOrden($repuesto){
		$sql = "delete from orden_repuesto where id = ".$repuesto;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}
	
	
}
