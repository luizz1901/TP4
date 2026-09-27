<?php
function artistaExiste(PDO $conexao, string $nome): bool
{
    try {
        $sql = "SELECT COUNT(*) FROM tbartbanda WHERE nome = :nome";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':nome', trim($nome));
        $sentenca->execute();
        return $sentenca->fetchColumn() > 0;
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function nomeRepeteEdicao(PDO $conexao, string $nome, int $idAtual): bool
{
    try {
        $sql = "SELECT COUNT(*) FROM tbartbanda WHERE nome = :nome AND id <> :id";
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

function atualizar(PDO $conexao, string $nome, int $id, string $descricao, float $precoShow, int $idGenero)
{
    try {
        $sql = "UPDATE tbartbanda set nome = :nome, descricao = :descricao, precoShow = :precoShow, idGenero = :idGenero WHERE id = :id;";
        $sentenca = $conexao->prepare($sql);
        $sentenca->bindValue(':nome', trim($nome));
        $sentenca->bindValue(':id', $id);
        $sentenca->bindValue(':descricao', trim($descricao));
        $sentenca->bindValue(':precoShow', $precoShow);
        $sentenca->bindValue(':idGenero', $idGenero);
        $sentenca->execute();
        $conexao = null;
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function buscarArtista(PDO $conexao, int $id): ?array
{
    try {
        $sql = "SELECT ab.id, ab.nome, ab.descricao, ab.precoShow, ab.foto, ab.idGenero, g.nomeGenero
            FROM tbartbanda ab, tbgenero g
            WHERE ab.idGenero = g.idGenero AND ab.id = :id";
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

function buscarIdGenero(PDO $conexao, string $nomeGenero): int
{
    try {
        $sql = "SELECT idGenero FROM tbgenero WHERE nomeGenero = :nomeGenero";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nomeGenero', $nomeGenero);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return (int) $resultado['idGenero'];
        } else {
            return -1;
        }
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>