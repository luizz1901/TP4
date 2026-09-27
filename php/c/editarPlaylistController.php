<?php
require_once '../requireTriplo.php';
require_once '../m/editarPlaylistModel.php';

try {
    $idUser = (int) ($_SESSION['id'] ?? 0);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $idPlaylist = (int) ($_GET['id'] ?? 0);
        $playlist = buscarPlaylist($conexao, $idPlaylist, $idUser);

        if (!$playlist) {
            header("Location: tabelaPlaylistController.php");
            exit;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idPlaylist = (int) ($_POST['idPlaylist'] ?? 0);
        $novoNome = $_POST['nome'] ?? '';

        $playlistAtual = buscarPlaylist($conexao, $idPlaylist, $idUser);
        $caminhoArquivo = $playlistAtual['foto'] ?? '';

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $arquivoFoto = $_FILES['foto'];
            $nomeOriginal = $arquivoFoto['name'];
            $extensaoArquivo = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
            $tamanhoArquivo = $arquivoFoto['size'];

            if (verificaFoto($tamanhoArquivo, $extensaoArquivo)) {
                $caminhoArquivo = uploadFoto($arquivoFoto);
            } else {
                header("Location: editarPlaylistController.php?id=" . $idPlaylist . "&erro=foto");
                exit;
            }
        }

        atualizar($conexao, $novoNome, $caminhoArquivo, $idPlaylist, $idUser);
        header("Location: tabelaPlaylistController.php");
        exit;
    }
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
require '../v/editarPlaylistView.php';
?>