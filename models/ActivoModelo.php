<?php
require_once(PATH_MODELOS."/BaseModelo.php");

class ActivoModelo {

	private $pattern = "------";
	
	public function obtenerListadoVehiculosPlanes(){
		$model = new BaseModelo();
		$sql = "select v.*, t.nombre as tipo, e.nombre as estado
				from vehiculo as v
				inner join tipo_vehiculo as t on  v.tipo_vehiculo_id = t.id
				inner join estado_vehiculo as e on  v.estado_vehiculo_id = e.id
				where v.eliminado = 0";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	
	/*public function getActivo()
	{
		$activo = $_GET['id'];
		$model = new BaseModel();		
		if($activo > 0){
			$sql = "SELECT * FROM activo_fisico a
					WHERE a.id = ?";
			$result = $model->execSql($sql, array($activo));
			//$result->laboratorios = $this->getLaboratoriosActivo($activo);					
		} else {
			$result = (object) array('id'=>0,'nombre_activo'=>'','ficha' =>'','codigo'=>'','inventario'=>'','manual_fabricante'=>'','seccion'=>'','version'=>'','imagen_maquina_url'=>'',
					'color'=>'','pais_origen'=>'','capacidad'=>'','marca_maquina'=>'','modelo_maquina'=>'','serie_maquina'=>'','caracteristicas'=>'','marca_motor'=>'','tipo_he'=>'','num_fases'=>'',
					'rpm'=>'','voltaje_motor'=>'','hz'=>'','amperios_motor'=>'','kw'=>'','tipo_motor'=>'','parte_maquina'=>'', 'funcion'=>'','alias'=>'','laboratorio_id'=>0
			);			
		}
		
		return $result;
	}
	
	private function getLaboratoriosActivo($activo){
		$model = new BaseModel();
		if($activo > 0){
			$sql = "SELECT l.id FROM activo_fisico a
        			INNER JOIN lab_activo la ON la.activo_fisico_id = a.id
        			INNER JOIN laboratorio l ON l.id = la.laboratorio_id
    				WHERE la.eliminado=0 and a.id = ?";
			$result = $model->execSql($sql, array($activo),true);
			$laboratorios =[];
			foreach ($result as $val){
				$laboratorios[] = $val->id;
			}
			return $laboratorios;
		}
	}
	
	public function getPartesMotor()
	{
		$model = new BaseModel();
		$result = (object) array('id'=>0,'denominacion'=>'','url'=>'');
		return $result;
	}
	
	public function saveActivo($activo){
		$model = new BaseModel();		
		return $model->saveDatos($activo,'activo_fisico');		
		
	}
	
	public function delActivo(){
		$activo = $_GET['id'];
		$sql = "update activo_fisico set eliminado = 1 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($activo),false,true);
		
		//Activo y Laboratorio
		/*
		$sql = "update lab_activo set eliminado = 1 where activo_fisico_id = ?";
		$result = $model->execSql($sql, array($activo),false,true);
		*/
//	}

/*	public function getCatalogo($tabla,$where=null){
		$model = new BaseModel();
		return $model->getCatalogo($tabla,$where);
	}	
	
	public function getMotor(){
		$model = new BaseModel();
		$sql = "SELECT * FROM tipo_motor";
		return $model->execSql($sql, array(),true);
	}
	
	public function  getLaboratorios(){
		$model = new BaseModel();
		$sql = "SELECT * FROM laboratorio where eliminado=0";
		return $model->execSql($sql, array(),true);
	}
	
	public function  getLaboratoriosActivoVer(){
		$activo = $_GET['id'];
		$model = new BaseModel();
		$sql = "SELECT l.nombre FROM laboratorio as l 
				inner join lab_activo as la on la.laboratorio_id = l.id
				where l.eliminado=0 and la.activo_fisico_id = ?";
		return $model->execSql($sql, array($activo),true);
	}*/
}
