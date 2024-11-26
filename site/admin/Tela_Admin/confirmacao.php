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
    <link rel="stylesheet" href="css/agendamento.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Styles/homeadm.css">
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
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="">Administrador</a></span>

            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#"></a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>

                <ul class="nav-links">
                <li><a href="Ver_Agendamentos.php">Agendamentos</a></li>
                    <li><a href="Servicos.php">Serviços</a></li>
                    <li><a href="Funcionarios/Alteração_Funcionario.php">Funcionarios</a></li>
                    <li><a href="Clientes/Alteração_Cliente.php">Clientes</a></li>
                    <li><a href="sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
    </header>

    
<center>
        <br><br>
        <div class="error-code">Marcado!</div>
        <div class="error-message">A consulta <strong><?php echo htmlspecialchars($nome_servico); ?></strong> foi marcada com sucesso!</div>
        <div class="error-message">Data: <strong><?php echo date('d/m/Y', strtotime($data_agendamento)); ?></strong></div>
        <div class="error-message">Horário: <strong><?php echo htmlspecialchars($horario); ?></strong></div>
        <br>
        <center><?php echo '<a href="Servicos.php" class="service-button">Voltar ao Site</a>'; ?></center>
        

        </center>
</body>
</html>