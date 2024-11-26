<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/CLFuncionario.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/FontFuncionario.css">
        
    <!-- ===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== Tabela CSS ===== -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>  -->
    <title>Funcionario</title>


    <style>

      /* STYLE DO NAV */


/* Importa a fonte "Poppins" do Google Fonts, com os pesos 300, 400, 500 e 600 */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

/* Reset básico de estilo e configuração global */
* {
    margin: 0; /* Remove margens padrão de todos os elementos */
    padding: 0; /* Remove padding padrão de todos os elementos */
    box-sizing: border-box; /* Define o box-sizing como border-box para incluir bordas e paddings no tamanho do elemento */
    font-family: 'Poppins', sans-serif; /* Define a fonte padrão como "Poppins" */
    transition: all 0.4s ease; /* Aplica uma transição suave de 0.4s para todas as mudanças de estilo */
}

/* ===== Cores definidas como variáveis CSS ===== */
:root {
    --body-color: #E4E9F7; /* Cor de fundo do corpo */
    --nav-color: #46a6f6; /* Cor de fundo do navbar */
    --side-nav: #010718; /* Cor de fundo do menu lateral */
    --text-color: #FFF; /* Cor padrão do texto */
    --search-bar: #F2F2F2; /* Cor de fundo da barra de pesquisa */
    --search-text: #010718; /* Cor do texto da barra de pesquisa */
}

/* Estilos para o corpo da página */
body {
    height: 100vh; /* Define altura de 100% da altura da viewport */
    background-color: var(--body-color); /* Usa a variável de cor de fundo definida para o corpo */
    font-family: 'Lato', sans-serif;
    color: #000;
}

/* Tema escuro para o corpo da página */
body.dark {
    --body-color: #18191A; /* Cor de fundo para o modo escuro */
    --nav-color: #242526; /* Cor do navbar no modo escuro */
    --side-nav: #242526; /* Cor do menu lateral no modo escuro */
    --text-color: #CCC; /* Cor do texto no modo escuro */
    --search-bar: #242526; /* Cor da barra de pesquisa no modo escuro */
}

/* Estilos para o navbar */
nav {
    position: fixed; /* Fixa o navbar no topo da tela */
    top: 0; /* Alinha o navbar no topo */
    left: 0; /* Alinha o navbar à esquerda */
    height: 70px; /* Altura do navbar */
    width: 100%; /* Largura total da tela */
    background-color: var(--nav-color); /* Cor de fundo do navbar */
    z-index: 100; /* Coloca o navbar acima de outros elementos */
}

/* Borda para o navbar no modo escuro */
body.dark nav {
    border: 1px solid #393838; /* Define uma borda para o navbar no modo escuro */
}

/* Container interno do navbar */
nav .nav-bar {
    position: relative; /* Necessário para posicionamento de elementos filhos */
    height: 100%; /* Altura total do container do navbar */
    max-width: 1000px; /* Largura máxima do container */
    width: 100%; /* Largura total da tela */
    background-color: var(--nav-color); /* Cor de fundo */
    margin: 0 auto; /* Centraliza o container */
    padding: 0 30px; /* Adiciona padding horizontal */
    display: flex; /* Exibe elementos filhos em linha */
    align-items: center; /* Alinha os elementos verticalmente no centro */
    justify-content: space-between; /* Distribui espaço igualmente entre os elementos */
}

/* Ícone para abrir o menu lateral no navbar */
nav .nav-bar .sidebarOpen {
    color: var(--text-color); /* Cor do ícone */
    font-size: 25px; /* Tamanho da fonte do ícone */
    padding: 5px; /* Padding ao redor do ícone */
    cursor: pointer; /* Mostra um cursor de mão */
    display: none; /* Esconde o ícone por padrão */
}

/* Estilo para o logo no navbar */
nav .nav-bar .logo a {
    font-size: 25px;
    font-weight: 500;
    color: var(--text-color);
    text-decoration: none;
    padding-top: 5px; /* Ajuste o valor conforme necessário */
}


/* Logo e ícone de alternância de menu para navegação lateral */
.menu .logo-toggle {
    display: none; /* Esconde o logo-toggle por padrão */
}

/* Container para os links de navegação */
.nav-bar .nav-links {
    display: flex; /* Exibe links em linha */
    align-items: center; /* Alinha os links verticalmente no centro */
}

/* Estilos para cada item da lista de links */
.nav-bar .nav-links li {
    margin: 0 5px; /* Adiciona uma margem horizontal entre os itens */
    list-style: none; /* Remove os marcadores de lista */
}

/* Estilos para os links */
.nav-links li a {
    position: relative; /* Necessário para posicionar o ponto de destaque */
    font-size: 17px; /* Tamanho da fonte do link */
    font-weight: 400; /* Espessura do texto do link */
    color: var(--text-color); /* Cor do texto */
    text-decoration: none; /* Remove o sublinhado do link */
    padding: 10px; /* Padding ao redor do link */
    
}

/* Ponto de destaque sob o link */
.nav-links li a::before {
    content: ''; /* Cria um elemento vazio */
    position: absolute; /* Posiciona o ponto relativo ao link */
    left: 50%; /* Centraliza horizontalmente */
    bottom: 0; /* Posiciona na base do link */
    transform: translateX(-50%); /* Ajusta a posição para centralizar */
    height: 6px; /* Altura do ponto */
    width: 6px; /* Largura do ponto */
    border-radius: 50%; /* Torna o ponto circular */
    background-color: var(--text-color); /* Cor do ponto */
    opacity: 0; /* Esconde o ponto inicialmente */
    transition: all 0.3s ease; /* Transição suave ao aparecer */
    
}

/* Exibe o ponto de destaque ao passar o mouse sobre o link */
.nav-links li:hover a::before {
    opacity: 1; /* Torna o ponto visível */
}

/* Container para alternância entre modo escuro e barra de pesquisa */
.nav-bar .darkLight-searchBox {
    display: flex; /* Exibe elementos em linha */
    align-items: center; /* Alinha verticalmente no centro */
}

/* Botões de alternância de modo e pesquisa */
.darkLight-searchBox .dark-light,
.darkLight-searchBox .searchToggle {
    height: 40px; /* Altura do botão */
    width: 40px; /* Largura do botão */
    display: flex; /* Exibe ícone no centro */
    align-items: center; /* Alinha verticalmente no centro */
    justify-content: center; /* Alinha horizontalmente no centro */
    margin: 0 5px; /* Margem entre os botões */
}

/* Ícones dentro dos botões */
.dark-light i,
.searchToggle i {
    position: absolute; /* Posiciona relativo ao botão */
    color: var(--text-color); /* Cor do ícone */
    font-size: 22px; /* Tamanho do ícone */
    cursor: pointer; /* Mostra cursor de mão */
    transition: all 0.3s ease; /* Transição suave para alternância */
}

/* Ícone do sol invisível por padrão */
.dark-light i.sun {
    opacity: 0; /* Esconde o ícone */
    pointer-events: none; /* Desabilita interação */
}

/* Ativa o ícone de sol e desativa o de lua ao alternar para modo claro */
.dark-light.active i.sun {
    opacity: 1; /* Exibe o ícone */
    pointer-events: auto; /* Habilita interação */
}

.dark-light.active i.moon {
    opacity: 0; /* Esconde o ícone de lua */
    pointer-events: none; /* Desabilita interação */
}


/* Ícone de "cancelar" na barra de pesquisa fica invisível por padrão */
.searchToggle i.cancel {
    opacity: 0; /* Esconde o ícone de cancelar */
    pointer-events: none; /* Desabilita a interação */
}

/* Quando a barra de pesquisa está ativa, exibe o ícone de cancelar e esconde o ícone de pesquisa */
.searchToggle.active i.cancel {
    opacity: 1; /* Exibe o ícone de cancelar */
    pointer-events: auto; /* Habilita a interação */
}

.searchToggle.active i.search {
    opacity: 0; /* Esconde o ícone de pesquisa */
    pointer-events: none; /* Desabilita a interação */
}

/* Posiciona e define o estilo da barra de pesquisa */
.searchBox {
    position: relative; /* Necessário para posicionamento dos elementos internos */
}

/* Campo de pesquisa que aparece ao clicar no ícone de pesquisa */
.searchBox .search-field {
    position: absolute; /* Posiciona o campo de pesquisa relativo ao container */
    bottom: -85px; /* Posiciona abaixo do ícone de pesquisa */
    right: 5px; /* Alinha o campo de pesquisa à direita */
    height: 50px; /* Altura do campo de pesquisa */
    width: 300px; /* Largura do campo de pesquisa */
    display: flex; /* Exibe os elementos internos em linha */
    align-items: center; /* Alinha o conteúdo verticalmente no centro */
    background-color: var(--nav-color); /* Cor de fundo do campo */
    padding: 3px; /* Padding interno */
    border-radius: 6px; /* Bordas arredondadas */
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1); /* Sombra para o campo */
    opacity: 0; /* Esconde o campo por padrão */
    pointer-events: none; /* Desabilita a interação */
    transition: all 0.3s ease; /* Transição suave para exibir/esconder */
}

/* Exibe o campo de pesquisa quando a barra de pesquisa está ativa */
.searchToggle.active ~ .search-field {
    bottom: -74px; /* Ajusta a posição do campo */
    opacity: 1; /* Torna o campo visível */
    pointer-events: auto; /* Habilita a interação */
}

/* Estiliza a seta decorativa abaixo do campo de pesquisa */
.search-field::before {
    content: ''; /* Cria um elemento vazio */
    position: absolute; /* Posiciona a seta relativa ao campo */
    right: 14px; /* Alinha a seta à direita */
    top: -4px; /* Posiciona a seta acima do campo */
    height: 12px; /* Altura da seta */
    width: 12px; /* Largura da seta */
    background-color: var(--nav-color); /* Cor da seta */
    transform: rotate(-45deg); /* Rotaciona para formar uma seta */
    z-index: -1; /* Posiciona a seta atrás do campo */
}

/* Campo de entrada de texto na barra de pesquisa */
.search-field input {
    height: 100%; /* Altura completa do campo de entrada */
    width: 100%; /* Largura completa do campo de entrada */
    padding: 0 45px 0 15px; /* Padding interno no campo */
    outline: none; /* Remove a borda de foco padrão */
    border: none; /* Remove bordas */
    border-radius: 4px; /* Bordas arredondadas */
    font-size: 14px; /* Tamanho da fonte */
    font-weight: 400; /* Espessura do texto */
    color: var(--search-text); /* Cor do texto */
    background-color: var(--search-bar); /* Cor de fundo do campo */
}

/* Muda a cor do texto no modo escuro */
body.dark .search-field input {
    color: var(--text-color); /* Define a cor do texto no modo escuro */
}

/* Ícone dentro da barra de pesquisa */
.search-field i {
    position: absolute; /* Posiciona o ícone dentro do campo */
    color: var(--nav-color); /* Cor do ícone */
    right: 15px; /* Alinha o ícone à direita */
    font-size: 22px; /* Tamanho do ícone */
    cursor: pointer; /* Mostra o cursor de mão */
}

/* Ícone no modo escuro */
body.dark .search-field i {
    color: var(--text-color); /* Define a cor do ícone no modo escuro */
}

/* Estilos de responsividade para telas menores que 790px */
@media (max-width: 790px) {
    /* Mostra o ícone de abrir o menu lateral no navbar */
    nav .nav-bar .sidebarOpen {
        display: block; /* Torna o ícone visível em telas pequenas */
    }

    /* Menu lateral em telas pequenas */
    .menu {
        position: fixed; /* Fixa o menu lateral na tela */
        height: 100%; /* Altura completa da viewport */
        width: 320px; /* Largura do menu lateral */
        left: -100%; /* Oculta o menu lateral fora da tela */
        top: 0; /* Alinha o menu ao topo */
        padding: 20px; /* Padding interno */
        background-color: var(--side-nav); /* Cor de fundo do menu */
        z-index: 100; /* Coloca o menu acima de outros elementos */
        transition: all 0.4s ease; /* Transição suave para exibir/esconder */
    }

    /* Exibe o menu lateral quando o navbar está ativo */
    nav.active .menu {
        left: 0; /* Move o menu para dentro da tela */
    }

    /* Esconde o logo do navbar quando o menu lateral está ativo */
    nav.active .nav-bar .navLogo a {
        opacity: 0; /* Torna o logo invisível */
        transition: all 0.3s ease; /* Transição suave ao esconder */
    }

    /* Ícone de fechar o menu lateral */
    .menu .logo-toggle {
        display: block; /* Torna o ícone visível */
        width: 100%; /* Largura total do menu */
        display: flex; /* Exibe ícone de fechar e logo em linha */
        align-items: center; /* Alinha verticalmente no centro */
        justify-content: space-between; /* Espaço entre ícone de fechar e logo */
    }

    /* Ícone de fechar o menu lateral */
    .logo-toggle .siderbarClose {
        color: var(--text-color); /* Cor do ícone */
        font-size: 24px; /* Tamanho do ícone */
        cursor: pointer; /* Mostra o cursor de mão */
    }

    /* Links de navegação no menu lateral */
    .nav-bar .nav-links {
        flex-direction: column; /* Organiza links verticalmente */
        padding-top: 30px; /* Espaço acima dos links */
    }

    /* Exibe links em blocos com margem superior */
    .nav-links li a {
        display: block; /* Exibe cada link como um bloco */
        margin-top: 20px; /* Espaço entre os links */
    }
}
/* FIM STYLE NAV */






h1 {
  color: #000; /* Cor do texto no modo claro */
}

/* Modo Escuro */
body.dark h1 {
  color: #fff; /* Cor do texto no modo escuro */
}



.search-icon {
    width: 22px; /* Tamanho da imagem do ícone */
    height: 22px;
    cursor: pointer;
    position: absolute; /* Posição do ícone dentro do campo de pesquisa */
    color: var(--text-color); /* Mantém a cor conforme o tema */
    filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(180deg) brightness(2) contrast(1.2);
}

/* Defina para que o ícone de pesquisa desapareça quando a barra de pesquisa estiver ativa */
.searchToggle.active .search-icon {
    opacity: 0;
    pointer-events: none;
}


 /* latin-ext */
 @font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/lato/v24/S6u9w4BMUTPHh7USSwaPGR_p.woff2) format('woff2');
  unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/lato/v24/S6u9w4BMUTPHh7USSwiPGQ.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/lato/v24/S6uyw4BMUTPHjxAwXjeu.woff2) format('woff2');
  unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/lato/v24/S6uyw4BMUTPHjx4wXg.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/lato/v24/S6u9w4BMUTPHh6UVSwaPGR_p.woff2) format('woff2');
  unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/lato/v24/S6u9w4BMUTPHh6UVSwiPGQ.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}
/* latin-ext */
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 900;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/lato/v24/S6u9w4BMUTPHh50XSwaPGR_p.woff2) format('woff2');
  unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
}
/* latin */
@font-face {
  font-family: 'Lato';
  font-style: normal;
  font-weight: 900;
  font-display: swap;
  src: url(https://fonts.gstatic.com/s/lato/v24/S6u9w4BMUTPHh50XSwiPGQ.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

.funcionario-profile .card {
    border-radius: 10px;
}

/* Imagem do perfil */
.funcionario-profile .card .card-header .profile_img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin: 10px auto;
    border: 10px solid #ccc;
    border-radius: 50%;
}

/* Título do cartão */
.funcionario-profile .card h3 {
    font-size: 20px;
    font-weight: 700;
}

/* Parágrafo do cartão */
.funcionario-profile .card p {
    font-size: 16px;
    color: #000;
}

/* Tabela dentro do cartão */
.funcionario-profile .table th,
.funcionario-profile .table td {
    font-size: 14px;
    padding: 5px 10px;
    color: #000;
}



    </style>
</head>
<body>
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Funcionarios</a></span>

            <div class="menu">
                

                <ul class="nav-links">
                <li><a href="/Clinica_Odontologica/admin/Tela_Admin/Ver_Agendamentos.php">Agendamentos</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="/Clinica_Odontologica/admin/Tela_Admin/Servicos.php">Serviços</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="../Funcionarios/Alteração_Funcionario.php">Funcionarios</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="../Clientes/Alteração_Cliente.php">Clientes</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="/Clinica_Odontologica/admin/Tela_Admin/sair.php">Sair</a></li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- <script src="script.js"></script> -->


<br><br><br><br>

<?php
if (isset($_GET['id'])) {
    $id = $_GET["id"];
require_once("conectaDB.php");  // Inclui o arquivo de conexão com o banco de dados

// Estabelece a conexão com o banco
$conexao = conectadb();
$conexao->set_charset("utf8");  // Define a codificação de caracteres


    require_once("conectaDB.php");
    $conexao = conectadb();
    $conexao->set_charset("utf8");
    $sql = "SELECT * FROM funcionarios WHERE id=$id";
    $result = $conexao->query($sql);
}



// Verifica se a consulta retornou resultados
if ($result->num_rows > 0) {
    // Loop para armazenar os dados nas variáveis
    while ($linha = $result->fetch_assoc()) {
        // Atribui cada valor a uma variável
        $id = $linha["id"];
        $nome = $linha["nome"];
        $sexo = $linha["sexo"];
        $data_nascimento = $linha["data_nascimento"];
        $cpf = $linha["cpf"];
        $senha = $linha["senha"];
        $estado = $linha["estado"];
        $cidade = $linha["cidade"];
        $bairro = $linha["bairro"];
        $rua = $linha["rua"];
        $numero_residencia = $linha["numero_residencia"];
        $cep = $linha["cep"];
        $telefone = $linha["telefone"];
        $email = $linha["email"];
        $cargo = $linha["cargo"];
        $nivel = $linha["nivel"];


    }
} else {
    echo "Nenhum funcionário encontrado.";
}

// Fecha a conexão
$conexao->close();

?>

<div class="funcionario-profile py-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent text-center">
               

              <h3><?php echo $nome; ?></h3>
            </div>
            <div class="card-body">
            <p class="mb-0"><strong class="pr-1">Funcionario ID:</strong><?php echo $id; ?></p>
              <p class="mb-0"><strong class="pr-1">Cargo:</strong><?php echo $cargo; ?></p>
              <p class="mb-0"><strong class="pr-1">Acesso:</strong><?php echo $nivel; ?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent border-0">
            <h3 class="mb-0">
    <img src="img/copy.png" alt="Informações Gerais" style="width: 20px; height: 20px; vertical-align: middle;" />
    Informações Gerais
</h3>

            </div>
            <div class="card-body pt-0">
    <table class="table table-bordered">
        <tr>
            <th width="30%">Nome</th>
            <td width="2%">:</td>
            <td><?php echo $nome; ?></td>
        </tr>
        <tr>
            <th width="30%">Sexo</th>
            <td width="2%">:</td>
            <td><?php echo $sexo; ?></td>
        </tr>
        <tr>
            <th width="30%">Data de Nascimento</th>
            <td width="2%">:</td>
            <td><?php echo $data_nascimento; ?></td>
        </tr>
        <tr>
            <th width="30%">CPF</th>
            <td width="2%">:</td>
            <td><?php echo $cpf; ?></td>
        </tr>
        <tr>
            <th width="30%">Estado</th>
            <td width="2%">:</td>
            <td><?php echo $estado; ?></td>
        </tr>
        <tr>
            <th width="30%">Cidade</th>
            <td width="2%">:</td>
            <td><?php echo $cidade; ?></td>
        </tr>
        <tr>
            <th width="30%">Bairro</th>
            <td width="2%">:</td>
            <td><?php echo $bairro; ?></td>
        </tr>
        <tr>
            <th width="30%">Rua</th>
            <td width="2%">:</td>
            <td><?php echo $rua; ?></td>
        </tr>
        <tr>
            <th width="30%">Número da Residência</th>
            <td width="2%">:</td>
            <td><?php echo $numero_residencia; ?></td>
        </tr>
        <tr>
            <th width="30%">CEP</th>
            <td width="2%">:</td>
            <td><?php echo $cep; ?></td>
        </tr>
        <tr>
            <th width="30%">Telefone</th>
            <td width="2%">:</td>
            <td><?php echo $telefone; ?></td>
        </tr>
        <tr>
            <th width="30%">E-mail</th>
            <td width="2%">:</td>
            <td><?php echo $email; ?></td>
        </tr>
    </table>
</div>

          </div>
            
      </div>
    </div>
</div>




    <script> // SCRIPT PARA MODO DARK

const body = document.querySelector("body"),
      nav = document.querySelector("nav"),
      modeToggle = document.querySelector(".dark-light"),
      searchToggle = document.querySelector(".searchToggle"),
      sidebarOpen = document.querySelector(".sidebarOpen"),
      siderbarClose = document.querySelector(".siderbarClose");

// Pega o modo salvo anteriormente (claro ou escuro) do armazenamento local do navegador
let getMode = localStorage.getItem("mode");
if(getMode && getMode === "dark-mode") {
    // Se o modo salvo for "dark-mode", adiciona a classe "dark" ao <body> para ativar o modo escuro
    body.classList.add("dark");
}

// Código JavaScript para alternar entre o modo claro e escuro
modeToggle.addEventListener("click", () => {
    // Alterna a classe "active" no botão de alternância entre claro/escuro
    modeToggle.classList.toggle("active");
    // Alterna a classe "dark" no <body> para mudar o tema
    body.classList.toggle("dark");

    // Código para manter o modo selecionado pelo usuário mesmo após atualizar a página ou reabrir o arquivo
    if (!body.classList.contains("dark")) {
        // Se o modo escuro não estiver ativo, salva "light-mode" no armazenamento local
        localStorage.setItem("mode", "light-mode");
    } else {
        // Se o modo escuro estiver ativo, salva "dark-mode" no armazenamento local
        localStorage.setItem("mode", "dark-mode");
    }
});

// Código JavaScript para alternar a exibição da barra de pesquisa
searchToggle.addEventListener("click", () => {
    // Alterna a classe "active" no ícone de pesquisa para mostrar/esconder a barra de pesquisa
    searchToggle.classList.toggle("active");
});

// Código JavaScript para abrir o menu lateral
sidebarOpen.addEventListener("click", () => {
    // Adiciona a classe "active" ao elemento <nav> para exibir o menu lateral
    nav.classList.add("active");
});

// Fecha o menu lateral se o usuário clicar fora dele
body.addEventListener("click", e => {
    // Pega o elemento no qual o usuário clicou
    let clickedElm = e.target;

    // Se o elemento clicado não for o botão de abrir a barra lateral nem o próprio menu
    if (!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")) {
        // Remove a classe "active" do <nav> para esconder o menu lateral
        nav.classList.remove("active");
    }
});
</script>



</body>
</html>