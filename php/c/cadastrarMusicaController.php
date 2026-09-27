<?php
require_once '../requireTriplo.php';
require_once '../m/cadastrarMusicaModel.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = verificarDadosFormulario();

        if ($dados['valido']) {
            $caminhoArquivo = uploadFoto($_FILES['foto']);
            $idArtista = buscarArtista($conexao, $dados['artista']);
            if ($idArtista == -1) {
                header("Location: cadastrarMusicaController.php");
            } else {
                $cadastroSucesso = processarCadastro($conexao, $dados['nome'], (float) $dados['duracao'], $dados['data'], $caminhoArquivo, $idArtista);
                header("Location: tabelaMusicaController.php");
                exit;
            }
        } else {
            header("Location: cadastrarMusicaController.php");
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
    $duracao = isset($_POST['duracao']) ? trim($_POST['duracao']) : '';
    $data = isset($_POST['data']) ? trim($_POST['data']) : '';
    $artista = isset($_POST['artista']) ? trim($_POST['artista']) : '';
    $arquivoFoto = $_FILES['foto'];
    $tamanhoArquivo = $arquivoFoto['size'];
    $nomeArquivo = $arquivoFoto['name'];
    $extensaoArquivo = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

    if (verificaFoto($tamanhoArquivo, $extensaoArquivo)) {
        return [
            'valido' => !empty($nome),
            'nome' => $nome,
            'duracao' => $duracao,
            'data' => $data,
            'artista' => $artista
        ];
    } else {
        return [
            'valido' => false,
            'nome' => $nome,
            'duracao' => $duracao,
            'data' => $data,
            'artista' => $artista
        ];
    }

}

$artistas = buscarTodosArtistas($conexao);
require '../v/cadastrarMusicaView.php';
?>