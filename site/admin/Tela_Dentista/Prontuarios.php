<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clinica_Odontologica";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consultar prontuários concluídos
$query_concluido = "SELECT prontuarios.id AS prontuario_id, prontuarios.*, agendamentos.status, agendamentos.horario, pacientes.nome
                    FROM prontuarios
                    JOIN agendamentos ON prontuarios.id_agendamento = agendamentos.id
                    JOIN pacientes ON agendamentos.id_paciente = pacientes.id_paciente
                    WHERE agendamentos.status = 'Concluída'";

$result_concluido = $conn->query($query_concluido);


// Verificar se a consulta foi bem-sucedida
if ($result_concluido === false) {
    die("Erro na consulta de prontuários concluídos: " . $conn->error);
}

// Consultar prontuários que NÃO estão com status 'Concluído' na tabela agendamentos
$query_nao_concluido = "SELECT prontuarios.*, agendamentos.status, agendamentos.horario, pacientes.nome
                        FROM prontuarios
                        JOIN agendamentos ON prontuarios.id_agendamento = agendamentos.id
                        JOIN pacientes ON agendamentos.id_paciente = pacientes.id_paciente
                        WHERE agendamentos.status != 'Concluída'";
$result_nao_concluido = $conn->query($query_nao_concluido);

// Verificar se a consulta foi bem-sucedida
if ($result_nao_concluido === false) {
    die("Erro na consulta de prontuários não concluídos: " . $conn->error);
}

// Variáveis para armazenar os resultados e a data de agendamento
$data_agendamento = "";

// Verificar se o formulário de data foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data_agendamento'])) {
    $data_agendamento = $_POST['data_agendamento'];

    // Consultar os agendamentos para a data fornecida
    $sql_data = "SELECT 
                prontuarios.id AS prontuario_id,  
                agendamentos.id, 
                agendamentos.data_agendamento, 
                agendamentos.horario, 
                pacientes.nome AS nome, 
                pacientes.cpf, 
                servicos.nome AS servico_nome, 
                servicos.valor, 
                agendamentos.status
            FROM agendamentos 
            JOIN pacientes ON agendamentos.id_paciente = pacientes.id_paciente
            JOIN servicos ON agendamentos.id_servico = servicos.id_servico
            JOIN prontuarios ON agendamentos.id = prontuarios.id_agendamento
            WHERE agendamentos.data_agendamento = ?";

    // Preparar e executar a consulta
    if ($stmt = $conn->prepare($sql_data)) {
        $stmt->bind_param("s", $data_agendamento);
        $stmt->execute();
        $result_data = $stmt->get_result();

        // Armazenar os resultados
        $agendamentos = [];
        while ($row = $result_data->fetch_assoc()) {
            $agendamentos[] = $row;
        }

        $stmt->close();
    } else {
        $error_message = "Erro ao buscar os agendamentos por data.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Styles/homeadm.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Tela_Admin/css/ver_agendamentos.css">
    <link rel="stylesheet" href="css/Prontuario2.css">
    
    <title>Dentista - Prontuarios</title>
    <style>
        .botao {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .botao:hover {
            background-color: #0056b3;
            text-decoration: none;
        }


    </style>
</head>
<body>
<nav>
    <div class="nav-bar">
        <i class='bx bx-menu sidebarOpen' ></i>
        <span class="logo navLogo"><a href="#">Dentista - Prontuários</a></span>

        <div class="menu">
            <ul class="nav-links">
                <li><a href="Agendamentos.php">Agendamentos</a></li>

                <li><a href="Clientes/Pesquisar_Cliente.php">Clientes</a></li>
                <li><a href="Prontuarios.php">Prontuários</a></li>
                <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>
<header></header>
<br><br><br><br><br><br>    
<div class="container">
    <h2>Consultar por Data:</h2>
    <form method="POST" action="">
        <label for="data_agendamento">Escolha a Data:</label>
        <input type="date" id="data_agendamento" name="data_agendamento" value="<?php echo htmlspecialchars($data_agendamento); ?>" required>
        <button type="submit">Buscar</button>
    </form>

    <?php if (isset($error_message)): ?>
        <div class="error" style="color: red;"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <?php if (!empty($agendamentos)): ?>
    <h3>Prontuários Encontrados por Data:</h3>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Horário</th>
                <th>Nome do Paciente</th>
                <th>Consulta</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agendamentos as $agendamento): ?>
                <tr>
                    <td><?php echo date("d/m/Y", strtotime($agendamento['data_agendamento'])); ?></td>
                    <td><?php echo $agendamento['horario']; ?></td>
                    <td><?php echo $agendamento['nome']; ?></td>
                    <td><?php echo $agendamento['servico_nome']; ?></td>
                    <td><?php echo $agendamento['status']; ?></td>
                    <td><a class="botao" href="detalhes_prontuario.php?id=<?php echo $agendamento['prontuario_id']; ?>">Ver</a>
                    <a class="botao" href="editar_prontuario.php?id=<?php echo $agendamento['prontuario_id']; ?>">Editar</a>
                    <a class="botao" href="excluir_prontuario.php?id=<?php echo $agendamento['prontuario_id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este prontuário?')">Excluir</a></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br><br>
    <?php endif; ?>

    <h3>Prontuários concluídos hoje:</h3>
    <table>
        <thead>
            <tr>
                <th>Horario</th>
                <th>Paciente</th>
                <th>ID</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_concluido->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['horario']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['id_agendamento']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><a class="botao" href="detalhes_prontuario.php?id=<?php echo $row['prontuario_id']; ?>">Ver</a>
                    <a class="botao" href="editar_prontuario.php?id=<?php echo $row['prontuario_id']; ?>">Editar</a>
                    <a class="botao" href="excluir_prontuario.php?id=<?php echo $row['prontuario_id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este prontuário?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

  
</div>

</body>
</html>
