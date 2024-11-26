<?php
        require_once("conectaDB.php");
        $conexao = conectadb();
        $conexao->set_charset("utf8");
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM pacientes WHERE id_paciente='$id'";
            $stmt = $conexao->prepare($sql);
            if ($stmt->execute()) {
                header ("Location: Deletar_Cliente.php");
            } else {
                echo $stmt->error;
            }
        }
        $conexao->close()
?>