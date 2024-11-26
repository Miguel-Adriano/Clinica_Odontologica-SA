<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>PEsquisar Cliente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="Clinica_Odontologica/admin/Styles/Style.css">
        
    <!-- ===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


    <style>
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
    font-size: 25px; /* Tamanho da fonte do logo */
    font-weight: 500; /* Espessura do texto */
    color: var(--text-color); /* Cor do logo */
    text-decoration: none; /* Remove o sublinhado do link */
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
.container {
    max-width: 1100px;
    margin: auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: all 0.4s ease; /* Aplica transição suave para todos */
    transition-property: max-width, margin, background, border-radius, box-shadow; /* Exclui padding da transição */
}

    </style>
</head>

<body>

<nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Dentista</a></span>

            <div class="menu">


                <ul class="nav-links">
                <li><a href="/Clinica_Odontologica/site/admin/Tela_Dentista/Agendamentos.php">Agendamentos</a></li>
                    <li><a href="/Clinica_Odontologica/site/admin/Tela_Dentista/Servicos.php" class="activate">Serviços</a></li>
                    <li><a href="">Clientes</a></li>
                    <li><a href="/Clinica_Odontologica/site/admin/Tela_Dentista/Prontuarios.php">Prontuários</a></li>
                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>
    <br><br><br><br>
    <div class="container">
        <h1 class="display-5 mb-4">Pesquisar Pacientes</h1>
        <table id="listar-usuario" class="table table-striped table-hover display" style="width:100%">
            <thead>
                <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Telefone</th>  
                <th>Pesquisar</th>
                
                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="style.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        
        $(document).ready(function() {
    $('#listar-usuario').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "Pesquisa_lista_cliente.php",
            "dataSrc": function (json) {
                if (json.error) {
                    console.error('Erro na resposta JSON:', json.error);
                    return [];
                }
                return json.data; 
            },
            "error": function(xhr, error, thrown) {
                console.error('Erro na requisição AJAX:', thrown);
            }
        },
        "language": {
            "lengthMenu": "Mostrar _MENU_ Pacientes",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo"
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Pacientes",
            "search": "Pesquisar:",
            "infoEmpty": "Mostrando 0 a 0 de 0 Pacientes",
            "infoFiltered": "(filtrado de _MAX_ total de Pacientes)",
            "zeroRecords": "Nenhum Funcionário encontrado",
            "loadingRecords": "Carregando...",
            "processing": "Sem dados..."
        },
        "columnDefs": [
            {
                "targets": -1, 
                "orderable": false,
                "searchable": false
            }
        ]
    });
});


    </script>
    
</body>

</html>
