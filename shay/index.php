<?php
    include('../php/conexao.php');
    session_start();
    if(isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {
        $query_login = "SELECT * FROM shay";
        $resultado_login = $conexao->query($query_login);
        $dados = $resultado_login->fetch_assoc();
        if($_SESSION['usuario'] == $dados['usuario'] && $_SESSION['senha'] == $dados['senha']) {
            header('Location: atendimentosdodia.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <form action="php/login.php" method="post">
            Usuário:
            <input type="text" name="usuario" id="usuario" required>
            Senha:
            <input type="password" name="senha" id="senha" required>
            <input type="submit" value="Entrar">
        </form>
        <?php 
            if(isset($_GET['invalid'])) {
                echo "Usuário e/ou senha inválido(s)";
            }
            if(isset($_GET['mustlogin'])) {
                echo "É preciso realizar o login";
            }
            if(isset($_GET['senhatrocada'])) {
                echo "Senha trocada com sucesso";
            }
        ?>
    </main>
</body>
</html>