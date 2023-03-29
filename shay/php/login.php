<?php
    include('../../php/conexao.php');
    session_start();
    $query_login = "SELECT * FROM shay";
    $resultado_login = $conexao->query($query_login);
    $dados = $resultado_login->fetch_assoc();
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    if($usuario == $dados['usuario'] && $senha == $dados['senha']) {
        $_SESSION['usuario'] = $dados['usuario'];
        $_SESSION['senha'] = $dados['senha'];
        header('Location: ../atendimentosdodia.php');
    }
    else {
        header('Location: ../index.php?invalid=1');
    }
?>