<?php 
    session_start();
	require './config/conexion.php'; //Pega de manera permanente el codigo
	if (isset($_SESSION['user_id'])) { //verificar si ya habia abierto la sesion
		$query = "SELECT * FROM maestros WHERE id = :id"; //:id == ?
		$registro = $conn->prepare($query);
		$registro->bindParam(':id', $_SESSION['user_id']); //sobreescribir el parametro
		$registro->execute();
		$resultado = $registro->fetch(PDO::FETCH_ASSOC);
		$user = null;
		if (count($resultado) > 0){
			$user = $resultado;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GADEMY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <?php require 'partials/header.php'?>

    <?php if(!empty($user)): ?>
        <div class="card">
            <span style="font-size: 30px; font-weight: bold;">Welcome: <?= $user['email']; ?></span>
            <br>
            <span style="font-size: 20px; font-weight: bold;">You are successfully logged in</span>
            <a href="logout.php" class="button" style="background-color: #4a548f; margin-block-end: 20px;">
                Logout
            </a>
        </div>

    <?php else: ?>
        <div class="card">
            <div class="user-icon">
                <img src="./assets/images/mampi.png" alt="User Icon">
            </div>
            <h1 style="color: #0b0811; font-weight: bold; ">Before starting, please:</h1>
            <a href="login.php" class="button">LOGIN</a>
            <div class="hr-label"><span class="hr-label__text">
                --------------------------- or ---------------------------
            </span></div>
            <a href="signup.php" class="button">SIGNUP</a>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
