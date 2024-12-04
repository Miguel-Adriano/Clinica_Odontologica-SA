<?php
// Iniciar a sessão
session_start();

// Destruir todas as variáveis de sessão
session_unset();

// Destruir a sessão
session_destroy();

// Prevenir que a página seja armazenada em cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


// Redirecionar para a página de login (ou qualquer página que você queira)
header("Location: /Clinica_Odontologica/site/Index.html");
exit();
?>
