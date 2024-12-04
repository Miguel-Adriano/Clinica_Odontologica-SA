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

// Variáveis para armazenar os resultados
$agendamentos = [];
$agendamentos_hoje = [];
$cpf = "";

// Verificar se uma exclusão foi solicitada
if (isset($_POST['excluir_agendamento'])) {
    $id_agendamento = $_POST['excluir_agendamento'];

    // Excluir agendamento pelo ID
    $sql_excluir = "DELETE FROM agendamentos WHERE id = ?";
    if ($stmt = $conn->prepare($sql_excluir)) {
        $stmt->bind_param("i", $id_agendamento);
        if ($stmt->execute()) {
            $success_message = "Agendamento excluído com sucesso.";
        } else {
            $error_message = "Erro ao excluir o agendamento.";
        }
        $stmt->close();
    }
}

// Consultar agendamentos do dia atual
$sql_hoje = "SELECT 
                agendamentos.id, 
                agendamentos.data_agendamento, 
                agendamentos.horario, 
                pacientes.nome AS paciente_nome, 
                pacientes.cpf, 
                servicos.nome AS servico_nome, 
                servicos.valor
            FROM agendamentos
            JOIN pacientes ON agendamentos.id_paciente = pacientes.id_paciente
            JOIN servicos ON agendamentos.id_servico = servicos.id_servico
            WHERE agendamentos.data_agendamento = CURDATE()";

$result_hoje = $conn->query($sql_hoje);

if ($result_hoje && $result_hoje->num_rows > 0) {
    while ($row = $result_hoje->fetch_assoc()) {
        $agendamentos_hoje[] = $row;
    }
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];

    // Validar CPF
    if (empty($cpf)) {
        $error_message = "Por favor, insira o CPF.";
    } else {
        // Consultar os agendamentos relacionados ao CPF
        $sql = "SELECT 
            agendamentos.id, 
            agendamentos.data_agendamento, 
            agendamentos.horario, 
            pacientes.nome AS paciente_nome, 
            pacientes.cpf, 
            servicos.nome AS servico_nome, 
            servicos.valor
        FROM agendamentos 
        JOIN pacientes ON agendamentos.id_paciente = pacientes.id_paciente
        JOIN servicos ON agendamentos.id_servico = servicos.id_servico
        WHERE pacientes.cpf = ?";

        // Preparar e executar a consulta
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $cpf);
            $stmt->execute();
            $result = $stmt->get_result();

            // Armazenar os resultados
            while ($row = $result->fetch_assoc()) {
                $agendamentos[] = $row;
            }

            $stmt->close();
        } else {
            $error_message = "Erro ao buscar os agendamentos.";
        }
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
    <title>Home</title>
</head>
<body>
<nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Administrador</a></span>

            <div class="menu">
                

            <ul class="nav-links">
                <li><a href="Ver_Agendamentos.php">Agendamentos</a></li>

                    <li><a href="Servicos.php">Serviços</a></li>

                    <li><a href="../Tela_Admin/Funcionarios/Alteração_Funcionario.php">Funcionarios</a></li>

                    <li><a href="../Tela_Admin/Clientes/Alteração_Cliente.php">Clientes</a></li>

                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>
    <header></header>
    <br><br><br><br><br><br>
    <div class="container">
        <h2>Consultar Agendamento Específico:</h2>
        <form method="POST" action="Ver_Agendamentos.php">
            <label for="cpf">Digite o CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" required>
            <button type="submit">Buscar</button>
        </form>

        <?php if (isset($error_message)): ?>
            <div class="error" style="color: red;"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($agendamentos)): ?>
    <h3>Agendamentos Encontrados por cpf:</h3>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Horário</th>
                <th>Nome do Paciente</th>
                <th>CPF</th>
                <th>Consulta</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agendamentos as $agendamento): ?>
                <tr>
                    <td><?php echo date("d/m/Y", strtotime($agendamento['data_agendamento'])); ?></td>
                    <td><?php echo $agendamento['horario']; ?></td>
                    <td><?php echo $agendamento['paciente_nome']; ?></td>
                    <td><?php echo $agendamento['cpf']; ?></td>
                    <td><?php echo $agendamento['servico_nome']; ?></td>
                    <td>R$ <?php echo $agendamento['valor']; ?></td>
                    <td>
                        <form method="POST" action="excluir_agendamento.php" style="display:inline;">
                            <input type="hidden" name="id_agendamento" value="<?php echo $agendamento['id']; ?>">
                            <button type="submit" onclick="return confirm('Deseja realmente excluir este agendamento?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br><br><br><br>
<?php elseif (!isset($error_message)): ?>
<?php endif; ?>

<?php if (!empty($agendamentos_hoje)): ?>
    <h3>Agendamentos para Hoje:</h3>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Horário</th>
                <th>Nome do Paciente</th>
                <th>CPF</th>
                <th>Consulta</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agendamentos_hoje as $agendamento): ?>
                <tr>
                    <td><?php echo date("d/m/Y", strtotime($agendamento['data_agendamento'])); ?></td>
                    <td><?php echo $agendamento['horario']; ?></td>
                    <td><?php echo $agendamento['paciente_nome']; ?></td>
                    <td><?php echo $agendamento['cpf']; ?></td>
                    <td><?php echo $agendamento['servico_nome']; ?></td>
                    <td>R$ <?php echo $agendamento['valor']; ?></td>
                    <td>
                        <form method="POST" action="excluir_agendamento.php" style="display:inline;">
                            <input type="hidden" name="id_agendamento" value="<?php echo $agendamento['id']; ?>">
                            <button type="submit" onclick="return confirm('Deseja realmente excluir este agendamento?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <h3>Agendamentos de Hoje</h3>
    <p>Nenhum agendamento encontrado para hoje.</p>
<?php endif; ?>

    </div>
</body>
</html>