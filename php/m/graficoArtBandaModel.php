<?php
function retornaTotaisPorGenero(PDO $conexao): array {
try {
    $sql = "SELECT g.nomeGenero, COUNT(a.idGenero) AS total
            FROM tbgenero g
            LEFT JOIN tbartbanda a ON g.idGenero = a.idGenero
            GROUP BY g.idGenero, g.nomeGenero";

    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}

    
}
?>