<?php
    include('../php/conexao.php');
    if(isset($_GET['dia'])) {
        include('../php/horarios.php')  ;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shayane Zonta Beauty</title>
    <link rel="stylesheet" href="../main.css">
</head>
<body onload="document.getElementsByTagName('main')[0].style.opacity = '1'">
    <header>
        <img src="../images/shayfoto.jpg" alt="Shayane">
        <b>Shayane Zonta Beauty</b>
        <a href="extensao.php">Extensão de Cílios</a>
        <a href="manutencao.php" id="select_menu">Manutenção de Extensão de Cílios</a>
        <a href="brow.php">Brow Lamination</a>
    </header>
    <main>
        <form action="../php/agendar.php" method="post" id="manutencao" autocomplete="off">
            Dia:
            <input type="date" name="dia" id="dia" oninput="window.location.replace('manutencao.php?dia='+this.value)" required>
            <?php
                if(isset($_GET['dia'])) {
                    $horarios_ocupados = consultaHorariosOcupados("manutencao");
                    exibirHorarios("manutencao", $horarios_ocupados, "Manutenção de Cílios");
                }

            ?>
        </form>
    </main>
    <script>
        /* Mantém o value do input date igual ao que foi selecionado pelo usuário */
        const searchParams = new URLSearchParams(window.location.search);
		if (searchParams.has("dia")) {
			const dataValue = searchParams.get("dia");
			document.getElementById("dia").value = dataValue;
		}
    </script>
</body>
</html>