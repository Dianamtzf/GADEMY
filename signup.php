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
    <link rel="icon" href="./images/logo.ico"></link>
    <title>GADEMY</title>
    <link rel="stylesheet" href="./css/signup.css">
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
                    <img src="./images/usersc.png" alt="User Icon">
                </div>
                <h1 style="margin-block-start: 0px; margin-block-end: 0px; text-align:center;">
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
                    <div style="display: flex; align-items: center;">
                        <label for="verify">¿Are you a teacher?</label>
                        <input type="checkbox" name="verify" id="verify" class="inputStyle"
                                style="width: 40%; margin-top: 15px;">
                    </div>
                    <input 
                        type="submit" 
                        value="Register"
                        class="button-signup"
                        id="signupButton"
                        disabled
                    >
                </form>
                <span style="margin-block-start: auto">Do you already have an account? Please: </span>
                <a href="login.php" class="button-login">Login</a>
            </div>
        </div>
    </section>
    <script type="module" src="./js/index.js"></script>
    <script type="module" src="./js/signup.js"></script>
</body>
</html>