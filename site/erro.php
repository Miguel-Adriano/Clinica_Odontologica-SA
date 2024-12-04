<?php 
session_start();
$id_servico = $_SESSION['id_servico']; // Obter o id da sessão
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro de data</title>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/botao.css">
</head>
<style>
    body{
        background-color: #f2f5fa;
        font-family: Arial, sans-serif;
    }
    img{
        width: 450px;
        transform: translate(1px, 1px);
    }
    .container {
            text-align: center;
        }
        .error-code {
            font-size: 100px;
            font-weight: bold;
        }
        .error-message {
            font-size: 20px;
            margin-top: 20px;
        }
</style>
<body>
    <header>
        <h1>Transforme seu sorriso</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="Servicos.php">Serviços</a>
            <a href="SobreNos.html">Quem somos</a>
            <a href="Contato.html">Contato</a>
        </nav>
    </header>

    
    <div class="container">
        <br><br>
        <div class="error-code">Oops!</div>
        <div class="error-message">Parece que você esta tentando marcar o dia fora do permitido (segunda a sexta!).</div>
        <div class="error-message">Pedimos que verifique a data novemente e remarque.</div>
        <div class="error-message">Agradecemos a compreensão.</div>
        <br>
        <center><?php echo '<a href="agendar2.php?id_servico=' . $id_servico . '" class="service-button">Alterar Horario</a>'; ?></center>
        <img src="img/dente confuso.avif" alt="imagem de um dente confuso">
    </div>
    
</body>
</html>