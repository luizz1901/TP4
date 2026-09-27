<?php
require_once '../requireTriplo.php';
require_once '../m/editarUsuarioModel.php';

try {
    $idUsuarioLogado = (int) $_SESSION['id'];
    $usuario = buscarUsuarioLogado($conexao, $idUsuarioLogado);

    if (!$usuario) {
        header("Location: loginUsuarioController.php");
        exit;
    }

    $urlOrigem = $_SERVER['HTTP_REFERER'] ?? 'menuController.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novoNome = $_POST['nome'] ?? '';
        $novaSenha = $_POST['senha'] ?? '';
        $urlRedirecionamento = $_POST['url_origem'] ?? 'menuPrincipalController.php';
        $caminhoFotoFinal = $usuario['foto'];

        if (nomeRepeteEdicao($conexao, $novoNome, $idUsuarioLogado)) {
            header("Location: editarUsuarioController.php?erro=nome_duplicado");
            exit;
        }

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $arquivoFoto = $_FILES['foto'];
            $nomeOriginal = $arquivoFoto['name'];
            $extensaoArquivo = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
            $novoNomeArquivo = uniqid() . '.' . $extensaoArquivo;
            $tempArquivo = $arquivoFoto['tmp_name'];
            $caminhoArquivo = "../arquivos/" . $novoNomeArquivo;

            if (move_uploaded_file($tempArquivo, $caminhoArquivo)) {
                $caminhoFotoFinal = $caminhoArquivo;
            }
        }

        atualizarPerfil($conexao, $idUsuarioLogado, $novoNome, $novaSenha, $caminhoFotoFinal);

        $_SESSION['nome'] = $novoNome;
        $_SESSION['foto'] = $caminhoFotoFinal;

        header("Location: " . $urlRedirecionamento);
        exit;
    }
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
require '../v/editarUsuarioView.php';
?>