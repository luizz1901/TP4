<?php
function processarCadastro(PDO $conexao, string $nome, string $arquivoFoto, int $idUser)
{
    try {
        $sql = "INSERT INTO tbplaylist (nome, foto, idUser) VALUES (:nome, :arquivoFoto, :idUser)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':arquivoFoto', $arquivoFoto);
        $stmt->bindValue(':idUser', $idUser);
        return $stmt->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>