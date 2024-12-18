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
$conn -> set_charset("utf8");
// Variáveis para armazenar os resultados
$agendamentos = [];
$cpf = "";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'];

    // Validar CPF
    if (empty($cpf)) {
        $error_message = "Por favor, insira o CPF.";
    } else {
        // Consultar os agendamentos relacionados ao CPF, incluindo o status
        $sql = "SELECT agendamentos.data_agendamento, agendamentos.horario, servicos.nome, servicos.valor, agendamentos.status
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Transforme seu Sorriso - Agendamentos</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/ver_agendamentos.css">
</head>
<body>
    <header>
        <h1>Transforme seu sorriso</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="Servicos.php">Serviços</a>
            <a href="SobreNos.html">Quem somos</a>
            <a href="Contato.html">Contato</a>
            <a href="Ver_Agendamentos.php" class="active">Agendamentos</a>
            <a href="Login.html">Login para Funcionarios</a>
        </nav>
    </header>

    <div class="container">
        <h2>Consulte o seu Agendamento</h2>
        <!-- Formulário para buscar agendamentos pelo CPF -->
        <form method="POST" action="Ver_Agendamentos.php">
            <label for="cpf">Digite o seu CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" required>
            <button type="submit">Buscar</button>
        </form>
        <script src="js/cpf.js"></script>

        <?php if (isset($error_message)): ?>
            <div class="error" style="color: red;"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($agendamentos)): ?>
            <h3>Agendamentos Encontrados</h3>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Consulta</th>
                        <th>Valor</th>
                        <th>Status</th> <!-- Nova coluna para o status -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agendamentos as $agendamento): ?>
                        <tr>
                            <td><?php echo date("d/m/Y", strtotime($agendamento['data_agendamento'])); ?></td>
                            <td><?php echo $agendamento['horario']; ?></td>
                            <td><?php echo $agendamento['nome']; ?></td>
                            <td>R$ <?php echo $agendamento['valor']; ?></td>
                            <td><?php echo htmlspecialchars($agendamento['status']); ?></td> <!-- Exibe o status -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (isset($cpf) && empty($agendamentos)): ?>
            <p>Nenhum agendamento encontrado.</p>
        <?php endif; ?>
    </div>

    

    <!-- CONTATO WHATSAPP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://wa.me/5547997078168?text=Adorei%20seu%20artigo" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF;border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888; z-index:1000;" target="_blank">
        <i style="margin-top:16px" class="fa fa-whatsapp"></i>
    </a>
</body>
</html>
