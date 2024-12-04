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
    <link rel="stylesheet" href="/Clinica_Odontologica/admin/Styles/homeadm.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/admin/Styles/servicos.css">
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
            <span class="logo navLogo"><a href="#">Administrador</a></span>

            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#"></a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>

                <ul class="nav-links">
                <li><a href="Ver_Agendamentos.php">Agendamentos</a></li>
                    <li><a href="Servicos.php">Serviços</a></li>
                    <li><a href="Funcionarios.php">Funcionarios</a></li>
                    <li><a href="Clientes.php">Clientes</a></li>
                    <li><a href="sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
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
        
    </div>
    
</body>
</html>