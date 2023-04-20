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
        <section id="clientes" class="ativa">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>Telefone</th>
                </tr>
                <?php
                    $dia = date("d");
                    $mes = date("m");
                    $query_clientes = "SELECT * FROM clientes";
                    $resultado_clientes = $conexao->query($query_clientes);
                    if($resultado_clientes->num_rows > 0) {
                        while($row = $resultado_clientes->fetch_assoc()) {
                            echo "<tr><td contenteditable='true'>" . $row['nome'] . "</td><td contenteditable='true'>" . $row['nascimento'] . "</td><td contenteditable='true'>" . $row['telefone'] . "</td></tr>";
                        }
                    }
                ?>
            </table>
        </section>
    </main>
	
</body>
</html>