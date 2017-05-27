<?php
require_once(PATH_MODELOS."/BaseModelo.php");


class NovedadModelo {
	
	public function guardarNovedad($novedad)
	{
		$model = new BaseModelo();
		return $model->guardarDatos($novedad, 'novedad');
	}

	public function obtenerVehiculos(){
		$model = new BaseModelo();
		$sql = "SELECT v.id, tv.nombre FROM vehiculo as v
				INNER JOIN tipo_vehiculo as tv ON v.tipo_vehiculo_id = tv.id
				WHERE v.eliminado=0";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
}