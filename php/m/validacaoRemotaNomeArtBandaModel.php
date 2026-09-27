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

?>