<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica_odontologica";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar se o parâmetro id_servico foi passado na URL
if (isset($_GET['id_servico'])) {
    $id_servico = $_GET['id_servico'];

    // Validar o id_servico para evitar injeção de SQL
    $id_servico = $conn->real_escape_string($id_servico);

    // Consultar os dados da tabela 'servicos' para deletar o registro com o id_servico
    $sql = "DELETE FROM `servicos` WHERE id_servico='$id_servico'";

    if ($conn->query($sql) === TRUE) {
        // Se a exclusão for bem-sucedida, redirecionar de volta para a página de listagem
        header("Location: Servicos.php");  // Altere para a página desejada
        exit();
    } else {
        echo "Erro ao deletar o serviço: " . $conn->error;
    }
} else {
    echo "ID do serviço não encontrado.";
}

$conn->close();
?>
