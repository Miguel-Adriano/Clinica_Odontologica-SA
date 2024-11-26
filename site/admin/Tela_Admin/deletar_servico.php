<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/Clinica_Odontologica/admin/Styles/homeadm.css">
    <link rel="stylesheet" href="/Clinica_Odontologica/admin/Styles/servicos.css">
    <title>Deletar Serviço</title>
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
            <span class="logo navLogo"><a href="#">Administrador</a></span>

            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#"></a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>

                <ul class="nav-links">
                <li><a href="Ver_Agendamentos.php">Agendamentos</a></li>
                    <li><a href="Servicos.php">Serviços</a></li>
                    <li><a href="Funcionarios.php">Funcionarios</a></li>
                    <li><a href="Clientes.php">Clientes</a></li>
                    <li><a href="sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <br><br><br><br><br>
    <center><h1>Deletar Serviço:</h1></center>

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

    // Consultar os dados da tabela 'servicos'
    $sql = "SELECT id_servico, nome, descricao, valor FROM servicos";
    $result = $conn->query($sql);
    ?>

    <section>
        <div class="services" id="services-list">
            <?php
            // Verifica se existem resultados
            if ($result->num_rows > 0) {
                // Exibe os dados de cada serviço
                while($row = $result->fetch_assoc()) {
                    echo '<div class="service">';
                    echo '<div class="service-content">';
                    echo '<h3 class="service-title">' . $row["nome"] . '</h3>';
                    echo '<p class="service-price">R$ ' . $row["valor"] . '</p>';
                    echo '<p class="service-description">' . nl2br($row["descricao"]) . '</p>';
                    // Adiciona um botão de deletar
                    echo '<a href="deleta.php?id_servico=' . $row["id_servico"] . '" class="service-button" onclick="return confirm(\'Tem certeza que deseja deletar este serviço?\')">DELETAR SERVIÇO</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Nenhum serviço encontrado";
            }

            // Fecha a conexão
            $conn->close();
            ?>
            
            <div class="service">
                <div class="service-content">
                    <h3 class="service-title"></h3>
                    <p class="service-price"></p>
                    <p class="service-description"></p>
                    <br>
                    <a href="Servicos.php" class="service-button">Marcar Consulta</a>
                    <br>
                    <a href="cadastrar_servico.php" class="service-button"> Adicionar Serviço </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function filterServices() {
            let searchQuery = document.getElementById('search-input').value.toLowerCase();
            let services = document.querySelectorAll('.service');
            services.forEach(service => {
                service.classList.remove('highlight');
                let serviceName = service.querySelector('.service-title').textContent.toLowerCase();
                if (serviceName.startsWith(searchQuery)) {
                    service.classList.add('highlight');
                }
            });
        }
    </script>
</body>
</html>
