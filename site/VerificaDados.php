<?php
// LOGIN1.php
session_start();
// EVITA QUE A PÁGINA SEJA ARMAZENADA EM CACHE
header("Cache-Control: no-cache, no-store, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: 0"); //Proxies

// CONEXAO COM O BANCO DE DADOS
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica_odontologica";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    header("Location: index.php?msg=1");
    exit();
}

$email = $_POST['email'];
$senha = $_POST['senha'];


// CONSULTA SQL PARA VERIFICAR O EMAIL E SENHA
$sql = "SELECT SUBSTRING_INDEX(nome, ' ', 1) AS primeiro_nome, nivel FROM funcionarios WHERE email='$email' AND senha = MD5('$senha')";

$result = $conn->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nivel = $row['nivel'];
    $_SESSION['primeiro_nome'] = $row['primeiro_nome'];
    
     if ($nivel == 1) {
        header("Location: admin/Tela_Admin/Ver_Agendamentos.php");
    } elseif ($nivel == 2) {
        header("Location: admin/Tela_Secretaria/Home.php");
    } elseif ($nivel == 3) {
        header("Location: admin/Tela_Dentista/Agendamentos.php");
    }
} else {
    echo $sql;
    echo "<script>alert('Usuario ou senha incorretos!'); window.location.href = 'index.html';</script>";
}
$conn->close();
?>