<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Styles/homeadm.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/site/admin/Styles/servicos.css">
    <title>Serviços</title>
    <style>
        .input {
    width: 500px;
    height: 25px;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid lightgrey;
    outline: none;
    box-shadow: 0px 0px 10px rgba(169, 169, 169, 0.8);
}

.suggestion-item:hover {
    background-color: #f1f1f1;
}

.input:hover {
    border: 2px solid lightgrey;
    box-shadow: 0px 0px 20px -17px;
}

.input:active {
    transform: scale(0.95);
}

.input:focus {
    border: 2px solid grey;
}


    </style>

</head>
<body>
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Dentista - Serviços</a></span>

            <div class="menu">


            <ul class="nav-links">


                    <li><a href="Agendamentos.php">Agendamentos</a></li>

                    <li><a href="Servicos.php" class="activate">Serviços</a></li>

                    <li><a href="Clientes/Pesquisar_Cliente.php">Clientes</a></li>

                    <li><a href="Prontuarios.php">Prontuários</a></li>

                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>
    <br><br><br><br><br>
    <center><h1>Serviços atuais:</h1></center>



    <?php
    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clinica_odontologica";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn -> set_charset("utf8");
    // Verificar conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Consultar os dados da tabela 'servicos'
    $sql = "SELECT id_servico, nome, descricao, valor FROM servicos";
    $result = $conn->query($sql);
    ?>

    <section>
        <div class="services" id="services-list">
            <?php
            // Variável para contar os serviços
            $counter = 0;

            // Verifica se existem resultados
            if ($result->num_rows > 0) {
                // Exibe os dados de cada serviço
                while($row = $result->fetch_assoc()) {
                    echo '<div class="service">';
                    echo '<div class="service-content">';
                    echo '<h3 class="service-title">' . $row["nome"] . '</h3>';
                    echo '<p class="service-price">R$ ' . $row["valor"] . '</p>';
                    echo '<p class="service-description">' . nl2br($row["descricao"]) . '</p>';
                    echo '<a href="agendar.php?id_servico=' . $row["id_servico"] . '" class="service-button">AGENDAR AGORA</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Nenhum serviço encontrado";
            }

            // Fecha a conexão
            $conn->close();
            ?>
                  


           
    </section>

    <script>
    function filterServices() {
        // Obtém o valor da barra de pesquisa
        let searchQuery = document.getElementById('search-bar').value.toLowerCase();

        // Obtém todos os serviços exibidos
        let services = document.querySelectorAll('.service');

        // Remove a classe 'highlight' de todos os serviços
        services.forEach(service => {
            service.classList.remove('highlight');
        });

        // Se a pesquisa não estiver vazia, aplica o destaque aos serviços que começam com a letra digitada
        if (searchQuery !== '') {
            services.forEach(service => {
                let serviceName = service.querySelector('.service-title').textContent.toLowerCase();
                if (serviceName.startsWith(searchQuery)) {
                    service.classList.add('highlight');  // Adiciona a classe de destaque
                }
            });
        }
    }
</script>


</body>
</html>