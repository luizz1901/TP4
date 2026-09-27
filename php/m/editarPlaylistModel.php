<?php

function buscarPlaylist(PDO $conexao, int $idPlaylist, int $idUser)
{
    try {
        $sql = "SELECT p.nome AS nomePlaylist, p.foto, u.nome AS nomeUsuario
            FROM tbplaylist AS p
            INNER JOIN tbusuarios AS u ON p.idUser = u.idUser
            WHERE p.idPlaylist = :idPlaylist AND p.idUser = :idUser";

        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':idPlaylist', $idPlaylist, PDO::PARAM_INT);
        $sentenca->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $sentenca->execute();

        $resultado = $sentenca->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function atualizar(PDO $conexao, string $nome, string $caminhoArquivo, int $idPlaylist, int $idUser)
{
    try {
        $sql = "UPDATE tbplaylist set nome = :nome, foto = :caminhoArquivo WHERE idPlaylist = :idPlaylist AND idUser = :idUser;";

        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':nome', trim($nome));
        $sentenca->bindValue(':caminhoArquivo', $caminhoArquivo);
        $sentenca->bindValue(':idUser', $idUser, PDO::PARAM_INT);
        $sentenca->bindValue(':idPlaylist', $idPlaylist, PDO::PARAM_INT);

        $sentenca->execute();

        $conexao = null;
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>