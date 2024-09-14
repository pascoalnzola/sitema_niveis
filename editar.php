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
    $email_rec = "";
    $foto = "";
    $bi = "";
    $sel = "SELECT * FROM Usuarios Where Codigo = ".$_SESSION['user_id'];
    $res = $conn->query($sel);
    $dado = $res->fetch();
    $nome = $dado['Nome'];
    $bi = $dado['N_BI'];
    $email = $dado['email'];
    $data = $dado['data_nascimento'];
    $nivel = $dado['Nivel'];
    $senha = $dado['senha'];
    $foto = $dado['foto'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(empty($_POST['foto'])){
            $nome = $_POST['nome'];
            $bi = $_POST['bi'];
            $email = $_POST['email'];
            $data = $_POST['data'];
            $nivel = $_POST['nivel'];
            $senha = $_POST['senha'];
            $email_rec = $_POST["rec_email"];
            //$foto = "imagens/".$_POST['foto'];
            $atualiar = "UPDATE Usuarios SET Nome = '$nome', N_BI = '$bi', email = '$email', data_nascimento = '$data', Nivel = '$nivel', senha = '$senha' WHERE Codigo = ".$_SESSION['user_id'];
            $atual = $conn->query($atualiar);
            $_SESSION['usuario'] = $nome;
            echo "<script>aler('Dados atualizado com sucesso!')</script>";
        }
        else{
            $nome = $_POST['nome'];
            $bi = $_POST['bi'];
            $email = $_POST['email'];
            $data = $_POST['data'];
            $nivel = $_POST['nivel'];
            $senha = $_POST['senha'];
            $email_rec = $_POST["rec_email"];
            $foto = "imagens/".$_POST['foto'];
            $atualiar = "UPDATE Usuarios SET Nome = '$nome', email = '$email', data_nascimento = '$data', Nivel = '$nivel', foto = '$foto', senha = '$senha' WHERE Codigo = ".$_SESSION['user_id'];
            $atual = $conn->query($atualiar);
            $_SESSION['usuario'] = $nome;
            echo "<script>aler('Dados atualizado com sucesso!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
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
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f4f4f4; /* Cor de fundo */
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Sombra leve */
}

header .user {
    display: flex;
    align-items: center;
}

header .user img {
    width: 50px; /* Tamanho da imagem de perfil */
    height: 50px;
    border-radius: 50%; /* Deixa a imagem circular */
    margin-right: 10px;
    object-fit: cover; /* Garante que a imagem se ajuste ao contêiner */
}

header .user h1 {
    font-size: 18px;
    color: #333;
}

header .items nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px; /* Espaçamento entre os itens */
}

header .items nav ul li {
    display: inline;
}

header .items nav ul li a {
    text-decoration: none;
    color: #007bff; /* Cor dos links */
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

header .items nav ul li a:hover {
    background-color: #007bff;
    color: #fff;
}

.admin-form {
    display: flex;
    align-items: center;
}

.admin-form form {
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

main {
    padding: 20px;
}

.edit-profile-section {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.edit-profile-section h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 28px;
    color: #333;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

.edit-profile-section form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.edit-profile-section label {
    font-size: 16px;
    color: #555;
}

.edit-profile-section input[type="text"],
.edit-profile-section input[type="email"],
.edit-profile-section input[type="date"],
.edit-profile-section input[type="password"],
.edit-profile-section select,
.edit-profile-section input[type="file"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-sizing: border-box;
}

.edit-profile-section input[type="file"] {
    padding: 5px;
}

.edit-profile-section .btn {
    background-color: rgb(18, 18, 41);
    color: #fff;
    border: none;
    cursor: pointer;
    height: 45px;
    font-size: 16px;
}

.edit-profile-section .btn.edit-btn {
    background-color: #007bff; /* Blue color for edit action */
}

.edit-profile-section .btn.edit-btn:hover {
    background-color: #0056b3;
}
.sidebar {
    width: 200px;
    background-color: #f4f4f4;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto;
    z-index: 1; /* Garante que a barra lateral fique sobreposta ao conteúdo */
}

/* Ajuste do header */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f4f4f4;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-left: -25px; /* Espaço para a barra lateral */
    z-index: 2;
    position: fixed;
    width: calc(100% - 250px); /* Ajusta a largura do header */
    top: 0;
}
/* Estilo para ajustar o conteúdo principal e a tabela */
.content {
    margin-left: 250px; /* Espaço à esquerda para a barra lateral */
    padding: 20px;
    width: calc(100% - 250px); /* Ajusta a largura para ocupar o restante da página */
    margin-top: 70px; /* Espaço para não sobrepor o header */
}
aside nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: block;
    gap: 20px; /* Espaçamento entre os itens */
}

aside .items nav ul li {
    display: block;
}

aside nav ul li a {
    text-decoration: none;
    color: #007bff; /* Cor dos links */
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

aside  nav ul li a:hover {
    background-color: #007bff;
    color: #fff;
}
nav ul{
    display: flex;
    flex-direction: row;
    list-style: none;
}
nav ul li{
    justify-content: space-between;
}
</style>
<body>
<div class="container">
    <aside class="sidebar">
        <h2>Ajustes</h2>
       <nav>
            <ul>
                <li><a href="index.php">Admin</a></li> <br>
                <li><a href="editar.php">Editar Perfil</a></li> <br>
                <li><a href="inserir.php">Inserir Usuário</a></li> <br>
                <li><a href="eliminar.php">Eliminar Usuário</a></li> <br>
                <li><a href="atualizar.php">Atualizar Usuário</a></li> <br>
                <li><a href="import.php">Importar Usuarios</a></li> <br>
                <li><a href="export.php">Exportar Usuarios</a></li>
            </ul>
       </nav>
    </aside>

    <div class="content">
        <header>
            <div class="user">
                <img src="<?php echo $_SESSION['perfil']; ?>" alt="foto_perfil">
                <h1><?php echo $_SESSION["usuario"]; ?></h1>
            </div>
        </header>
    <main>
        <section class="edit-profile-section">
            <h1>Editar Perfil</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <label for="nome">Nome*</label>
                <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>
                
                <label for="nome">BI*</label>
                <input type="text" name="bi" id="bi" value="<?php echo $bi; ?>" required>

                <label for="email">Email*</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>

                <label for="rec_email">Email de Recuperação*</label>
                <input type="email" name="rec_email" id="rec_email" value="<?php echo $email_rec; ?>">
                
                <label for="data">Data de Nascimento*</label>
                <input type="date" name="data" id="data" value="<?php echo $data; ?>" required>
                
                <label for="nivel">Nível*</label>
                <select name="nivel" id="nivel" required>
                    <option value="Admin" <?php echo $nivel == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="Nivel1" <?php echo $nivel == 'Nivel1' ? 'selected' : ''; ?>>Nível 1</option>
                    <option value="Nivel2" <?php echo $nivel == 'Nivel2' ? 'selected' : ''; ?>>Nível 2</option>
                </select>
                
                <label for="foto">Foto de Perfil*</label>
                <input type="file" name="foto" id="foto" accept="image/*" value="<?php echo $foto; ?>">
                
                <label for="senha">Senha*</label>
                <input type="password" name="senha" id="senha" value="<?php echo $senha; ?>" required>
                
                <input type="submit" value="Editar" class="btn edit-btn">
            </form>
        </section>
    </main>
</body>
</html>
