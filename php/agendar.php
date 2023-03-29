<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <title>Shayane Zonta Beauty</title>
    <link rel="stylesheet" href="../main.css">
</head>
<body onload="document.getElementsByTagName('main')[0].style.opacity = '1'">
    <header>
        <img src="../images/shayfoto.jpg" alt="Shayane">
        <b>Shayane Zonta Beauty</b>
    </header>
    <main>
        <?php
            include('conexao.php');
            $data = explode("-", $_POST['dia']);
            $dia = $data[2];
            $mes = $data[1];
            $horario = $_POST['horario'];
            $nome = $_POST['nome'];
            $nascimento = $_POST['nascimento'];
            $telefone = $_POST['telefone'];
            $procedimento = $_POST['procedimento'];

            $query_cliente = "SELECT * FROM clientes WHERE nome = '$nome' AND nascimento = '$nascimento'";
            $resultado_query_cliente = $conexao->query($query_cliente);
            if ($resultado_query_cliente->num_rows < 1) {
                $query_criar_cliente = "INSERT INTO clientes (nome, nascimento, telefone) VALUES ('$nome', '$nascimento', '$telefone')";
                $resultado_query_cliente = $conexao->query($query_criar_cliente);
                $query_update_agenda = "SELECT id FROM clientes WHERE nome = '$nome' AND nascimento = '$nascimento'";
                $resultado_update_agenda = $conexao->query($query_update_agenda);
                $id = $resultado_update_agenda->fetch_assoc();
                $query_agendamento = "INSERT INTO agenda (dia, mes, horario, nome, nascimento, telefone, procedimento, idcliente) VALUES ('$dia', '$mes', '$horario', '$nome', '$nascimento', '$telefone', '$procedimento', '".$id['id']."')";
                if (mysqli_query($conexao, $query_agendamento)) {
                    echo "Agendamento de ". $procedimento. " feito com sucesso no dia " . $_POST['dia'] . " para " . $nome;
                } 
                
            }
            else {
                $query_update_agenda = "SELECT id FROM clientes WHERE nome = '$nome' AND nascimento = '$nascimento'";
                $resultado_update_agenda = $conexao->query($query_update_agenda);
                $id = $resultado_update_agenda->fetch_assoc();
                $query_agendamento = "INSERT INTO agenda (dia, mes, horario, nome, nascimento, telefone, procedimento, idcliente) VALUES ('$dia', '$mes', '$horario', '$nome', '$nascimento', '$telefone', '$procedimento', '".$id['id']."')";
                if (mysqli_query($conexao, $query_agendamento)) {
                    echo "Agendamento de ". $procedimento . " feito com sucesso no dia " . $_POST['dia'] . " para " . $nome;
                }
            }
        ?>
    </main>
</body>
</html>