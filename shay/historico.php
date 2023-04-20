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
        <section id="historico" class="ativa">
            <input type="date" name="dia" id="dia" value="<?php if(isset($_GET['dia'])) { echo $_GET['dia']; } ?>" oninput="window.location.href='historico.php?dia='+this.value">
            <table id="tablehistorico">
                <tr>
                    <th>Nome</th>
                    <th>Procedimento</th>
                    <th>Horário</th>
                    <th>Nascimento</th>
                    <th>Telefone</th>
                    <th>Atendido</th>
                </tr>
                <?php
                    if(isset($_GET['dia'])) {
                        $data = explode('-', $_GET['dia']);
                        $dia = $data[2];
                        $mes = $data[1];
                        $query_historico = "SELECT * FROM agenda WHERE dia = $dia AND mes = $mes ORDER BY horario";
                        $resultado_historico = $conexao->query($query_historico);
                        if($resultado_historico->num_rows > 0) {
                            while($row = $resultado_historico->fetch_assoc()) {
                                if($row['atendido'] == 1) {
                                    $atendido = "class='atendido'";
                                }
                                else {
                                    $atendido = "class='naoatendido'";
                                }
                                echo "<tr><td contenteditable='true'>" . $row['nome'] . "</td><td contenteditable='true'>" . $row['procedimento'] . "</td><td contenteditable='true'>" . $row['horario'] . "</td><td contenteditable='true'>" . $row['nascimento'] . "</td><td contenteditable='true'>" . $row['telefone'] . "</td><td><a href='php/atendido.php?id=" . $row['id'] . "' " . $atendido . ">X</a></td></tr>";
                            }
                        }
                    }
                    
                ?>
            </table>
        </section>
    </main>
	
</body>
</html>