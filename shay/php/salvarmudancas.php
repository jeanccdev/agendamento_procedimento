<?php
    session_start();
    if(isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {
        include('../../php/conexao.php');
        $query_login = "SELECT * FROM shay";
        $resultado_login = $conexao->query($query_login);
        $dados = $resultado_login->fetch_assoc();
        if($_SESSION['usuario'] != $dados['usuario'] || $_SESSION['senha'] != $dados['senha']) {
            header('Location: index.php');
        }
        else {
            $domabertura = $_GET['domabertura'];
            $segabertura = $_GET['segabertura'];
            $terabertura = $_GET['terabertura'];
            $quaabertura = $_GET['quaabertura'];
            $quiabertura = $_GET['quiabertura'];
            $sexabertura = $_GET['sexabertura'];
            $sababertura = $_GET['sababertura'];
            $domfechamento = $_GET['domfechamento'];
            $segfechamento = $_GET['segfechamento'];
            $terfechamento = $_GET['terfechamento'];
            $quafechamento = $_GET['quafechamento'];
            $quifechamento = $_GET['quifechamento'];
            $sexfechamento = $_GET['sexfechamento'];
            $sabfechamento = $_GET['sabfechamento'];
            $extensao = $_GET['extensao'];
            $manutencao = $_GET['manutencao'];
            $brow = $_GET['brow'];
            $config = array(
                'Domingo' => array(
                    'abertura' => $domabertura,
                    'fechamento' => $domfechamento
                ),
                'Segunda' => array(
                    'abertura' => $segabertura,
                    'fechamento' => $segfechamento
                ),
                'Terca' => array(
                    'abertura' => $terabertura,
                    'fechamento' => $terfechamento
                ),
                'Quarta' => array(
                    'abertura' => $quaabertura,
                    'fechamento' => $quafechamento
                ),
                'Quinta' => array(
                    'abertura' => $quiabertura,
                    'fechamento' => $quifechamento
                ),
                'Sexta' => array(
                    'abertura' => $sexabertura,
                    'fechamento' => $sexfechamento
                ),
                'Sabado' => array(
                    'abertura' => $sababertura,
                    'fechamento' => $sabfechamento
                ),
                'duracao' => array(
                    'extensao' => $extensao,
                    'manutencao' => $manutencao,
                    'brow' => $brow
                )
            );
            $json = json_encode($config);
            file_put_contents("../../configs.json", $json);
            header('Location: ../configuracoes.php');
        }
    }
    else {
        header('Location: index.php');
    }
?>