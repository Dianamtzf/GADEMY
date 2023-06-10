<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include("../../config/conexion.php");
    
    $id = $_POST['cur_id'];
    $name = $_POST['cur_name'];
    $category = $_POST['cur_category'];
    $description = $_POST['cur_descrip'];
    $image = $_POST['cur_img'];
    $teacher = $_POST['cur_mae_id'];

    $query = "UPDATE cursos
                SET cur_name = '$name',
                    cur_category = '$category',
                    cur_descrip = '$description',
                    cur_img = '$image',
                    cur_mae_id = '$teacher'
                WHERE cur_id = '$id'";

    $stmt = $conn->prepare($query);
    $resultado = $stmt->execute();

    if($resultado) {
        Header("Location: table.php");
    } else {
        echo "Something went wrong";
    }
?>