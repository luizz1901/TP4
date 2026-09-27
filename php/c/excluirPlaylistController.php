<?php
require_once '../requireDuplo.php';
require_once '../m/excluirPlaylistModel.php';

try {
    $idForm = (int) ($_SESSION['id'] ?? 0);
    $idPlaylist = (int) ($_GET['id'] ?? 0);

    if ($idForm > 0 && $idPlaylist > 0) {
        if (exclusao($conexao, $idPlaylist, $idForm)) {
            http_response_code(200);
            echo "Playlist excluída!";
        } else {
            http_response_code(500);
            echo "Erro ao excluir a playlist.";
        }
    } else {
        http_response_code(400);
        echo "Dados inválidos.";
    }


    $conexao = null;
    exit;
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
?>