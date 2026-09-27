<?php
require_once '../requireDuplo.php';
require_once '../m/tabelaPlaylistModel.php';

try {
    $pesquisa = $_GET['pesquisa'] ?? '';
    $limite = (int) ($_GET['limite'] ?? 10);
    $idUser = $_SESSION['id'];

    $totalRegistros = contarTotalPlaylists($conexao, $pesquisa, $idUser);

    require_once '../paginas.php';

    $playlists = listarPlaylists($conexao, $pesquisa, $limite, $offset, $idUser);

    $conexao = null;
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}



require '../v/tabelaPlaylistView.php';

?>