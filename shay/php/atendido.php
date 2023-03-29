<?php
    include('../../php/conexao.php');
    $id = $_GET['id'];
    $query_agenda = "SELECT * FROM agenda WHERE id = ". $id;
    $resultado_agenda = $conexao->query($query_agenda);
    $agenda = $resultado_agenda->fetch_assoc();
    if($agenda['atendido'] == 1) {
        $query_atendido = "UPDATE agenda SET atendido = 0 WHERE id = " . $id;
        $resultado_atendido = $conexao->query($query_atendido);
    }
    else {
        $query_atendido = "UPDATE agenda SET atendido = 1 WHERE id = " . $id;
        $resultado_atendido = $conexao->query($query_atendido);
    }
    header('Location: '.$_SERVER['HTTP_REFERER']);
?>