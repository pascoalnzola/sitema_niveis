<?php
    include("Banco_dados/config.php");
    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
    }
    $nome = "";
    $email = "";
    $email_rec = "";
    $data = "";
    $nivel = "";
    $senha = "";
    $cod = "";
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(isset($_GET['codigo']) && !empty($_GET['codigo'])){
            $cod = $_GET['codigo'];
            $select = "SELECT * FROM Usuarios Where Codigo = $cod";
            $res = $conn->query($select);
            if($res->rowCount() > 0){
                $res = $conn->query($select)->fetch();
                $cod = $res['Codigo'];
                $nome = $res['Nome'];
                $email = $res['email'];
                $email_rec = $res['email_rec'];
                $data = $res['data_nascimento'];
                $nivel = $res['Nivel'];
                $senha = $res['senha'];
            }
            else{
                echo "<script>alert('Os dados pesquisados não existem!')</script>";
            }
        }
    }
    else
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["data"]) && isset($_POST["nivel"]) && isset($_POST["senha"]) && isset($_POST["rec_email"]))
            if(empty($_POST['foto'])){
                $cod = $_POST['id'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $data = $_POST['data'];
                $nivel = $_POST['nivel'];
                $senha = $_POST['senha'];
                $email_rec = $_POST["rec_email"];
                $foto = "imagens/".$_POST['foto'];
                $atualiar = "UPDATE Usuarios SET Nome = '$nome', email = '$email', email_rec = '$email_rec', data_nascimento = '$data', Nivel = '$nivel', senha = '$senha' WHERE Codigo =  $cod";
                $atual = $conn->query($atualiar);
                if($cod == $_SESSION["user_id"]){
                    $_SESSION["usuario"] = $nome;
                }
                echo "<script>alert('Dados atualizado com sucesso!')</script>";
            }
            else{
                $cod = $_POST['id'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $data = $_POST['data'];
                $nivel = $_POST['nivel'];
                $senha = $_POST['senha'];
                $email_rec = $_POST["rec_email"];
                $foto = "imagens/".$_POST['foto'];
                $atualiar = "UPDATE Usuarios SET Nome = '$nome', email = '$email', email_rec = '$email_rec', data_nascimento = '$data', Nivel = '$nivel', foto = '$foto', senha = '$senha' WHERE Codigo =  $cod";
                $atual = $conn->query($atualiar);
                if($cod == $_SESSION["user_id"]){
                    $_SESSION["usuario"] = $nome;
                }
                echo "<script>alert('Dados atualizado com sucesso!')</script>";
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

    #titulo {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    #search-form {
        max-width: 400px;
        margin: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    #search-form label {
        font-size: 14px;
        color: #555;
    }

    #search-form input[type="number"],
    #search-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .search-btn {
        background-color: rgb(18, 18, 41);
        color: #fff;
        cursor: pointer;
    }

    .search-btn:hover {
        background-color: #333;
    }

    #insert {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

    #insert form input[type="text"][readonly] {
        background-color: #f9f9f9;
        cursor: not-allowed;
    }

    .btn {
        background-color: rgb(18, 18, 41);
        color: #fff;
        border: none;
        cursor: pointer;
        height: 45px;
        font-size: 16px;
    }

    .btn:hover {
        background-color: #333;
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
                <li><a href="import.php">Importar Usuarios</a></li>

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
        <h1 id="titulo">Atualizar Usuário</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="search-form">
            <label for="codigo">Código*</label>
            <input type="number" name="codigo" id="codigo" required>
            <input type="submit" value="Pesquisar" class="btn search-btn">
        </form>
        <div id="insert">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="id">ID*</label>
                <input type="text" name="id" id="id" value="<?php echo $cod; ?>" readonly>
                <label for="nome">Nome*</label>
                <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>
                <label for="email">Email*</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                <label for="rec_email">Email de Recuperação*</label>
                <input type="email" name="rec_email" id="rec_email" value="<?php echo $email_rec; ?>">
                <label for="data">Data de Nascimento*</label>
                <input type="date" name="data" id="data" value="<?php echo $data; ?>" required>
                <label for="nivel">Nível*</label>
                <select name="nivel" id="nivel" required>
                    <option value="<?php echo $nivel; ?>"><?php echo $nivel; ?></option>
                    <option value="Admin">Admin</option>
                    <option value="Nivel1">Nível 1</option>
                    <option value="Nivel2">Nível 2</option>
                </select>
                <label for="foto">Foto de Perfil*</label>
                <input type="file" name="foto" id="foto" accept="image/*" value="<?php echo $foto; ?>">
                <label for="senha">Senha*</label>
                <input type="password" name="senha" id="senha" value="<?php echo $senha; ?>" required>
                <input type="submit" value="Atualizar" class="btn">
            </form>
        </div>
    </main>
</body>
</html>
