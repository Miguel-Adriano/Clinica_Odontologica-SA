<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Transforme seu Sorriso</title>
    <link rel="stylesheet" href="css/servicos.css">

</head>
<body>
    <header>
        <h1>Transforme seu sorriso</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="Servicos.html" class="active">Serviços</a>
            <a href="SobreNos.html">Quem somos</a>
            <a href="Contato.html">Contato</a>
            <a href="Ver_Agendamentos.php">Agendamentos</a>
            <a href="Login.html">Login para Funcionarios</a>
        </nav>
    </header>

    <br><br>
    <center>
        <section>
            <input type="text" id="search-input" class="input" placeholder="Procurar serviço..." onkeyup="showSuggestions(this.value)" autocomplete="off">
            <div id="suggestions-container" class="suggestions" ></div>
        </section>
    </center>

    <script>
        // Função para buscar sugestões enquanto o usuário digita
        function showSuggestions(query) {
            const suggestionsContainer = document.getElementById("suggestions-container");
            
            // Se a consulta for vazia, esconda as sugestões
            if (query.length === 0) {
                suggestionsContainer.innerHTML = '';
                return;
            }

            // Requisição AJAX para o backend (PHP)
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "search_suggestions.php?q=" + query, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const suggestions = JSON.parse(xhr.responseText);
                    suggestionsContainer.innerHTML = '';
                    
                    suggestions.forEach(function(suggestion) {
                        const div = document.createElement("div");
                        div.classList.add("suggestion-item");
                        div.innerHTML = suggestion.nome;
                        div.onclick = function() {
                            // Redireciona para agendar.php com o id_servico na URL
                            window.location.href = "agendar.php?id_servico=" + suggestion.id_servico;
                        };
                        suggestionsContainer.appendChild(div);
                    });
                }
            };
            xhr.send();
        }
    </script>


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
        </div>
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

<br><br><br>
    <footer style=" padding: 20px 0; text-align: center;">
        <div style="max-width: 1200px; margin: auto; display: flex; flex-wrap: wrap; justify-content: space-between; padding: 0 20px;">
            <!-- Sobre nós -->
            <div style="flex: 1 1 200px; margin: 10px;">
                <h3>Sobre nós</h3>
                <p>Somos uma Clinica comprometida em oferecer os melhores serviços para nossos clientes.</p>
            </div>
    
            <!-- Links úteis -->
            <div style="flex: 1 1 200px; margin: 10px;">
                <h3>Links úteis</h3>
                <ul style="list-style: none; padding: 0; text-align: center;">
                    <li><a href="index.html" style="color: black; text-decoration: none;">Início</a></li>
                    <li><a href="SobreNos.html" style="color: black; text-decoration: none;">Sobre</a></li>
                    <li><a href="Servicos.php" style="color: black; text-decoration: none;">Serviços</a></li>
                    <li><a href="Contato.html" style="color: black; text-decoration: none;">Contato</a></li>
                </ul>
            </div>
    
            <!-- Redes sociais -->
            <div style="flex: 1 1 200px; margin: 10px;">
                <h3>Siga-nos</h3>
                <a href="" style="color: black; margin-right: 10px;">Facebook</a>
                <a href="" style="color: black; margin-right: 10px;">Twitter</a>
                <a href="" style="color: black; margin-right: 10px;">Instagram</a>
            </div>
        </div>
        <div style="margin-top: 20px; border-top: 1px solid #555; padding-top: 10px;">
            <p>&copy; 2024 Transforme seu Sorriso. Todos os direitos reservados.</p>
        </div>
    </footer>
    <!-- CONTATO WHATSAPP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://wa.me/5547997078168?text=Adorei%20seu%20artigo" style="position:fixed;width:60px;height:60px;bottom:40px;right:40px;background-color:#25d366;color:#FFF;border-radius:50px;text-align:center;font-size:30px;box-shadow: 1px 1px 2px #888; z-index:1000;" target="_blank">
        <i style="margin-top:16px" class="fa fa-whatsapp"></i>
    </a>
</body>
</html>
