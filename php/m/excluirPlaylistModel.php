<?php
function exclusao(PDO $conexao, int $idPlaylist, int $idUser)
{
    try {
        $sql = "DELETE FROM tbplaylist WHERE idPlaylist = :idPlaylist AND idUser = :idUser;";

        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':idPlaylist', $idPlaylist, PDO::PARAM_INT);
        $sentenca->bindValue(':idUser', $idUser, PDO::PARAM_INT);

        return $sentenca->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>