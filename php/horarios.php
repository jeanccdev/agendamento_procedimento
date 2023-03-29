<?php
    include("conexao.php");
    $dia = $_GET['dia'];
    $abrirArquivo = file_get_contents("../configs.json");
    $configs = json_decode($abrirArquivo);
    $diasDaSemana = array('Domingo', 'Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
    $diaDaSemana = date('w', strtotime($dia));
    $dia = $diasDaSemana[$diaDaSemana];
    $abertura = strtotime($_GET['dia'] . ' ' . $configs->$dia->abertura);
    $fechamento = strtotime($_GET['dia'] . ' ' . $configs->$dia->fechamento);

    function consultaHorariosOcupados($procedimento) {
        global $abertura, $fechamento, $configs, $conexao;
        $horarios_ocupados = array();
        $dia = explode("-", $_GET['dia']);
        $query_horarios = "SELECT * FROM agenda WHERE dia = ".$dia[2]. " AND mes = ".$dia[1];
        $resultado_horarios = $conexao->query($query_horarios);
        if($resultado_horarios->num_rows > 0) {
            while($row = $resultado_horarios->fetch_assoc()) {
                $tstamp = strtotime($_GET['dia'] . ' ' . $row['horario']);
                if($row['procedimento'] == "Extensão de Cílios") {
                    for($j=0;$j<=$configs->duracao->extensao/15-1;$j++) {
                        $horarios_ocupados[$tstamp+$j*900] = $row['procedimento'];
                    }
                    for($j=0;$j<=$configs->duracao->$procedimento/15-1;$j++) {
                        $horarios_ocupados[$tstamp-$j*900] = $row['procedimento'];
                    }
                }
                if($row['procedimento'] == "Manutenção de Extensão de Cílios") {
                    for($j=0;$j<=$configs->duracao->manutencao/15-1;$j++) {
                        $horarios_ocupados[$tstamp+$j*900] = $row['procedimento'];
                    }
                    for($j=0;$j<=$configs->duracao->$procedimento/15-1;$j++) {
                        $horarios_ocupados[$tstamp-$j*900] = $row['procedimento'];
                    }
                }
                if($row['procedimento'] == "Brow Lamination") {
                    for($j=0;$j<=$configs->duracao->brow/15-1;$j++) {
                        $horarios_ocupados[$tstamp+$j*900] = $row['procedimento'];
                    }
                    for($j=0;$j<=$configs->duracao->$procedimento/15-1;$j++) {
                        $horarios_ocupados[$tstamp-$j*900] = $row['procedimento'];
                    }
                }
            }
        }
        return $horarios_ocupados;
    }

    function exibirHorarios($procedimento, $horarios_ocupados, $nomeprocedimento) {
        global $abertura, $fechamento, $configs, $dia;
        if($configs->$dia->abertura != "Fechado") {
            echo "Horario:<select name='horario' id='horario' required>";
            for($i = $abertura; $i <= $fechamento - $configs->duracao->$procedimento * 60; $i += 15 * 60) {
                if(empty($horarios_ocupados[$i])) {
                    $hora = date('H:i', $i);
                    echo "<option value='".$hora."'>".$hora."</option>";
                }
            }
            echo "</select>
                        Nome Completo:
                        <input type='text' name='nome' id='nome' placeholder='Nome Completo' required>
                        Data de Nascimento:
                        <input type='date' name='nascimento' id='nascimento' required>
                        Telefone:
                        <input type='tel' name='telefone' id='telefone' placeholder='Apenas Números' required>
                        <input type='hidden' id='procedimento' name='procedimento' value='".$nomeprocedimento."'>
                        <input type='submit' value='Agendar'>";
        }
        else {
            echo "Não há horários disponíveis para esse dia";
        }
    }
?>