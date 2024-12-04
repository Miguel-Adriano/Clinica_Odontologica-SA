<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="Clinica_Odontologica/admin/Styles/Style.css">
    <link rel="stylesheet" href="css/Arquivo.css">
    <link rel="stylesheet" href="css/Demo.css">
        
    <!-- ===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/js/telefone.js">
    <link rel="shortcut icon" type="imagex/png" href="/admin/img/logo.png">

    <link rel="stylesheet" href="css/cadastro_cliente.css">

    <title>Cadastrar Funcionario</title>


</head>
<body class="theme-one">
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Funcionarios</a></span>

            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#">Funcionarios</a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>

                <ul class="nav-links">
                <li><a href="/Clinica_Odontologica/admin/Tela_Admin/Ver_Agendamentos.php">Agendamentos</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="#">Serviços</a></li>
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
                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

           
        </div>
    </nav>



>


<div class="content">
<div class="container">
            <div class="form-section">
                <center><h2>Cadastro de Paciente</h2> </center>
                <br>

                <form class="professional-form" enctype="multipart/form-data" method="POST" action="BE_CC.php">
                    <div class="left-section">
                        <div class="space"></div>
                    </div>

                    <div class="right-section">
                        <div style="width: 600px;">
                            <label>Nome*</label>
                            <input type="text" placeholder="Santiago" name="nome" id="nome" autocomplete="off" required>
                        </div>

                    <div style="align-items: center; width: 600px; display: flex; gap: 10px;">
                        <label class="pequeno">Sexo*</label>
                        <select required name="sexo" id="sexo" style="cursor: pointer;">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                        <label class="cpf">CPF*</label>
                        <input type="text" placeholder="000.000.000-00" name="cpf" id="cpf" maxlength="14" autocomplete="off" required>

                    </div>


                    <label>Email*</label>
                    <input style="width: 600px;"type="email" name="email" id="email" placeholder="contato@simpleexmplo.com" autocomplete="off" required>
                    
                    <div>
                        <label >Data de Nascimento*</label>
                        <input style="cursor: pointer;" class="pequeno" type="date" name="data" id="data" autocomplete="off" required>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <label>Estado*</label>
                        <select class="estados" id="estado" name="estado" id="estado" style="cursor: pointer;" required>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option selected value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>

                        <label>Cidade*</label>
                        <input style="width: 300px;" type="text" name="cidade" id="cidade" placeholder="Cidade" autocomplete="off" required>

                    </div>                 

                    <label>Bairro*</label>
                    <input style="width: 600px;" type="text" name="bairro" id="bairro" placeholder="Bairro" autocomplete="off" required>

                    <label>Rua*</label>
                    <input style="width: 600px;" type="text" name="rua" id="rua" placeholder="Rua" autocomplete="off" required>

                    <label>N°*</label>
                    <input style="width: 600px;" type="number" name="numre" id="numre" placeholder="Número residencial" autocomplete="off" required>

                    <label>CEP*</label>
                    <input style="width: 600px;" maxlength="9" type="text" name="cep" id="cep" placeholder="00000-000" autocomplete="off" required>

                    <label>Telefone*</label>
                    <input style="width: 600px;" type="text" id="telefone" name="telefone" placeholder="47 99999-9999"
                    maxlength="14"  autocomplete="off" required>
                
                    <div class="form-buttons" style="width: 250px"> 
                       <button type="submit"> Cadastrar </button>   
                       <button class="vermelho" type="reset">  Apagar  </button> 
                    </div> 
            </div>                 
        </div>

        </form>        
    </div>
</div>
</div>
        <script src="js/telefone.js"></script>
   <script src="js/cep.js"></script>
    <script src="js/cpf.js"></script>

</body>
</html>