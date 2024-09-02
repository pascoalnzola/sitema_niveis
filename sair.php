<?php
    include("Banco_dados/config.php");
    unset($_SESSION['user_id']);
    unset($_SESSION['usuario']);
    session_destroy();
    header("Location: login.php");
?>