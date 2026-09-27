<?php
require_once '../requireDuplo.php';
require_once '../m/gerenciarPlaylistModel.php';

try {
    $idPlaylist = isset($_GET['id']) ? (int) $_GET['id'] : 0;

    if ($idPlaylist === 0) {
        header("Location: tabelaPlaylistController.php");
        exit;
    }

    $acao = $_GET['acao'] ?? null;
    $idMusica = isset($_GET['idMusica']) ? (int) $_GET['idMusica'] : 0;

    if ($acao && $idMusica > 0) {
        if ($acao === 'adicionar') {
            $sucesso = adicionaMusica($conexao, $idPlaylist, $idMusica);
            if ($sucesso) {
                header("Location: gerenciarPlaylistController.php?id=$idPlaylist");
            } else {
                header("Location: gerenciarPlaylistController.php?id=$idPlaylist");
            }
            exit;
        }

        if ($acao === 'remover') {
            removeMusica($conexao, $idPlaylist, $idMusica);
            header("Location: gerenciarPlaylistController.php?id=$idPlaylist");
            exit;
        }
    }

    $todasMusicas = listarMusicas($conexao);
    $playlist = buscarPlaylistPorId($conexao, $idPlaylist);
    $idsMusicasNaPlaylist = listarIdsMusicasDaPlaylist($conexao, $idPlaylist);
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}



require_once '../v/gerenciarPlaylistView.php';