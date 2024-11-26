<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica_odontologica";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recuperar o ID do serviço da URL
session_start();
$id_servico = isset($_GET['id_servico']) ? $_GET['id_servico'] : null;


$_SESSION['id_servico'] = $id_servico; // Armazena o id_servico na sessão


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
    } else {
        $nome_servico = "Serviço não encontrado";
    }
} else {
    $nome_servico = "Serviço não especificado";
}

$conn->close();

// Verificar se a data foi enviada pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['data'])) {
    $data_escolhida = $_POST['data'];

    // Verificar se a data não é um fim de semana
    $dia_da_semana = date('N', strtotime($data_escolhida)); // 1 = segunda-feira, 7 = domingo
    if ($dia_da_semana == 6 || $dia_da_semana == 7) {
        echo "Por favor, escolha um dia útil (segunda a sexta-feira).";
        exit;
    }

    // Consultar horários ocupados no mesmo dia
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT horario FROM agendamentos WHERE data_agendamento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $data_escolhida);
    $stmt->execute();
    $result = $stmt->get_result();

    $horarios_ocupados = [];
    while ($row = $result->fetch_assoc()) {
        $horarios_ocupados[] = $row['horario'];
    }

    // Definir os horários disponíveis
    $horarios_disponiveis = [];
    $horarios = [
        '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
        '11:00', '11:30', '13:00', '13:30', '14:00', '14:30',
        '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'
    ];

    // Remover horários ocupados apenas para o mesmo dia
    foreach ($horarios as $hora) {
        if (!in_array($hora, $horarios_ocupados)) {
            $horarios_disponiveis[] = $hora;
        }
    }

    $conn->close();
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
  <form class="form" action="insert_pacientes.php?id_servico=<?php echo $id_servico; ?>" method="POST">
      <div class="input-box">
          <label>Nome completo</label>
          <input name="nome" required placeholder="Insira seu nome completo" type="text">
      </div>
      <div class="column">
          <div class="input-box">
              <label>Telefone</label>
              <input name="telefone" id="phone" placeholder="+55 11 12345-6789" type="text" required>
          </div>
          <div class="input-box">
              <label>Data de nascimento</label>
              <input name="data_nascimento" required placeholder="Data de nascimento" type="date">
          </div>
      </div>
      <div class="column">
      <div class="input-box">
          <label>Email</label>
          <input name="email" id="email" placeholder="exemplo@email.com" type="email" required>
      </div>
      
      <div class="input-box">
          <label>CPF</label>
          <input name="cpf" id="cpf" placeholder="000.000.000-00" type="text" required>
      </div>
      </div>
      <br>
      <div class="gender-box">
        <label>Gênero</label>
        <div class="gender-option">
          <div class="gender">
            <input name="sexo" id="masculino" type="radio" value="Masculino" required>
            <label for="masculino">Homem</label>
          </div>
          <div class="gender">
            <input name="sexo" id="feminino" type="radio" value="Feminino" required>
            <label for="feminino">Mulher</label>
          </div>
          <div class="gender">
            <input name="sexo" id="N/A" type="radio" value="N/A" required>
            <label for="N/A">Prefiro não dizer</label>
          </div>
        </div>
      </div>
      <br>
      <div class="input-box address">
        <label>Endereço</label>
        <div class="column">
        <input name="rua" style="width: 350px" required placeholder="Rua" type="text">
        <input name="numero_residencia" style="width: 100px" required placeholder="n°" type="number">
        </div>
        <div class="column">
          <div style="width: 498px">
          <input name="estado" required placeholder="Estado" type="text">
          </div>
          <input name="cidade" required placeholder="Cidade" type="text">
        <input name="bairro" required placeholder="Bairro" type="text">
        </div>
        <input name="cep" required placeholder="CEP" type="text" id="cep">
      </div>
 
      <header></header>
      <button type="submit">Verificar horários disponíveis</button>
  </form>
</section>
<script src="js/cpf.js"></script>
<script src="js/telefone.js"></script>
<script src="js/cep.js"></script>

   
    </center>
    <!-- Formulário de Escolha de Data -->
    <!-- <form method="POST" action="">
        <label for="data">Escolha a data para o agendamento (somente dias úteis):</label><br>
        <input type="date" id="data" name="data" min="<?php echo date('Y-m-d'); ?>" required>
        <button type="submit">Verificar horários disponíveis</button>
    </form> -->

    <?php
    // Se a data for válida e o formulário for enviado
    if (isset($data_escolhida) && !empty($horarios_disponiveis)) {
        echo "<h2>Horários disponíveis para o dia " . date('d/m/Y', strtotime($data_escolhida)) . ":</h2>";
        
        // Exibir os horários disponíveis
        echo "<form method='POST' action='confirmar_agendamento.php'>";
        echo "<input type='hidden' name='id_servico' value='$id_servico'>";
        echo "<input type='hidden' name='data_agendamento' value='$data_escolhida'>";

        foreach ($horarios_disponiveis as $horario) {
            echo "<input type='radio' name='horario' value='$horario' id='$horario' required>";
            echo "<label for='$horario'>$horario</label><br>";
        }

        echo "<br><button type='submit'>Confirmar Agendamento</button>";
        echo "</form>";
    }
    ?>



    </body>
    </html>


