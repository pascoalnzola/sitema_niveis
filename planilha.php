<?php
    include("Banco_dados/config.php");
    // Verifica se o usuário está logado
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagens/OIP (1).jfif" type="image/x-icon">
    <title>Processar</title>
</head>
</style>

<body>
    <?php
        $arquivo = "Todos_Usuarios.xls";
        $html = '';
        $html .= '<table border="1">';
        $html .= ' <thead>';
        $html .= ' <tr>';
        $html .= '<th>Código</th>
                <th>Nome</th>
                <th>E-mail</th>';
        $html .= '<th>E-mail de Recuperação</th>
                <th>Data de Nascimento</th>
                <th>Nível</th>
                <th>Senha</th>
                <th>Foto de Perfil</th>';
        $html .= '</tr>';
        $html .= ' </thead>';
        $html .= '<tbody>';

        if(isset($_SESSION['nivel']) && $_SESSION['nivel'] != 'Todos') {
            $arquivo = "Niveis_Usuarios.xls";
            $nivel = $_SESSION['nivel'];
            $select = "SELECT * FROM Usuarios WHERE Nivel='$nivel'";
            $res = $conn->query($select);
            if($res->rowCount() > 0) {
                $dados = $res->fetchAll();
                foreach ($dados as $dado) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($dado['Codigo']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['Nome']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['email']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['email_rec']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['data_nascimento']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['Nivel']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['senha']) . "</td>";
                    $html .= "<td><img src='" . htmlspecialchars($dado['foto']) . "' alt='foto_perfil'></td>";
                    $html .= "</tr>";
    
                    header("Expires: Mon, 26 jul 1997 05:00:00 GMT");
                    header("Last-Modified: ".gmdate("D,d M YH:i:s")."GMT");
                    header("Cache-Control: no-cache, must-revalidate");
                    header("Pragma: no-cache");
                    header("Content-type: application/x-msexcel");
                    header("Content-Disposition: attachment; filename = \"{$arquivo}\"");
                    header("Content-Description PHP Generated Data");
                }
            }
        }
        else {
            $selecionar = "SELECT * FROM USUARIOS";
            $res = $conn->query($selecionar);
            if($res->rowCount() > 0) {
                $dados = $res->fetchAll();
                foreach ($dados as $dado) {
                    $html .= "<tr>";
                    $html .= "<td>" . htmlspecialchars($dado['Codigo']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['Nome']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['email']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['email_rec']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['data_nascimento']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['Nivel']) . "</td>";
                    $html .= "<td>" . htmlspecialchars($dado['senha']) . "</td>";
                    $html .= "<td><img src='" . htmlspecialchars($dado['foto']) . "' alt='foto_perfil'></td>";
                    $html .= "</tr>";
                }
                $html .= '</tbody>';
                $html .= '</table>';

                header("Expires: Mon, 26 jul 1997 05:00:00 GMT");
                header("Last-Modified: ".gmdate("D,d M YH:i:s")."GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Program: no-cache");
                header("Content-type: application/x-msexcel");
                header("Content-Disposition: attachment; filename = \"{$arquivo}\"");
                header("Content-Description PHP Generated Data");
            }
        }
        echo $html;
    ?>
</body>

</html>