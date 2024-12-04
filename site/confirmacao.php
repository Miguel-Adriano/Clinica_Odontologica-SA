<?php 
session_start();

// Recuperar os valores da sessão
$data_agendamento = isset($_SESSION['data_agendamento']) ? $_SESSION['data_agendamento'] : 'Data não definida';
$horario = isset($_SESSION['horario']) ? $_SESSION['horario'] : 'Horário não definido';


// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'Clinica_Odontologica'); // Substitua com suas credenciais

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar o nome do serviço com base no id_servico
$sql = "SELECT nome FROM servicos WHERE id_servico = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_servico);
$stmt->execute();
$stmt->bind_result($nome_servico);
$stmt->fetch();
$stmt->close();

// Obter a data e o horário do agendamento da sessão
$data_agendamento = isset($_SESSION['data_agendamento']) ? $_SESSION['data_agendamento'] : '';
$horario = isset($_SESSION['horario']) ? $_SESSION['horario'] : 'Horário não definido';


// Fechar a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
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
        <div class="error-code">Marcado!</div>
        <div class="error-message">Sua consulta para <strong><?php echo htmlspecialchars($nome_servico); ?></strong> foi marcada com sucesso!</div>
        <div class="error-message">Data: <strong><?php echo date('d/m/Y', strtotime($data_agendamento)); ?></strong></div>
        <div class="error-message">Horário: <strong><?php echo htmlspecialchars($horario); ?></strong></div>

        <div class="error-message">Nos veremos em breve!</div>
        <br>
        <center><?php echo '<a href="index.html" class="service-button">Voltar ao Site</a>'; ?></center>
        <img src="img/dente feliz.avif" alt="imagem de um dente confuso">
    </div>
    
</body>
</html>