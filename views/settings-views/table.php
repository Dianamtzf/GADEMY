<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    include("../../config/conexion.php");
    $message = '';

    $query = "SELECT * FROM cursos";

    $stmt = $conn->prepare($query);
    $resultado = $stmt->execute();
  
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $iterator = new ArrayIterator($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Settings</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
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
          <a href="../../">
            <i class='bx bxs-home'></i>
            <span class="links_name">Home</span>
          </a>
          <span class="tooltip">Home</span>
        </li>
        <li>
          <a href="../courses.php">
            <i class='bx bx-book-bookmark'></i>
            <span class="links_name">Courses</span>
          </a>
          <span class="tooltip">Courses</span>
        </li>
        <li>
          <a href="../teachers.php">
            <i class='bx bxs-graduation'></i>
            <span class="links_name">Teachers</span>
          </a>
          <span class="tooltip">Teachers</span>
        </li>
        <li>
          <a href="../students.php">
            <i class='bx bxs-group'></i>
            <span class="links_name">Students</span>
          </a>
          <span class="tooltip">Students</span>
        </li>
        <li>
          <a href="table.php">
            <i class='bx bx-cog'></i>
            <span class="links_name">Settings</span>
          </a>
          <span class="tooltip">Settings</span>
        </li>
        <li class="profile">
          <a href="../../logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Logout</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="encabezado" style="display: flex; justify-content: center; align-items: flex-end;">
      <div style="display: flex; justify-content: center; align-items: center;">
        <div class="search-bar">
              <input type="text" placeholder="Search" name="q" class="buscador">
              <button><img src="../../images/search.png" alt=""></button>
        </div>
        <a href="home.php" class="btn btn-success btnAdd">Add Course</a>
      </div>
    </div>
    <section class="home-section" style="display: flex; justify-content: center; align-items: center;">
        <div class="col-md-6">
            <h3 class="text-center" style="color: #fff; margin-top: 40px;">Registered Courses</h3>
            <table class="table" style="color: #fff;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($iterator->valid()){ ?>
                        <?php $row = $iterator->current();?>
                        <tr>
                            <td><?php echo $row['cur_id']?></td>
                            <td><?php echo $row['cur_name']?></td>
                            <td><?php echo $row['cur_category']?></td>
                            <td><?php echo $row['cur_descrip']?></td>
                            <td>
                                <a href="edit.php?cur_id=<?php echo $row['cur_id']?>" class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                            <!-- Button trigger modal -->
                            <a href="delete.php?cur_id=<?php echo $row['cur_id']?>"
                                class="btn btn-danger"
                                onclick="confirmarBorrado(event)"
                              >
                                Delete
                            </a>

                            <!--
                            <button 
                                type="button"
                                class="btn btn-danger"
                                id="btnBorrar"
                                onclick="eliminarRegistro(<php echo $row['cur_id']?>)"
                              >
                                Delete
                            </button> -->

                        </tr>
                        <?php $iterator->next(); ?>
                    <?php }?>
                </tbody>
            </table>
            <!--
            <button type="button" class="btn btn-danger prueba" onclick="eliminarCurso()">Delete Course</button>-->
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script type="module" src="../../js/index.js"></script>
    
    <script>

      function confirmarBorrado(event) {
        event.preventDefault(); // Evita que se siga el enlace por defecto

        Swal.fire({
              title: 'Are you sure?',
              text: "Do you want to delete this course?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = event.target.href;
              }
            })
      } 
    </script>
    
</body>
</html>