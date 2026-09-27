<?php
function contarTotalArtistas(PDO $conexao, string $pesquisa): int
{
    try {
        $sql = "SELECT COUNT(*) FROM tbartbanda WHERE nome LIKE :pesquisa";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}

function listarArtistas(PDO $conexao, string $pesquisa, int $limite, int $offset): array
{
    try {
        $sql = "select ab.id, ab.nome, ab.descricao, ab.precoShow, ab.foto, g.nomeGenero
from tbartbanda ab, tbgenero g
where ab.idGenero = g.idGenero and ab.nome like :pesquisa LIMIT :limite OFFSET :offset";
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