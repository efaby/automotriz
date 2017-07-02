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

}
