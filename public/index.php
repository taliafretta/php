<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial - Ouvidoria Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Ouvidoria Online</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="../src/controller/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../src/controller/register.php">Cadastro</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>


<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">Bem-vindo à Ouvidoria Online!</h1>
        <p class="lead">Este é um serviço para você registrar suas reclamações, sugestões ou denúncias.</p>
        <?php
        echo '<p>Use os botões abaixo para acessar os serviços.</p>';
        ?>
        <a class="btn btn-primary btn-lg" href="../src/controller/login.php" role="button">Login</a>
        <a class="btn btn-secondary btn-lg" href="../src/controller/register.php" role="button">Cadastro</a>
    </div>
</div>

<?php
    include '../src/utils/db_connection.php';
    $conn = OpenCon();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birthdate = $_POST['birthdate'];
        $phone = $_POST['phone'];
        $whatsapp = $_POST['whatsapp'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        saveUser($fullName, $email, $password, $birthdate, $phone, $whatsapp, $state, $city);
    }

    CloseCon($conn);
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
