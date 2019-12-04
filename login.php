<!DOCTYPE html>
<html>
<head>
<title>UVAdminPasswords</title>
<meta http-equiv="Refresh" content="10;url=index.html">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/estilos.css">
<link rel="shortcut icon" href="favicon.png">
</head>

<body>
<?php

if(!fopen("/etc/UVAdminPasswords/UVAdminPasswords.ini", "r")) {

echo "<h1>Archivo .ini no accesible</h1>";
die("<h2>Instalacion incorrecta, reintentar</h2>");


}

$array_ini = parse_ini_file("/etc/UVAdminPasswords/UVAdminPasswords.ini");

if(!$nombre=$_POST['nombre']) {die("<h1>Tienes que escribir un nombre de usuario</h1>");}
if(!$_POST['clave']) {die("<h1>Tienes que escribir una clave</h1>");}
$clave=sha1($_POST['clave']);

$conexion=mysql_connect("localhost", $array_ini['user_bd'], $array_ini['pass_bd'])
	or die("no se ha podido conectar con el servidor");
mysql_select_db($array_ini['name_bd'], $conexion) or die("Problemas seleccionando base de datos");

$consultaa=sprintf("SELECT * FROM users WHERE nombre='%s'", mysql_real_escape_string($nombre));
$consulta=mysql_query($consultaa, $conexion) or die("problema en un select");
$fila=mysql_fetch_assoc($consulta);

$consultaa2=sprintf("select clave from users where nombre='%s'", mysql_real_escape_string($nombre));
$consulta2=mysql_query($consultaa2) or die("problemas en un select");
$array_clave=mysql_fetch_array($consulta2);
$clave_real=$array_clave[0];

if ($clave==$clave_real) {
	session_start();
	$_SESSION['user']=$fila['nombre'];
	header("Location: uvadminpasswords.php");
	
	
} else {
echo "<h1>Clave incorrecta</h1>";
}

?>

</body>
</html>
