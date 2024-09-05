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

.user-table th, .user-table td {
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

</style>
<body>
    <header>
        <div class="user">
            <img src="<?php echo $_SESSION['perfil']; ?>" alt="foto_perfil">
            <h1><?php echo $_SESSION["usuario"]; ?></h1>
        </div>
        <div class="admin-form">
            <form action="admin.php" method="post">
                <select name="Admin" id="Admin">
                    <option value="">Admin</option>
                    <option value="editar">Editar Perfil</option>
                    <option value="inserir">Inserir Usuário</option>
                    <option value="eliminar">Eliminar Usuário</option>
                    <option value="atualizar">Atualizar Usuário</option>
                </select>
                <input type="submit" value="Aplicar" class="btn">
            </form>
        </div>
    </header>
    <div class="logout-button">
        <a href="sair.php">Sair</a>
    </div>
    <main>
        <div class="title-container">
            <h1>Usuários Cadastrados</h1>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="filter-form">
            <select name="niveis" id="niveis">
                <option value="Todos">Todos</option>
                <option value="Admin">Admin</option>
                <option value="Nivel1">Nível 1</option>
                <option value="Nivel2">Nível 2</option>
            </select>
            <input type="submit" value="Aplicar" class="btn">
        </form>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>E-mail de Recuperação</th>
                    <th>Data de Nascimento</th>
                    <th>Nível</th>
                    <th>Senha</th>
                    <th>Foto de Perfil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    if (isset($_GET['niveis'])) {
                        $nivel = $_GET['niveis'];
                        $select = $nivel == "Todos" ? "SELECT * FROM Usuarios" : "SELECT * FROM Usuarios WHERE Nivel='$nivel'";
                        $res = $conn->query($select);
                        $dados = $res->fetchAll();
                        foreach ($dados as $dado) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($dado['Codigo']) . "</td>";
                            echo "<td>" . htmlspecialchars($dado['Nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($dado['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($dado['email_rec']) . "</td>";
                            echo "<td>" . htmlspecialchars($dado['data_nascimento']) . "</td>";
                            echo "<td>" . htmlspecialchars($dado['Nivel']) . "</td>";
                            echo "<td>" . htmlspecialchars($dado['senha']) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($dado['foto']) . "' alt='foto_perfil'></td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
