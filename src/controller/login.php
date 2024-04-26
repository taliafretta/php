<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ouvidoria Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form id="loginForm" method="POST" action="ouvidoria.php">-->
        <div class="form-group">
            <label for="emailLogin">Email:</label>
            <input type="email" class="form-control" id="emailLogin" name="email" required>
        </div>
        <div class="form-group">
            <label for="passwordLogin">Senha:</label>
            <input type="password" class="form-control" id="passwordLogin" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
</body>
</html>
