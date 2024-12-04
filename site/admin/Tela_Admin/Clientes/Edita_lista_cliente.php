<?php

// Incluir a conexão com o banco de dados
include_once './conecta.php';

// Receber os dados da requisição
$dados_requisicao = $_REQUEST;

// Lista de colunas da tabela (somente os campos desejados)
$colunas = [
    0 => 'id_paciente',
    1 => 'nome',
    2 => 'cpf',
    3 => 'email',
    4 => 'telefone',
    5 => 'editar'  // Coluna extra para o botão de editar
];

// Obter a quantidade de registros no banco de dados
$query_qnt_pacientes = "SELECT COUNT(id_paciente) AS qnt_pacientes FROM pacientes";

// Acessa o IF quando há parâmetros de pesquisa   
if(!empty($dados_requisicao['search']['value'])) {
    $query_qnt_pacientes .= " WHERE id_paciente LIKE :id ";
    $query_qnt_pacientes .= " OR nome LIKE :nome ";
    $query_qnt_pacientes .= " OR cpf LIKE :cpf ";
    $query_qnt_pacientes .= " OR email LIKE :email ";
    $query_qnt_pacientes .= " OR telefone LIKE :telefone ";  // Adiciona o filtro para telefone
}

// Preparar a QUERY
$result_qnt_pacientes = $conn->prepare($query_qnt_pacientes);

// Acessa o IF quando há parâmetros de pesquisa   
if(!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_qnt_pacientes->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_pacientes->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_pacientes->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_pacientes->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_pacientes->bindParam(':telefone', $valor_pesq, PDO::PARAM_STR);  // Adiciona o telefone
}

// Executar a QUERY responsável em retornar a quantidade de registros no banco de dados
$result_qnt_pacientes->execute();
$row_qnt_pacientes = $result_qnt_pacientes->fetch(PDO::FETCH_ASSOC);

// Recuperar os registros do banco de dados (somente os campos desejados)
$query_pacientes = "SELECT id_paciente, nome, cpf, email, telefone 
                    FROM pacientes ";

// Acessa o IF quando há parâmetros de pesquisa   
if(!empty($dados_requisicao['search']['value'])) {
    $query_pacientes .= " WHERE id_paciente LIKE :id ";
    $query_pacientes .= " OR nome LIKE :nome ";
    $query_pacientes .= " OR cpf LIKE :cpf ";
    $query_pacientes .= " OR email LIKE :email ";
    $query_pacientes .= " OR telefone LIKE :telefone ";  // Adiciona o filtro para telefone
}

// Ordenar os registros
$query_pacientes .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " . $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio , :quantidade";

// Preparar a QUERY
$result_pacientes = $conn->prepare($query_pacientes);
$result_pacientes->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_pacientes->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

// Acessa o IF quando há parâmetros de pesquisa   
if(!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_pacientes->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_pacientes->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_pacientes->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
    $result_pacientes->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
    $result_pacientes->bindParam(':telefone', $valor_pesq, PDO::PARAM_STR);
}

// Executar a QUERY
$result_pacientes->execute();

// Ler os registros retornados do banco de dados e atribuir no array 
while ($row_paciente = $result_pacientes->fetch(PDO::FETCH_ASSOC)) {
    extract($row_paciente);
    $registro = [];
    $registro[] = $id_paciente;
    $registro[] = $nome;
    $registro[] = $cpf;
    $registro[] = $email;
    $registro[] = $telefone;  // Adiciona o telefone no array
    $registro[] = '<a href="Editor_Cliente.php?id=' . $id_paciente . '" class="btn btn-primary editar">Editar</a>';

    $dados[] = $registro;
}

// Cria o array de informações a serem retornadas para o Javascript
$resultado = [
    "draw" => intval($dados_requisicao['draw']),
    "recordsTotal" => intval($row_qnt_pacientes['qnt_pacientes']),
    "recordsFiltered" => intval($row_qnt_pacientes['qnt_pacientes']),
    "data" => $dados
];

// Retornar os dados em formato de objeto para o JavaScript
echo json_encode($resultado);
?>
