<?php
function processarCadastro(PDO $conexao, string $nome, string $senha, string $caminhoArquivo): bool
{
    try {
        $sql = "INSERT INTO tbusuarios (nome, senha, foto) VALUES (:nome, :senha, :foto)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':foto', $caminhoArquivo);
        return $stmt->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>