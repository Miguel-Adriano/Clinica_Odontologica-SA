<?php
session_start();
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

// Variáveis para armazenar os resultados
$agendamentos_hoje = [];

// Verificar se a atualização de status foi solicitada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id_agendamento = $_POST['id_agendamento'];
    $novo_status = $_POST['status'];

    // Atualizar o status do agendamento
    $sql_update = "UPDATE agendamentos SET status = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql_update)) {
        $stmt->bind_param("si", $novo_status, $id_agendamento);
        if ($stmt->execute()) {
            $success_message = "Status atualizado com sucesso.";
        } else {
            $error_message = "Erro ao atualizar o status.";
        }
        $stmt->close();
    }
}

// Consultar agendamentos do dia atual
$sql_hoje = "SELECT 
                agendamentos.id, 
                agendamentos.data_agendamento, 
                agendamentos.horario, 
                pacientes.nome AS paciente_nome, 
                pacientes.cpf, 
                servicos.nome AS servico_nome, 
                servicos.valor, 
                agendamentos.status
            FROM agendamentos
            JOIN pacientes ON agendamentos.id_paciente = pacientes.id_paciente
            JOIN servicos ON agendamentos.id_servico = servicos.id_servico
            WHERE agendamentos.data_agendamento = CURDATE()";

$result_hoje = $conn->query($sql_hoje);

if ($result_hoje && $result_hoje->num_rows > 0) {
    while ($row = $result_hoje->fetch_assoc()) {
        $agendamentos_hoje[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Styles/homeadm.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Tela_Admin/css/ver_agendamentos.css">
    <title>Agendamentos - Secretário</title>
    <style>
        /* Estilo do campo select */
select {
    background-color: #fff;
    border: 2px solid #ccc;
    border-radius: 5px;
    padding: 8px 16px;
    font-size: 14px;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 160px; /* Define uma largura mais atraente */

}

/* Estilo do fundo do select para parecer um botão */
select:hover {
    border-color: #4c7aaf;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
}

/* Adicionando uma seta personalizada */
select::-ms-expand {
    display: none;
}

select::after {
    content: ' ▼';
    font-size: 16px;
    margin-left: 10px;
}

/* Colocando a seta ao lado do select */
select {
    padding-right: 30px;
}

/* Definindo a cor de fundo para cada valor */
select.realizar {
    background-color: #FFF9C4; /* Amarelo claro */
}

select.pendente {
    background-color: #FFCDD2; /* Vermelho claro */
}

select.concluida {
    background-color: #C8E6C9; /* Verde claro */
}



    </style>
</head>
<body>
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen'></i>
            <span class="logo navLogo"><a href="#">Secretario - Home</a></span>

            <div class="menu">
                <ul class="nav-links">
                    <li><a href="Home.php">Home</a></li>    
                    <li><a href="Agendamentos.php">Agendamentos</a></li>
                    <li><a href="Servicos.php" class="activate">Serviços</a></li>
                    <li><a href="Clientes/Alteração_Cliente.php">Clientes</a></li>
                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
<br><br><br><br><br>
<div class="container">
        
        <h2>Agendamentos para Hoje:</h2>

        <?php if (!empty($agendamentos_hoje)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Nome do Paciente</th>
                        <th>CPF</th>
                        <th>Consulta</th>
                        <th>Valor</th>
                        <th>Status</th>
        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agendamentos_hoje as $agendamento): ?>
                        <tr>
                            <td><?php echo date("d/m/Y", strtotime($agendamento['data_agendamento'])); ?></td>
                            <td><?php echo $agendamento['horario']; ?></td>
                            <td><?php echo $agendamento['paciente_nome']; ?></td>
                            <td><?php echo $agendamento['cpf']; ?></td>
                            <td><?php echo $agendamento['servico_nome']; ?></td>
                            <td>R$ <?php echo $agendamento['valor']; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id_agendamento" value="<?php echo $agendamento['id']; ?>">
                                    <select name="status" onchange="mudarCorSelect(this)">
                                        <option value="A Realizar" <?php echo $agendamento['status'] === 'A Realizar' ? 'selected' : ''; ?>>A Realizar</option>
                                        <option value="Atrasada" <?php echo $agendamento['status'] === 'Atrasada' ? 'selected' : ''; ?>>Atrasada</option>
                                        <option value="Concluída" <?php echo $agendamento['status'] === 'Concluída' ? 'selected' : ''; ?>>Concluída</option>
                                    </select>
                                    <button type="submit" name="update_status">Atualizar</button>
                                </form>
                            </td>
                         
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum agendamento encontrado para hoje.</p>
        <?php endif; ?>
    </div>
<script>
    function mudarCorSelect(select) {
    const value = select.value;

    // Remover todas as classes de status
    select.classList.remove('realizar', 'pendente', 'concluida');

    // Adicionar a classe correspondente ao valor selecionado
    if (value === 'A Realizar') {
        select.classList.add('realizar');
    } else if (value === 'Atrasada') {
        select.classList.add('pendente');
    } else if (value === 'Concluída') {
        select.classList.add('concluida');
    }
}

window.onload = function() {
    const selects = document.querySelectorAll('select');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            mudarCorSelect(select);
        });

        // Mudar a cor ao carregar a página
        mudarCorSelect(select);
    });
}
</script>


</body>
</html>
