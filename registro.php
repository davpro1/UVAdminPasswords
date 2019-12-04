<!DOCTYPE html>

<html>
<head>
<title>UVAdminPasswords</title>
<meta http-equiv="Refresh" content="5;url=registro.html">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/estilos.css">
<link rel="shortcut icon" href="favicon.png">
</head>
<body>

<?php

$nombre=$_POST['nombre'];
$clave=$_POST['clave'];
$clave_admin=$_POST['pass_registration'];
$clave_admin=sha1($clave_admin);

$array_ini = parse_ini_file("/etc/uvadminpasswords/uvadminpasswords.ini");


$nombretabla=sprintf("tabla%s", $nombre);

if ($clave_admin != $array_ini['pass_registration']) {

	die("<h1>Clave de administracion incorrecta</h1>");

	}

$conexion=mysql_connect("localhost", $array_ini['user_bd'], $array_ini['pass_bd'])
	or die("no se ha podido conectar con el servidor");
mysql_select_db($array_ini['name_bd'], $conexion) or die("<h1>Problemas seleccionando base de datos</h1>");

$comprobar_si_existe=mysql_query("select * from users where nombre=\"$nombre\"");
$comprobar=mysql_fetch_array($comprobar_si_existe);

if ($comprobar) {

	die("<h1>El usuario ya existe en la base de datos</h1>");

	}


$consulta=sprintf("insert into users values(\"%s\", sha1('%s'), \"%s\")", mysql_real_escape_string($nombre), mysql_real_escape_string($clave), mysql_real_escape_string($nombretabla));
$consulta=mysql_query($consulta, $conexion) or die("problemas creando el usuario en la base de datos");

$consulta2=sprintf("create table %s(servicio varchar(20), clavet varchar(100))", mysql_real_escape_string($nombretabla));
$consulta2=mysql_query($consulta2, $conexion) or die("problemas creando la tabla del usuario");

echo "<h1>El usuario $nombre se ha agregado con éxito a la base de datos</h1>";
?>
</body>
</html>
