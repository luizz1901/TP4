<?php
ob_start();
date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../m/geraPDFArtBandaModel.php';
require_once __DIR__ . '/../conexao.php';

use Mpdf\Mpdf;

try {
    $mpdf = new Mpdf();
    $mpdf->SetTitle("Relatório Artistas");
    $artistas = retornaArtistas($conexao);
    require __DIR__ . '/../v/geraPDFArtBandaView.php';

    $mpdf->SetDisplayMode("fullpage");

    $html = ob_get_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output('relatorioArtistas.pdf', \Mpdf\Output\Destination::INLINE);

} catch (\Mpdf\MpdfException $e) {

    header("Location: ../v/paginaErro.php");
    exit;

}
?>