<?php

function contarTotalPlaylists(PDO $conexao, string $pesquisa, int $idUser): int
{
    try {
        $sql = "SELECT COUNT(*) FROM tbplaylist WHERE nome LIKE :pesquisa AND idUser = :idUser";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
        $stmt->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function listarPlaylists(PDO $conexao, string $pesquisa, int $limite, int $offset, int $idUser): array
{
    try {
        $sql = "SELECT p.idPlaylist, p.nome as nomePlaylist, p.foto, u.nome as nomeUsuario, GROUP_CONCAT(m.nome SEPARATOR '|||') AS musicas
    FROM tbplaylist AS p
    INNER JOIN tbusuarios AS u ON p.idUser = u.idUser
    LEFT JOIN tbmusicaplaylist AS pm ON p.idPlaylist = pm.idPlaylist
    LEFT JOIN tbmusica AS m ON pm.idMusica = m.idMusica
    WHERE p.idUser = :idUser AND p.nome LIKE :pesquisa
    GROUP BY p.idPlaylist
    LIMIT :limite OFFSET :offset";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>