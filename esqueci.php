<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <form action="solicitar_redefinicao.php" method="post">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" required> <br> <br>
                    <input type="submit" value="Enviar Link de Redefinição" class="btn">
                </form>
            </div>

            <!-- Formulário de Redefinição de Senha -->
            <div id="reset-form" style="display: none;">
                <h2>Redefinir Senha</h2>
                <form action="redifinir_senha.php" method="post">
                    <label for="new-password">Nova Senha*</label>
                    <input type="password" name="new-password" id="new-password" required>
                    <label for="confirm-password">Confirmar Nova Senha*</label>
                    <input type="password" name="confirm-password" id="confirm-password" required> <br><br><br>
                    <input type="submit" value="Redefinir Senha" class="btn">
                </form>
            </div>
        </div>
    </main>
    <script>
        // Simulação para mostrar o formulário de redefinição após o envio do link
        document.querySelector('#request-form form').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('request-form').style.display = 'none';
            document.getElementById('reset-form').style.display = 'block';
        });
    </script>
</body>
</html>
