<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        
    <!-- ===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../nav.css">
    <title>Funcionarios</title>


    
</head>
<body>
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Funcionarios</a></span>

            <div class="menu">


                <ul class="nav-links">
                <li><a href="/Clinica_Odontologica/site/admin/Tela_Admin/Ver_Agendamentos.php">Agendamentos</a></li>
                    <li></li>
                    <li><a href="/Clinica_Odontologica/site/admin/Tela_Admin/Servicos.php">Serviços</a></li>
                    <li></li>
                    <li><a href="../Funcionarios/Alteração_Funcionario.php">Funcionarios</a></li>
                    <li></li>
                    <li><a href="../Clientes/Alteração_Cliente.php">Clientes</a></li>
                    <li></li>
                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>

    <!-- <script src="script.js"></script> -->


<br><br><br><br><br>

<center><h1>O que deseja fazer?</h1></center>
<br>
    <div class="card-container">
    <a href="Cadastro_funcionario.php" class="card adicionar">
     <div class="overlay"></div>
  <div class="circle">

<svg width="78px" height="75px" viewBox="29 14 78 75" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 42 (36781) - http://www.bohemiancoding.com/sketch -->

    <image href="img/formulario.png" x="35" y="10" width="73px" height="80px" />
    
</svg>
  </div>
  <p>Adicionar</p>
</a>






<a href="Editar_Funcionario.php" class="card editar">
     <div class="overlay"></div>
  <div class="circle">
    
<svg width="73px" height="83px" viewBox="27 21 70 80" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
   
    <image href="img/editar.png" x="27" y="20" width="70px" height="75px" />

</svg>

  </div>
  <p>Editar</p>
</a>









<a href="../Funcionarios/Pesquisar_Funcionario.php" class="card pesquisar">
     <div class="overlay"></div>
  <div class="circle">
    
    
<svg width="80px" height="93px" viewBox="27 21 70 80" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

  <image href="img/pesquisar.png" x="29" y="19" width="65px" height="80px" /> 

</svg>

  </div>
  <p>Pesquisar</p>
</a>

<a href="Deletar_Funcionario.php" class="card deletar">
     <div class="overlay"></div>
  <div class="circle">
     
    
  <svg width="71px" height="76px" viewBox="29 14 71 76" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <!-- Generator: Sketch 42 (36781) - http://www.bohemiancoding.com/sketch -->

    <image href="img/lixeira.png" x="28" y="15" width="71px" height="76px" />
    <!-- <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(1855.000000, 26.000000)">
        <path d="M4.28872448,42.7464904 C4.28872448,39.3309774 5.4159227,33.7621426 6.40576697,30.4912557 C10.5920767,32.1098991 14.3021264,35.1207513 18.69596,35.1207513 C30.993618,35.1207513 42.5761396,28.7162991 49.9992251,17.9014817 C56.8027248,23.8881252 60.8188351,33.0463165 60.8188351,42.7464904 C60.8188351,60.817447 47.6104607,76.6693426 32.5537798,76.6693426 C17.4970989,76.6693426 4.28872448,60.817447 4.28872448,42.7464904" id="Fill-8" fill="#AFCEFF"></path>
        <path d="M64.3368879,31.1832696 L62.8424171,46.6027478 L60.6432609,46.7824348 L59.8340669,34.6791304 L47.6573402,25.3339478 C44.2906753,34.068487 34.3459503,40.2903304 24.4684093,40.2903304 C17.7559812,40.2903304 10.046244,37.4168 5.80469412,32.8004522 L5.80469412,34.6791304 L5.80469412,46.6027478 L4.28932167,46.6027478 L1.30187314,27.8802435 C1.30187314,20.9790957 3.52342407,15.5432 7.27229127,11.3578087 C13.132229,4.79558261 21.8124018,0.0492173913 30.5672235,0.342852174 C37.4603019,0.569286957 42.6678084,2.72991304 50.8299179,0.342852174 C51.4629405,1.44434783 51.8615656,3.00455652 51.5868577,5.22507826 C51.4629405,6.88316522 51.2106273,7.52302609 50.8299179,8.45067826 C58.685967,14.1977391 64.3368879,20.7073739 64.3368879,31.1832696" id="Fill-10" fill="#3B6CB7"></path>
        <path d="M58.9405197,54.5582052 C62.0742801,54.8270052 65.3603242,52.60064 65.6350321,49.5386574 C65.772386,48.009127 65.2617876,46.5570226 64.3182257,45.4584487 C63.3761567,44.3613357 62.0205329,43.6162922 60.4529062,43.4818922 L58.9405197,54.5582052 Z" id="Fill-13" fill="#568ADC"></path>
        <path d="M6.32350389,54.675367 C3.18227865,54.8492104 0.484467804,52.4957496 0.306803449,49.4264626 C0.217224782,47.8925496 0.775598471,46.4579757 1.75200594,45.3886191 C2.7284134,44.3192626 4.10792487,43.6165843 5.67853749,43.530393 L6.32350389,54.675367 Z" id="Fill-15" fill="#568ADC"></path>
    </g> -->
</svg>

  </div>
  <p>Deletar</p>
</a>

</div>
    <script>

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