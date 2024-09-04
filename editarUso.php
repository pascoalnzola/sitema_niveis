<?php
    include("Banco_dados/config.php");
    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
    }
    $nome = "";
    $email = "";
    $data = "";
    $nivel = "";
    $senha = "";
    $cod = "";
    $sel = "SELECT * FROM Usuarios Where Codigo = ".$_SESSION['user_id'];
    $res = $conn->query($sel);
    $dado = $res->fetch();
    $nome = $dado['Nome'];
    $email = $dado['email'];
    $data = $dado['data_nascimento'];
    $nivel = $dado['Nivel'];
    $senha = $dado['senha'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["data"]) && isset($_POST["nivel"]) && isset($_POST["senha"])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $data = $_POST['data'];
            $nivel = $_POST['nivel'];
            $senha = $_POST['senha'];
            $atualiar = "UPDATE Usuarios SET Nome = '$nome', email = '$email', data_nascimento = '$data', Nivel = '$nivel', senha = '$senha' WHERE Codigo = ".$_SESSION['user_id'];
            $atual = $conn->query($atualiar);
            echo "<script>aler('Dados atualizado com sucesso!')</script>";
        }
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
    background: #f5f5f5;
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

#insert {
    max-width: 800px;
    margin: auto;
    margin-top: 20px;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#insert h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

#insert form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

#insert form label {
    font-size: 14px;
    color: #555;
}

#insert form input,
#insert form select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-sizing: border-box;
}

#insert form input[type="file"] {
    padding: 0;
}

#insert form .btn {
    background-color: rgb(18, 18, 41);
    color: #fff;
    border: none;
    cursor: pointer;
    height: 45px;
    font-size: 16px;
    margin-top: 10px;
}

#insert form .btn:hover {
    background-color: #333;
}

</style>
<body>
    <header>
        <div class="user">
            <img src="<?php echo $_SESSION['perfil']; ?>" alt="foto_perfil">
            <h1><?php echo $_SESSION["usuario"]; ?></h1>
        </div>
        <div>
            <form action="usuario.php" method="post">
                <select name="Admin" id="Admin">
                    <option value="editar">Editar Perfil</option>
                    <option value="">Usuario</option>
                </select>
                <input type="submit" value="Aplicar" id="btn">
            </form>
        </div>
    </header>
    <div id="insert">
        <h1>Editar Perfil</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <label for="nome">Nome*</label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <label for="data">Data de Nascimento*</label>
            <input type="date" name="data" id="data" value="<?php echo htmlspecialchars($data); ?>" required>
            <label for="nivel">Nível*</label>
            <select name="nivel" id="nivel" required>
                <option value="Admin" <?php if ($nivel == 'Admin') echo 'selected'; ?>>Admin</option>
                <option value="Nivel1" <?php if ($nivel == 'Nivel1') echo 'selected'; ?>>Nível 1</option>
                <option value="Nivel2" <?php if ($nivel == 'Nivel2') echo 'selected'; ?>>Nível 2</option>
            </select>
            <label for="foto">Foto de Perfil*</label>
            <input type="file" name="foto" id="foto" accept="image/*">
            <label for="senha">Senha*</label>
            <input type="password" name="senha" id="senha" value="<?php echo htmlspecialchars($senha); ?>" required>
            <input type="submit" value="Editar" class="btn">
        </form>
    </div>
</body>
</html>
