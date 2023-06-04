<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'config/conexion.php';
$message = '';

if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $name = $_POST['name'];
    $mae_img = $_POST['mae_img'];
    $verify = isset($_POST['verify']) ? 1 : 0;
    // Check if email already exists in the database
    $email = $_POST['email'];
    $query = "SELECT * FROM maestros WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $message = 'The email address is already registered.';
    } else {
        if($password === $repassword) {
            $sql = 'INSERT INTO maestros (name, email, password, mae_img, verify) VALUES (:name, :email, :password, :mae_img, :verify)';
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name); // Enlace del parámetro :name
            $stmt->bindParam(':email', $_POST['email']);
            $newPass = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $newPass);
            $stmt->bindParam(':mae_img', $mae_img); // Enlace del parámetro :mae_img
            $stmt->bindParam(':verify', $verify);
        

            if($stmt->execute()) {
                $message = 'Successfully created a new user.';
            } else {
                $message = 'Gosh... something was wrong';
            }
        } else {
            $message = 'The passwords do not match. Please try again.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup to my platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="card">

        <h1 style="margin-block-start: 0px; margin-block-end: 0px;">
            Signup
        </h1>

        <?php require 'partials/header.php' ?>
        <?php if(!empty($message)): ?>
            <p style="color: #d90000;">
                <?= $message; ?>
            </p>
        <?php endif; ?>

        <form action="signup.php" method="post">
            <br>
            <input 
                type="text" 
                name="name" 
                id="name"
                placeholder="Enter your name"
                class="inputStyle"
            >
            <input 
                type="email" 
                name="email" 
                id="email"
                placeholder="Enter your email"
                class="inputStyle"
            >
            <input 
                type="text" 
                name="mae_img" 
                id="mae_img"
                placeholder="Enter your photo link"
                class="inputStyle"
            >
            <label for="verify">¿Are you teacher?</label>
            <input 
                type="checkbox" 
                name="verify" 
                id="verify"
                class="inputStyle"
            >
            <input 
                type="password" 
                name="password" 
                id="password"
                placeholder="Enter your password"
                class="inputStyle"
            >
            <input 
                type="password" 
                name="repassword" 
                id="repassword"
                placeholder="Confirm your password"
                class="inputStyle"
                style="margin-block-end: 0px;"
            >
            <input 
                type="submit" 
                value="Register"
                class="button-signup"
                id="signupButton"
            >
        </form>
        <span style="margin-block-start: auto">Do you already have an account? Please: </span>
        <a href="login.php" class="button-login">Login</a>
    </div>
    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const repasswordInput = document.getElementById('repassword');
        const signupButton = document.getElementById('signupButton');

        emailInput.addEventListener('input', toggleSignupButton);
        passwordInput.addEventListener('input', toggleSignupButton);
        repasswordInput.addEventListener('input', toggleSignupButton);

        function toggleSignupButton() {
            if (emailInput.value.trim() === '' || passwordInput.value.trim() === '' || repasswordInput.value.trim() === '') {
                signupButton.disabled = true;
                signupButton.style.backgroundColor = '#a8a8a8';
                signupButton.style.cursor = 'no-drop';
            } else {
                signupButton.disabled = false;
                signupButton.style.cursor = 'pointer';
                signupButton.style.backgroundColor = '#224667';
            }
        }
    </script>
</body>
</html>