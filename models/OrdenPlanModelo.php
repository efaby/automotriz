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
	
	public function obtenerOrdenes($id){
		$model = new BaseModelo();
		$where =null;
		$sql = "SELECT op.id,v.id as vehiculo_id,tv.nombre as vehiculo_nombre,pm.unidad_numero,
				pm.tiempo_ejecucion,
				pm.tarea as plan, vp.numero_operacion,op.fecha_emision, op.fecha_atencion,op.atendido,
				pm.herramientas,pm.materiales,pm.equipo,pm.observaciones,
				pm.tiempo_ejecucion,pm.observaciones
				FROM vehiculo as v
				INNER JOIN tipo_vehiculo as tv ON v.tipo_vehiculo_id=tv.id
				INNER JOIN vehiculo_plan as vp ON vp.vehiculo_id = v.id
				INNER JOIN plan_mantenimiento as pm ON pm.id=vp.plan_mantenimiento_id
				INNER JOIN orden_plan as op ON op.vehiculo_plan_id = vp.id";
		if($id >0){
			$where = " WHERE atendido=0 and op.id=".$id;
		}
		$sql .=$where;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
}