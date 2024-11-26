<?php

$nomeservidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "clinica_odontologica";

// O CODIGO ABAIXO CRIA A CONEXAO 
$conn = mysqli_connect($nomeservidor, $usuario, $senha, $bancodedados);

session_start();
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Recebe os valores do POST
$nome = $_POST['nome'];
$sexo = $_POST['sexo'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$data = $_POST['data'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$numre = $_POST['numre'];
$cep = $_POST['cep'];
$telefone = $_POST['telefone'];

// Corrige a acentuação
$conn->set_charset("utf8");

// Verifica se o CPF ou o e-mail já existem no banco de dados
$sql_check = "SELECT * FROM `pacientes` WHERE `cpf` = '$cpf' OR `email` = '$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Se já existir, exibe uma mensagem de erro e interrompe o processo
    echo "<script>
            alert('Paciente com esse CPF ou E-mail já cadastrado.');
            window.location.href = 'Pesquisar_Cliente.php'; // Redireciona para o formulário
          </script>";
    exit; // Interrompe a execução
} else {
    // Se não existir, insere o novo registro
    $sql = "INSERT INTO `pacientes` 
            (`nome`, `sexo`, `data_nascimento`, `cpf`, `estado`, `cidade`, `bairro`, `rua`, `numero_residencia`, `cep`, `telefone`, `email`) 
            VALUES 
            ('$nome', '$sexo', '$data', '$cpf', '$estado', '$cidade', '$bairro', '$rua', '$numre', '$cep', '$telefone', '$email')";

    if (!$conn->query($sql)) {
        die("Erro ao executar a consulta, favor consultar a administração: " . $conn->error);
    } else {
        echo "<script>
                alert('Registro adicionado com sucesso!');
                window.location.href = 'Pesquisar_Cliente.php'; // Redireciona para a página de pesquisa
              </script>";
        exit; // Garante que o script PHP encerre após o redirecionamento
    }
}

?>
