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
            <span class="logo navLogo"><a href="#">Secretario - Clientes</a></span>

            <div class="menu">


                <ul class="nav-links">
                    <li><a href="Home.php">Home</a></li>

                    <li><a href="Agendamentos.php">Agendamentos</a></li>

                    <li><a href="Servicos.php" class="activate">Serviços</a></li>

                    <li><a href="Clientes/Alteração_Cliente.php">Clientes</a></li>

                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>


</body>
</html>