<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ouvidoria Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<?php include '../view/navbar.php'; ?>
<body>
<div class="container">
    <h2>Login</h2>

    <?php session_start(); ?>
    <?php if (isset($_SESSION['login_message'])): ?>
        <div class="alert <?= $_SESSION['login_success'] ? 'alert-success' : 'alert-danger' ?>" role="alert">
            <?= htmlspecialchars($_SESSION['login_message']) ?>
        </div>
        <?php
        $emailValue = isset($_SESSION['attempted_email']) ? $_SESSION['attempted_email'] : '';
        unset($_SESSION['login_message']);
        unset($_SESSION['login_success']);
        unset($_SESSION['attempted_email']);
        ?>
    <?php else: ?>
        <?php $emailValue = ''; ?>
    <?php endif; ?>

    <form id="loginForm" method="POST" action="ticket.php">
        <div class="form-group">
            <label for="emailLogin">Email:</label>
            <input type="email" class="form-control" id="emailLogin" name="email"
                   value="<?= htmlspecialchars($emailValue) ?>" required>
        </div>
        <div class="form-group">
            <label for="passwordLogin">Senha:</label>
            <input type="password" class="form-control" id="passwordLogin" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php include '../view/footer.php'; ?>
</html>
