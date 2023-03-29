<?php
    session_start();
    if(isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {
        $query_login = "SELECT * FROM shay";
        $resultado_login = $conexao->query($query_login);
        $dados = $resultado_login->fetch_assoc();
        if($_SESSION['usuario'] != $dados['usuario'] || $_SESSION['senha'] != $dados['senha']) {
            header('Location: index.php');
        }
    }
    else {
        header('Location: index.php');
    }
?>