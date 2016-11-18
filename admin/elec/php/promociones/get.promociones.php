<?php
// Incluir el archivo de base de datos
include_once("../clases/class.Database.php");
include_once("../lib/ezsql/ezsql.php");


$db = new ezSQL_mysql("kiacom_useradmin", "l0Ze%~%mXtVr", "kiacom_conce_promodb", "localhost");


if( isset( $_GET["pag"] ) ){
	$pag = $_GET["pag"];
}else{
	$pag = 1;
}

$sql = "SELECT * FROM promocion";


$respuesta = Database::get_todo_paginado( 'promocion', $pag );

//$respuesta = $db->get_results( $sql );


echo json_encode( $respuesta );


?>