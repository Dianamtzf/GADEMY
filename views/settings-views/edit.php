<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include("../../config/conexion.php");
    $message = '';

    $courseId = $_GET['cur_id'];
    $query = "SELECT * FROM cursos WHERE cur_id='$courseId'";
    $stmt = $conn->prepare($query);
    $resultado = $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="sidebar" id="sidebar">
      <div class="logo-details">
        <img src="../../images/logo-v.jpg" style="width: 60px;" class="bx icon">
        <div class="logo_name">GADEMY</div>
        <i class='bx bx-menu' id="btn"></i>
      </div>
      <ul class="nav-list" style="padding-left: 0rem;">
        <li>
          <a href="#">
            <i class='bx bxs-home'></i>
            <span class="links_name">Home</span>
          </a>
          <span class="tooltip">Home</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-question-mark'></i>
            <span class="links_name">About us</span>
          </a>
          <span class="tooltip">About us</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-book-bookmark'></i>
            <span class="links_name">Courses</span>
          </a>
          <span class="tooltip">Courses</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bxs-graduation'></i>
            <span class="links_name">Teachers</span>
          </a>
          <span class="tooltip">Teachers</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bxs-group'></i>
            <span class="links_name">Students</span>
          </a>
          <span class="tooltip">Students</span>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog'></i>
            <span class="links_name">Settings</span>
          </a>
          <span class="tooltip">Settings</span>
        </li>
        <li class="profile">
          <a href="#">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Logout</span>
          </a>
        </li>
      </ul>
    </div>
    
    <section class="home-section" style="display: flex; justify-content: center;">
        <div class="col-md-12">
            <h3 style="color: #fff;">Update Course</h3>
            <form action="edit.php" method="post">
                <input type="text" name="cur_name" value="<?php echo $data['cur_name']?>">
                <input type="text" name="cur_category" class="form-control mb-3" value="<?php echo $data['cur_category']?>">
                <input type="text" name="cur_descrip" class="form-control mb-3" value="<?php echo $data['cur_descrip']?>">
                <input type="text" name="cur_img" class="form-control mb-3" value="<?php echo $data['cur_img']?>">
                <input type="number" name="cur_mae_id" min="0" max="999" class="form-control mb-3" value="<?php echo $data['cur_mae_id']?>">
                <div style="display: flex; align-items: baseline;">
                    <a href="table.php" class="btn btn-warning mb-5" style="margin: 10px;">Cancel</a>
                    <input type="submit" class="btn" style="background-color: #429867;" value="Actualizar">
                </div>
            </form>
        </div>
    </section>
    
    <script type="module" src="../../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>