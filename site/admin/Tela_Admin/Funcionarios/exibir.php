<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
echo "<h3> Miguel Adriano  </h3> <hr>";
    if(isset($_GET['imagem'])) {
        $nomeImagem = $_GET['imagem'];
        $caminhoImagem = 'uploads/jpg' . $nomeImagem;
        echo "<img src=\"$caminhoImagem\" alt=\"Imagem Enviada\">";
    } else {
        echo "Nenhuma imagem foi enviada.";
    }
    ?>
</body>
</html>