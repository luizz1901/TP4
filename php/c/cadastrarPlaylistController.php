<?php
require_once '../requireTriplo.php';
require_once '../m/cadastrarPlaylistModel.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = verificarDadosFormulario();

        if ($dados['valido']) {
            $caminhoArquivo = uploadFoto($_FILES['foto']);
            $idUser = $_SESSION['id'];
            $cadastroSucesso = processarCadastro($conexao, $dados['nome'], $caminhoArquivo, $idUser);
            header("Location: tabelaPlaylistController.php");
            exit;
        } else {
            echo "Houve algum erro no cadastro!";
            header("Location: cadastrarPlaylistController.php");
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
    $arquivoFoto = $_FILES['foto'];
    $tamanhoArquivo = $arquivoFoto['size'];
    $nomeArquivo = $arquivoFoto['name'];
    $extensaoArquivo = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

    if (verificaFoto($tamanhoArquivo, $extensaoArquivo)) {
        return [
            'valido' => !empty($nome),
            'nome' => $nome
        ];
    } else {
        return [
            'valido' => false,
            'nome' => $nome
        ];
    }
}

require '../v/cadastrarPlaylistView.php';
?>