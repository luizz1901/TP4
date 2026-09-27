<?php 
require_once '../requireDuplo.php';
require_once '../m/tabelaArtBandaModel.php';

try {
$pesquisa = $_GET['pesquisa'] ?? '';
$limite = (int) ($_GET['limite'] ?? 10);
$totalRegistros = contarTotalArtistas($conexao, $pesquisa);

require_once '../paginas.php';

$artistas = listarArtistas($conexao, $pesquisa, $limite, $offset);

$conexao = null; 
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
require '../v/tabelaArtBandaView.php';

?>