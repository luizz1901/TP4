<?php
require_once '../requireTriplo.php';
require_once '../m/editarArtBandaModel.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int) ($_POST['id'] ?? 0);
        $novoNome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $preco = limparPreco($_POST['preco'] ?? '0');
        $idGenero = buscarIdGenero($conexao, $_POST['genero']);

        if (nomeRepeteEdicao($conexao, $novoNome, $id)) {
            header("Location: editarArtBandaController.php?id=$id");
            exit;
        }

        atualizar($conexao, $novoNome, $id, $descricao, $preco, $idGenero);

        header("Location: tabelaArtBandaController.php");
        exit;
    }
    $idForm = (int) ($_GET['id'] ?? 0);
    $artista = buscarArtista($conexao, $idForm);

    if (!$artista) {
        header("Location: tabelaArtBandaController.php");
        exit;
    }
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
function limparPreco(string $precoCru): float
{
    $precoLimpo = str_replace(['R$', ' ', ','], ['', '', '.'], $precoCru);
    return (float) $precoLimpo;
}
require '../v/editarArtBandaView.php';
?>