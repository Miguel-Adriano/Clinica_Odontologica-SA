<?php

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Clinica_Odontologica";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];

    // Validação simples (pode ser expandida conforme necessário)
    if (!empty($nome) && !empty($descricao) && !empty($valor)) {
        // Prepara o SQL para inserir os dados na tabela
        $sql = "INSERT INTO servicos (nome, descricao, valor) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $nome, $descricao, $valor); // "ssd" indica string, string, e decimal

        // Executa o comando
        if ($stmt->execute()) {
            echo '<script>alert("Serviço cadastrado com sucesso!"); window.location.href = "Servicos.php";</script>';
        } else {
            echo '<script>alert("Erro ao cadastrar serviço: ' . $stmt->error . '");</script>';
        }

        // Fecha a conexão
        $stmt->close();
    } else {
        echo '<script>alert("Preencha todos os campos!");</script>';
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/Clinica_Odontologica/admin/Styles/homeadm.css">

    <title>Cadastro de Serviço</title>
    <style>
        /* Estilo geral do formulário */
form {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Estilo para o título e rótulos */
form h2 {
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #333;
}

label {
    font-size: 1rem;
    font-weight: 600;
    color: #555;
    margin-bottom: 8px;
    display: block;
}

/* Estilo para os campos de entrada */
.form-input {
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-sizing: border-box;
    margin-bottom: 20px;
    transition: border 0.3s ease;
}

.form-input:focus {
    outline: none;
    border-color: #4CAF50;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
}



/* Estilo para o botão de envio */
button {
  height: 40px;
  width: 100%;
  color: #000;
  font-size: 1rem;
  font-weight: 400;
  margin-top: 15px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s ease;
  background: #3494ee;
}

button:hover {
  background: #91bcfa;
}


.service-button {
    display: inline-block;
    padding: 10px 20px;
    border: 1px solid #333;
    border-radius: 20px;
    text-decoration: none;
    color: #333;
    font-size: 0.9rem;
    font-weight: bold;
    transition: all 0.3s ease;
}


    </style>
</head>
<body>
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Administrador</a></span>

            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#"></a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>

                <ul class="nav-links">
                <li><a href="Ver_Agendamentos.php">Agendamentos</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="Servicos.php">Serviços</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="../Tela_Admin/Funcionarios/Alteração_Funcionario.php">Funcionarios</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="../Tela_Admin/Funcionarios/Alteração_Cliente.php">Clientes</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>
<br><br><br><br>
<center><h1>Adicionar novo Serviço</h1></center>
    <section>
    <center><div>
    <a href="Servicos.php" class="service-button" style="background-color: white">Voltar</a>

    <br>
                   
    </div></center>
    <br>
        <form method="POST" action="cadastrar_servico.php">
            <div class="form-group">
                <label for="nome">Nome do Serviço</label>
                <input type="text" id="nome" name="nome" class="form-input" required placeholder="Serviço" >
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-input" required placeholder="Descrição" ></textarea>
            </div>

            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="number" id="valor" name="valor" class="form-input" required step="0.01" min="0" placeholder="R$">
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Serviço</button>
            
        </form>
    </section>
</body>
</html>
