<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="Clinica_Odontologica/admin/Styles/Style.css">
        
    <!-- ===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/editar_cliente.css">
</head>

<body>

<nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#">Administrador</a></span>

            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#">Administrador</a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>

                <ul class="nav-links">
                <li><a href="/Clinica_Odontologica/site/admin/Tela_Secretaria/Home.php">Home</a></li>    
                    <li><a href="/Clinica_Odontologica/site/admin/Tela_Secretaria/Agendamentos.php">Agendamentos</a></li>
                    <li><a href="/Clinica_Odontologica/site/admin/Tela_Secretaria/Servicos.php" class="activate">Serviços</a></li>
                    <li><a href="/Clinica_Odontologica/site/admin/Tela_Secretaria/Clientes/Alteração_Cliente.php">Clientes</a></li>
                    <li><a href="/Clinica_Odontologica/site/sair.php">Sair</a></li>
                </ul>
            </div>

            
        </div>
    </nav>
    <br><br><br><br>
    <div class="container">
        <h1 class="display-5 mb-4">Editar Clientes</h1>
        <table id="listar-usuario" class="table table-striped table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Deletar</th>   
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
            "url": "Edita_lista_cliente.php",
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
