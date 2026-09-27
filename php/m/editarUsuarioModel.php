<?php
function nomeRepeteEdicao(PDO $conexao, string $nome, int $idAtual): bool
{
    try {
        $sql = "SELECT COUNT(*) FROM tbusuarios WHERE nome = :nome AND idUser <> :id";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':nome', trim($nome));
        $sentenca->bindValue(':id', $idAtual);
        $sentenca->execute();
        return $sentenca->fetchColumn() > 0;
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function atualizarPerfil(PDO $conexao, int $id, string $nome, string $senha, string $caminhoFoto)
{
    try {
        $sql = "UPDATE tbusuarios SET nome = :nome, senha = :senha, foto = :foto WHERE idUser = :id";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':nome', trim($nome));
        $sentenca->bindValue(':senha', $senha);
        $sentenca->bindValue(':foto', $caminhoFoto);
        $sentenca->bindValue(':id', $id);
        $sentenca->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function buscarUsuarioLogado(PDO $conexao, int $id): ?array
{
    try {
        $sql = "SELECT * FROM tbusuarios WHERE idUser = :id";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':id', $id);
        $sentenca->execute();
        $resultado = $sentenca->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>