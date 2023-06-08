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
        <div class="buscador">
            Aqui va el buscador
        </div>
        <a href="../home.php">Add Course</a>
        <div class="col-md-6">
            <h3 class="text-center" style="color: #fff;">Registered Courses</h3>
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
                            <button 
                                type="button"
                                class="btn btn-primary"
                                onclick="eliminarRegistro(<?php echo $row['cur_id']?>)"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Course</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to delete this course?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" onclick="eliminarUsuario()">Delete Course</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <?php $iterator->next(); ?>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </section>

    <script type="module" src="../../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>