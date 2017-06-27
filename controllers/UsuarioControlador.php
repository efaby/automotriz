<?php
use Dompdf\Options;
use Dompdf\Dompdf;
require_once (PATH_MODELOS . "/UsuarioModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");


/**
 * Controlador de Usuarios
 */
class UsuarioControlador {
	
	public function listar() {
		$model = new UsuarioModelo();
		$datos = $model->obtenerListadoUsuarios();
		$tipo = $model->obtenerTipo();
		$message = "";
		require_once PATH_VISTAS."/Usuario/vista.listado.php";
	}
	
	public function editar(){
		$model = new UsuarioModelo();
		$arrayId = explode('-', $_GET['id']);
		$usuario = $model->obtenerUsuario($arrayId[1]);
		$tipo = $arrayId[0];
		$message = "";
		require_once PATH_VISTAS."/Usuario/vista.formulario.php";
	}
	
	public function guardar() {
		$usuario ['id'] = $_POST ['id'];
		$usuario ['identificacion'] = $_POST ['identificacion'];
		$usuario ['nombres'] = $_POST ['nombres'];
		$usuario ['apellidos'] = $_POST ['apellidos'];
		$usuario ['direccion'] = $_POST ['direccion'];
		$usuario ['tipo_usuario_id'] = $_POST ['tipo_usuario_id'];
		$usuario ['telefono'] = $_POST ['telefono'];
		$usuario ['password'] = $_POST ['password'];
		$usuario ['email'] = $_POST ['email'];
		$usuario ['celular'] = $_POST ['celular'];	
		$usuario ['usuario'] = $_POST ['identificacion'];
		$model = new UsuarioModelo();
		try {
			$datos = $model->guardarUsuario( $usuario );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$_POST ['tipo_usuario_id'] );
	}
	
	public function eliminar() {
		$model = new UsuarioModelo();
		$arrayId = explode('-', $_GET['id']);
		try {
			$datos = $model->eliminarUsuario($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}
	public function visualizarPdf(){
		$tipo_id = $_GET ['id'];
		$model = new UsuarioModelo();
		$datos = $model->obtenerListadoUsuarios($tipo_id);
		$tipo = $model->obtenerTipo($tipo_id);
		$html="<html>
					<head>
						<link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'/>
						<style>
							body {
							margin: 20px 20px 20px 50px;
							}
							table{
							border-collapse: collapse; width: 100%;
							}
								
							td{
							border:1px solid #ccc; padding:1px;
							font-size:9pt;
							}
						</style>
					</head>
					<body>
						<center><h3>Listado de Usuarios - ".$tipo['descripcion']."</h3></center>
						<table width= 100%>
							<tr>
				    		    <td><b>Identificación</b></td>
								<td><b>Nombres</b></td>
								<td><b>Apellidos</b></td>
								<td><b>Usuario</b></td>
								<td><b>Email</b></td>
								<td><b>Tipo Usuario</b></td>							    
							</tr>";
						foreach ($datos as $item) {
							echo "<tr><td>".$item['identificacion']."</td>";
							echo "<td>".$item['nombres']."</td>";
							echo "<td>".$item['apellidos']."</td>";
							echo "<td>".$item['usuario']."</td>";
							echo "<td>".$item['email']."</td>";
							echo "<td>".$item['tipo_usuario']." </td></tr>";						
						}
		$html .="		</table>
					</body>
				</html>";
		print_r($html);
		exit();
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
		
		$dompdf->load_html($html);
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", null, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", null, 6, array(0,0,0)); //footer
		$dompdf->stream('usuario', array("Attachment"=>false));
					
	}
}
