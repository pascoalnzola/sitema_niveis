<?php
    include("Banco_dados/config.php");
    if(isset($_POST["email"]) && isset($_POST["senha"]) && !empty($_POST["email"]) && !empty($_POST["senha"])){
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $cont = 0;
        $query = "SELECT * FROM Usuarios where email = '$email'";
        $result = $conn->query($query)->fetch(PDO::FETCH_ASSOC);
        if($res["Nome"] == $user && $res["senha"] == $senha){
            if($res["Nivel"] == "Admin"){
                $_SESSION['perfil'] = $res['foto'];
                $_SESSION['user_id'] = $res['Codigo'];
                $_SESSION['usuario'] = $user;
                $cont = 1;
                header("Location: index.php");
                return;
            }
            else if($res["Nivel"] == "Nivel1"){
                $_SESSION['perfil'] = $res['foto'];
                $_SESSION['user_id'] = $res['Codigo'];
                $_SESSION['usuario'] = $user;
                $cont = 1;
                header("Location: nivel.php");
                return;
            }
            else if($res["Nivel"] == "Nivel2"){
                $_SESSION['perfil'] = $res['foto'];
                $_SESSION['user_id'] = $res['Codigo'];
                $_SESSION['usuario'] = $user;
                $cont = 1;
                header("Location: nivel.php");
                return;
            }
        }
        if($cont == 0){
            header("Location: login.php");
        }
    }
    else{
        header("Location: login.php");
    }
?>