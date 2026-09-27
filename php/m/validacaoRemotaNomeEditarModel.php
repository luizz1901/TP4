<?php

function nomeRepeteEdicao(PDO $conexao, string $nome, int $idAtual): bool {
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

?>