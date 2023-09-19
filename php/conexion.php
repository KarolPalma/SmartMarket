<?php //Archivo PHP que establece la conexion a la BD, para la conexion al 000webhost estas variables cambian de valor
	$servidor="localhost";
	$usuario="root";
	$clave="51342";
	$bd="smart_market";

	$conexion=mysqli_connect($servidor, $usuario, $clave, $bd); //Trata de generar la conexion mediante los datos traspasados

	if (!$conexion) //Si no es posible lograr la conexion devuelve un mensaje de error
	{
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	exit;
	}
	else //Y si se logra la conexion habilita los caracteres de UTF8 y la zona horaria que corresponde a Honduras (esto ultimo es para aplicarlo en el 000webhost)
	{
		mysqli_set_charset($conexion,"utf8");
		mysqli_query($conexion,"SET time_zone = '-06:00'");
	}
?>