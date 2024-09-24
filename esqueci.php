<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/OIP (1).jfif" type="image/x-icon">
    <title>Esqueci minha Senha</title>
    <link rel="stylesheet" href="estilo/estilo.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #f5f5f5;
}

header {
    background-color: #ffffff;
    border-bottom: 2px solid #ddd;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

header h1 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

main {
    padding: 20px;
}

#reset-container {
    max-width: 600px;
    margin: auto;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

#request-form, #reset-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

#request-form h2, #reset-form h2 {
    text-align: center;
    color: #333;
}

#request-form label, #reset-form label {
    font-size: 14px;
    color: #555;
}

#request-form input, #reset-form input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-sizing: border-box;
}

#reset-form input[type="submit"], #request-form input[type="submit"] {
    background-color: rgb(18, 18, 41);
    color: #fff;
    border: none;
    cursor: pointer;
    height: 45px;
    font-size: 16px;
}

#reset-form input[type="submit"]:hover, #request-form input[type="submit"]:hover {
    background-color: #333;
}

</style>
<body>
    <header>
        <div class="user">
            <h1>Esqueci minha Senha</h1>
        </div>
    </header>
    <main>
        <div id="reset-container">
            <!-- Formulário de Solicitação de Redefinição de Senha -->
            <div id="request-form">
                <h2>Solicitar Redefinição de Senha</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" required> <br> <br>
                    <input type="submit" value="Enviar Link de Redefinição" class="btn">
                </form>
            </div>
        </div>
    </main>
    <?php
        include("Banco_dados/config.php");
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = $_POST['email'];
            $query = "SELECT * FROM Usuarios where email = '$email'";
            $result = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
            if($email == $result['email']){
                $_SESSION['id'] = $result['Codigo'];
                $_SESSION['email_code'] = $result['email'];
                include("rec.php");
            }
        }
    ?>
</body>
</html>
