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


    <link rel="stylesheet" href="css/cadastrar_funcionario.css">

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
                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

           
        </div>
    </nav>

    <!-- <script src="script.js"></script> -->

<script src="/admin/js/cpf.js"></script>
<script>
 // Seleciona o campo de CPF
 const cpfInput = document.getElementById('cpf');

// Adiciona o evento para aplicar a máscara
cpfInput.addEventListener('input', function () {
    let value = cpfInput.value;

    // Remove caracteres não numéricos
    value = value.replace(/\D/g, '');

    // Aplica a máscara
    if (value.length > 3 && value.length <= 6) {
        value = value.replace(/(\d{3})(\d+)/, '$1.$2');
    } else if (value.length > 6 && value.length <= 9) {
        value = value.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3');
    } else if (value.length > 9) {
        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d+)/, '$1.$2.$3-$4');
    }

    // Atualiza o valor do campo de entrada
    cpfInput.value = value;
});
</script>


<div class="content">
<div class="container">
            <div class="form-section">
                <center><h2>Cadastro do Profissional</h2> </center>
                <br>

                <form class="professional-form" enctype="multipart/form-data" method="POST" action="BE_CF.php">
                    <div class="left-section">
                        <div class="space"></div>
                    </div>

                    <div class="right-section">
                        <div style="width: 600px;">
                            <label>Nome do Profissional*</label>
                            <input type="text" placeholder="Santiago" name="nome" id="nome" required>
                        </div>

                    <div style="align-items: center; width: 600px; display: flex; gap: 10px;">
                        <label class="pequeno">Sexo*</label>
                        <select required name="sexo" id="sexo">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                        <label class="cpf">CPF*</label>
                        <input type="text" placeholder="000.000.000-00" name="cpf" id="cpf" maxlength="14" required>

                        <label>Senha*</label>
                        <input type="text" placeholder="senha" name="senha" id="senha" required>
                    </div>
                             
                    <label>Email*</label>
                    <input style="width: 600px;"type="email" name="email" id="email" placeholder="contato@simpleexmplo.com" required>
                    
                    <div>
                        <label >Data de Nascimento*</label>
                        <input class="pequeno" type="date" name="data" id="data" required>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <label>Estado*</label>
                        <select class="estados" id="estado" name="estado" id="estado" required>
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
                        <input style="width: 300px;" type="text" name="cidade" id="cidade" placeholder="Cidade" required>

                    </div>                 

                    <label>Bairro*</label>
                    <input style="width: 600px;" type="text" name="bairro" id="bairro" placeholder="Bairro" required>

                    <label>Rua*</label>
                    <input style="width: 600px;" type="text" name="rua" id="rua" placeholder="Rua" required>

                    <label>N°*</label>
                    <input style="width: 600px;" type="number" name="numre" id="numre" placeholder="Número residencial" required>

                    <label>CEP*</label>
                    <input style="width: 600px;" type="text" name="cep" id="cep" placeholder="00000-000" required>

                    <label>Telefone*</label>
                    <input style="width: 600px;" type="text" id="telefone" name="telefone" placeholder="47 99999-9999"
                    maxlength="14" onkeydown="javascript:fMasc(this,mTel);" required>
                    <label>Cargo*</label>
                    <input style="width: 600px;" type="text" name="cargo" id="cargo" placeholder="Secretario"required>
                    
                    
                    <label>Grupo de Acesso*</label>
                    <select style="width: 600px;" name="acesso" id="acesso" placeholder="Selecione" required>
                        <option value="1">Administrador</option>
                        <option value="2">secretario</option>
                        <option value="3">Dentista</option>
                    </select> 

                
                    <div class="form-buttons" style="width: 150px"> 
                        <button type="submit">Cadastrar </button>
                    </div> 
        
                  

            </div>                 
        </div>

            
            
        </form>        
    </div>
</div>
</div>
    

</body>
</html>