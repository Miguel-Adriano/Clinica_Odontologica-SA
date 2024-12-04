<?php
session_start();
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

$id_paciente = $_SESSION['id_paciente']; // Obter o id da sessão
$id_servico = isset($_GET['id_servico']) ? $_GET['id_servico'] : null;

$nome_servico = "Serviço não especificado";

if ($id_servico) {
    // Consultar o nome do serviço no banco de dados
    $sql = "SELECT nome FROM servicos WHERE id_servico = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_servico);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome_servico = $row['nome'];
    }
}

$horarios_ocupados = [];
$horarios_disponiveis = [];
$horarios = [
    '08:00:00', '08:30:00', '09:00:00', '09:30:00', '10:00:00', '10:30:00',
    '11:00:00', '11:30:00', '13:00:00', '13:30:00', '14:00:00', '14:30:00',
    '15:00:00', '15:30:00', '16:00:00', '16:30:00', '17:00:00', '17:30:00'
];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['data'])) {
    $data_escolhida = $_POST['data'];

    // Verificar se a data não é um fim de semana
    $dia_da_semana = date('N', strtotime($data_escolhida)); // 1 = segunda-feira, 7 = domingo
    if ($dia_da_semana == 6 || $dia_da_semana == 7) {
        header("Location: erro.php");
        exit;
    }

    // Consultar horários ocupados no mesmo dia para o mesmo serviço
$sql = "SELECT horario FROM agendamentos WHERE data_agendamento = ? AND id_servico = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $data_escolhida, $id_servico); // Certificando-se de usar o id_servico
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $horarios_ocupados[] = $row['horario']; // Adiciona os horários ocupados no mesmo dia e serviço
}

// Verificar se o paciente já tem um agendamento para o mesmo serviço e horário
$sql = "SELECT horario FROM agendamentos WHERE data_agendamento = ? AND id_servico = ? AND id_paciente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $data_escolhida, $id_servico, $id_paciente);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $horarios_ocupados[] = $row['horario']; // Adiciona os horários ocupados por este paciente no mesmo serviço e dia
}

// Remover horários ocupados para o mesmo dia e serviço
foreach ($horarios as $hora) {
    if (!in_array($hora, $horarios_ocupados)) {
        $horarios_disponiveis[] = $hora; // Apenas horários disponíveis para o serviço atual
    }
}
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Serviço</title>
    <link rel="stylesheet" href="css/agendar.css">
    <link rel="stylesheet" href="css/index.css">

    <style>
        .confirmar {
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
  
  .confirmar:hover {
    background: #91bcfa;
  }

  input[type="date"] {
    appearance: none; /* Remove o estilo nativo */
    -webkit-appearance: none; /* Remove o estilo no Chrome e Safari */
    height: 40px; /* Mantém a altura */
    width: 300px; /* Ajuste a largura para aumentar horizontalmente */
    color: #000;
    font-size: 1rem;
    font-weight: 400;
    margin-top: 15px;
    border: 2px solid #3494ee; /* Borda azul */
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    background: transparent; /* Fundo transparente */
    padding: 0 15px; /* Adiciona espaço interno */
}

input[type="date"]:focus {
    outline: none; /* Remove o contorno padrão do foco */
    box-shadow: 0 0 5px rgba(52, 148, 238, 0.7); /* Efeito de sombra azul ao focar */
}

/* Estilo para as opções de horário */
input[type="radio"] {
  margin-right: 10px;
  margin-bottom: 5px;
  cursor: pointer;
}

/* Estilo para horários disponíveis (verdes) */
input[type="radio"].disponivel + label {
  color: green;
  font-weight: bold;
}

/* Estilo para horários já ocupados (vermelhos) */
input[type="radio"].ocupado + label {
  color: red;
  font-weight: bold;
}

/* Estilo para o label (horários) */
label {
  cursor: pointer;
  font-size: 16px;
  margin-bottom: 5px;
}



/* Estilo geral das caixas de horário */
.horario-box {
    display: inline-block;
    margin: 5px;
    padding: 10px 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
    text-align: center;
    cursor: pointer;
}

.horario-box input[type="radio"] {
    display: none; /* Esconde o botão de rádio */
}

.horario-box label {
    font-size: 14px;
    font-weight: bold;
}

/* Estilo para horários disponíveis */
.horario-box.disponivel {
    background-color: #d4f8d4; /* Verde claro */
    border: 1px solid #8ecf8e;
    color: #2b7a2b;
}

.horario-box.disponivel:hover {
    background-color: #8ecf8e;
    color: white;
    border-color: #2b7a2b;
}
/* Estilo para horário selecionado */
.horario-box input[type="radio"]:checked + label {
    background-color: #d4e4f8; /* Verde claro */
    border: 1px solid #8eaacf;
    color: #2b5e7a;
    transition: all 0.3s ease; /* Suaviza as transições */
}

/* Estilo para horários ocupados */
.horario-box.ocupado {
    background-color: #f8d4d4; /* Vermelho claro */
    border: 1px solid #cf8e8e;
    color: #7a2b2b;
    opacity: 0.6;
    cursor: not-allowed; /* Aparece como não clicável */
}

.horario-box.ocupado label {
    pointer-events: none; /* Desabilita interação com o label */
}

/* Estilo para o botão "Confirmar Agendamento" */
.confirmar {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

.confirmar:hover {
    background-color: #0056b3;
}


        </style>


</head>
<body>
<header>
        <h1>Transforme seu sorriso</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="Servicos.php" class="active">Serviços</a>
            <a href="SobreNos.html">Quem somos</a>
            <a href="Contato.html">Contato</a>
            <a href="Ver_Agendamentos.php">Agendamentos</a>
        </nav>
        
    </header>
    <br><br>
    <center><h1>Agendar Serviço</h1>

<br>
    <!-- Exibir o nome do serviço que está sendo agendado -->
    <p>Você está agendando o serviço: <strong><?php echo htmlspecialchars($nome_servico); ?></strong></p>

<br><br>

<section class="container">
  <header>Escolha de Data</header>
  <form method="POST" action="">
  <div class="column">
    <div class="input-box">
      <label for="data">Escolha a data para o agendamento (somente dias úteis):</label><br>
      <br>
      <input style="width: 100px;" type="date" id="data" name="data" min="<?php echo date('Y-m-d'); ?>" required>
      <br>
      <button class="confirmar" type="submit">Verificar horários disponíveis</button>
    </div>
  </div>
</form>
 




<!-- JAVASCRIPT -->
<script src="js/cpf.js"></script>
<script src="js/telefone.js"></script>
<script src="js/cep.js"></script>

<script> //SCRIPT PARA LIMITAR A ESCOLHA DE DIA ATÉ 1 MÊS A PARTIR DO DIA ATUAL
  function setMaxDate() {
    var today = new Date();
    var maxDate = new Date(today);
    maxDate.setMonth(today.getMonth() + 1); // Adiciona 1 mês à data de hoje

    // Formata a data para o formato YYYY-MM-DD, que é o formato aceito pelo input de tipo "date"
    var year = maxDate.getFullYear();
    var month = (maxDate.getMonth() + 1).toString().padStart(2, '0'); // Adiciona 0 à esquerda se necessário
    var day = maxDate.getDate().toString().padStart(2, '0'); // Adiciona 0 à esquerda se necessário

    // Define o valor máximo no campo de data
    document.getElementById("data").setAttribute("max", year + '-' + month + '-' + day);
  }

  // Chama a função para definir o limite máximo de data assim que a página carregar
  window.onload = setMaxDate;
</script>

<div class="horarios-container">
    <br>
    <?php
        // Verifica se a data foi selecionada
        if (isset($data_escolhida) && !empty($data_escolhida)) {
            echo "<h2>Horários disponíveis para o dia: " . date('d/m/Y', strtotime($data_escolhida)) . "</h2>";
        } else {
            echo "<h2>Horários disponíveis para o dia:</h2>";
        }
    ?>

    <form method="POST" action="confirmar_agendamento.php">
        <input type="hidden" name="id_servico" value="<?php echo $id_servico; ?>">
        <input type="hidden" name="data_agendamento" value="<?php echo $data_escolhida; ?>">

        <?php
        // Renderizar os horários como caixas
        foreach ($horarios as $horario) {
            // Verifica se o horário está ocupado
            $class = in_array($horario, $horarios_ocupados) ? 'ocupado' : 'disponivel';

            echo "
                <div class='horario-box $class'>
                    <input type='radio' name='horario' value='$horario' id='$horario' class='radio-input' " . ($class == 'ocupado' ? 'disabled' : 'required') . ">
                    <label for='$horario'>$horario</label>
                </div>";
        }
        ?>

        <br>
        <button type="submit" class="confirmar">Confirmar Agendamento</button>
    </form>
</div>




</section>
</center>
    </body>
    </html>



