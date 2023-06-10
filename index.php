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
    <link rel="icon" href="./images/logo.ico"></link>
    <title>GADEMY</title>
    <link rel="stylesheet" href="./css/index.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php require 'partials/header.php'?>

    <?php if(!empty($user)): ?>
        <?php if($user['verify'] == 0): ?>
            <div class="sidebar" id="sidebar">
                <div class="logo-details">
                    <img src="./images/logo-v.jpg" style="width: 60px;" class="bx icon">
                    <div class="logo_name">GADEMY</div>
                    <i class='bx bx-menu' id="btn"></i>
                </div>
                <ul class="nav-list">
                    <li>
                        <a href="./">
                            <i class='bx bxs-home'></i>
                            <span class="links_name">Home</span>
                        </a>
                        <span class="tooltip">Home</span>
                    </li>
                    <li>
                        <a href="./views/courses.php">
                            <i class='bx bx-book-bookmark'></i>
                            <span class="links_name">Courses</span>
                        </a>
                        <span class="tooltip">Courses</span>
                    </li>
                    <li class="profile">
                        <a href="logout.php">
                            <i class='bx bx-log-out'></i>
                            <span class="links_name">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <section class="home-section" 
            style="background-image: linear-gradient(to bottom, rgb(33 33 33 / 70%), rgba(33,33,33,1)), url(../images/home2.jpg);
                    background-size: contain; min-height: 100vh; background-repeat: no-repeat; background-position: center top;
                    background-position: center; background-size: cover;">
                <div class="container">
                    <div class="card">
                        <div class="user-icon">
                            <img src="<?= $user['mae_img']; ?>" alt="User Icon">
                        </div>
                        <span style="font-size: 30px; font-weight: bold;">Welcome Student: <?= $user['name']; ?></span>
                        <br>
                        <span style="font-size: 20px; font-weight: bold;">You are successfully logged in</span>
                    </div>
                </div>
            </section>
            
            
        <?php else: ?>
            <div class="sidebar" id="sidebar">
                <div class="logo-details">
                    <img src="./images/logo-v.jpg" style="width: 60px;" class="bx icon">
                    <div class="logo_name">GADEMY</div>
                    <i class='bx bx-menu' id="btn"></i>
                </div>
                <ul class="nav-list">
                    <li>
                        <a href="./">
                            <i class='bx bxs-home'></i>
                            <span class="links_name">Home</span>
                        </a>
                        <span class="tooltip">Home</span>
                    </li>
                    <li>
                        <a href="./views/courses.php">
                            <i class='bx bx-book-bookmark'></i>
                            <span class="links_name">Courses</span>
                        </a>
                        <span class="tooltip">Courses</span>
                    </li>
                    <li>
                        <a href="./views/settings-views/home.php">
                            <i class='bx bx-cog'></i>
                            <span class="links_name">Settings</span>
                        </a>
                        <span class="tooltip">Settings</span>
                    </li>
                    <li>
                        <a href="./views/teachers.php">
                            <i class='bx bxs-graduation'></i>
                            <span class="links_name">Teachers</span>
                        </a>
                        <span class="tooltip">Teachers</span>
                    </li>
                    <li>
                        <a href="./views/students.php">
                            <i class='bx bxs-group'></i>
                            <span class="links_name">Students</span>
                        </a>
                        <span class="tooltip">Students</span>
                    </li>
                    <li class="profile">
                        <a href="logout.php">
                            <i class='bx bx-log-out'></i>
                            <span class="links_name">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <section class="home-section" 
            style="background-image: linear-gradient(to bottom, rgb(33 33 33 / 70%), rgba(33,33,33,1)), url(../images/home2.jpg);
                    background-size: contain; min-height: 100vh; background-repeat: no-repeat; background-position: center top;
                    background-position: center; background-size: cover;">
                <div class="container">
                    <div class="card">
                        <div class="user-icon">
                            <img src="<?= $user['mae_img']; ?>" alt="User Icon">
                        </div>
                        <span style="font-size: 30px; font-weight: bold;">Welcome Teacher: <?= $user['name']; ?></span>
                        <br>
                        <span style="font-size: 20px; font-weight: bold;">You are successfully logged in</span>
                    </div>
                </div>
            </section>
        <?php endif; ?>


    <?php else: ?>
    <div class="sidebar" id="sidebar">
        <div class="logo-details">
            <img src="./images/logo-v.jpg" style="width: 60px;" class="bx icon">
            <div class="logo_name">GADEMY</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="./">
                    <i class='bx bxs-home'></i>
                    <span class="links_name">Home</span>
                </a>
                <span class="tooltip">Home</span>
            </li>
            <li>
                <a href="./views/about.html">
                    <i class='bx bx-question-mark'></i>
                    <span class="links_name">About us</span>
                </a>
                <span class="tooltip">About us</span>
            </li>
        </ul>
    </div>
    <section class="home-section" 
            style="background-image: linear-gradient(to bottom, rgb(33 33 33 / 70%), rgba(33,33,33,1)), url(../images/home2.jpg);
                    background-size: contain; min-height: 100vh; background-repeat: no-repeat; background-position: center top;
                    background-position: center; background-size: cover;">
        <div class="contenedor">
            <div class="carta">
                <h1 style="color: #629f5c; font-weight: bold; font-size: xxx-large;">
                    The best courses with the best teachers. 
                </h1>
                <h1 style="color: #d6db8d; font-weight: bold; font-size: xxx-large;">
                    Only at GADEMY.
                </h1>
                <h1 style="color: #d6db8d; font-weight: bold; font-size: xxx-large;">
                    Starts now!
                </h1>
                <div class="acciones">
                   <a href="login.php" class="button log" style="background-color: #ef6f13; margin-top: 25px; font-size: 1.1rem;">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        LOGIN
                    </a>
                   <nav class="linea-nav" style="width: 60%;"></nav>
                   <a href="signup.php" class="button sig" style="background-color: #f3450f;font-size: 1.1rem;">
                   <i class="fa-solid fa-user-plus fa-flip-horizontal"></i>
                        SIGNUP
                    </a> 
                </div>
            </div>
        </div>
        
    </section>
    <?php endif; ?>
    <script type="module" src="./js/index.js"></script>
</body>
</html>
