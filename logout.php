<!DOCTYPE html>
<html>
<head>
<title>UVAdminPasswords</title>
<meta http-equiv="Refresh" content="5;url=index.html">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/estilos.css">
<link rel="shortcut icon" href="favicon.png">
</head>

<body>

<?php
session_start();
session_unset();
session_destroy();
echo "<h1>Sesion Cerrada</h1>";
echo "<p>Redirigiendo a la página de login</p>";



?>


</body>
</html>
