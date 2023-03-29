<?php
    include('../php/conexao.php');
    include('php/logado.php');
    $abrirArquivo = file_get_contents("../configs.json");
    $configs = json_decode($abrirArquivo);
    $diasDaSemana = array('Domingo', 'Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Shayane Zonta Beauty</title>
</head>
<body>
    <header>
        <a href="atendimentosdodia.php">Atendimentos do Dia</a>
		<a href="historico.php">Histórico</a>
        <a href="clientes.php">Clientes</a>
        <a href="configuracoes.php">Configurações</a>
        <a href="trocarsenha.php">Trocar Senha</a>
        <a href="php/logout.php">Sair</a>
	</header>
    <main>
        <section id="configuracoes" class="ativa">
            <table>
            <?php
                foreach($diasDaSemana as $dia) {
                    echo "<tr><th>".$dia."</th><td contenteditable='true'>".$configs->$dia->abertura."</td><td contenteditable='true'>".$configs->$dia->fechamento."</td></tr>";
                }
                echo "<tr><th>Extensão de Cílios</th><td contenteditable='true'>".$configs->duracao->extensao."</td></tr>";
                echo "<tr><th>Manutenção de Cílios</th><td contenteditable='true'>".$configs->duracao->manutencao."</td></tr>";
                echo "<tr><th>Brow Lamination</th><td contenteditable='true'>".$configs->duracao->brow."</td></tr>";
            ?>
            </table>
            <button onclick="salvarMudancas()">Salvar Mudanças</button>
            <?php if(isset($_GET['salvo'])) { echo "<br>Salvo com sucesso!<br>";} ?>
        </section>
    </main>
    <script>
        function salvarMudancas() {
            var tdTags = document.getElementsByTagName("td");
            window.location.replace("php/salvarmudancas.php?domabertura="+tdTags[0].innerHTML+"&domfechamento="+tdTags[1].innerHTML+"&segabertura="+tdTags[2].innerHTML+"&segfechamento="+tdTags[3].innerHTML+"&terabertura="+tdTags[4].innerHTML+"&terfechamento="+tdTags[5].innerHTML+"&quaabertura="+tdTags[6].innerHTML+"&quafechamento="+tdTags[7].innerHTML+"&quiabertura="+tdTags[8].innerHTML+"&quifechamento="+tdTags[9].innerHTML+"&sexabertura="+tdTags[10].innerHTML+"&sexfechamento="+tdTags[11].innerHTML+"&sababertura="+tdTags[12].innerHTML+"&sabfechamento="+tdTags[13].innerHTML+"&extensao="+tdTags[14].innerHTML+"&manutencao="+tdTags[15].innerHTML+"&brow="+tdTags[16].innerHTML);
        }
    </script>
</body>
</html>