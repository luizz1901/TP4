<?php
require_once '../requireTriplo.php';
require_once '../m/editarMusicaModel.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idMusica = (int) ($_POST['id'] ?? 0);
        $novoNome = $_POST['nome'] ?? '';
        $novaDuracao = (float) ($_POST['duracao'] ?? 0);
        $novaData = $_POST['data'] ?? '';
        $idArtista = (int) ($_POST['artista'] ?? 0);
        $fotoAtual = $_POST['foto_atual'] ?? '';

        $caminhoArquivo = $fotoAtual;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $novoArquivoFoto = $_FILES['foto'];
            $tamanhoArquivo = $novoArquivoFoto['size'];
            $extensaoArquivo = strtolower(pathinfo($novoArquivoFoto['name'], PATHINFO_EXTENSION));

            if (verificaFoto($tamanhoArquivo, $extensaoArquivo)) {
                $caminhoArquivo = uploadFoto($novoArquivoFoto);
            }
        }

        atualizar($conexao, $idMusica, $novoNome, $novaDuracao, $novaData, $caminhoArquivo, $idArtista);

        $conexao = null;
        header("Location: tabelaMusicasController.php");
        exit;
    }

    $idMusica = (int) ($_GET['id'] ?? 0);

    if ($idMusica <= 0) {
        header("Location: tabelaMusicasController.php");
        exit;
    }

    $musica = buscarMusicaPorId($conexao, $idMusica);
    $artistas = listarArtistas($conexao);

    $conexao = null;

    if (!$musica) {
        header("Location: tabelaMusicasController.php");
        exit;
    }
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}

require '../v/editarMusicaView.php';
?>