<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require '../../config/conexion.php';
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
            header('Location: table.php');
        } else {
            $message = 'Algo anda mal';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
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
                <p style="font-size: 25px; color: #0cbb52; font-weight: 600;">Add Course</p>
                <form action="home.php" method="post">
                    <div class="input-espaciado">
                        <div class="input-field">
                            <input 
                                type="text" 
                                name="cur_name" 
                                id="cur_name"
                                required
                            >
                            <label>Course Name</label>
                        </div>
                    </div>

                    <div class="input-espaciado">
                        <div class="input-field">
                            <input 
                                type="text" 
                                name="cur_category" 
                                id="cur_category"
                                required
                            >
                            <label>Course Category</label>
                        </div>
                    </div>

                    <div class="input-espaciado">
                        <div class="input-field inputStyle">
                        <label for="cur_descrip">Course Description</label>
                        <textarea name="cur_descrip" id="cur_descrip" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="input-espaciado">
                        <div class="input-field">
                            <input 
                                type="text" 
                                name="cur_img" 
                                id="cur_img"
                                required
                            >
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
                        <button type="submit" class="btn" style="background-color: #429867;" onclick="mostrarDialogo(event)" disabled>Add Course</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </section>
    
    <script type="module" src="../../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
      function mostrarDialogo(event) {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Course Added!!!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
              event.target.form.submit();
            });
        }
        // Obtener referencias a los campos del formulario y al botón "Add Course"
        const curNameInput = document.getElementById('cur_name');
        const curCategoryInput = document.getElementById('cur_category');
        const curDescripInput = document.getElementById('cur_descrip');
        const curImgInput = document.getElementById('cur_img');
        const teacherSelect = document.getElementsByName('cur_mae_id')[0];
        const addCourseButton = document.querySelector('button[type="submit"]');

        // Agregar un event listener para detectar cambios en los campos del formulario y en el select del profesor
        curNameInput.addEventListener('input', validarCampos);
        curCategoryInput.addEventListener('input', validarCampos);
        curDescripInput.addEventListener('input', validarCampos);
        curImgInput.addEventListener('input', validarCampos);
        teacherSelect.addEventListener('change', validarCampos);

        // Función para validar los campos y habilitar/deshabilitar el botón "Add Course"
        function validarCampos() {
          if (
            curNameInput.value.trim() !== '' &&
            curCategoryInput.value.trim() !== '' &&
            curDescripInput.value.trim() !== '' &&
            curImgInput.value.trim() !== '' &&
            teacherSelect.value.trim() !== ''
          ) {
            addCourseButton.removeAttribute('disabled');
          } else {
            addCourseButton.setAttribute('disabled', 'disabled');
          }
        }
    </script>
</body>
</html>

