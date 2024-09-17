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
    <title>Processar</title>
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

/* Barra lateral */
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

/* Ajuste da tabela */
.user-table {
    border-collapse: collapse;
    width: 100%;
    max-width: 1000px;
    margin: 20px auto;
    /* Distância entre a tabela e as bordas */
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
                    <h1>Dados carregados</h1>
                </div>
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>BI</th>
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
                if(isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['tmp_name'])){
                    $usuarios = [];
                    $i = $j = 0;
                    $arquivo = new DOMDocument();
                    $arquivo->load($_FILES['arquivo']['tmp_name']);
                    $linhas = $arquivo->getElementsByTagName("Row");
                    //var_dump($linhas);
                    $primeira = true;
                    foreach($linhas as $linha){
                        if($primeira == false){
                            $nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                            $bi = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                            $email = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                            $email_rec = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                            $data_nascimento = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                            $nivel = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
                            $senha = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
                            $foto = $linha->getElementsByTagName("Data")->item(7)->nodeValue;
                            // Armazenar os dados em um array associativo com índices
                            $usuarios[] = [
                                'nome' => $nome,
                                'bi' => $bi,
                                'email' => $email,
                                'email_rec' => $email_rec,
                                'data_nascimento' => $data_nascimento,
                                'nivel' => $nivel,
                                'senha' => $senha,
                                'foto' => $foto
                            ];
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($nome) . "</td>";
                            echo "<td>". htmlspecialchars($bi) ."</td>";
                            echo "<td>" . htmlspecialchars($email) . "</td>";
                            echo "<td>" . htmlspecialchars($email_rec) . "</td>";
                            echo "<td>" . htmlspecialchars($data_nascimento) . "</td>";
                            echo "<td>" . htmlspecialchars($nivel) . "</td>";
                            echo "<td>" . htmlspecialchars($senha) . "</td>";
                            echo "<td><img src='" . htmlspecialchars($foto) . "' alt='foto_perfil'></td>";
                            echo "</tr>";
                            
                        }
                        $primeira = false;
                    }
                    // Armazenar os dados na sessão
                        $_SESSION['usuarios'] = $usuarios;
                }
            ?>
            </tbody>
        </table>
        <form class="logout-button" action="<?php echo $_SERVER['PHP_SELF']?>" method="get">
            <input type="submit" value="Importar os dados">
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                $query = "SELECT * FROM Usuarios";
                $res = $conn->query($query);
                if($res->rowCount() > 0){
                    $valor = $res->fetchAll();
                    foreach($valor as $valor1){
                        foreach ($_SESSION['usuarios'] as $index => $usuario) {
                            foreach ($usuario as $key => $value) {
                                if($key === 'email'){
                                    if($value == $valor1['email']){
                                        echo "<script>alert('Email já Cadastrado $value')</script>";
                                    }
                                }
                            }
                        }
                    } 
                }
            }
        ?>
    </main>
</div>
</body>
</html>