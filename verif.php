<?php
    include("Banco_dados/config.php");
    if(!(isset($_SESSION['code']))){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Dois Fatores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #e0f7fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 350px;
}

h2 {
    margin-bottom: 25px;
    color: #0277bd;
}

p {
    margin-bottom: 20px;
    color: #01579b;
}

input[type="text"] {
    width: 100%;
    padding: 12px;
    margin: 15px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

button {
    background-color: #0277bd;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

button:hover {
    background-color: #01579b;
}

#message {
    margin-top: 20px;
    font-size: 15px;
}
</style>
<body>
    <div class="container">
        <h2>Verificação de Dois Fatores</h2>
        <p>Insira o código que foi enviado para seu e-mail.</p>
        <form id="verificationForm" action="<?php echo $_SERVER['PHP_SELF']?>" method="get">
            <input type="text" id="code" name="code" placeholder="Digite o código" required>
            <button type="submit">Verificar</button>
        </form>
        <a href="login.php">Voltar no login</a>
        <p id="message"></p>
    </div>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if(isset($_GET["code"])){
                if($_GET['code'] == $_SESSION['code']){
                    $mail = $_SESSION['email'];
                    $query = "SELECT * FROM Usuarios where email = '$mail'";
                    $result = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
                    if($result["Nivel"] == "Admin"){
                        $_SESSION['perfil'] = $result['foto'];
                        $_SESSION['user_id'] = $result['Codigo'];
                        $_SESSION['usuario'] = $result['Nome'];
                        $cont = 1;
                        header("Location: index.php");
                        return;
                    }
                    else if($result["Nivel"] == "Nivel1"){
                        $_SESSION['perfil'] = $result['foto'];
                        $_SESSION['user_id'] = $result['Codigo'];
                        $_SESSION['usuario'] = $result['Nome'];
                        $cont = 1;
                        header("Location: nivel.php");
                        return;
                    }
                    else if($result["Nivel"] == "Nivel2"){
                        $_SESSION['perfil'] = $result['foto'];
                        $_SESSION['user_id'] = $result['Codigo'];
                        $_SESSION['usuario'] = $result['Nome'];
                        $cont = 1;
                        header("Location: nivel.php");
                        return;
                    }
                }
                else{
                    echo "<script>alert('Código incorreto')</script>";
                }
                if($cont == 0){
                    header("Location: login.php");
                }
            }
        }
    ?>
</body>
</html>
