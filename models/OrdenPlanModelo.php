<?php	
require_once(PATH_MODELOS."/BaseModelo.php");

class OrdenPlanModelo {
	public function guardarOrdenPlan($orden)
	{
		$model = new BaseModelo();
		return $model->guardarDatos($orden, 'orden_plan');
	}
	
	public function obtenerOrdenPlan($vehiculo_id,$usuario_id){
		$model = new BaseModelo();
		$sql = "SELECT id FROM orden_plan
				WHERE tecnico_asignado=".$usuario_id." and vehiculo_plan_id=".$vehiculo_id." and atendido=0";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerOrdenes($id, $at, $usuario, $tipo){
		$model = new BaseModelo();
		$where = "";
		$sql = "SELECT op.id,v.id as vehiculo_id,tv.nombre as vehiculo_nombre,pm.unidad_numero,
				pm.tiempo_ejecucion as tiempo_estimado,pm.unidad_id,v.marca,v.numero, pm.procedimiento, pm.estado_maquina,
				pm.tarea as plan, pm.unidad_numero as frecuencia,op.fecha_emision, op.fecha_atencion,op.atendido,
				pm.herramientas,pm.materiales,pm.equipo,pm.observaciones,pm.url,tv.id as tipo_vehiculo,
				op.tiempo_ejecucion,op.observacion, u.nombres, u.apellidos, v.tipo_vehiculo_id,v.medida_uso, mr.id as repuestoId, mr.aprobado
				FROM vehiculo as v
				INNER JOIN tipo_vehiculo as tv ON v.tipo_vehiculo_id=tv.id
				INNER JOIN vehiculo_plan as vp ON vp.vehiculo_id = v.id
				INNER JOIN plan_mantenimiento as pm ON pm.id=vp.plan_mantenimiento_id
				INNER JOIN orden_plan as op ON op.vehiculo_plan_id = vp.id
				INNER JOIN usuario as u on u.id = pm.tecnico_id
				left join mantenimiento_respuestos as mr on mr.mantenimiento_id = op.id
				where (pm.tecnico_id = ".$usuario." or 0 = ".$usuario.") and ((pm.eliminado = 0) or (pm.eliminado = 1 and op.atendido = 1)) and (v.tipo_vehiculo_id = ".$tipo." or 0 = ".$tipo.")";
		/*if($id >0 && $at==0){
			$where = " WHERE atendido=0 and op.id=".$id;
		}elseif($at==1){
			$where = " WHERE atendido=1 and op.id=".$id;
		}	*/
		if($id >0){
			$where = " and op.id=".$id;
		}

		$sql .=$where . " order by op.atendido ";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
}