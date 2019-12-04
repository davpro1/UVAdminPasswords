<!DOCTYPE html>

<html>
<head>
<title>UVAdminPasswords</title>
<meta http-equiv="Refresh" content="5;url=uvadminpasswords.php">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/estilos.css">
<link rel="shortcut icon" href="favicon.png">
</head>
<body>

<?php

session_start();
$usuario=$_SESSION['user'];
$servicio=$_POST['servicio'];
$clave=$_POST['clave'];

$array_ini = parse_ini_file("/etc/uvadminpasswords/uvadminpasswords.ini");

$conexion=mysql_connect("localhost", $array_ini['user_bd'], $array_ini['pass_bd'])
	or die("no se ha podido conectar con el servidor");
mysql_select_db($array_ini['name_bd'], $conexion) or die("Problemas seleccionando base de datos");


$consultaa=sprintf("SELECT * FROM users WHERE nombre='%s'", mysql_real_escape_string($usuario));
$consulta=mysql_query($consultaa, $conexion) or die("problema en un select");
$usuarios=mysql_fetch_assoc($consulta);
$tabla=$usuarios['tabla'];
$ingresar_registro=sprintf("insert into $tabla values('%s', aes_encrypt('%s', \"$array_ini[pass_cifrado]\"))", mysql_real_escape_string($servicio), mysql_real_escape_string($clave));
mysql_query($ingresar_registro, $conexion) or die("problema agregando registro");

echo "<p>El servicio '$servicio' se ha agregado con éxito</p>";
?>
</body>
</html>
