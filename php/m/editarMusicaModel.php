<?php

function buscarMusicaPorId(PDO $conexao, int $idMusica): ?array
{
    try {
        $sql = "SELECT idMusica, nome, duracao, DtCriacao, foto, id AS idArtista FROM tbmusica WHERE idMusica = :idMusica";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idMusica', $idMusica, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function listarArtistas(PDO $conexao): array
{
    try {
        $sql = "SELECT id, nome FROM tbartbanda ORDER BY nome ASC";
        $stmt = $conexao->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
function atualizar(PDO $conexao, int $idMusica, string $nome, float $duracao, string $dataCriacao, string $caminhoFoto, int $idArtista): bool
{
    try {
        $sql = "UPDATE tbmusica 
            SET nome = :nome, 
                duracao = :duracao, 
                DtCriacao = :dataCriacao, 
                foto = :caminhoFoto, 
                id = :idArtista 
            WHERE idMusica = :idMusica";

        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':nome', trim($nome));
        $sentenca->bindValue(':duracao', $duracao);
        $sentenca->bindValue(':dataCriacao', $dataCriacao);
        $sentenca->bindValue(':caminhoFoto', $caminhoFoto);
        $sentenca->bindValue(':idArtista', $idArtista, PDO::PARAM_INT);
        $sentenca->bindValue(':idMusica', $idMusica, PDO::PARAM_INT);

        return $sentenca->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}
?>