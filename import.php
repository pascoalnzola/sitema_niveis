<?php
   include("Banco_dados/config.php");
    if(!isset($_SESSION["user_id"])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-bt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/OIP (1).jfif" type="image/x-icon">
    <title>Importar Dados</title>
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

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f4f4f4;
    /* Cor de fundo */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    /* Sombra leve */
}

header .user {
    display: flex;
    align-items: center;
}

header .user img {
    width: 50px;
    /* Tamanho da imagem de perfil */
    height: 50px;
    border-radius: 50%;
    /* Deixa a imagem circular */
    margin-right: 10px;
    object-fit: cover;
    /* Garante que a imagem se ajuste ao contêiner */
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
    gap: 20px;
    /* Espaçamento entre os itens */
}

header .items nav ul li {
    display: inline;
}

header .items nav ul li a {
    text-decoration: none;
    color: #007bff;
    /* Cor dos links */
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

header .items nav ul li a:hover {
    background-color: #007bff;
    color: #fff;
}

nav ul {
    display: flex;
    flex-direction: row;
    list-style: none;
}

nav ul li {
    justify-content: space-between;
}

select,
input[type="submit"] {
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

.logout-button {
    text-align: right;
    padding: 10px 20px;
}

.logout-button a {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: blue;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
}

.logout-button a:hover {
    background-color: darkblue;
}

main {
    padding: 20px;
}

.title-container {
    text-align: center;
    margin-bottom: 20px;
}

.title-container h1 {
    font-size: 28px;
    color: #333;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

#filter-form {
    text-align: center;
    margin-bottom: 20px;
}

.user-table {
    border-collapse: collapse;
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.user-table th,
.user-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

.user-table th {
    background-color: #f4f4f4;
    color: #333;
}

.user-table img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

#pesquisar {
    width: 300px;
    height: 35px;
}

.sidebar {
    width: 200px;
    background-color: #f4f4f4;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    overflow-y: auto;
    z-index: 1;
    /* Garante que a barra lateral fique sobreposta ao conteúdo */
}

/* Ajuste do header */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f4f4f4;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-left: -25px;
    /* Espaço para a barra lateral */
    z-index: 2;
    position: fixed;
    width: calc(100% - 250px);
    /* Ajusta a largura do header */
    top: 0;
}

/* Estilo para ajustar o conteúdo principal e a tabela */
.content {
    margin-left: 250px;
    /* Espaço à esquerda para a barra lateral */
    padding: 20px;
    width: calc(100% - 250px);
    /* Ajusta a largura para ocupar o restante da página */
    margin-top: 70px;
    /* Espaço para não sobrepor o header */
}

aside nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: block;
    gap: 20px;
    /* Espaçamento entre os itens */
}

aside .items nav ul li {
    display: block;
}

aside nav ul li a {
    text-decoration: none;
    color: #007bff;
    /* Cor dos links */
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

aside nav ul li a:hover {
    background-color: #007bff;
    color: #fff;
}

nav ul {
    display: flex;
    flex-direction: row;
    list-style: none;
}

nav ul li {
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
                <div class="title-container">
                    <h1>Cadastrar por importação</h1>
                </div>
                <form action="processar.php" method="post" enctype="multipart/form-data">
                    <label for="arquivo">Importar Arquivo</label>
                    <input type="file" name="arquivo" id="arquivo">
                    <input type="submit" value="Carregar arquivo">
                </form>
            </main>
</body>

</html>