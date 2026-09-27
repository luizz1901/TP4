<?php

function contarTotalMusicas (PDO $conexao, string $pesquisa): int {
try {
    $sql = "SELECT COUNT(*) FROM tbmusica WHERE nome LIKE :pesquisa";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
    $stmt->execute();
    return (int) $stmt->fetchColumn();
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
}

function listarMusicas (PDO $conexao, string $pesquisa, int $limite, int $offset): array {
try {
    $sql = "SELECT m.idMusica, m.nome, m.duracao, m.DtCriacao, m.foto, a.nome AS nomeArtista
            FROM tbmusica AS m 
            INNER JOIN tbartbanda AS a ON m.id = a.id 
            WHERE m.nome LIKE :pesquisa 
            LIMIT :limite OFFSET :offset";
    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
}
?>