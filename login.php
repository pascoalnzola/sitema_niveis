<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(to bottom, #e3f2fd, #bbdefb);
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    .login-container {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 350px;
        text-align: center;
    }

    .login-container img {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
    }

    h2 {
        color: #1e88e5;
        margin-bottom: 20px;
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 12px 0;
        border: 2px solid #1e88e5;
        border-radius: 8px;
        font-size: 16px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #1e88e5;
        border: none;
        color: white;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover {
        background-color: #1565c0;
    }

    a {
        color: #1e88e5;
        text-decoration: none;
        font-size: 14px;
        margin: 5px 0;
        display: block;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
    <div class="login-container" id="request-form">
        <h2>Entrar</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <button type="submit">Login</button>
        </form>
        <a href="esqueci.php">Esqueceu a senha?</a>
    </div>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST["email"]) && isset($_POST["senha"])){
                include("factores1.php");
            }
        }
    ?>
</body>
</html>
