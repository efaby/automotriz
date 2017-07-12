<?php
use Dompdf\Options;
use Dompdf\Dompdf;
require_once (PATH_MODELOS . "/VehiculoModelo.php");
require_once (PATH_HELPERS. "/dompdf/autoload.inc.php");
require_once (PATH_HELPERS. "/dompdf/src/FontMetrics.php");
require_once (PATH_MODELOS . "/UsuarioModelo.php");
require_once (PATH_HELPERS. "/File.php");

/**
 * Controlador de Vehiculos
 */
class VehiculoControlador {
	
	public function listar() {
		$model = new VehiculoModelo();
		$datos = $model->obtenerListadoVehiculos();
		$tipo = $model->obtenerTipo();
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.listado.php";
	}
	
	public function editar(){
		$model = new VehiculoModelo();
		$arrayId = explode('-', $_GET['id']);
		$vehiculo = $model->obtenerVehiculo($arrayId[1]);
		$tipo = $arrayId[0];
		$usuarios = $model->obtenerConductores($tipo);
		if($arrayId[1]>0){
			$modelUser = new UsuarioModelo();
			$user = $modelUser->obtenerUsuario($vehiculo['usuario_id']);
			$users = array();
			$ban = true;
			foreach ($usuarios as $item){
				if($item["id"] == $user["id"]){
					$ban = false;
				}
				$users[] = $item;
			}
			if($ban){
				$users[count($users)] = $user;
			}
			$usuarios = $users;
		}
		$medida = "Kilometros";
		if($tipo>3 && $tipo < 9){
			$medida = "Horas";
		}		
		$estados = $model->obtenerEstadoVehiculo();		
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.formulario.php";
	}

	public function downloadFile(){
		$nombre = $_GET['id'];
		$upload = new File();
		return $upload->downloadPdf($nombre);
	}	
	public function guardar() {
		$vehiculo ['id'] = $_POST ['id'];
		$vehiculo ['tipo_vehiculo_id'] = $_POST ['tipo_vehiculo_id'];
		$vehiculo ['usuario_id'] = $_POST ['usuario_id'];
		$vehiculo ['marca'] = $_POST ['marca'];
		$vehiculo ['modelo'] = $_POST ['modelo'];
		$vehiculo ['estado_vehiculo_id'] = $_POST ['estado_vehiculo_id'];
		$vehiculo ['numero'] = $_POST ['numero'];
		$vehiculo ['placa'] = $_POST ['placa'];
		$vehiculo ['anio'] = $_POST ['anio'];
		$vehiculo ['numero_motor'] = $_POST ['numero_motor'];	
		$vehiculo ['numero_chasis'] = $_POST ['numero_chasis'];
		$vehiculo ['medida_uso'] = $_POST ['medida_uso'];
		$vehiculo ['url'] = $this->uploadFile('vehiculo');
		
		
		$model = new VehiculoModelo();
		$conductor = $_POST ['conductor'];
		if($conductor > 0 && $conductor != $vehiculo ['usuario_id']){
			$model->updateUsuario($conductor, "- 1");
		}
		
		try {
			$model->updateUsuario($vehiculo ['usuario_id'], "+ 1");
			$datos = $model->guardarVehiculo( $vehiculo );
			$_SESSION ['message'] = "Datos almacenados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$_POST ['tipo_vehiculo_id'] );
	}
	
	private function uploadFile($nombre,$carpeta){
		$upload = new File();
		return $upload->uploadFile($nombre,$carpeta);
	}
	
	public function eliminar() {
		$model = new VehiculoModelo();
		$arrayId = explode('-', $_GET['id']);
		try {
			$datos = $model->eliminarVehiculo($arrayId[1]);
			$_SESSION ['message'] = "Datos eliminados correctamente.";
		} catch ( Exception $e ) {
			$_SESSION ['message'] = $e->getMessage ();
		}
		header ( "Location: ../listar/".$arrayId[0] );
	}

	public function listarplan() {
		$model = new VehiculoModelo();

		$datos = $model->obtenerListadoVehiculos();
		$message = "";
		require_once PATH_VISTAS."/Vehiculo/vista.listadoplan.php";
	}
	
	public function visualizarPdf(){
		$tipo_id = $_GET ['id'];
		$model = new VehiculoModelo();
		$datos = $model->obtenerListadoVehiculos($tipo_id);		
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
						th{
						border:1px solid #ccc; padding:1px;
						font-size:9pt;
						}	
						td{
						border:1px solid #ccc; padding:1px;
						font-size:9pt;
						}
						</style>
					</head>
					<body>
						<table width= 100%>
							<tr>
								<th rowspan='2' style='text-align:center'>
				  					<img src=".PATH_FILES."../images/espoch.jpg width='100px' height='100px'/>
				  				</th>
				    			<th colspan='2' style='text-align:center'>ESPOCH-GADPC</th>
				    			<th rowspan='2' style='text-align:center'>
				  					<img src=".PATH_FILES."../images/gobierno.jpg width='100px' height='100px'/>
				  				</th>				    			
							</tr>
				  			<tr>
				    			<th colspan='2' style='text-align:center'>Listado de ".$tipo['descripcion']."</th>
							</tr>				    		
				  	  </table><br>		
					  <table width= 100%>
							 <tr>
						    	<td><b>Número</b></td>
							    <td><b>Tipo</b></td>
							    <td><b>Marca</b></td>
								<td><b>Modelo</b></td>
							    <td><b>Placa</b></td>
							    <td><b>Conductor</b></td>
							    <td><b>Estado</b></td>
							</tr>";		
							foreach ($datos as $item) {
						$html .="<tr><td>".$item['numero']."</td>
								 <td>".$item['tipo']."</td>
								 <td>".$item['marca']."</td>
								 <td>".$item['modelo']."</td>
								 <td>".$item['placa']."</td>
								 <td>".$item['nombres']." ".$item['apellidos']."</td>
								 <td>".$item['estado']." </td></tr>";
							}	
		$html .="</table>
					</body>
				</html>";
		$options = new Options();
		$options->set('isHtml5ParserEnabled', true);
		$dompdf = new Dompdf($options);
		
		$dompdf->load_html($html);
		$dompdf->render();
		$canvas = $dompdf->get_canvas();
		$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", null, 6, array(0,0,0)); //header
		$canvas->page_text(270, 770, "Copyright © 2017", null, 6, array(0,0,0)); //footer
		$dompdf->stream('vehiculo', array("Attachment"=>false));
	}
	
	public function visualizarFicha(){
		$model = new VehiculoModelo();
		$arrayId = explode('-', $_GET['id']);
		$vehiculo = $model->obtenerVehiculo($arrayId[1]);
		$tipo_id = $arrayId[0];
		$usuarios = $model->obtenerConductor($arrayId[1]);
		
		$nombres = $usuarios[0]['nombres']. " ".$usuarios[0]['apellidos'];
		
		$medida = "Kilometros";
		if($tipo_id>3 && $tipo_id<9){
			$medida = "Horas";
		}
		$estados = $model->obtenerEstadoVehiculo();
		foreach ($estados as $estado) {
			if($vehiculo['estado_vehiculo_id']==$estado['id']){
				$estado_nombre = $estado['nombre'];
			}
		}
		$tipo = $model->obtenerTipo($tipo_id);
		$urlImage = "../images/vehiculo.png";
		if($vehiculo['url']!=''){
			$urlImage = $vehiculo['url'];
		}
		
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
	
						th{
						border:1px solid #ccc; padding:1px;
						font-size:9pt;
						}
						td{
						border:1px solid #ccc; padding:1px;
						font-size:9pt;
						}
						</style>
					</head>
					<body>
						<table width= 100%>
							<tr>
								<th rowspan='3' style='text-align:center'>
				  					<img src=".PATH_FILES."../images/espoch.jpg width='100px' height='100px'/>
				  				</th>
				    			<th colspan='2' style='text-align:center'>ESPOCH-GADPC</th>
				    			<th rowspan='3' style='text-align:center'>
				  					<img src=".PATH_FILES."../images/gobierno.jpg width='100px' height='100px'/>
				  				</th>				    			
							</tr>
				  			<tr>
				    			<th colspan='2' style='text-align:center'>Ficha Técnica <br> ".$tipo['nombre']."</th>
							</tr>
				    		<tr>
				    			<th colspan='2' style='text-align:center'>".$vehiculo['marca']."</th>
							</tr>
				  	  </table><br>				  							
				  	  <table width= 100%>
							<tr>
				    			<td width='50%' rowspan=2 style='margin:0 auto; text-align:center;'>
				    				<img src=".PATH_FILES.$urlImage." height='150px'/>	
				    			</td>
				    			<td width='50%'><b>";
								if($tipo_id>3 && $tipo_id<9){
									$html .="Operador:";
								}else{
									$html .="Conductor:";
								}	
				
								$html .="</b><br><br>".$nombres."</td>
				    		</tr>
							<tr>			
								<td width='50%'><b>Marca:</b><br><br>".$vehiculo['marca']."</td>
							</tr>
							<tr>
								<td width='50%'><b>Número:</b><br><br>".$vehiculo['numero']."<br><br></td>
								<td width='50%'><b>Modelo:</b><br><br>".$vehiculo['modelo']."<br><br></td>																
							</tr>
							<tr>
								<td width='50%'><b>Placa:</b><br><br>".$vehiculo['placa']."<br><br></td>
								<td width='50%'><b>Número Motor:</b><br><br>".$vehiculo['numero_motor']."<br><br></td>		
							</tr>
							<tr>
								<td width='50%'><b>Número Chasis:</b><br><br>".$vehiculo['numero_chasis']."<br><br></td>
								<td width='50%'><b>Año Fabricación:</b><br><br>".$vehiculo['anio']."<br><br></td>
							</tr>
							<tr>
								<td width='50%'><b>".$medida.":</b><br><br>".$vehiculo['medida_uso']."<br><br></td>
								<td width='50%'><b>Estado:</b><br><br>".$estado_nombre."<br><br></td>								
							</tr>										
						</table>
					</body>
				</html>";

				$options = new Options();
				$options->set('isHtml5ParserEnabled', true);
				$dompdf = new Dompdf($options);
	
				$dompdf->load_html($html);
				$dompdf->render();
				$canvas = $dompdf->get_canvas();
				$canvas->page_text(550, 750, "Pág. {PAGE_NUM}/{PAGE_COUNT}", null, 6, array(0,0,0)); //header
				$canvas->page_text(270, 770, "Copyright © 2017", null, 6, array(0,0,0)); //footer
				$dompdf->stream('vehiculo', array("Attachment"=>false));
	}
}