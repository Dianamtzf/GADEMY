<!-- Cursos En forma de tarjetas y buscador-->
<?php 
session_start();
require '../config/conexion.php'; // Pega de manera permanente el código

$query = "SELECT * FROM cursos"; 
$registro = $conn->prepare($query);
$registro->execute();
$cursos = $registro->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Responsive Sidebar Menu | CodingLab</title>
    <link rel="stylesheet" href="../css/courses.css">
    <script type="module" src="../js/courses.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
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
                        <a href="about.html">
                            <i class='bx bx-question-mark'></i>
                            <span class="links_name">About us</span>
                        </a>
                        <span class="tooltip">About us</span>
                    </li>
                    <li>
                        <a href="courses.php">
                            <i class='bx bx-book-bookmark'></i>
                            <span class="links_name">Courses</span>
                        </a>
                        <span class="tooltip">Courses</span>
                    </li>
                    <li>
                        <a href="home.php">
                            <i class='bx bx-cog'></i>
                            <span class="links_name">Settings</span>
                        </a>
                        <span class="tooltip">Settings</span>
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
            <input type="text" class="buscStyle" id="buscador" placeholder="Buscar curso por nombre">
        </div>
    <div class="container">
        <div class="card-container">
            <?php foreach ($cursos as $curso): ?>
                <div class="card">
                    <div style="flex: 1;">
                        <img class="imgStyle" src="<?= $curso['cur_img'] ?>" style="width: 100%;">
                    </div>
                    <div style="flex: 2; margin-left: 20px;">
                        <div class="card-title">
                            <span style="font-size: 30px; font-weight: bold;">Course: <?= $curso['cur_name']?></span>
                            <br>
                        </div>
                        <div class="card-body">
                            <span style="font-size: 20px; font-weight: bold;">Category: <?= $curso['cur_category']?></span>
                            <br>
                            <br>
                            <span style="font-size: 15px; font-weight: bold;"><?= $curso['cur_descrip']?></span>
                            <br>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


    <script type="module" src="../js/courses.js"></script>
    <link rel="stylesheet" href="../css/courses.css">
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
