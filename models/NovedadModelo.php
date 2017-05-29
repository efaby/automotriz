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

	public function obtenerlistadoNovedad($usuario){
		$model = new BaseModelo();	
		$sql = "select n.*, u.nombres  as nombre_tecnico1, u.apellidos as apellido_tecnico1, u1.nombres  as nombre_tecnico2, u1.apellidos as apellido_tecnico2, v.*, u2.nombres as nombre_usuario, u2.apellidos as apellido_usuario
				from novedad as n
				inner join vehiculo as v on v.id = n.vehiculo_id
				inner join usuario as u2 on u2.id = n.usuario_registra
				left join usuario as u on u.id = n.tecnico_asigna
				left join usuario as u1 on u1.id = n.tecnico_repara
				where (tecnico_asigna = ".$usuario." or 0 = ".$usuario.") order by n.id desc";	

		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	

	public function obtenerNovedad()
	{
		$novedad = $_GET['id'];
		$model = new BaseModelo();		
		$sql = "select n.*, u.nombres  as nombre_tecnico1, u.apellidos as apellido_tecnico1, u1.nombres  as nombre_tecnico2, u1.apellidos as apellido_tecnico2, v.*, u2.nombres as nombre_usuario, u2.apellidos as apellido_usuario
				from novedad as n
				inner join vehiculo as v on v.id = n.vehiculo_id
				inner join usuario as u2 on u2.id = n.usuario_registra				
				left join usuario as u on u.id = n.tecnico_asigna
				left join usuario as u1 on u1.id = n.tecnico_repara
				where n.id = ".$novedad;

		$result = $model->ejecutarSql($sql);
		$resultArray = $model->obtenerCampos($result);
		return $resultArray[0];	

	}

	public function obtenerTecnicos(){
		$model = new BaseModelo();
		$sql = "select u.id, u.nombres, u.apellidos from usuario as u where eliminado = 0 and u.tipo_usuario_id = 2";
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}
/*
	
	
	
	public function saveNovedad($novedad)
	{
		$model = new BaseModel();
		return $model->saveDatos($novedad,'novedad');
	}

	
	public function delParalelo(){
		$paralelo = $_GET['id'];
		$sql = "update paralelo set eliminado = 1 where id = ?";
		$model = new BaseModel();
		$result = $model->execSql($sql, array($paralelo),false,true);
	}

	public function getLaboratorios($usuario){
		$model = new BaseModel();	
		$sql = "select l.id, l.nombre from laboratorio as l where l.eliminado = 0 and (l.usuario_id = ? or 0 = ?)";		
		return $model->execSql($sql, array($usuario,$usuario),true);
	}
	
	public function getMaquinas($laboratorio){
		$model = new BaseModel();
		$sql = "select a.id, a.nombre_activo as nombre from activo_fisico as a
				
				where a.laboratorio_id = ".$laboratorio;
		return $model->execSql($sql, array(),true);
	}
	
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