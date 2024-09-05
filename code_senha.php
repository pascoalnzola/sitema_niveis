<?php
    include("Banco_dados/config.php");
    if(!isset($_SESSION['code_senha'])){
        header("Location: esqueci.php");
    }
?>
<!DOCTYPE html>
<html lang="ptt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veriica o código</title>
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
            <h1>Verifique o código enviado</h1>
        </div>
    </header>
    <main>
        <div id="reset-container">
            <!-- Formulário de Redefinição de Senha -->
            <div id="reset-form">
                <h2>Redefinir Senha</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <label for="new-password">Código*</label>
                    <input type="number" name="code" id="code" required>
                    <br><br><br>
                    <input type="submit" value="Verificar o código" class="btn">
                </form>
                <a href="esqueci.php">Voltar a solicitar_redefinição</a>
            </div>
        </div>
    </main>
    <?php
        if(isset($_POST["code"]) && !empty($_POST['code'])){
            if($_POST['code'] == $_SESSION['code_senha']){
                header("Location: redifinir_senha.php");
            }
            else{
                echo "<script>alert('Código incorreto')</script>";
            }
        }
    ?>
</body>
</html>