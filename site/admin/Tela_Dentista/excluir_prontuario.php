<?php
session_start();

// Conexão com o banco de dados
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = new mysqli("localhost", "root", "", "clinica_odontologica");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
// Verificar se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id_prontuario = $_GET['id'];

    // Preparar a consulta para excluir o prontuário
    $sql = "DELETE FROM prontuarios WHERE id = ?";
    
    // Preparar e executar a consulta
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id_prontuario); // 'i' para integer
        $stmt->execute();

        // Verificar se a exclusão foi bem-sucedida
        if ($stmt->affected_rows > 0) {
            $_SESSION['mensagem'] = "Prontuário excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir o prontuário. Tente novamente.";
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        $_SESSION['mensagem'] = "Erro ao preparar a consulta de exclusão.";
    }

    // Redirecionar para a página de prontuários ou lista
    header("Location: prontuarios.php"); // Altere para a página correta de onde a exclusão será gerenciada
    exit;
} else {
    // Se o ID não foi passado, redireciona ou exibe um erro
    $_SESSION['mensagem'] = "ID do prontuário não encontrado.";
    header("Location: prontuarios.php"); // Página de redirecionamento
    exit;
}

// Fechar a conexão
$conn->close();
?>
