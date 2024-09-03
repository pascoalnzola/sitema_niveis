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
    #insert{
        max-width: max-content;
        margin: auto;
        margin-top: 1%;
    }
    #insert h1{
        text-align: center;
    }
    #insert form{
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    #insert form input{
        width: 350px;
        height: 20px;
        padding: 5px;
    }
    #insert form select{
        width: 360px;
        height: 40px;
        padding: 5px;
    }
    #insert form .btn{
        margin: auto;
        height: 30px;
        background-color: rgb(18, 18, 41);
        color: #fff;
    }
    img{
        width: 80px;
        border-radius: 15px;
        height: 40px;
    }
    .user{
        display: flex;
    }
</style>
<body>
    <header>
        <div class="user">
            <img src="<?php echo $_SESSION['perfil']?>" alt="foto_perfil">
            <h1><?php echo $_SESSION["usuario"] ?></h1>
        </div>
        <div>
            <form action="admin.php" method="post">
                <select name="Admin" id="Admin">
                    <option value="inserir">Inserir Usuario</option>
                    <option value="">Admin</option>
                    <option value="editar">Editar Perfil</option>
                    <option value="eliminar">Eliminar Usuario</option>
                    <option value="atualizar">Atualizar Usuario</option>
                </select>
                <input type="submit" value="Aplicar" id="btn">
            </form>
        </div>
    </header>
    <div id="insert">
        <h1>Inserir Usuário</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <label for="nome">Nome*</label>
            <input type="text" name="nome" id="nome">
            <label for="email">Email*</label>
            <input type="email" name="email" id="email">
            <label for="data">Data de Nascimentto*</label>
            <input type="date" name="data" id="data">
            <label for="nivel">Nível*</label>
            <select name="nivel" id="nivel">
                <option value="Admin">Admin</option>
                <option value="Nivel1">Nível 1</option>
                <option value="Nivel2">Nível 2</option>
            </select>
            <label for="foto">Foto de Perfil*</label>
            <input type="file" name="foto" id="foto" accept="image/*">
            <label for="senha">Senha*</label>
            <input type="password" name="senha" id="senha">
            <input type="submit" value="Inserir" class="btn">
        </form>
    </div>
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