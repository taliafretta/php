<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: ticket.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Abertura de Ouvidoria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('form').submit(function (event) {
                var descricao = $('#descricao').val();
                var tipo = $('#tipo').val();
                var anexos = $('#anexos')[0].files.length;

                if (descricao === "" || tipo === "" || anexos === 0) {
                    alert("Todos os campos são obrigatórios, incluindo pelo menos um anexo.");
                    event.preventDefault();
                }
            });
        });
    </script>
</head>
<body>
<?php include '../view/navbar.php'; ?>
<div  class="container mt-5">
    <h3 class="mb-4">Abertura de Ouvidoria</h3>
    <form id="ticketRegister" method="POST" action="ticket_process.php" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="type">Descrição do caso:</label>
            <textarea class="form-control" id="descriptiom" name="description" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="type">Tipo de serviço afetado:</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>

        <div class="form-group mb-3">
            <input type="file" class="btn btn-secondary" id="attachments" name="attachments" multiple required>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>