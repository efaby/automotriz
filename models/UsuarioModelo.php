<?php
require_once(PATH_MODELOS."/BaseModelo.php");

/**
 * Modelo para modulo de Usuarios
 * 
 *
 */
class UsuarioModelo {
	
	private $patron = "_-_-";

	public function obtenerListadoUsuarios(){
		$tipo = $_GET['id'];
		if($tipo == 1){
			$tipo = " 1 or tipo_usuario_id = 2";
		}
		$model = new BaseModelo();		
		$sql = "select u.id, u.identificacion,  u.nombres, u.apellidos, u.email,u.usuario,  t.nombre as tipo_usuario 
						from usuario as u 
						inner join tipo_usuario as t on  u.tipo_usuario_id = t.id 
						where eliminado = 0 and (tipo_usuario_id = ".$tipo.")";		
		$result = $model->ejecutarSql($sql);
		return $model->obtenerCampos($result);
	}	
	
	public function obtenerUsuario()
	{
		$usuario = $_GET['id'];
		$model = new BaseModelo();	
		if($usuario > 0){
			$sql = "select * from usuario where id = ".$usuario;
			$result = $model->ejecutarSql($sql);
			$resultArray = $model->obtenerCampos($result);
			$resultArray = $resultArray[0];
				
		} else {
			$resultArray = Array ( 'id' => '' ,'identificacion' => '','nombres' => '','apellidos' => '','email' => '','direccion' => '','password' => '', 'tipo_usuario_id' => '0','telefono' => '', 'celular' => '','password1' => '','usuario' => '','genero' => '');
		}
		$resultArray['password'] = $resultArray['password1'] = $this->patron;
		return $resultArray;
	}
	
	public function obtenerTipoUsuario(){
		$model = new BaseModelo();			
		return $model->obtenerCatalogo("tipo_usuario");
	}
	
	public function guardarUsuario($usuario)
	{
		if((($usuario['id']>0) && ($usuario['password']!=$this->patron))||($usuario['id']==0)){
			$usuario['password'] =  md5($usuario['password']);
		} else {
			unset($usuario['password']);
		}
		$model = new BaseModelo();
		return $model->guardarDatos($usuario, 'usuario');
	}
	
	public function eliminarUsuario(){
		$usuario = $_GET['id'];
		$sql = "update usuario set eliminado = 1 where id = ".$usuario;
		$model = new BaseModelo();
		$result = $model->ejecutarSql($sql);
	}

}
