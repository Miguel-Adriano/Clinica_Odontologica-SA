<?php
// Conecte ao banco de dados
$conn = new mysqli("localhost", "root", "", "clinica_odontologica");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificando se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletando os dados do formulário com segurança
    $id_agendamento = isset($_POST['id_agendamento']) ? $_POST['id_agendamento'] : '';
    $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';
    $id_servico = isset($_POST['id_servico']) ? $_POST['id_servico'] : '';
    $uso_anestesia = isset($_POST['uso_anestesia']) ? $_POST['uso_anestesia'] : '';
    $sangramento = isset($_POST['sangramento']) ? $_POST['sangramento'] : '';
    $alergia = isset($_POST['alergia']) ? $_POST['alergia'] : '';
    $alergia_qual = isset($_POST['alergia_qual']) ? $_POST['alergia_qual'] : '';  // Nova variável alergia_qual
    $higiene = isset($_POST['higiene']) ? $_POST['higiene'] : '';
    $tartaro = isset($_POST['tartaro']) ? $_POST['tartaro'] : '';
    $gengiva = isset($_POST['gengiva']) ? $_POST['gengiva'] : '';
    $mucosa = isset($_POST['mucosa']) ? $_POST['mucosa'] : '';  // Nova variável mucosa
    $halitose = isset($_POST['halitose']) ? $_POST['halitose'] : '';  // Nova variável halitose
    $observacoes = isset($_POST['observacoes']) ? $_POST['observacoes'] : '';

    // Coletando os valores dos checkboxes para as doenças
    $doenca_metabolica = isset($_POST['doenca_metabolica']) ? 'Sim' : 'Não';
    $doenca_cardiaca = isset($_POST['doenca_cardiaca']) ? 'Sim' : 'Não';
    $doenca_respiratoria = isset($_POST['doenca_respiratoria']) ? 'Sim' : 'Não';
    $doenca_vascular = isset($_POST['doenca_vascular']) ? 'Sim' : 'Não';
    $doenca_neurologica = isset($_POST['doenca_neurologica']) ? 'Sim' : 'Não';
    $doenca_gastrointestinal = isset($_POST['doenca_gastrointestinal']) ? 'Sim' : 'Não';
    $doenca_visual = isset($_POST['doenca_visual']) ? 'Sim' : 'Não';
    $doenca_endocrina = isset($_POST['doenca_endocrina']) ? 'Sim' : 'Não';
    $diabetes = isset($_POST['diabetes']) ? 'Sim' : 'Não';
    $hipertensao = isset($_POST['hipertensao']) ? 'Sim' : 'Não';
    $neoplasias = isset($_POST['neoplasias']) ? 'Sim' : 'Não';

    // Verifique o número de colunas e valores
    $query = "INSERT INTO prontuarios 
              (id_agendamento, id_paciente, id_servico, uso_anestesia, sangramento, alergia, alergia_qual, higiene, tartaro, gengiva, mucosa, halitose, observacoes, 
               doenca_metabolica, doenca_cardiaca, doenca_respiratoria, doenca_vascular, doenca_neurologica, 
               doenca_gastrointestinal, doenca_visual, doenca_endocrina, diabetes, hipertensao, neoplasias) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        // Vinculando os parâmetros corretamente
        $stmt->bind_param("iissssssssssssssssssssss", 
                          $id_agendamento, $id_paciente, $id_servico, $uso_anestesia, $sangramento, $alergia, $alergia_qual, $higiene, $tartaro, $gengiva, 
                          $mucosa, $halitose, $observacoes, $doenca_metabolica, $doenca_cardiaca, $doenca_respiratoria, $doenca_vascular, $doenca_neurologica, 
                          $doenca_gastrointestinal, $doenca_visual, $doenca_endocrina, $diabetes, $hipertensao, $neoplasias);
        
         // Executando a consulta
         if ($stmt->execute()) {
            // Agora atualizando o status do agendamento
            $updateQuery = "UPDATE agendamentos SET status = 'Concluída' WHERE id = ?";
            if ($updateStmt = $conn->prepare($updateQuery)) {
                // Vinculando o parâmetro para a atualização
                $updateStmt->bind_param("i", $id_agendamento);
                
                // Executando a atualização
                if ($updateStmt->execute()) {
                    // Notificação de sucesso
                    echo "<script>
                        alert('Dados inseridos e agendamento atualizado com sucesso!');
                        window.location.href = 'Agendamentos.php';
                    </script>";
                } else {
                    echo "Erro ao atualizar o agendamento: " . $updateStmt->error;
                }

                // Fechando o statement de atualização
                $updateStmt->close();
            } else {
                echo "Erro na preparação da consulta de atualização: " . $conn->error;
            }
        } else {
            echo "Erro ao inserir dados no prontuário: " . $stmt->error;
        }
        
        // Fechando o statement de inserção
        $stmt->close();
    } else {
        echo "Erro na preparação da consulta de inserção: " . $conn->error;
    }
}

// Fechar a conexão com o banco
$conn->close();
?>
