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
$senha = md5($_POST['senha']);
$email = $_POST['email'];
$data = $_POST['data'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$numre = $_POST['numre'];
$cep = $_POST['cep'];
$telefone = $_POST['telefone'];
$cargo = $_POST['cargo'];
$acesso = $_POST['acesso'];

// Corrige a acentuação
$conn->set_charset("utf8");

// Consulta SQL diretamente com os valores
$sql = "INSERT INTO `clinica_odontologica`.`funcionarios` 
(`nome`, `sexo`, `data_nascimento`, `cpf`, `senha`, `estado`, `cidade`, 
`bairro`, `rua`, `numero_residencia`, `cep`, `telefone`, `email`, `cargo`, `nivel`) 
VALUES 
('$nome', '$sexo', '$data', '$cpf', '$senha','$estado', '$cidade', '$bairro', '$rua', '$numre', '$cep', 
'$telefone', '$email', '$cargo', '$acesso');";

// Executa a query diretamente
if (!$conn->query($sql)) {
    die("Erro ao executar a consulta, favor consultar a administração: " . $conn->error);
} else {
    echo "<script>
            alert('Registro adicionado com sucesso!');
            window.location.href = 'Pesquisar_Funcionario.php';
          </script>";
    exit; // Garante que o script PHP encerre após o redirecionamento
}
?>

