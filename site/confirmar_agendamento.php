<?php 
session_start();
$id_paciente = $_SESSION['id_paciente']; // Obter o id_paciente da sessão
$id_servico = $_SESSION['id_servico']; // Obter o id_serviço da sessão

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clinica_Odontologica";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar os dados do formulário
    $data_agendamento = $_POST['data_agendamento'];
    $horario = $_POST['horario'];

    // Salvar na sessão
    $_SESSION['data_agendamento'] = $data_agendamento;
    $_SESSION['horario'] = $horario;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar os dados (Você pode adicionar mais validações conforme necessário)
    if (empty($data_agendamento) || empty($horario)) {
        header ("Location: agendar2.php?id_servico=" . $id_servico);
        exit;
    }

    // Verificar se já existe um agendamento no mesmo dia, horário e serviço
    $sql_check = "SELECT COUNT(*) AS total 
                  FROM agendamentos 
                  WHERE data_agendamento = ? AND horario = ? AND id_servico = ?";
    
    if ($stmt_check = $conn->prepare($sql_check)) {
        $stmt_check->bind_param("sss", $data_agendamento, $horario, $id_servico); // Verifica se já existe agendamento para o mesmo serviço
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();
        
        if ($row_check['total'] > 0) {
            // Armazenar a mensagem de erro em sessão para exibir na próxima página
            $_SESSION['erro_agendamento'] = "Já existe um agendamento para esta data e horário no mesmo serviço. Por favor, escolha outro.";
            $stmt_check->close();
            $conn->close();
            header("Location: agendar.php"); // Redireciona de volta à página de agendamento
            exit;
        }
        $stmt_check->close();
    } else {
        echo "Erro ao verificar agendamentos: " . $conn->error;
        exit;
    }

    // Preparar o SQL para inserir os dados na tabela agendamentos
    $sql = "INSERT INTO agendamentos (id_servico, data_agendamento, horario, id_paciente) 
            VALUES (?, ?, ?, ?)";

    // Preparar a declaração SQL
    if ($stmt = $conn->prepare($sql)) {
        // Vincular os parâmetros
        $stmt->bind_param("sssi", $id_servico, $data_agendamento, $horario, $id_paciente);

        // Executar a consulta
        if ($stmt->execute()) {
            header("Location: confirmacao.php");
        } else {
            echo "Erro ao realizar o agendamento: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    // Fechar a conexão
    $conn->close();
}
?>
