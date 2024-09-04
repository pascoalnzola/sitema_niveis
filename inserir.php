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
        gap: 10px;
    }

    .admin-form form {
        display: flex;
        align-items: center;
    }

    select, input[type="submit"] {
        width: 150px;
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

    #insert {
        max-width: 600px;
        margin: auto;
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
        padding: 3px;
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
                    <option value="inserir">Inserir Usuário</option>
                    <option value="admin">Admin</option>
                    <option value="editar">Editar Perfil</option>
                    <option value="eliminar">Eliminar Usuário</option>
                    <option value="atualizar">Atualizar Usuário</option>
                </select>
                <input type="submit" value="Aplicar" class="btn">
            </form>
        </div>
    </header>
    <main>
        <div id="insert">
            <h1>Inserir Usuário</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <label for="nome">Nome*</label>
                <input type="text" name="nome" id="nome" required>
                
                <label for="email">Email*</label>
                <input type="email" name="email" id="email" required>
                
                <label for="email_rec">Email de Recuperação*</label>
                <input type="email" name="email_rec" id="email_rec" required>
                
                <label for="data">Data de Nascimento*</label>
                <input type="date" name="data" id="data" required>
                
                <label for="nivel">Nível*</label>
                <select name="nivel" id="nivel" required>
                    <option value="Admin">Admin</option>
                    <option value="Nivel1">Nível 1</option>
                    <option value="Nivel2">Nível 2</option>
                </select>
                
                <label for="foto">Foto de Perfil*</label>
                <input type="file" name="foto" id="foto" accept="image/*" required>
                
                <label for="senha">Senha*</label>
                <input type="password" name="senha" id="senha" required>
                
                <input type="submit" value="Inserir" class="btn">
            </form>
        </div>
    </main>
    <?php
        if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['data']) && isset($_POST['nivel']) && isset($_POST['senha']) && isset($_POST['foto'])
          && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['data']) && !empty($_POST['nivel']) && !empty($_POST['senha'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $data = $_POST['data'];
            $nivel = $_POST['nivel'];
            $senha = $_POST['senha'];
            $foto = "./imagens/".$_POST['foto'];
            $cosult = "SELECT * FROM Usuarios";
            $verif = $conn->query($cosult)->fetchAll();
            foreach($verif as $ve){
                if($ve['email'] == $email){
                    echo "<script>alert('Email já Cadastrado!')</script>";
                    return;
                }
            }
            $query = "INSERT INTO Usuarios Values(Default, '$nome', '$email','$data','$nivel','$senha','$foto')";
            $inserir = $conn->query($query);
            echo "<script>alert('Dados Cadastrado com sucesso!')</script>";
        }
    ?>
</body>
</html>
