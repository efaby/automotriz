<?php
require_once(PATH_MODELOS."/BaseModelo.php");


class NovedadModelo {
	
	public function guardarNovedad($novedad)
	{
		$model = new BaseModelo();
		return $model->guardarDatos($novedad, 'novedad');
	}

	public function obtenerVehiculos($userId){
		$model = new BaseModelo();
		$sql = "SELECT v.*, tv.nombre FROM vehiculo as v
				INNER JOIN tipo_vehiculo as tv ON v.tipo_vehiculo_id = tv.id
				WHERE v.eliminado=0 and usuario_id = ".$userId;
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function obtenerFallas(){
		$model = new BaseModelo();
		$sql = "SELECT * from tipo_falla where eliminado=0";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}

	public function obtenerlistadoNovedad($usuario,$id){
		$model = new BaseModelo();	
		$sql = "select n.*, n.id as ids, u.nombres  as nombre_tecnico1, u.apellidos as apellido_tecnico1, tf.nombre as falla, u1.nombres  as nombre_tecnico2, u1.apellidos as apellido_tecnico2, v.*, 
				u2.nombres as nombre_usuario, u2.apellidos as apellido_usuario, mr.id as repuestoId, mr.aprobado
				from novedad as n
				inner join vehiculo as v on v.id = n.vehiculo_id
				inner join usuario as u2 on u2.id = n.usuario_registra
				left join usuario as u on u.id = n.tecnico_asigna
				left join usuario as u1 on u1.id = n.tecnico_repara
				left join tipo_falla as tf on tf.id = n.tipo_falla_id
				left join mantenimiento_respuestos as mr on mr.mantenimiento_id = n.id
				where (tecnico_asigna = ".$usuario." or 0 = ".$usuario.") and v.tipo_vehiculo_id = ".$id." order by n.id desc";	

		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	

	public function obtenerNovedad($nov=null)
	{
		if($nov != null){
			$novedad = $nov;
		}else{
			$novedad = $_GET['id'];
		}
		$model = new BaseModelo();		
		$sql = "select n.*, n.id as ids, u.nombres  as nombre_tecnico1, tf.nombre as falla, u.apellidos as apellido_tecnico1, 
				u1.nombres  as nombre_tecnico2, u1.apellidos as apellido_tecnico2, v.*, u2.nombres as nombre_usuario, 
				u2.apellidos as apellido_usuario, tp.nombre as tipo_vehiculo,
				u3.nombres  as nombre_supervisor, u3.apellidos as apellido_supervisor
				from novedad as n
				inner join vehiculo as v on v.id = n.vehiculo_id
				inner join usuario as u2 on u2.id = n.usuario_registra
				left join usuario as u3 on u3.id = n.supervisor_id	
				inner join tipo_vehiculo as tp on tp.id = v.tipo_vehiculo_id
				left join tipo_falla as tf on tf.id = n.tipo_falla_id
				left join usuario as u on u.id = n.tecnico_asigna
				left join usuario as u1 on u1.id = n.tecnico_repara				
				where n.id = ".$novedad;

		$result = $model->ejecutarSql($sql);
		$resultArray = $model->obtenerCampos($result);
		return $resultArray[0];	

	}

	public function obtenerTecnicos(){
		$model = new BaseModelo();
		$sql = "select u.id, u.nombres, u.apellidos from usuario as u where eliminado = 0 and u.tipo_usuario_id = 6";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
	
	public function saveNovedad($novedad)
	{
		$model = new BaseModelo();
		return $model->guardarDatos($novedad, 'novedad');
	}	

/*
	
	
	public function getTecnicos(){
		$model = new BaseModel();
		$sql = "select u.id, u.nombres, u.apellidos from usuario as u where eliminado = 0 and u.tipo_usuario_id = 2";
		return $model->execSql($sql, array(),true);
	}
	
	public function getActivoById($id){
		$model = new BaseModel();
		$sql = "select nombre_activo as nombre from activo_fisico where id = ".$id;
		return $model->execSql($sql, array());
	}
	
	public function getSupervisorById(){
		$model = new BaseModel();
		$sql = "select nombres, apellidos, email from usuario where tipo_usuario_id = 1 and eliminado = 0 ";
		return $model->execSql($sql, array());
	}
	
	
	public function getNovedadById($id)
	{
		$model = new BaseModel();
		$sql = "select a.nombre_activo as maquina, u.nombres, u.apellidos, u.email
				from novedad as n
				inner join activo_fisico as a on a.id =  n.activo_fisico_id
				inner join usuario as u on u.id = n.tecnico_asigna
				where n.id = ?";	
		return $model->execSql($sql, array($id));
	
	}
	
	public function getEmailByIdActivo($id){
		$model = new BaseModel();
		$sql = "select u.id, u.nombres, u.apellidos, u.email from usuario as u
				inner join laboratorio as l on l.usuario_id
				inner join activo_fisico as a on a.laboratorio_id = l.id
				where a.id = ".$id;
		return $model->execSql($sql, array());
	}
	*/
}