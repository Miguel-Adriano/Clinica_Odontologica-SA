<?php
session_start();
$id = $_SESSION['id'];

$servername = "localhost"; // Nome do servidor
$username = "root"; // Usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "Clinica_Odontologica"; // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar os dados do formulário
    $nome = $_POST['nome'] ?? null;
    $sexo = $_POST['sexo'] ?? null;
    $data_nascimento = $_POST['data_nascimento'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $rua = $_POST['rua'] ?? null;
    $numero_residencia = $_POST['numero_residencia'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $email = $_POST['email'] ?? null;

    // Iniciar a parte da consulta de atualização
    $set_clause = [];
    $params = [];
    $types = "";

    // Adicionar os campos alterados à consulta
    if ($nome !== null) {
        $set_clause[] = "nome = ?";
        $params[] = $nome;
        $types .= "s";
    }
    if ($sexo !== null) {
        $set_clause[] = "sexo = ?";
        $params[] = $sexo;
        $types .= "s";
    }
    if ($data_nascimento !== null) {
        $set_clause[] = "data_nascimento = ?";
        $params[] = $data_nascimento;
        $types .= "s";
    }
    if ($cpf !== null) {
        $set_clause[] = "cpf = ?";
        $params[] = $cpf;
        $types .= "s";
    }
    if ($estado !== null) {
        $set_clause[] = "estado = ?";
        $params[] = $estado;
        $types .= "s";
    }
    if ($cidade !== null) {
        $set_clause[] = "cidade = ?";
        $params[] = $cidade;
        $types .= "s";
    }
    if ($bairro !== null) {
        $set_clause[] = "bairro = ?";
        $params[] = $bairro;
        $types .= "s";
    }
    if ($rua !== null) {
        $set_clause[] = "rua = ?";
        $params[] = $rua;
        $types .= "s";
    }
    if ($numero_residencia !== null) {
        $set_clause[] = "numero_residencia = ?";
        $params[] = $numero_residencia;
        $types .= "s";
    }
    if ($cep !== null) {
        $set_clause[] = "cep = ?";
        $params[] = $cep;
        $types .= "s";
    }
    if ($telefone !== null) {
        $set_clause[] = "telefone = ?";
        $params[] = $telefone;
        $types .= "s";
    }
    if ($email !== null) {
        $set_clause[] = "email = ?";
        $params[] = $email;
        $types .= "s";
    }

    // Verificar se há algum campo a ser atualizado
    if (empty($set_clause)) {
        echo "<script>alert('Nenhum campo foi modificado.'); window.history.back();</script>";
        exit;
    }

    // Construir a consulta final
    $sql = "UPDATE pacientes SET " . implode(", ", $set_clause) . " WHERE id_paciente = ?";
    $params[] = $id;
    $types .= "i";  // O id é um inteiro

    // Preparar a consulta
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind dos parâmetros
        $stmt->bind_param($types, ...$params);

        // Executar a consulta
        if ($stmt->execute()) {
            echo "<script>alert('Dados atualizados com sucesso!'); window.location.href = 'Pesquisar_Cliente.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar os dados: {$stmt->error}'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Erro na preparação da consulta: {$conn->error}'); window.history.back();</script>";
    }
}

$conn->close();
?>