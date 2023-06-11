<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include("../../config/conexion.php");
    $message = '';

    $courseId = $_GET['cur_id'];
    $query = "SELECT cursos.*, maestros.name, maestros.id FROM cursos, maestros WHERE cur_id='$courseId'";
    $stmt = $conn->prepare($query);
    $resultado = $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
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

    <section class="home-section" 
                style="background-image: linear-gradient(to bottom, rgb(33 33 33 / 70%), rgba(33,33,33,1));
                    background-size: contain; min-height: 100vh; background-repeat: no-repeat; background-position: center top;
                    background-position: center; background-size: cover;">
        <div class="container">
            <div class="card-addCourse">
                <p style="font-size: 25px; color: #0cbb52; font-weight: 600;">Edit Course</p>
                <form action="update.php" method="post" style="">
                  <input type="hidden" name="cur_id" value="<?php echo $data['cur_id']?>">
                    <div class="input-espaciado">
                        <div class="input-field">
                          <input type="text" name="cur_name" id="cur_name" value="<?php echo $data['cur_name'];?>" required>  
                          <label>Course Name</label>
                        </div>
                    </div>

                    <div class="input-espaciado">
                        <div class="input-field">
                          <input type="text" name="cur_category" id="cur_category" value="<?php echo $data['cur_category'];?>" required>
                          <label>Course Category</label>
                        </div>
                    </div>

                    <div class="input-espaciado">
                        <div class="input-field inputStyle">
                        <label for="cur_descrip">Course Description</label>
                        <textarea name="cur_descrip" id="cur_descrip" rows="4" required><?php echo $data['cur_descrip']; ?></textarea>
                        </div>
                    </div>

                    <div class="input-espaciado">
                        <div class="input-field">
                          <input type="text" name="cur_img" id="cur_img" value="<?php echo $data['cur_img'];?>" required>  
                          <label>Course's URL image</label>
                        </div>
                    </div>
                    
                    <select name="cur_mae_id" 
                            style="width: 88%;
                                    height: 35px;
                                    border-radius: 7px;
                                    border: none;
                                    outline: none;
                                    background-color: #353434;
                                    color: #fff;
                                    margin-bottom: 30px;">
                      <?php
                        ini_set('display_errors', 1);
                        error_reporting(E_ALL);
                        require '../../config/conexion.php';
                        
                        $teachers = 'SELECT * FROM maestros';
                        $stmt = $conn->prepare($teachers);
                        $res = $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $iterator = new ArrayIterator($data);
                      ?>
                      <optgroup>
                        <option value="" class="text-center" disabled selected>----Select a teacher----</option>
                      </optgroup>
                        
                        <?php while($iterator->valid()){ ?>
                          <?php $row = $iterator->current(); ?>
                          <?php if (intval($row['verify']) === 1): ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                          <?php endif; ?>
                          <?php $iterator->next(); ?>
                        <?php }?>
                    </select>

                    <div style="display: flex; align-items: center; justify-content: center;">
                        <a href="table.php" class="btn btn-warning" style="margin-right: 20px;">Cancel</a>
                        <button type="submit" class="btn" style="background-color: #429867;" onclick="mostrarDialogo(event)">Update</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script type="module" src="../../js/index.js"></script>

    <script>
     function mostrarDialogo(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Do you want to update this course?',
                text: "You can update it later if you want!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.form.submit();
                }
            });
        }

    </script>
</body>
</html>