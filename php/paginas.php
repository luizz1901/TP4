<?php

function calcularTotalPaginas(int $totalRegistros, int $limite): int
{
    $paginas = (int) ($totalRegistros / $limite);
    if (($totalRegistros % $limite) > 0) {
        $paginas++;
    }
    return $paginas;
}

$pesquisa = $_GET['pesquisa'] ?? '';
$limite = (int) ($_GET['limite'] ?? 10);
$paginaAtual = (int) ($_GET['pagina'] ?? 1);
$offset = ($paginaAtual - 1) * $limite;

if ($paginaAtual < 1) {
    $paginaAtual = 1;
}
$totalPaginas = calcularTotalPaginas($totalRegistros, $limite);
?>