<?php
function usuarioExiste(PDO $conexao, string $nome, string $id)
{
    try {
        if (!empty($id)) {
            $sql = "SELECT COUNT(*) FROM tbusuarios WHERE nome = :nome AND idUser <> :id";
            $sentenca = $conexao->prepare($sql);
            $sentenca->bindValue(':id', (int) $id);
        } else {
            $sql = "SELECT COUNT(*) FROM tbusuarios WHERE nome = :nome";
            $sentenca = $conexao->prepare($sql);
        }

        $sentenca->bindValue(':nome', trim($nome));
        $sentenca->execute();
        return $sentenca->fetchColumn() > 0;

    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>