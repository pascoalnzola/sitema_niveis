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
    <link rel="stylesheet" href="estilo/estilo.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

header {
    background-color: #ffffff;
    border-bottom: 2px solid #ddd;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}

.user h1 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

.action-form {
    display: flex;
    align-items: center;
}

.action-form form {
    display: flex;
    align-items: center;
}

select, input[type="submit"] {
    height: 40px;
    padding: 5px;
    margin: 0 5px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 16px;
}

input[type="submit"] {
    background-color: rgb(18, 18, 41);
    color: #fff;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #333;
}

.logout {
    text-align: right;
    padding: 10px 20px;
}

.logout a {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: blue;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
}

.logout a:hover {
    background-color: darkblue;
}

main {
    padding: 20px;
    text-align: center;
}

main h1 {
    font-size: 28px;
    color: #333;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

</style>
<body>
    <header>
        <div class="user">
            <img src="<?php echo $_SESSION['perfil']; ?>" alt="foto_perfil">
            <h1><?php echo $_SESSION["usuario"]; ?></h1>
        </div>
        <div class="action-form">
            <form action="usuario.php" method="post">
                <select name="Admin" id="Admin">
                    <option value="">Usuário</option>
                    <option value="editar">Editar Perfil</option>
                </select>
                <input type="submit" value="Aplicar" class="btn">
            </form>
        </div>
    </header>
    <div class="logout">
        <a href="sair.php">Sair</a>
    </div>
    <main>
        <h1>Você é um Usuário Normal</h1>
    </main>
</body>
</html>
