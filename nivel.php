<?php
    include("Banco_dados/config.php");
    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="esttilo/estilo.css">
</head>
<style>
     .Sair{
        max-width: max-content;
        padding: 5px;
        border-radius: 5px;
        margin-top: 5px;
        margin-left: 5px;
        background-color: blue;
    }
    .Sair a{
        color: #fff;
    }
    h1{
        text-align: center;
    }
</style>
<body>
    <header>
        <div>
            <h1><?php echo $_SESSION["usuario"] ?></h1>
        </div>
        <div>
            <form action="usuario.php" method="post">
                <select name="Admin" id="Admin">
                    <option value="">Usuario</option>
                    <option value="editar">Editar Perfil</option>
                </select>
                <input type="submit" value="Aplicar" id="btn">
            </form>
        </div>
    </header>
    <div class="Sair"><a href="sair.php"> Sair</a></div>
    <h1>Tu és um Usuarios Normal</h1>
</body>
</html>