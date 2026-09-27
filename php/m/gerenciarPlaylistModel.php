<?php
function listarMusicas($conexao)
{
    try {

        $sql = "SELECT m.idMusica, m.nome, m.duracao, m.DtCriacao, m.foto, ab.nome as nomeArtista
    FROM tbmusica as m, tbartbanda as ab
    WHERE m.id = ab.id";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function adicionaMusica(PDO $conexao, int $idPlaylist, int $idMusica): bool
{
    try {
        $sql = "INSERT INTO tbmusicaplaylist (idMusica, idPlaylist) VALUES (:idMusica, :idPlaylist)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idMusica', $idMusica, PDO::PARAM_INT);
        $stmt->bindValue(':idPlaylist', $idPlaylist, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function removeMusica(PDO $conexao, int $idPlaylist, int $idMusica)
{
    try {
        $sql = "DELETE FROM tbmusicaplaylist WHERE idPlaylist = :idPlaylist AND idMusica = :idMusica";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idMusica', $idMusica, PDO::PARAM_INT);
        $stmt->bindValue(':idPlaylist', $idPlaylist, PDO::PARAM_INT);
        return $stmt->execute();

    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}

function buscarPlaylistPorId(PDO $conexao, int $idPlaylist)
{
    try {
        $sql = "SELECT p.idPlaylist, p.nome, p.foto 
            FROM tbplaylist as p 
            WHERE p.idPlaylist = :idPlaylist";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}

function listarIdsMusicasDaPlaylist(PDO $conexao, int $idPlaylist): array
{
    try {
        $sql = "SELECT idMusica FROM tbmusicaplaylist WHERE idPlaylist = :idPlaylist";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idPlaylist', $idPlaylist, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);

    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}
?>