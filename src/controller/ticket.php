<?php
include '../model/User.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $_SESSION['attempted_email'] = $email;
    $password = $_POST['password'];
    $user = new User();
    $user = $user->findByEmail($email);
    print_r($user);

    if ($user && password_verify($password, $user->getPasswordHash())) {
        $_SESSION['login_message'] = 'Logado com sucesso';
        $_SESSION['login_success'] = true;
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_name'] = $user->getFullName();

        header('Location: ticket.php');
        exit();
    } else {
        $_SESSION['login_message'] = 'Email ou senha inválido';
        $_SESSION['login_success'] = false;
        $_SESSION['logged_in'] = false;
    }
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../utils/Database.php';
$database_connection = (new Database())->connection;

$stmt = $database_connection->prepare("SELECT id, user_id, description, type, created_at FROM ticket WHERE user_id = ?");
$stmt->bind_param("s", $_SESSION['user_id']);
$stmt->execute();
$ouvidorias = $stmt->get_result();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Ouvidorias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<?php include '../view/navbar.php'; ?>
<body>
<div class="container mt-3">
    <h3>Ouvidorias Abertas</h3>

    <?php if ($ouvidorias->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Tipo de Serviço</th>
                <th>Data de Abertura</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ouvidorias as $ouvidoria): ?>
                <tr>
                    <td><?= htmlspecialchars($ouvidoria['id']) ?></td>
                    <td><?= htmlspecialchars($ouvidoria['description']) ?></td>
                    <td><?= htmlspecialchars($ouvidoria['type']) ?></td>
                    <td><?= htmlspecialchars($ouvidoria['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma ouvidoria registrada.</p>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
