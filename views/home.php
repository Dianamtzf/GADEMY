<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require '../config/conexion.php';
    $message = '';

    if(!empty($_POST['cur_mae_id']) && !empty($_POST['cur_name']) && !empty($_POST['cur_category'])) {
        $cur_name = $_POST['cur_name'];
        $cur_category = $_POST['cur_category'];
        $cur_descrip = $_POST['cur_descrip'];
        $cur_img = $_POST['cur_img'];
        $cur_mae_id = $_POST['cur_mae_id'];

        $query = 'INSERT INTO cursos(cur_name, cur_category, cur_descrip, cur_img, cur_mae_id) 
                    VALUES(:cur_name, :cur_category, :cur_descrip, :cur_img, :cur_mae_id)'; 
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cur_name', $cur_name);
        $stmt->bindParam(':cur_category', $cur_category);
        $stmt->bindParam(':cur_descrip', $cur_descrip);
        $stmt->bindParam(':cur_img', $cur_img);
        $stmt->bindParam(':cur_mae_id', $cur_mae_id);
        
        //$result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($stmt->execute()) {
            $message = 'The course has been registered';
        } else {
            $message = 'Algo anda mal';
        }
        header('Location: home.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

    <h1>WELCOME</h1>

    <?php if(!empty($message)): ?>
            <p style="color: #d90000;">
                <?= $message; ?>
            </p>
    <?php endif; ?>

    <div>
    <form action="home.php" method="post">
            <br>
            <input 
                type="text" 
                name="cur_name" 
                id="cur_name"
                placeholder="Enter the name of the course"
                class="inputStyle"
            >
            <input 
                type="text" 
                name="cur_category" 
                id="cur_category"
                placeholder="Enter the category of the course"
                class="inputStyle"
            >
            <input 
                type="text" 
                name="cur_descrip" 
                id="cur_descrip"
                placeholder="Enter the description of the course"
                class="inputStyle"
            >
            
            <input 
                type="text" 
                name="cur_img" 
                id="cur_img"
                placeholder="Enter the course's URL image"
                class="inputStyle"
            >
            <input 
                type="number" 
                name="cur_mae_id" 
                id="cur_mae_id"
                placeholder="Enter the teacher's ID"
                class="inputStyle"
                style="margin-block-end: 0px;"
            >
            <input 
                type="submit" 
                value="addCourse"
                class="button-signup"
                id="addCButton"
            >
        </form>
        <span style="margin-block-start: auto">Do you already have an account? Please: </span>
        <a href="../login.php" class="button-login">Login</a>
    </div>











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>