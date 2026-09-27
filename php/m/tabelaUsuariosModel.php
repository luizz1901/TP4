<?php
function contarTotalUsuarios(PDO $conexao, string $pesquisa): int
{
    try {
        $sql = "SELECT COUNT(*) FROM tbusuarios WHERE nome LIKE :pesquisa";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}

function listarUsuarios(PDO $conexao, string $pesquisa, int $limite, int $offset): array
{
    try {
        $sql = "SELECT * FROM tbusuarios WHERE nome LIKE :pesquisa LIMIT :limite OFFSET :offset";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}
?>