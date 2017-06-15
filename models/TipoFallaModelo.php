<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Tipo Falla
 * 
 *
 */
class TipoFallaModelo {
	

	public function obtenerListadoTipoFalla(){
		$model = new BaseModelo();		
		$sql = "select * from tipo_falla where eliminado = 0 ";		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	

	public function obtenerTipoFalla($tipo){
		$model = new BaseModelo();	
		if($tipo > 0){
			$sql = "select * from tipo_falla where id = ".$tipo;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
				
		} else {
			$resultArray = Array ( 'id' => '' ,'nombre' => '','descripcion' => '');
		}
		return $resultArray;
	}
	
	public function guardarTipoFalla($tipo){
		$model = new BaseModelo();
		return $model->guardarDatos($tipo, 'tipo_falla');
	}
	
	public function eliminarTipoFalla($tipo){		
		$sql = "update tipo_falla set eliminado = 1 where id = ".$tipo;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}

}
