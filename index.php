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
    #tit{
        max-width: max-content;
        margin: auto;
        margin-top: 5%;

    }
    table{
        border: 1px solid black;
        border-collapse: collapse;
        margin: auto;
        width: 1000px;
        margin-top: 1%;
        text-align: center;
    }
    .Sair{
        max-width: max-content;
        padding: 5px;
        border-radius: 5px;
        margin-top: 5px;
        margin-left: 5px;
        background-color: blue;
    }
    .Sair a{
        color: #fff;
    }
    #enp{
        max-width: max-content;
        margin-left: 180px;
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
            <h1><?php echo $_SESSION["usuario"]; ?></h1>
        </div>
        <div>
            <form action="admin.php" method="post">
                <select name="Admin" id="Admin">
                    <option value="">Admin</option>
                    <option value="editar">Editar Perfil</option>
                    <option value="inserir">Inserir Usuario</option>
                    <option value="eliminar">Eliminar Usuario</option>
                    <option value="atualizar">Atualizar Usuario</option>
                </select>
                <input type="submit" value="Aplicar" id="btn">
            </form>
        </div>
    </header>
    <div class="Sair"><a href="sair.php"> Sair</a></div>
    <div id="tit">
        <h1>Usuários Cadastrados</h1>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="get" id="enp">
        <select name="niveis" id="niveis">
            <option value="Todos">Todos</option>
            <option value="Admin">Admin</option>
            <option value="Nivel1">Nivel1</option>
            <option value="Nivel2">Nivel2</option>
        </select>
        <input type="submit" value="Aplicar">
    </form>
    <table class="table" border="1">
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Data de nascimento</th>
                <th scope="col">Nível</th>
                <th scope="col">Senha</th>
                <th scope="col">Foto de Perfil</th>
            </tr>
        </thead>
        <?php
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                if(isset($_GET['niveis'])){
                    $nivel = $_GET['niveis'];
                    if($nivel == "Todos"){
                        $select = "SELECT * FROM Usuarios";
                        $res = $conn->query($select);
                        $dados = $res->fetchAll();
                        foreach ($dados as $dado) {
                            echo "<tr>";
                            echo "<td>".$dado['Codigo']."</td>";
                            echo "<td>".$dado['Nome']."</td>";
                            echo "<td>".$dado['email']."</td>";
                            echo "<td>".$dado['data_nascimento']."</td>";
                            echo "<td>".$dado['Nivel']."</td>";
                            echo "<td>".$dado['senha']."</td>";
                            echo "<td>".$dado['foto']."</td>";
                            echo "</tr>";
                        }
                    }
                    else if($nivel == "Admin"){
                        $select = "SELECT * FROM Usuarios Where Nivel='$nivel'";
                        $res = $conn->query($select);
                        $dados = $res->fetchAll();
                        foreach ($dados as $dado) {
                            echo "<tr>";
                            echo "<td>".$dado['Codigo']."</td>";
                            echo "<td>".$dado['Nome']."</td>";
                            echo "<td>".$dado['email']."</td>";
                            echo "<td>".$dado['data_nascimento']."</td>";
                            echo "<td>".$dado['Nivel']."</td>";
                            echo "<td>".$dado['senha']."</td>";
                            echo "<td>".$dado['foto']."</td>";
                            echo "</tr>";
                        }
                    }
                    else if($nivel == "Nivel1"){
                        $select = "SELECT * FROM Usuarios Where Nivel='$nivel'";
                        $res = $conn->query($select);
                        $dados = $res->fetchAll();
                        foreach ($dados as $dado) {
                            echo "<tr>";
                            echo "<td>".$dado['Codigo']."</td>";
                            echo "<td>".$dado['Nome']."</td>";
                            echo "<td>".$dado['email']."</td>";
                            echo "<td>".$dado['data_nascimento']."</td>";
                            echo "<td>".$dado['Nivel']."</td>";
                            echo "<td>".$dado['senha']."</td>";
                            echo "<td>".$dado['foto']."</td>";
                            echo "</tr>";
                        }
                    }
                    else if($nivel == "Nivel2"){
                        $select = "SELECT * FROM Usuarios Where Nivel='$nivel'";
                        $res = $conn->query($select);
                        $dados = $res->fetchAll();
                        foreach ($dados as $dado) {
                            echo "<tr>";
                            echo "<td>".$dado['Codigo']."</td>";
                            echo "<td>".$dado['Nome']."</td>";
                            echo "<td>".$dado['email']."</td>";
                            echo "<td>".$dado['data_nascimento']."</td>";
                            echo "<td>".$dado['Nivel']."</td>";
                            echo "<td>".$dado['senha']."</td>";
                            echo "<td>".$dado['foto']."</td>";
                            echo "</tr>";
                        }
                    }
                }
            }
            
        ?>
    </table>
</body>
</html>