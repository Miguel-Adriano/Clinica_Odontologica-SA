<?php
// Conexão com o banco de dados
$id = isset($_GET['id']) ? $_GET['id'] : '';
$conn = new mysqli("localhost", "root", "", "clinica_odontologica");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para obter os dados do prontuário
$sql = "SELECT * FROM prontuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
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
    <title>Editar Prontuário</title>
    <!-- <link rel="stylesheet" href="css/consulta.css"> -->
    <link rel="stylesheet" href="css/prontuario.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Styles/homeadm.css">
    <style>
        /* Mesma estilização do layout anterior */
        /* Adicione aqui as estilizações do seu arquivo CSS */
    </style>
</head>
<body>
<nav>
    <div class="nav-bar">
        <i class='bx bx-menu sidebarOpen'></i>
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
    <h2>Editar Prontuário</h2>
    <form action="atualizar_prontuario.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

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
                <select name="uso_anestesia">
            <option value="Sim" <?php echo ($row['uso_anestesia'] == 'sim') ? 'selected' : ''; ?>>Sim</option>
            <option value="Não" <?php echo ($row['uso_anestesia'] == 'nao') ? 'selected' : ''; ?>>Não</option>
        </select>
            </div>
        </div>

        <div class="examination-group">
            <div>
                <label for="sangramento">Teve Sangramento:</label>
                <select name="sangramento">
            <option value="Sim" <?php echo ($row['sangramento'] == 'sim') ? 'selected' : ''; ?>>Sim</option>
            <option value="Não" <?php echo ($row['sangramento'] == 'nao') ? 'selected' : ''; ?>>Não</option>
        </select>
            </div>
            <div>
                <label for="alergia">Alergia:</label>
                <select name="alergia">
            <option value="Sim" <?php echo ($row['alergia'] == 'sim') ? 'selected' : ''; ?>>Sim</option>
            <option value="Não" <?php echo ($row['alergia'] == 'nao') ? 'selected' : ''; ?>>Não</option>
        </select>
            </div>
        </div>

        <div class="examination-group">
            <div>
                <label for="alergia_qual">Qual Alergia?</label>
                <input type="text" name="alergia_qual" value="<?php echo htmlspecialchars($row['alergia_qual']); ?>" >
            </div>
        </div>

        <div class="examination-group">
            <div class="checkbox-group">
                <label><input type="checkbox" name="doenca_metabolica" <?php echo $row['doenca_metabolica'] == 'Sim' ? 'checked' : ''; ?>> Doença Metabólica</label>
                <label><input type="checkbox" name="doenca_cardiaca" <?php echo $row['doenca_cardiaca'] == 'Sim' ? 'checked' : ''; ?>> Doença Cardíaca</label>
                <label><input type="checkbox" name="doenca_respiratoria" <?php echo $row['doenca_respiratoria'] == 'Sim' ? 'checked' : ''; ?>> Doença Respiratória</label>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" name="doenca_vascular" <?php echo $row['doenca_vascular'] == 'Sim' ? 'checked' : ''; ?>> Doença Vascular</label>
                <label><input type="checkbox" name="doenca_neurologica" <?php echo $row['doenca_neurologica'] == 'Sim' ? 'checked' : ''; ?>> Doença Neurológica</label>
                <label><input type="checkbox" name="doenca_gastrointestinal" <?php echo $row['doenca_gastrointestinal'] == 'Sim' ? 'checked' : ''; ?>> Doença Gastrointestinal</label>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" name="doenca_visual" <?php echo $row['doenca_visual'] == 'Sim' ? 'checked' : ''; ?>> Doença Visual</label>
                <label><input type="checkbox" name="doenca_endocrina" <?php echo $row['doenca_endocrina'] == 'Sim' ? 'checked' : ''; ?>> Doença Endócrina</label>
                <label><input type="checkbox" name="diabetes" <?php echo $row['diabetes'] == 'Sim' ? 'checked' : ''; ?>> Diabetes</label>
            </div>
            <div class="checkbox-group">
                <label><input type="checkbox" name="hipertensao" <?php echo $row['hipertensao'] == 'Sim' ? 'checked' : ''; ?>> Hipertensão</label>
                <label><input type="checkbox" name="neoplasias" <?php echo $row['neoplasias'] == 'Sim' ? 'checked' : ''; ?>> Neoplasias</label>
            </div>
        </div>

        <div class="examination-group">
            <div>
                <label for="higiene">Higiene:</label>
                <input type="text" name="higiene" value="<?php echo htmlspecialchars($row['higiene']); ?>" >
            </div>
            <div>
                <label for="tartaro">Tártaro:</label>
                <input type="text" name="tartaro" value="<?php echo htmlspecialchars($row['tartaro']); ?>" >
            </div>
        </div>

        <div class="examination-group">
            <div>
                <label for="gengiva">Gengiva:</label>
                <input type="text" name="gengiva" value="<?php echo htmlspecialchars($row['gengiva']); ?>" >
            </div>
        </div>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" ><?php echo htmlspecialchars($row['observacoes']); ?></textarea>

        <button type="submit" class="buttonEnviar">Salvar Alterações</button>
    </form>
</div>

</body>
</html>
