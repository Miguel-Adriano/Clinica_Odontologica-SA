<?php

// Incluir a conexao com o banco de dados
include_once './conecta.php';


// Receber os dados da requisição
$dados_requisicao = $_REQUEST;

// Lista de colunas da tabela
$colunas = [
    0 => 'id',
    1 => 'nome',
    2 => 'cpf',
    3 => 'email',
    4 => 'telefone',
    5 => 'cargo',
    6 => 'editar'  // Coluna extra para o botão de editar
];

// Obter a quantidade de registros no banco de dados
$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM funcionarios";

// Acessa o IF quando há parâmetros de pesquisa   
if(!empty($dados_requisicao['search']['value'])) {
    $query_qnt_usuarios .= " WHERE id LIKE :id ";
    $query_qnt_usuarios .= " OR nome LIKE :nome ";
    $query_qnt_usuarios .= " OR cpf LIKE :cpf ";
    $query_qnt_usuarios .= " OR email LIKE :email ";
    $query_qnt_usuarios .= " OR telefone LIKE :telefone ";  // Adiciona o filtro para telefone
    $query_qnt_usuarios .= " OR cargo LIKE :cargo ";  // Adiciona o filtro para cargo
}

// Preparar a QUERY
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);

// Acessa o IF quando há parâmetros de pesquisa   
if(!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_qnt_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':telefone', $valor_pesq, PDO::PARAM_STR);  // Adiciona o telefone
    $result_qnt_usuarios->bindParam(':cargo', $valor_pesq, PDO::PARAM_STR);  // Adiciona o cargo
}

// Executar a QUERY responsável em retornar a quantidade de registros no banco de dados
$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);

// Recuperar os registros do banco de dados
$query_usuarios = "SELECT id, nome, cpf, email, telefone, cargo 
                    FROM funcionarios ";

// Acessa o IF quando há parâmetros de pesquisa   
if(!empty($dados_requisicao['search']['value'])) {
    $query_usuarios .= " WHERE id LIKE :id ";
    $query_usuarios .= " OR nome LIKE :nome ";
    $query_usuarios .= " OR cpf LIKE :cpf ";
    $query_usuarios .= " OR email LIKE :email ";
    $query_usuarios .= " OR telefone LIKE :telefone ";  // Adiciona o filtro para telefone
    $query_usuarios .= " OR cargo LIKE :cargo ";  // Adiciona o filtro para cargo
}

// Ordenar os registros
$query_usuarios .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " . $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio , :quantidade";

// Preparar a QUERY
$result_usuarios = $conn->prepare($query_usuarios);
$result_usuarios->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_usuarios->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

// Acessa o IF quando há parâmetros de pesquisa   
if(!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
    $result_usuarios->bindParam(':telefone', $valor_pesq, PDO::PARAM_STR);  // Adiciona o telefone
    $result_usuarios->bindParam(':cargo', $valor_pesq, PDO::PARAM_STR);  // Adiciona o cargo
}

// Executar a QUERY
$result_usuarios->execute();

// Ler os registros retornados do banco de dados e atribuir no array 
while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    extract($row_usuario);
    $registro = [];
    $registro[] = $id;
    $registro[] = $nome;
    $registro[] = $cpf;
    $registro[] = $email;
    $registro[] = $telefone;  // Adiciona o telefone no array
    $registro[] = $cargo;     // Adiciona o cargo no array
    $registro[] = '<a href="Editor_Funcionario.php?id=' . $id . '" class="btn btn-primary editar">Editar</a>';
    $dados[] = $registro;
}

// Cria o array de informações a serem retornadas para o Javascript
$resultado = [
    "draw" => intval($dados_requisicao['draw']),
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']),
    "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']),
    "data" => $dados
];

// Retornar os dados em formato de objeto para o JavaScript
echo json_encode($resultado);
