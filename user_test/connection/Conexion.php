<?php

		$servidor="localhost";//$_SERVER['HTTP_HOST']
		$usuario="root";
		$clave="123";
		$db="agentes_informaticos";
			$conexion_sql = mysql_connect($servidor,$usuario,$clave)or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db($db, $conexion_sql)or die ('Error al seleccionar la Base de Datos: '.mysql_error());

?>