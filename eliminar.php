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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["data"]) && isset($_POST["nivel"]) && isset($_POST["senha"]) && isset($_POST["rec_email"])){
            $cod = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $email_rec = $_POST["rec_email"];
            $data = $_POST['data'];
            $nivel = $_POST['nivel'];
            $senha = $_POST['senha'];
            $deletar = "DELETE FROM Usuarios WHERE Codigo = $cod";
            $atual = $conn->query($deletar);
            echo "<script>alert('Dados eleiminados com sucesso!')</script>";
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

.delete-section {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#titulo {
    text-align: center;
    margin-bottom: 20px;
    font-size: 28px;
    color: #333;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

#search-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

#search-form label {
    font-size: 16px;
    color: #555;
    margin-bottom: 5px;
}

#search-form input[type="number"],
#search-form input[type="submit"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    box-sizing: border-box;
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
    margin-top: 20px;
}

#insert form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

#insert form label {
    font-size: 16px;
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

#insert form input[readonly] {
    background-color: #f9f9f9;
    cursor: not-allowed;
}

.delete-btn {
    background-color: rgb(255, 69, 58); /* Red color for delete action */
    color: #fff;
    border: none;
    cursor: pointer;
    height: 45px;
    font-size: 16px;
}

.delete-btn:hover {
    background-color: #c9302c;
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
                    <option value="eliminar">Eliminar Usuário</option>
                    <option value="">Admin</option>
                    <option value="editar">Editar Perfil</option>
                    <option value="inserir">Inserir Usuário</option>
                    <option value="atualizar">Atualizar Usuário</option>
                </select>
                <input type="submit" value="Aplicar" class="btn">
            </form>
        </div>
    </header>
    <main>
        <section class="delete-section">
            <h1 id="titulo">Eliminar Usuário</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="search-form">
                <label for="codigo">Código*</label>
                <input type="number" name="codigo" id="codigo" placeholder="Digite o código" required>
                <input type="submit" value="Pesquisar" class="btn search-btn">
            </form>
            <div id="insert">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="id">ID*</label>
                    <input type="text" name="id" id="id" value="<?php echo $cod; ?>" readonly>
                    <label for="nome">Nome*</label>
                    <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" readonly>
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" readonly>
                    <label for="rec_email">Email de Recuperação*</label>
                    <input type="email" name="rec_email" id="rec_email" value="<?php echo $email_rec; ?>">
                    <label for="data">Data de Nascimento*</label>
                    <input type="date" name="data" id="data" value="<?php echo $data; ?>" readonly>
                    <label for="nivel">Nível*</label>
                    <select name="nivel" id="nivel" disabled>
                        <option value="<?php echo $nivel; ?>"><?php echo $nivel; ?></option>
                        <option value="Admin">Admin</option>
                        <option value="Nivel1">Nível 1</option>
                        <option value="Nivel2">Nível 2</option>
                    </select>
                    <label for="senha">Senha*</label>
                    <input type="password" name="senha" id="senha" value="<?php echo $senha; ?>" required>
                    <input type="submit" value="Eliminar" class="btn delete-btn">
                </form>
            </div>
        </section>
    </main>
</body>
</html>
