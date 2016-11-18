<?php
	require_once("ez_sql_core.php");
	require_once("ez_sql_mysql.php");

	function conexion($user, $pass, $db, $host) {
		return new ezSQL_mysql($user, $pass, $db, $host);
	}
?>