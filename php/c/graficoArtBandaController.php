<?php
require_once __DIR__ . '/../conexao.php';
require_once __DIR__ . '/../m/graficoArtBandaModel.php';

try {
    $dadosGrafico = retornaTotaisPorGenero($conexao);

    $labels = [];
    $totais = [];

    foreach ($dadosGrafico as $item) {
        $labels[] = $item['nomeGenero'];
        $totais[] = (int) $item['total'];
    }
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
require_once __DIR__ . '/../v/graficoArtBandaView.php';
?>