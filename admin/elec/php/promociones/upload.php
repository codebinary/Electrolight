<?php 
	
	// Incluir el archivo de base de datos
	include_once("../clases/class.Database.php");

	include_once("util.php");


	$HOST 		= $_SERVER['HTTP_HOST'];
	$file 		= $_FILES["file"]["name"];

	$id 		= limpiarData($_POST["id"]);
	$nombre 	= limpiarData($_POST["nombre"]);
	$estado 	= limpiarData($_POST["estado"]);
	$legal 		= limpiarData($_POST["legal"]);



	$BASE_URL 	= "/promociones/";

	echo $id;


	if($id != undefined){

		if(!is_dir("../../../files/"))
			mkdir("../../../files/", 0777);

		if($file && move_uploaded_file($_FILES["file"]["tmp_name"], "../../../files/" . $file)){

			$urlImage['url'] = "http://".$HOST. $BASE_URL. "files/" . $file;
			echo json_encode($urlImage);

			/*$sql = "UPDATE promocion
						SET
							url = '". $urlImage ."'

					WHERE id=". $id;

			$db = Database:: ejecutar_idu($sql);

			if (is_numeric($db) OR $db == true) {
		
				$respuesta = array('err' => false, 'Mensaje' => 'La imagen se actualizó correctamente'); 
				echo json_encode($respuesta);
		
			}else{

				$respuesta = array('err' => true, 'Mensaje' => "er");

			}*/
			
		}

	}else{

		if(!is_dir("../../../files/"))
			mkdir("../../../files/", 0777);

		if($file && move_uploaded_file($_FILES["file"]["tmp_name"], "../../../files/" . $file)){

			$urlImage['url'] = "http://".$HOST. $BASE_URL. "files/" . $file;
			echo json_encode($urlImage);

			/*$sql = "INSERT INTO promocion(nombre, estado, url, legal )
				VALUES ('". $nombre ."',
						'". $estado ."',
						'". $urlImage ."',
						'". $legal ."')";


			$db = Database:: ejecutar_idu($sql);

			if (is_numeric($db) OR $db == true) {
		
				$respuesta = array('err' => false, 'Mensaje' => 'La imagen se actualizó GUARDO'); 
		
			}else{

				$respuesta = array('err' => true, 'Mensaje' => "er");

			}*/
			
		}

	}

	

	


 ?>