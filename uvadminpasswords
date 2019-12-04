<!DOCTYPE html>
<html>
<head>
<title>UVAdminPasswords</title>
<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="css/contacto.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="favicon.png">
</head>
<body>
<div id="contenedor">
<?php

session_start();
$usuario=$_SESSION['user'];

$array_ini = parse_ini_file("/etc/uvadminpasswords/uvadminpasswords.ini");
$pass_cifrado=$array_ini['pass_cifrado'];

echo "<h1 align=\"right\">logeado como '$usuario'<h1>";
echo "<p align=\"right\"><a href='logout.php'>Salir</a></p>";
echo "<br />";


$conexion=mysql_connect("localhost", $array_ini['user_bd'], $array_ini['pass_bd'])
	or die("no se ha podido conectar con el servidor");
mysql_select_db($array_ini['name_bd'], $conexion) or die("Problemas seleccionando base de datos");

$sesion=sprintf("select * from users where nombre='%s'", mysql_real_escape_string($usuario));
$consulta=mysql_query($sesion, $conexion) or die("problema en un select");
$usuarios=mysql_fetch_assoc($consulta);
$tabla=$usuarios['tabla'];
$servicios_c=mysql_query("select servicio from $tabla", $conexion) or die("problema en un select");
$clavet_string=sprintf("select aes_decrypt(clavet, '%s') from %s", mysql_real_escape_string($pass_cifrado), mysql_real_escape_string($tabla));
$clavet_c=mysql_query($clavet_string, $conexion) or die("problema en un select");


while (($row=mysql_fetch_array($servicios_c)) && ($rew=mysql_fetch_array($clavet_c))) {

echo "<p class=\"servicio\">$row[0]</p>";
echo "<input type=\"button\" value=\"Mostrar clave\" onclick=\"this.nextSibling.style.display='block';this.style.display='none'\"/><div class=\"spoiler\">$rew[0]</div>";
echo "<hr />";
}



?>

<h2 class="centrado">Creación y eliminación de registros</h2>

<h3 class="centrado">Crear un nuevo registro</h3>
<form class="contacto" name="crear_registro" action="crear.php" method="POST">
<div>
<label for="name">Nombre del servicio a crear</label>
<input type="text" name="servicio"></input>
</div>
<div>
<label for="clave">Clave del servicio</label>
<input type="text" name="clave"></input>
</div>
<button class="submit" type="submit">Crear</button>
</form>

<h3 class="centrado">Eliminar registro</h3>
<form class="contacto" name="eliminar_registro" action="eliminar.php" method="POST">
<div>
<label for="name">Nombre del servicio a eliminar</label>
<input type="text" name="servicio"></input>
</div>
<div>
<button class="submit" type="submit">Eliminar</button>
</div>
</form>

<h2 class="centrado">Generación d_e claves aleatorias</h2>
<form class="contacto" name="generar_clave" action="generar_clave.php">
<div>
<button class="submit" type="submit">Generar</button>
</div>
</form>
</div>
</body>
</html>
