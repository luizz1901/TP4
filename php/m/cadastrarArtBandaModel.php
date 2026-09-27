<?php
function processarCadastro(PDO $conexao, string $nome, string $descricao, string $preco, string $caminhoArquivo, int $idGenero): bool
{
    try {
        $sql = "INSERT INTO tbartbanda (nome, descricao, precoShow, foto, idGenero) VALUES (:nome, :descricao, :preco, :caminhoArquivo, :idGenero)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':caminhoArquivo', $caminhoArquivo);
        $stmt->bindValue(':idGenero', $idGenero);
        return $stmt->execute();
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}

function buscarIdGenero(PDO $conexao, string $nomeGenero): int
{
    try {
        $sql = "SELECT idGenero FROM tbgenero WHERE nomeGenero = :nomeGenero";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nomeGenero', $nomeGenero);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return (int) $resultado['idGenero'];
        } else {
            return -1;
        }
    } catch (Exception $e) {
        header("Location: ../v/paginaErro.php");
        exit;
    }
}
?>