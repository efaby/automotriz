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
}