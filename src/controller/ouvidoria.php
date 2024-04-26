<?php

include '../model/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordEncrypted = password_hash($password, PASSWORD_DEFAULT);
    print($email);
    $user = getUserByEmail($email);
    print($user);
    exit();
}

session_start();


// Simula uma verificação de login.
if (!isset($_SESSION['usuario_logado'])) {
//    header('Location: login.php');
//    exit();
}

// Assumindo que o ID do usuário está armazenado na sessão.
$usuario_id = $_SESSION['usuario_id'];

// Conexão com o banco de dados
$database_connection = OpenCon();
$database_connection = new PDO('mysql:host=localhost;dbname=database', 'root', 'root');
$database_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Preparar e executar a consulta
$stmt = $database_connection->prepare("SELECT id, descricao, tipo, data_abertura FROM ouvidoria WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);
$ouvidorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
//?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Ouvidorias</title>
</head>
<body>
<h3>Ouvidorias Abertas</h3>
<?php if (count($ouvidorias) > 0): ?>
    <table border="1">
        <thead>
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
                <td><?= htmlspecialchars($ouvidoria['descricao']) ?></td>
                <td><?= htmlspecialchars($ouvidoria['tipo']) ?></td>
                <td><?= htmlspecialchars($ouvidoria['data_abertura']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhuma ouvidoria registrada.</p>
<?php endif; ?>
</body>
</html>
