<?php
require_once(PATH_MODELOS."/BaseModelo.php");


class ReparacionModelo {

	public function obtenerReparaciones($id,$usuario){
		$model = new BaseModelo();
		$nuevos = "";
		$nuevos1 = "";
		if($id == 2){
			$nuevos = " and fecha_ingreso = '".date('Y-m-d')."' ";
			$nuevos1 = " and fecha_emision = '".date('Y-m-d')."' ";
			$id = 0;
		}
		
		$user = "";
		$user1 = "";
		if($usuario != 1){
			$user = " and tecnico_asigna = ".$usuario;
			$user1 = " and tecnico_asignado = ".$usuario;
		}
		
		$sql = "select n.id as ids, n.problema as actividad, v.marca,v.numero,
				u2.nombres , u2.apellidos , 'Correctivo' as tipo, 1 as tipo_id
				from novedad as n
				inner join vehiculo as v on v.id = n.vehiculo_id
				inner join usuario as u2 on u2.id = n.usuario_registra				
				where atendido = ".$id." ".$nuevos." ".$user."
			union 
				SELECT op.id as ids, pm.tarea as actividad,	v.marca,v.numero, 
				 u.nombres, u.apellidos, 'Preventivo' as tipo, 2 as tipo_id
				FROM vehiculo as v
				INNER JOIN vehiculo_plan as vp ON vp.vehiculo_id = v.id
				INNER JOIN plan_mantenimiento as pm ON pm.id=vp.plan_mantenimiento_id
				INNER JOIN orden_plan as op ON op.vehiculo_plan_id = vp.id
				INNER JOIN usuario as u on u.id = v.usuario_id
				
				where  op.atendido = ".$id." ".$nuevos1 ." ".$user1;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	

	
}