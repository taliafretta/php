<?php
session_start();

// Simula uma verificação de login. Isso deve ser substituído pela sua lógica de autenticação real.
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php'); // Redireciona para a página de login
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Abertura de Ouvidoria</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                var descricao = $('#descricao').val();
                var tipo = $('#tipo').val();
                var anexos = $('#anexos')[0].files.length;

                if (descricao === "" || tipo === "" || anexos === 0) {
                    alert("Todos os campos são obrigatórios, incluindo pelo menos um anexo.");
                    event.preventDefault(); // Impede o envio do formulário
                }
            });
        });
    </script>
</head>
<body>
<h3>Abertura de Ouvidoria</h3>
<form action="processa_ouvidoria.php" method="post" enctype="multipart/form-data">
    <label for="descricao">Descrição do caso:</label><br>
    <textarea id="descricao" name="descricao" required></textarea><br><br>

    <label for="tipo">Tipo de serviço afetado:</label><br>
    <input type="text" id="tipo" name="tipo" required><br><br>

    <label for="anexos">Anexos:</label><br>
    <input type="file" id="anexos" name="anexos[]" multiple required><br><br>

    <input type="submit" value="Enviar">
</form>
</body>
</html>

<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_logado'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $anexos = $_FILES['anexos'];

    // Aqui você implementaria a lógica para salvar no banco de dados
    foreach ($anexos['tmp_name'] as $key => $tmp_name) {
        $conteudoAnexo = file_get_contents($tmp_name);
        $base64 = base64_encode($conteudoAnexo);
        // Salvar $base64 no banco de dados junto com outras informações
    }
}
?>
