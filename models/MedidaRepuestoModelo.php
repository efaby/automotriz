<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Medida Repuesto
 * 
 *
 */
class MedidaRepuestoModelo {
	

	public function obtenerMedidasRepuestos(){
		$model = new BaseModelo();		
		$sql = "select * from medida_repuesto where eliminado = 0 ";		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	

	public function obtenerMedidaRepuesto($tipo){
		$model = new BaseModelo();	
		if($tipo > 0){
			$sql = "select * from medida_repuesto where id = ".$tipo;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
				
		} else {
			$resultArray = Array ( 'id' => '' ,'nombre' => '','descripcion' => '');
		}
		return $resultArray;
	}
	
	public function guardarMedidaRepuesto($tipo){
		$model = new BaseModelo();
		return $model->guardarDatos($tipo, 'medida_repuesto');
	}
	
	public function eliminarMedidaRepuesto($tipo){		
		$sql = "update medida_repuesto set eliminado = 1 where id = ".$tipo;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}

}
