<?php

function retornaArtistas(PDO $conexao): array
{
    try {
        $sql = "SELECT ab.id, ab.nome, ab.descricao, ab.precoShow, ab.foto, g.nomeGenero
 FROM tbartbanda as ab inner join tbgenero as g on ab.idGenero = g.idGenero";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}

?>