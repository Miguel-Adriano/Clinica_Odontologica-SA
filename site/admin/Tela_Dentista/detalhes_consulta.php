<?php
// Verifique se o id_agendamento e id_paciente foram passados corretamente
$id_agendamento = isset($_GET['id_agendamento']) ? $_GET['id_agendamento'] : '';
$id_paciente = isset($_GET['id_paciente']) ? $_GET['id_paciente'] : '';

// Conecte ao banco de dados
$conn = new mysqli("localhost", "root", "", "clinica_odontologica");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Busca os serviços disponíveis
$query_servicos = "SELECT id_servico, nome FROM servicos";
$result_servicos = $conn->query($query_servicos);
$servicos = [];
if ($result_servicos->num_rows > 0) {
    while ($row = $result_servicos->fetch_assoc()) {
        $servicos[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prontuário Odontológico</title>
    <link rel="stylesheet" href=".css/consulta.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Styles/homeadm.css">

    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

.container {
    width: 100%;
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

h2 {
    text-align: center;
    color: #46a6f6;
    font-size: 24px;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"], input[type="radio"], input[type="checkbox"], select, textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="radio"], input[type="checkbox"] {
    width: auto;
    margin-right: 8px;
}

input[type="text"]:focus, select:focus, textarea:focus {
    border-color: #46a6f6;
    outline: none;
}

.buttonEnviar {
    background-color: #46a6f6;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

.buttonEnviar:hover {
    background-color: #4c7aaf;
}

.buttonApagar {
    background-color: #f64f46;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

.buttonApagar:hover {
    background-color: #af4e4c;
}

.examination-group {
    display: flex;
    justify-content: space-between;
    gap: 30px;
    flex-wrap: wrap;
    width: 100%;
}

.examination-group > div {
    flex: 1 1 48%;
    display: flex;
    flex-direction: column;
}

.examination-group > div label {
    margin-bottom: 6px;
}

.checkbox-group label {
    display: block;
}

@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    h2 {
        font-size: 20px;
    }

    .examination-group > div {
        flex: 1 1 100%;
    }

    button {
        width: 100%;
    }
}



    </style>

</head>
<body>
<nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Dentista - Prontuario</a></span>

            <div class="menu">


                <ul class="nav-links">


                    <li><a href="Agendamentos.php">Agendamentos</a></li>

                    <li><a href="Servicos.php" class="activate">Serviços</a></li>

                    <li><a href="Clientes.php">Clientes</a></li>

                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>
<br><br><br><br><br>
    <div class="container">
        <h2>Prontuário Odontológico</h2>
        <form action="processar_insercao.php" method="POST">
            <!-- ID do Agendamento -->
            <label for="id_agendamento">ID do Agendamento:</label>
            <input type="text" name="id_agendamento" value="<?php echo htmlspecialchars($id_agendamento); ?>" readonly><br>

            <!-- ID do Paciente -->
            <label for="id_paciente">ID do paciente:</label>
            <input type="text" name="id_paciente" value="<?php echo htmlspecialchars($id_paciente); ?>" readonly><br>

            <!-- Tratamento -->
            <label for="id_servico">Tratamento:</label>
            <select name="id_servico" required>
                <option value="">Selecione um serviço</option>
                    <?php foreach ($servicos as $servico): ?>
                <option value="<?php echo htmlspecialchars($servico['id_servico']); ?>">
                    <?php echo htmlspecialchars($servico['nome']); ?>
                </option>
                    <?php endforeach; ?>
            </select><br>

            <!-- Usou Anestesia -->
            <label for="uso_anestesia">Usou Anestesia:</label>
            <select name="uso_anestesia">
                <option value="sim">Sim</option>
                <option value="nao" selected>Não</option>
            </select><br>

            <!-- Sangramento -->
            <label for="sangramento">Teve Sangramento:</label>
            <select name="sangramento" required>
                <option value="sim">Sim</option>
                <option value="nao" selected>Não</option>
            </select><br>

            <!-- Alergia -->
            <label for="alergia">Alergia:</label>
            <select name="alergia" required>
                <option value="sim">Sim</option>
                <option value="nao" selected>Não</option>
            </select><br>

            <label for="alergia_qual">Qual Alergia?</label>
            <input type="text" name="alergia_qual"><br>

            <!-- Doenças -->
    <div class="disease-group">
        <br>
        <label for="doencas">Possui doença?</label>
        <br><br>
        <div class="checkbox-group">
            <label for="doenca_metabolica">
                <input type="checkbox" name="doenca_metabolica" value="sim"> Doença Metabólica
            </label>
            <label for="doenca_cardiaca">
                <input type="checkbox" name="doenca_cardiaca" value="sim"> Doença Cardíaca
            </label>
            <label for="doenca_respiratoria">
                <input type="checkbox" name="doenca_respiratoria" value="sim"> Doença Respiratória
            </label>
            <label for="doenca_vascular">
                <input type="checkbox" name="doenca_vascular" value="sim"> Doença Vascular
            </label>
            <label for="doenca_neurologica">
                <input type="checkbox" name="doenca_neurologica" value="sim"> Doença Neurológica
            </label>
            <label for="doenca_gastrointestinal">
                <input type="checkbox" name="doenca_gastrointestinal" value="sim"> Doença Gastrointestinal
            </label>
            <label for="doenca_visual">
                <input type="checkbox" name="doenca_visual" value="sim"> Doença Visual
            </label>
            <label for="doenca_endocrina">
                <input type="checkbox" name="doenca_endocrina" value="sim"> Doença Endócrina
            </label>

        </div>
    </div>


            <!-- Exame Clínico -->
            <div class="examination-group">
                <div>
                    <label for="higiene">Higiene:</label>
                    <select name="higiene" required>
                        <option value="normal">Normal</option>
                        <option value="boa">Boa</option>
                        <option value="ausente">Ausente</option>
                    </select><br>

                    <label for="tartaro">Tártaro:</label>
                    <select name="tartaro" required>
                        <option value="ausente">Ausente</option>
                        <option value="pouco">Pouco</option>
                        <option value="muito">Muito</option>
                    </select><br>

                    <label for="gengiva">Gengiva:</label>
                    <select name="gengiva" required>
                        <option value="normal">Normal</option>
                        <option value="gengivite">Gengivite</option>
                        <option value="periodontite">Periodontite</option>
                    </select><br>
                </div>

                <div>
                    <label for="observacoes">Observações:</label>
                    <textarea name="observacoes"></textarea><br>
                </div>
            </div>

            <button class="buttonEnviar" type="submit" onclick="return confirmarConsulta();">Confirmar Consulta</button>


            <h6 style="color:white">.</h6>
            <button class="buttonApagar" type="reset">Apagar</button>
        </form>
    </div>

    
<script>
    function confirmarConsulta() {
        // Exibe a caixa de diálogo de confirmação
        var confirmacao = confirm("Tem certeza que deseja confirmar a consulta?");
        
        // Se o usuário clicar em "OK", o formulário será enviado
        if (confirmacao) {
            return true; // O formulário é enviado
        } else {
            return false; // O envio do formulário é cancelado
        }
    }
</script>
</body>
</html>