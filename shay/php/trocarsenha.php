<?php
    include('../../php/conexao.php');
    $senhaatual = $_POST['senhaatual'];
    $novasenha = $_POST['novasenha'];
    $confirmarsenha = $_POST['confirmarsenha'];
    $query_senha = "SELECT * FROM shay";
    $resultado_login = $conexao->query($query_senha);
    $dados = $resultado_login->fetch_assoc();
    if($senhaatual == $dados['senha']) {
        if($novasenha == $confirmarsenha) {
            $query_nova_senha = "UPDATE shay SET senha = '". $novasenha . "' WHERE senha = '". $senhaatual . "'";
            $resultado_nova_senha = $conexao->query($query_nova_senha);
            header('Location: ../index.php?senhatrocada=1');
        }
        else {
            header('Location: ../trocarsenha.php?confirmarsenha=1');
        }
    }
    else {
        header('Location: ../trocarsenha.php?senhainvalida=1');
    }
?>