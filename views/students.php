<!-- Estudiantes En forma de listas (img, nombre, correo) y buscador-->
<!-- Maestros En forma de listas (img, nombre, correo) y buscador-->
<?php 
session_start();
require '../config/conexion.php'; // Pega de manera permanente el código

$query = "SELECT * FROM maestros"; 
$registro = $conn->prepare($query);
$registro->execute();
$maestros = $registro->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Responsive Sidebar Menu | CodingLab</title>
    <link rel="icon" href="../images/logo.ico"></link>
    <link rel="stylesheet" href="../css/students.css">
    <script type="module" src="../js/students.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div class="sidebar" id="sidebar">
                <div class="logo-details">
                    <img src="../images/logo-v.jpg" style="width: 60px;" class="bx icon">
                    <div class="logo_name">GADEMY</div>
                    <i class='bx bx-menu' id="btn"></i>
                </div>
                <ul class="nav-list">
                    <li>
                        <a href="../index.php">
                            <i class='bx bxs-home'></i>
                            <span class="links_name">Home</span>
                        </a>
                        <span class="tooltip">Home</span>
                    </li>
                    <li>
                        <a href="courses.php">
                            <i class='bx bx-book-bookmark'></i>
                            <span class="links_name">Courses</span>
                        </a>
                        <span class="tooltip">Courses</span>
                    </li>
                    <li>
                        <a href="teachers.php">
                            <i class='bx bxs-graduation'></i>
                            <span class="links_name">Teachers</span>
                        </a>
                        <span class="tooltip">Teachers</span>
                    </li>
                    <li>
                        <a href="students.php">
                            <i class='bx bxs-group'></i>
                            <span class="links_name">Students</span>
                        </a>
                        <span class="tooltip">Students</span>
                    </li>
                    <li>
                        <a href="settings-views/table.php">
                            <i class='bx bx-cog'></i>
                            <span class="links_name">Settings</span>
                        </a>
                        <span class="tooltip">Settings</span>
                    </li>
                    <li class="profile">
                        <a href="../logout.php">
                            <i class='bx bx-log-out'></i>
                            <span class="links_name">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

    <section class="home-section">
    <div class="buscador">
        <input type="text" class="buscStyle" id="buscador" placeholder="Search by name" style="  width: 600px;
                                                                                                        padding: 10px;
                                                                                                        border: 2px solid #ffffff38;
                                                                                                        border-width: 1px;
                                                                                                        border-radius: 14px;
                                                                                                        background-color: transparent;
                                                                                                        font-size: 16px;
                                                                                                        color: #ffffff38;
                                                                                                        margin-top: 20px;
                                                                                                        outline: none;">
        <i class="fa-solid fa-magnifying-glass" style="color: #ffffff; margin-left: 10px; font-size: 20px;"></i>
    </div>

    <h2 class="titulo" style="text-align: center; font-size: 40px; font-weight: 600; color: white; margin-top: 20px;">Students</h2>
    <nav class="nav-divider centrado" style="   margin-left: auto;
                                                margin-right: auto;
                                                width: fit-content;
                                                background-color: #30612b;
                                                height: 5px;
                                                margin-bottom: 20px;
                                                width: 90%;
                                                "></nav>
    <div class="container">
        <div class="card-container">
            <?php foreach ($maestros as $maestro): ?>
                <?php if (intval($maestro['verify']) === 0): ?>
                    <div class="card" style="  box-shadow: 1px 0px 12px 4px rgba(0,0,0,0.49);
                                                -webkit-box-shadow: 1px 0px 12px 4px rgba(0,0,0,0.49);
                                                -moz-box-shadow: 1px 0px 12px 4px rgba(0,0,0,0.49); height: 350px; ">
                        <div style="flex: 1;">
                            <img class="imgStyle" src="<?= $maestro['mae_img'] ?>">
                        </div>
                        <div style="flex: 2; margin-left: 20px;">
                            <div class="card-title">
                                <label style="font-size: 20px; font-weight: 600;">Name:</label>
                                <span style="font-size: 15px; font-weight: 500;"><?= $maestro['name']?></span>
                                <br>
                            </div>
                            <div class="card-body">
                                <label style="font-size: 20px; font-weight: 600;">Email:</label>
                                <span style="font-size: 15px; font-weight: 500;"><?= $maestro['email']?></span>
                                <br>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>



    <script type="module" src="../js/students.js"></script>
    <link rel="stylesheet" href="../css/students.css">
    <script>
        const searchInput = document.getElementById('buscador');
        const cards = document.querySelectorAll('.card');

        searchInput.addEventListener('keyup', (event) => {
            const searchTerm = event.target.value.toLowerCase();

            cards.forEach((card) => {
                const courseName = card.querySelector('.card-title span').textContent.toLowerCase();
                card.style.display = courseName.includes(searchTerm) ? 'block' : 'none';
            });
        });
</script>
</body>
</html>
