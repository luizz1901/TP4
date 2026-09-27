<?php

function exclusao(PDO $conexao, int $id)
{
    try {
        $sql = "DELETE FROM tbusuarios WHERE idUser = :id;";

        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':id', $id, PDO::PARAM_INT);

        $sentenca->execute();

    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}


?>