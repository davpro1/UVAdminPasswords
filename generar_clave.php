<!DOCTYPE html>

<html>
<head>
<title>UVAdminPasswords</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/estilos.css">
<link rel="shortcut icon" href="favicon.png">
</head>
<body>

<?php
echo "<h1>Generando entropía</h1>";
system("du -s>/dev/null");
echo "<h1>Listado de claves, elige la que más te guste</h1>";

for ($i = 15; $i <= 50; $i++) {
    echo "<p>-------------------</p>";
    system("gpg --gen-random --armor 0 ".$i);
    echo "<p>-------------------</p>";
}
?>
</body>
</html>
