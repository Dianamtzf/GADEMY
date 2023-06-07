<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require '../config/conexion.php'; //Pega de manera permanente el codigo
    $query = "SELECT * FROM cursos";
    $registro = $conn->prepare($query);
	$registro->execute();
	$resultado = $registro->fetch(PDO::FETCH_ASSOC);
	$curso = null;
    $curso = $resultado;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Nombre del curso: <?= $curso['cur_name']; ?></h1>
    <h1>Nombre del curso: <?= $curso['cur_descrip']; ?></h1>
</body>
</html>