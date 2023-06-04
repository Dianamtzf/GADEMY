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
            header('Location: views/home.php');
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
    <title>Login to my platform</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="card">

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
            >
         </form>
        <span style="margin-block-start: auto">Do not you have an account yet? Please: </span>
        <a href="signup.php" class="button-signup">Signup</a>
    </div>
    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginButton = document.getElementById('loginButton');

        emailInput.addEventListener('input', toggleLoginButton);
        passwordInput.addEventListener('input', toggleLoginButton);

        function toggleLoginButton() {
            if (emailInput.value.trim() === '' || passwordInput.value.trim() === '') {
                loginButton.disabled = true;
                loginButton.style.backgroundColor = '#a8a8a8';
                loginButton.style.cursor = 'no-drop';
            } else {
                loginButton.disabled = false;
                loginButton.style.cursor = 'pointer';
                loginButton.style.backgroundColor = '#224667';
            }
        }
    </script>

</body>
</html>