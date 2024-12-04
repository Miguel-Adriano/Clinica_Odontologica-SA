<?php 
session_start(); // Inicia a sessão

// Verifica se o ID foi passado na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $_SESSION['id'] = (int) $_GET['id']; // Armazena o ID na sessão
} elseif (!isset($_SESSION['id'])) {
    die('ID não fornecido ou inválido.');
}

// O ID estará disponível em $_SESSION['id']
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/CLFuncionario.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/FontFuncionario.css">
        
    <!-- ===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== Tabela CSS ===== -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/editar_funcionario.css">
    <title>Editar Funcionario</title>


</head>
<body>
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Funcionarios</a></span>

            <div class="menu">
                

                <ul class="nav-links">
                <li><a href="/Clinica_Odontologica/admin/Tela_Admin/Ver_Agendamentos.php">Agendamentos</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="/Clinica_Odontologica/admin/Tela_Admin/Servicos.php">Serviços</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="../Funcionarios/Alteração_Funcionario.php">Funcionarios</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="../Clientes/Alteração_Cliente.php">Clientes</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="/Clinica_Odontologica/admin/Tela_Admin/sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>



<br><br><br><br>


<?php
// Obtém o ID da URL e valida
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Conexão com o banco de dados
try {
    $pdo = new PDO('mysql:host=localhost;dbname=Clinica_Odontologica', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}



if ($id <= 0) {
    die("ID inválido ou não fornecido.");
}

// Obtém os dados do funcionário com base no ID
$sql = "SELECT * FROM funcionarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$funcionario) {
    die("Funcionário não encontrado!");
}


?>
<form action="Edita.php" method="POST">
    <div class="funcionario-profile py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-transparent text-center">
                            
                            <h3><?php echo htmlspecialchars($funcionario['nome']); ?></h3>
                        </div>
                        <div class="card-body">
                            <p class="mb-0"><strong class="pr-1">Funcionario
                                    ID:</strong><?php echo htmlspecialchars($funcionario['id']); ?></p>
                            <p class="mb-0"><strong
                                    class="pr-1">Cargo:</strong><?php echo htmlspecialchars($funcionario['cargo']); ?>
                            </p>
                            <p class="mb-0"><strong
                                    class="pr-1">Acesso:</strong><?php echo htmlspecialchars($funcionario['nivel']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-transparent border-0">
                            <h3 class="mb-0">
                                <img src="img/copy.png" alt="Informações Gerais"
                                    style="width: 20px; height: 20px; vertical-align: middle;" />
                                Informações Gerais
                            </h3>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Nome</th>
                                    <td width="2%">:</td>
                                    <td><input style="all: unset; width: 500px;" type="text" id="nome" name="nome"
                                            value="<?= htmlspecialchars($funcionario['nome']); ?>" required></td>
                                </tr>
                                <tr>
                                    <th width="30%">Sexo</th>
                                    <td width="2%">:</td>
                                    <td><input style="all: unset; width: 500px;" type="text" id="sexo" name="sexo"
                                            value="<?= htmlspecialchars($funcionario['sexo']); ?>" required></td>
                                </tr>
                                <tr>
                                    <th width="30%">Data de Nascimento</th>
                                    <td width="2%">:</td>
                                    <td><input style="all: unset; width: 500px;" type="date" id="data_nascimento"
                                            name="data_nascimento"
                                            value="<?= htmlspecialchars($funcionario['data_nascimento']); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">CPF</th>
                                    <td width="2%">:</td>
                                    <td><input style="all: unset; width: 500px;" type="text" id="cpf" name="cpf"
                                            value="<?= htmlspecialchars($funcionario['cpf']); ?>" required></td>
                                </tr>

                                <tr>
                                    <th width="30%">Senha</th>
                                    <td width="2%">:</td>
                                    <td><input style="all: unset; width: 500px;" type="text" id="senha" name="senha"
                                            value="<?= htmlspecialchars($funcionario['senha']); ?>" required></td>
                                </tr>
                                <tr>
                                    <th width="30%">Estado</th>
                                    <td width="2%">:</td>
                                    <td>
                                        <input style="all: unset; width: 500px;" type="text" id="estado" name="estado"
                                            value="<?= htmlspecialchars($funcionario['estado']); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">Cidade</th>
                                    <td width="2%">:</td>
                                    <td>
                                        <input style="all: unset; width: 500px;" type="text" id="cidade" name="cidade"
                                            value="<?= htmlspecialchars($funcionario['cidade']); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">Bairro</th>
                                    <td width="2%">:</td>
                                    <td>
                                        <input style="all: unset; width: 500px;" type="text" id="bairro" name="bairro"
                                            value="<?= htmlspecialchars($funcionario['bairro']); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">Rua</th>
                                    <td width="2%">:</td>
                                    <td>
                                        <input style="all: unset; width: 500px;" type="text" id="rua" name="rua"
                                            value="<?= htmlspecialchars($funcionario['rua']); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">Número da Residência</th>
                                    <td width="2%">:</td>
                                    <td>
                                        <input style="all: unset; width: 500px;" type="text" id="numero_residencia"
                                            name="numero_residencia"
                                            value="<?= htmlspecialchars($funcionario['numero_residencia']); ?>"
                                            required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">CEP</th>
                                    <td width="2%">:</td>
                                    <td>
                                        <input style="all: unset; width: 500px;" type="text" id="cep" name="cep"
                                            value="<?= htmlspecialchars($funcionario['cep']); ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">Telefone</th>
                                    <td width="2%">:</td>
                                    <td>
                                        <input style="all: unset; width: 500px;" type="text" id="telefone"
                                            name="telefone" value="<?= htmlspecialchars($funcionario['telefone']); ?>"
                                            required>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%">E-mail</th>
                                    <td width="2%">:</td>
                                    <td>
                                        <input style="all: unset; width: 500px;" type="email" id="email" name="email"
                                            value="<?= htmlspecialchars($funcionario['email']); ?>" required>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                    
            </div>
        </div>
    </div>
    <center><button type="submit">Atualizar</button></center>
</form>

</body>
</html>