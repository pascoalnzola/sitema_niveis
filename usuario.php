<?php
    include("Banco_dados/config.php");
    if(isset($_POST["Admin"]) && !empty($_POST["Admin"])){
        $acao = $_POST["Admin"];
        if($acao == "editar"){
            header("Location: editarUso.php");
        }
    }
    else{
        header("Location: nivel.php");
    }
?>