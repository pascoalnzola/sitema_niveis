<?php
    include("Banco_dados/config.php");
    if(isset($_POST["Admin"]) && !empty($_POST["Admin"])){
        $acao = $_POST["Admin"];
        if($acao == "editar"){
            header("Location: editar.php");
        }
        else if($acao == "eliminar"){
            header("Location: eliminar.php");
        }
        else if($acao == "inserir"){
            header("Location: inserir.php");
        }
        elseif($acao == "atualizar"){
            header("Location: atualizar.php");
        }
    }
    else{
        header("Location: index.php");
    }
?>