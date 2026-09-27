<?php

function exclusao(PDO $conexao, int $id)
{
    try {
        $sql = "DELETE FROM tbmusica WHERE idMusica = :id;";

        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':id', $id, PDO::PARAM_INT);

       return $sentenca->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>