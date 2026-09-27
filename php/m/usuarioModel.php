<?php
function buscarUsuarioPorNome(PDO $conexao, string $nome)
{
    try {
        $sql = "SELECT idUser, nome, senha, foto FROM tbusuarios WHERE nome = :nome";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}

function buscarUsuarioPorId(PDO $conexao, int $id)
{
    try {
        $sql = "SELECT idUser, nome, senha, foto FROM tbusuarios WHERE idUser = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }


}
?>