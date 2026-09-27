<?php
require_once '../requireTriplo.php';
require_once '../m/cadastrarArtBandaModel.php';

try {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = verificarDadosFormulario();

    if ($dados['valido']) {
        $caminhoArquivo = uploadFoto($_FILES['foto']);
        $idGenero = buscarIdGenero($conexao, $dados['genero']);
        $cadastroSucesso = processarCadastro($conexao, $dados['nome'], $dados['descricao'], $dados['preco'], $caminhoArquivo, $idGenero);
        header("Location: tabelaArtBandaController.php");
        exit;
    } else {
       header("cadastrarArtBandaController.php");
        exit;
    }
}
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}

function verificarDadosFormulario(): array
{
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';
    $preco = isset($_POST['preco']) ? trim($_POST['preco']) : '';
    $genero = isset($_POST['genero']) ? trim($_POST['genero']) : '';
    $arquivoFoto = $_FILES['foto'];

    $tamanhoArquivo = $arquivoFoto['size'];
    $nomeArquivo = $arquivoFoto['name'];
    $extensaoArquivo = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

    if ((($extensaoArquivo == "jpg") || ($extensaoArquivo == "jpeg") || ($extensaoArquivo == "png")) && ($tamanhoArquivo < 200000)) {
        return [
            'valido' => !empty($nome),
            'nome' => $nome,
            'descricao' => $descricao,
            'preco' => $preco,
            'genero' => $genero
        ];
    }
    return [
        'valido' => false,
        'nome' => $nome,
        'descricao' => $descricao,
        'preco' => $preco,
        'genero' => $genero
    ];
}
require '../v/cadastrarArtBandaView.php';
?>