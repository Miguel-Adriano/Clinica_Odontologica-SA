<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "clinica_odontologica");

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para validar os valores dos checkboxes (se estão marcados ou não)
function getCheckboxValue($checkboxValue) {
    return isset($checkboxValue) && $checkboxValue == 'on' ? 'Sim' : 'Não';
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário com verificação para os checkboxes
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $id_agendamento = isset($_POST['id_agendamento']) ? $_POST['id_agendamento'] : '';
    $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';
    $uso_anestesia = isset($_POST['uso_anestesia']) ? $_POST['uso_anestesia'] : '';
    $sangramento = isset($_POST['sangramento']) ? $_POST['sangramento'] : '';
    $alergia = isset($_POST['alergia']) ? $_POST['alergia'] : '';
    $alergia_qual = isset($_POST['alergia_qual']) ? $_POST['alergia_qual'] : '';
    $doenca_metabolica = getCheckboxValue($_POST['doenca_metabolica'] ?? null);
    $doenca_cardiaca = getCheckboxValue($_POST['doenca_cardiaca'] ?? null);
    $doenca_respiratoria = getCheckboxValue($_POST['doenca_respiratoria'] ?? null);
    $doenca_vascular = getCheckboxValue($_POST['doenca_vascular'] ?? null);  // Verificação se a chave existe
    $doenca_neurologica = getCheckboxValue($_POST['doenca_neurologica'] ?? null);  // Verificação se a chave existe
    $doenca_gastrointestinal = getCheckboxValue($_POST['doenca_gastrointestinal'] ?? null);
    $doenca_visual = getCheckboxValue($_POST['doenca_visual'] ?? null);
    $doenca_endocrina = getCheckboxValue($_POST['doenca_endocrina'] ?? null);
    $diabetes = getCheckboxValue($_POST['diabetes'] ?? null);  // Verificação se a chave existe
    $hipertensao = getCheckboxValue($_POST['hipertensao'] ?? null);
    $neoplasias = getCheckboxValue($_POST['neoplasias'] ?? null);  // Verificação se a chave existe
    $higiene = isset($_POST['higiene']) ? $_POST['higiene'] : '';
    $tartaro = isset($_POST['tartaro']) ? $_POST['tartaro'] : '';
    $gengiva = isset($_POST['gengiva']) ? $_POST['gengiva'] : '';
    $observacoes = isset($_POST['observacoes']) ? $_POST['observacoes'] : '';

    // Preparar a consulta para atualizar o prontuário
    $sql = "UPDATE prontuarios SET 
                id_agendamento = ?, 
                id_paciente = ?, 
                uso_anestesia = ?, 
                sangramento = ?, 
                alergia = ?, 
                alergia_qual = ?, 
                doenca_metabolica = ?, 
                doenca_cardiaca = ?, 
                doenca_respiratoria = ?, 
                doenca_vascular = ?, 
                doenca_neurologica = ?, 
                doenca_gastrointestinal = ?, 
                doenca_visual = ?, 
                doenca_endocrina = ?, 
                diabetes = ?, 
                hipertensao = ?, 
                neoplasias = ?, 
                higiene = ?, 
                tartaro = ?, 
                gengiva = ?, 
                observacoes = ? 
            WHERE id = ?";

    // Preparar a declaração SQL
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // Logar erro em vez de exibir diretamente
        error_log("Erro ao preparar a consulta: " . $conn->error);
        echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao tentar atualizar o prontuário. Por favor, tente novamente mais tarde.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
        exit;
    }

    // Bind dos parâmetros
    $stmt->bind_param(
        "iisssssssssssssssssssi", // Definir os tipos dos parâmetros (i = int, s = string)
        $id_agendamento, 
        $id_paciente, 
        $uso_anestesia, 
        $sangramento, 
        $alergia, 
        $alergia_qual, 
        $doenca_metabolica, 
        $doenca_cardiaca, 
        $doenca_respiratoria, 
        $doenca_vascular, 
        $doenca_neurologica, 
        $doenca_gastrointestinal, 
        $doenca_visual, 
        $doenca_endocrina, 
        $diabetes, 
        $hipertensao, 
        $neoplasias, 
        $higiene, 
        $tartaro, 
        $gengiva, 
        $observacoes, 
        $id
    );

    // Executar a consulta e verificar se ocorreu sucesso
    if ($stmt->execute()) {
        echo "<script>
                alert('Prontuário atualizado com sucesso!');
                window.location.href = 'Prontuarios.php';
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao atualizar prontuário. Detalhes: " . $stmt->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
} else {
    echo "Nenhum dado foi enviado.";
}
?>

<script>
    function notificarAtualizacao() {
        // Exibe a notificação de sucesso
        alert("Prontuário atualizado com sucesso!");
        
        // Redireciona o usuário após o "OK" da notificação
        window.location.href = "Prontuarios.php";
    }

    // Chama a função assim que a página é carregada ou em algum outro evento
    notificarAtualizacao();
    </script>
