<?php 

	session_start();

	require_once("class.Database.php");

	$postdata = file_get_contents("php://input");

	$request = json_decode($postdata);
	$request = (array) $request;

	$respuesta = array(
			'err' => true,
			'mensaje' => 'Usuario / Contraseña incorrectos'
		);

	//echo $request['codigo'];
	
	/*if(isset($request['codigo']) && isset($request['contrasena'])){
		echo "HOa";
		exit();
	}*/

	if(isset($request['codigo']) && isset($request['contrasena'])){

		$codigo 	= addslashes($request['codigo']);
		$contrasena = addslashes($request['contrasena']);

		$sql = "SELECT count(*) as existe FROM usuarios where codigo = '$codigo'";
		
		$existe = Database::get_valor_query($sql, 'existe');		

		

		if($existe){


			$sql = "SELECT contrasena FROM usuarios WHERE codigo = '$codigo'";



			$data_pass = Database::get_valor_query($sql, 'contrasena');


			$pass = sha1($contrasena);

			

			if($data_pass == $pass){

				$respuesta = array(
					'err' 		=> false,
					'mensaje' 	=> 'Login valido',
					'url'		=> '../elec'
				);

				$_SESSION['user'] = $codigo;

			}

		}


	}


	echo json_encode($respuesta);


 ?>