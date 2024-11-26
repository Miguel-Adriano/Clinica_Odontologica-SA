<?php
// Iniciar a sessão
session_start();
$id_servico = $_SESSION['id_servico']; // Obter o id da sessão
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

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $rua = $_POST['rua'];
    $numero_residencia = $_POST['numero_residencia'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];

    // Verificar se o paciente já existe (usando CPF ou Email como chave única)
    $sql_check = "SELECT id_paciente FROM pacientes WHERE cpf = ?";
    if ($stmt_check = $conn->prepare($sql_check)) {
        $stmt_check->bind_param("s", $cpf);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // Se já existe, obter o id_paciente
            $stmt_check->bind_result($id_paciente);
            $stmt_check->fetch();

            // Salvar o id_paciente na sessão
            $_SESSION['id_paciente'] = $id_paciente;
            header ("Location: agendar2.php?id_servico=$id_servico");
        } else {
            // Se não existe, fazer o cadastro
            $sql_insert = "INSERT INTO pacientes (nome, telefone, data_nascimento, email, cpf, sexo, rua, numero_residencia, estado, cidade, bairro, cep)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            if ($stmt_insert = $conn->prepare($sql_insert)) {
                $stmt_insert->bind_param("ssssssssssss", $nome, $telefone, $data_nascimento, $email, $cpf, $sexo, $rua, $numero_residencia, $estado, $cidade, $bairro, $cep);
                
                if ($stmt_insert->execute()) {
                    // Obter o id_paciente após o insert
                    $id_paciente = $stmt_insert->insert_id;

                    // Salvar o id_paciente na sessão
                    $_SESSION['id_paciente'] = $id_paciente;


                    header ("Location: agendar2.php?id_servico=$id_servico");

                } else {
                    echo "Erro ao registrar o paciente: " . $stmt_insert->error;
                }

                $stmt_insert->close();
            }
        }

        $stmt_check->close();
    }

    // Fechar a conexão
    $conn->close();
}
?>