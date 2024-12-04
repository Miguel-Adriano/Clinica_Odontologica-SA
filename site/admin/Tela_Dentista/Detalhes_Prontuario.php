<?php
// Conexão com o banco de dados e consulta de dados do prontuário
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = new mysqli("localhost", "root", "", "clinica_odontologica");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM prontuarios WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Prontuário não encontrado.";
    exit;
}

// Consulta para obter o nome do tratamento (id_servico)
$sql_servico = "SELECT nome FROM servicos WHERE id_servico = ?";
$stmt_servico = $conn->prepare($sql_servico);
$stmt_servico->bind_param("i", $row['id_servico']);
$stmt_servico->execute();
$result_servico = $stmt_servico->get_result();
$servico = $result_servico->fetch_assoc();
$nome_servico = $servico['nome'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Prontuário</title>

    <link rel="stylesheet" href="css/prontuario.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Styles/homeadm.css">

    <style>

        @media print {
    /* Ajusta a página para uma largura padrão e remove as margens para maximizar o uso da página */
    body {
        font-size: 12px;
        line-height: 1.2;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }

    /* Ajusta o tamanho da fonte para otimizar o uso do espaço */
    h2 {
        font-size: 18px;
    }

    /* Define o layout para evitar o excesso de quebras */
    input[type="text"], textarea, select {
        font-size: 12px;
        padding: 4px;
        margin-bottom: 8px;
    }

    .checkbox-group label {
        font-size: 12px;
        margin-right: 5px;
    }

    /* Ajusta para garantir que o conteúdo caiba em uma página */
    @page {
        size: A4; /* Tamanho da página */
        margin: 10mm; /* Define as margens */
    }

    /* Força o conteúdo a caber em uma única página */
    .container {
        page-break-before: auto;
        page-break-after: auto;
    }

    /* Esconde o botão de gerar PDF na versão impressa */
    button {
        display: none;
    }
}
    </style>
</head>
<body>
<nav>
    <div class="nav-bar">
        <i class='bx bx-menu sidebarOpen' ></i>
        <span class="logo navLogo"><a href="#"></a></span>

     <div class="menu">
            <ul class="nav-links">
                <li><a href="Agendamentos.php">Agendamentos</a></li>
                <li><a href="Servicos.php" class="activate">Serviços</a></li>
                <li><a href="Clientes/Pesquisar_Cliente.php">Clientes</a></li>
                <li><a href="Prontuarios.php">Prontuários</a></li>
                <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
            </ul>
      
        </div>
    </div>
</nav>

<div class="container">
<br><br>
    <h2>Detalhes do Prontuário</h2>

        <div class="examination-group">
            <div>
                <label for="id_agendamento">ID do Agendamento:</label>
                <input type="text" name="id_agendamento" value="<?php echo htmlspecialchars($row['id_agendamento']); ?>" readonly>
            </div>
            <div>
                <label for="id_paciente">ID do Paciente:</label>
                <input type="text" name="id_paciente" value="<?php echo htmlspecialchars($row['id_paciente']); ?>" readonly>
            </div>
        </div>

        <div class="examination-group">
            <div>
            <label for="id_servico">Tratamento:</label>
                <input type="text" name="id_servico" value="<?php echo htmlspecialchars($nome_servico); ?>" readonly>
            </div>
            <div>
                <label for="uso_anestesia">Usou Anestesia:</label>
                <input type="text" name="uso_anestesia" value="<?php echo htmlspecialchars($row['uso_anestesia']); ?>" readonly>
            </div>
        </div>

        <div class="examination-group">
            <div>
                <label for="sangramento">Teve Sangramento:</label>
                <input type="text" name="sangramento" value="<?php echo htmlspecialchars($row['sangramento']); ?>" readonly>
            </div>
            <div>
                <label for="alergia">Alergia:</label>
                <input type="text" name="alergia" value="<?php echo htmlspecialchars($row['alergia']); ?>" readonly>
            </div>
        </div>

        <div class="examination-group">
            <div>
                <label for="alergia_qual">Qual Alergia?</label>
                <input type="text" name="alergia_qual" value="<?php echo htmlspecialchars($row['alergia_qual']); ?>" readonly>
            </div>
        </div>

        <div class="examination-group">
            <div class="checkbox-group">
                <label><input type="checkbox" disabled <?php echo $row['doenca_metabolica'] == 'Sim' ? 'checked' : ''; ?>> Doença Metabólica</label>
                <label><input type="checkbox" disabled <?php echo $row['doenca_cardiaca'] == 'Sim' ? 'checked' : ''; ?>> Doença Cardíaca</label>
                <label><input type="checkbox" disabled <?php echo $row['doenca_respiratoria'] == 'Sim' ? 'checked' : ''; ?>> Doença Respiratória</label>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" disabled <?php echo $row['doenca_vascular'] == 'Sim' ? 'checked' : ''; ?>> Doença Vascular</label>
                <label><input type="checkbox" disabled <?php echo $row['doenca_neurologica'] == 'Sim' ? 'checked' : ''; ?>> Doença Neurológica</label>
                <label><input type="checkbox" disabled <?php echo $row['doenca_gastrointestinal'] == 'Sim' ? 'checked' : ''; ?>> Doença Gastrointestinal</label>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" disabled <?php echo $row['doenca_visual'] == 'Sim' ? 'checked' : ''; ?>> Doença Visual</label>
                <label><input type="checkbox" disabled <?php echo $row['doenca_endocrina'] == 'Sim' ? 'checked' : ''; ?>> Doença Endócrina</label>
                <label><input type="checkbox" disabled <?php echo $row['diabetes'] == 'Sim' ? 'checked' : ''; ?>> Diabetes</label>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" disabled <?php echo $row['hipertensao'] == 'Sim' ? 'checked' : ''; ?>> Hipertensão</label>
                <label><input type="checkbox" disabled <?php echo $row['neoplasias'] == 'Sim' ? 'checked' : ''; ?>> Neoplasias</label>
            </div>
        </div>

        <div class="examination-group">
            <div>
                <label for="higiene">Higiene:</label>
                <input type="text" name="higiene" value="<?php echo htmlspecialchars($row['higiene']); ?>" readonly>
            </div>
            <div>
                <label for="tartaro">Tártaro:</label>
                <input type="text" name="tartaro" value="<?php echo htmlspecialchars($row['tartaro']); ?>" readonly>
            </div>
        </div>

        <div class="examination-group">
            <div>
                <label for="gengiva">Gengiva:</label>
                <input type="text" name="gengiva" value="<?php echo htmlspecialchars($row['gengiva']); ?>" readonly>
            </div>
        </div>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" readonly><?php echo htmlspecialchars($row['observacoes']); ?></textarea>

        <button class="buttonEnviar" onclick="gerarPDF()">Gerar PDF</button>



        <script>
function gerarPDF() {
    // Abrir a caixa de diálogo de impressão
    window.print();
}
</script>

</div>

</body>
</html>
