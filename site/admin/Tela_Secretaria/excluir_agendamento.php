<?php
session_start();

// Configurações do banco de dados
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

// Verificar se o ID do agendamento foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_agendamento'])) {
    $id_agendamento = $_POST['id_agendamento'];

    // Excluir o agendamento
    $sql = "DELETE FROM agendamentos WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id_agendamento);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Agendamento excluído com sucesso.');
                    window.location.href = 'Agendamentos.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao excluir o agendamento.');
                    window.location.href = 'Agendamentos.php';
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Erro ao preparar a exclusão.');
                window.location.href = 'Agendamentos.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Nenhum agendamento selecionado.');
            window.location.href = 'Agendamentos.php';
          </script>";
}

$conn->close();
?>
