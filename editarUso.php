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
        height: 15px;
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
        cursor: pointer;
    }
    #cod{
        max-width: max-content;
        margin: auto;
    }
    #cod input{
        height: 30px;
        width: 200px;
    }
    #cod .pes{
        width: 160px;
        cursor: pointer;
    }
    #cod .pes:hover{
        background-color: rgb(18, 18, 41);
        color: white;
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
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <label for="nome">Nome*</label>
            <input type="text" name="nome" id="nome" value="<?php echo $nome ?> ">
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" value="<?php echo $email ?> ">
            <label for="data">Data de Nascimentto*</label>
            <input type="date" name="data" id="data" value="<?php echo $data ?> ">
            <label for="nivel">Nível*</label>
            <select name="nivel" id="nivel">
                <option value="Admin">Admin</option>
                <option value="Nivel1">Nível 1</option>
                <option value="Nivel2">Nível 2</option>
            </select>
            <label for="foto">Foto de Perfil*</label>
            <input type="file" name="foto" id="foto" accept="image/*"> 
            <label for="senha">Senha*</label>
            <input type="password" name="senha" id="senha" value="<?php echo $senha ?> ">
            <input type="submit" value="Editar" class="btn">
        </form>
    </div>
</body>
</html>