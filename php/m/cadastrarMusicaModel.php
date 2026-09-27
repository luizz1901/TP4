<?php
function processarCadastro(PDO $conexao, string $nome, float $duracao, string $dataCriacao, string $caminhoFoto, int $idArtista): bool
{
    try {
        $sql = "INSERT INTO tbmusica (nome, duracao, DtCriacao, foto, id) VALUES (:nome, :duracao, :dataCriacao, :caminhoFoto, :idArtista)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':duracao', $duracao);
        $stmt->bindValue(':dataCriacao', $dataCriacao);
        $stmt->bindValue(':caminhoFoto', $caminhoFoto);
        $stmt->bindValue(':idArtista', $idArtista);
        return $stmt->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}

function buscarArtista(PDO $conexao, string $nomeArtista): int
{
    try {
        $nomeLimpo = trim($nomeArtista);
        $sql = "SELECT id FROM tbartbanda WHERE LOWER(nome) = LOWER(:nomeArtista)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nomeArtista', $nomeArtista);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return (int) $resultado['id'];
        } else {
            return -1;
        }
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function buscarTodosArtistas(PDO $conexao): array
{
    try {
        $sql = "SELECT id, nome FROM tbartbanda ORDER BY nome ASC";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>