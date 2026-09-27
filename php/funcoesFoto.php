<?php
function uploadFoto(array $arquivoFoto): string
{
    $nomeOriginal = $arquivoFoto['name'];
    $extensaoArquivo = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
    $novoNomeArquivo = uniqid() . '.' . $extensaoArquivo;
    $tempArquivo = $arquivoFoto['tmp_name'];
    $caminhoArquivo = "../../arquivos/" . $novoNomeArquivo;
    move_uploaded_file($tempArquivo, $caminhoArquivo);
    return $caminhoArquivo;
}

function verificaFoto(int $tamanhoArquivo, string $extensaoArquivo) : bool {
    if ($tamanhoArquivo < 204800 && ($extensaoArquivo == "jpg" || $extensaoArquivo == "png" || $extensaoArquivo == "jpeg")) {
        return true;
    } else {
        return false;
    }
}
?>