<?php
// Incluir el archivo de base de datos
include_once("../clases/class.Database.php");
include_once("util.php");

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);
$request = (array) $request;

if(isset( $request['id'] )){

	$sql = "DELETE FROM promocion WHERE id=".$request['id'];

	$db = Database::ejecutar_idu( $sql );

	if (is_numeric($db) OR $db == true) {
		
		$respuesta = array('err' => false, 'Mensaje' => 'Se elimino correctamente'); 
	}else{

		$respuesta = array('err' => true, 'Mensaje' => $db);

	}

}


echo json_encode($respuesta);

?>