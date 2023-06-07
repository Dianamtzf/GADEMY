<?php 
    session_start();
    if (isset($_SESSION['user_id'])) {
        header('Location: views/home.php');
    }

    require 'config/conexion.php';
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $registro = $conn->prepare('SELECT id, email, password FROM maestros WHERE email = :email');
        $registro->bindParam(':email', $_POST['email']);
        $registro->execute();
        $usuario = $registro->fetch(PDO::FETCH_ASSOC);
        $message = '';
        //compara y sabe si existe el registro
        if (count($usuario) > 0 && password_verify($_POST['password'], $usuario['password']))
        {
            $_SESSION['user_id'] = $usuario['id'];
            header('Location: /');
        } else {
            $message = 'The email or password is invalid... Try again.';
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
    <link rel="stylesheet" href="./css/login.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
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
    <section class="home-section">
        <div class="container">
            <div class="card">
                <div class="user-icon">
                    <img src="./images/user1.png" alt="User Icon">
                </div>
                <h1 style="margin-block-start: 0px; margin-block-end: 0px;">
                    Login
                </h1>
                <?php require './partials/header.php' ?>
                <?php if(!empty($message)): ?>
                    <p style="color: #d90000;">
                        <?= $message; ?>
                    </p>
                <?php endif; ?>
                
                <form action="login.php" method="post">
                    <br>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="inputStyle" 
                        placeholder="Enter your email"
                    >
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="inputStyle" 
                        placeholder="Enter your password"
                        style="margin-block-end: 0px;"
                    >
                    <input 
                        type="submit" 
                        class="button-login" 
                        id="loginButton" 
                        value="Login"
                        disabled
                    >
                </form>
                <span style="margin-block-start: auto">Do not you have an account yet? Please: </span>
                <a href="signup.php" class="button-signup">Signup</a>
            </div>
        </div>
    </section>
    <script type="module" src="./js/index.js"></script>
    <script type="module" src="./js/login.js"></script>

</body>
</html>