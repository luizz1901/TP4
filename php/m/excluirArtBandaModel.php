<?php

function exclusao(PDO $conexao, int $id)
{
    try {
        $sql = "DELETE FROM tbartbanda WHERE id = :id;";

        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':id', $id, PDO::PARAM_INT);

       return $sentenca->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>