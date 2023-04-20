<?php
    include('../php/conexao.php');
    include('php/logado.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="atendimentosdodia.php">Atendimentos do Dia</a>
		<a href="historico.php">Histórico</a>
        <a href="clientes.php">Clientes</a>
        <a href="configuracoes.php">Configurações</a>
        <a href="php/logout.php">Sair</a>
	</header>
    <main>
        <section id="atendimentosdodia">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Procedimento</th>
                    <th>Horário</th>
                    <th>Nascimento</th>
                    <th>Telefone</th>
                    <th>Atendido</th>
                </tr>
                <?php
                    $dia = date("d");
                    $mes = date("m");
                    $query_agenda_hoje = "SELECT * FROM agenda WHERE dia = $dia AND mes = $mes ORDER BY horario";
                    $resultado_agenda_hoje = $conexao->query($query_agenda_hoje);
                    if($resultado_agenda_hoje->num_rows > 0) {
                        while($row = $resultado_agenda_hoje->fetch_assoc()) {
                            if($row['atendido'] == 1) {
                                $atendido = "class='atendido'";
                            }
                            else {
                                $atendido = "class='naoatendido'";
                            }
                            echo "<tr><td contenteditable='true'>" . $row['nome'] . "</td><td contenteditable='true'>" . $row['procedimento'] . "</td><td contenteditable='true'>" . $row['horario'] . "</td><td contenteditable='true'>" . $row['nascimento'] . "</td><td contenteditable='true'>" . $row['telefone'] . "</td><td><a href='php/atendido.php?id=" . $row['id'] . "' " . $atendido . ">X</a></td></tr>";
                        }
                    }
                ?>
            </table>
        </section>
    </main>
</body>
</html>