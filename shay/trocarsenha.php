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
    <style>
        form input {
            background: #ddd;
        }
    </style>
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
        <form action="php/trocarsenha.php" method="post" autocomplete='off'>
            Senha Atual:
            <input type="password" name="senhaatual" id="senhaatual" required>
            Nova Senha:
            <input type="password" name="novasenha" id="novasenha" required>
            Confirmar Senha:
            <input type="password" name="confirmarsenha" id="confirmarsenha" required oninput="confirmarSenha()">
            <?php
                if(isset($_GET['senhainvalida'])) {
                    echo "Senha Incorreta";
                }
                if(isset($_GET['confirmarsenha'])) {
                    echo "As senhas não conferem";
                }
            ?>
            <input type="submit" value="Trocar Senha" id="submit" disabled>
        </form>
        <button onclick="visualizarSenha()">Visualizar Senha</button>
    </main>
    <script>
        var novasenha = document.getElementById('novasenha').value;
        var confirmarsenha = document.getElementById('confirmarsenha').value;
        function confirmarSenha() {
            if(document.getElementById('confirmarsenha').value == document.getElementById('novasenha').value) {
                document.getElementById('submit').disabled = false;
            }
        }

        function visualizarSenha() {
            var senhaatual = document.getElementById('senhaatual');
            var novasenha = document.getElementById('novasenha');
            var confirmarsenha = document.getElementById('confirmarsenha');
            if(senhaatual.type === 'password' || novasenha.type === 'password' || confirmarsenha.type === 'password') {
                senhaatual.type = 'text';
                novasenha.type = 'text';
                confirmarsenha.type = 'text';
            }
            else {
                senhaatual.type = 'password';
                novasenha.type = 'password';
                confirmarsenha.type = 'password';
            }
        }
    </script>
</body>
</html>