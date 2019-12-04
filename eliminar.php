<!DOCTYPE html>

<html>
<head>
<title>UVAdminPasswords</title>
<meta http-equiv="Refresh" content="5;url=privatekeys.php">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/estilos.css">
<link rel="shortcut icon" href="favicon.png">
</head>
<body>

<?php



session_start();
$usuario=$_SESSION['user'];
$servicio=$_POST['servicio'];

$array_ini = parse_ini_file("/etc/uvadminpasswords/uvadminpasswords.ini");

$conexion=mysql_connect("localhost", $array_ini['user_bd'], $array_ini['pass_bd'])
	or die("no se ha podido conectar con el servidor");
mysql_select_db($array_ini['name_bd'], $conexion) or die("Problemas seleccionando base de datos");

$consultaa=sprintf("SELECT * FROM users WHERE nombre='%s'", mysql_real_escape_string($usuario));
$consulta=mysql_query($consultaa, $conexion) or die("problema en un select");
$usuarios=mysql_fetch_assoc($consulta);
$tabla=$usuarios['tabla'];
$comprobar_si_existe=mysql_query("select * from $tabla where servicio=\"$servicio\"");
$comprobar=mysql_fetch_array($comprobar_si_existe);

if ($comprobar) {

$eliminar_registro=sprintf("DELETE from $tabla where servicio='%s'", mysql_real_escape_string($servicio));
mysql_query($eliminar_registro, $conexion) or die("problema eliminando registro");
echo "<p>Se ha eliminado el registro $servicio correctamente</p>";

}

else {

echo "<p>El registro $servicio no existe</p>";

}
?>
</body>
</html>
