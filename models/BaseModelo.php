<?php
/**
 * Clase que se usa para la conexion ala base de datos
 */
class BaseModelo
{
	private $username = USERNAME;
	private $password = PASSWORD;	
	private $database = DATABASE;
	private $host = HOSTNAME_DATABASE;
	private $conexion;	

	private function abrirConexion()
	{
		$this->conexion=mysqli_connect($this->host,$this->username,$this->password,$this->database);
		mysqli_set_charset($this->conexion,'utf8');
	//	mysql_select_db(,$this->conexion);
	}

	private function cerrarConexion()
	{
		mysqli_close($this->conexion);
	}

	public function ejecutarSql($sql,$obtenerId = false)
	{
		$this->abrirConexion();
		$result=mysqli_query($this->conexion,$sql);
		
		if($obtenerId){
        	$result = mysqli_insert_id($this->conexion);
        	
		}
        $this->cerrarConexion();
		return $result;
	}
	
	public function obtenerCampos($resultado){
		$resultArray = array();
		if($resultado !== false){
			while ($row = mysqli_fetch_assoc($resultado))
			{
				$resultArray[] = $row;
			}
		}
		
		return $resultArray;
	}
	
	public function obtenerCatalogo($tabla){
		$sql = "Select * from ".$tabla;
		$result = $this->ejecutarSql($sql);
		return $this->obtenerCampos($result);
	}
	
	public function guardarDatos($objeto,$tabla){		
		
		$id = isset($objeto["id"])?$objeto["id"]:0;
		unset($objeto["id"]);		
		$values = "";
		$keys = "";
		foreach ($objeto as $key => $value){
			if($id == 0){
				$values .= ($values == '')?"'".$value."'":" ,'".$value."'";
				$keys .= ($keys == '')?$key:' ,'.$key;
			} else {
				$values .= ($values == '')? $key ." = '".$value."'":" ,".$key ." = '".$value."'";				
			}
		}		
		
		if($id == 0){
			$sql = ' Insert into '.$tabla. ' ('.$keys.') values ('.$values.')';
		} else {
			$sql = 'Update '.$tabla. ' set '.$values.' where id = '.$id;
		}


		return $this->ejecutarSql($sql,true);
	}
	
	
	
}
