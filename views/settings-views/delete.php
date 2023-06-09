<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include("../../config/conexion.php");
    $message = '';
    
    $courseId = $_GET['cur_id'];
    $query = "DELETE FROM cursos WHERE cur_id = '$courseId'";
    $stmt = $conn->prepare($query);
    $resultado = $stmt->execute();
    if ($resultado) {
        Header("Location: table.php");
    } else {
        echo "Couldn't delete the item dude:D";
    }
?>