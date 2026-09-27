<?php
session_start();

require_once '../m/cadastrarUsuarioModel.php';
require_once '../conexao.php';
require_once '../funcoesFoto.php';

try {
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        setcookie('usuario', '', time() - 3600, "/");
        header("Location: cadastrarUsuarioController.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = verificarDadosFormulario();


        if ($dados['valido']) {
            $arquivoFoto = $_FILES['foto'];
            $caminhoArquivo = uploadFoto($arquivoFoto);
            $cadastroSucesso = processarCadastro($conexao, $dados['nome'], $dados['senha'], $caminhoArquivo);

            if ($cadastroSucesso) {
                $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
                header("Location: loginUsuarioController.php");
                exit;
            } else {
                $_SESSION['erro'] = "Erro ao cadastrar usuário!";
                header("Location: cadastrarUsuarioController.php");
                exit;
            }
        }
    }
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}

function verificarDadosFormulario(): array
{
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';
    $tamanhoArquivo = (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0)
        ? $_FILES['foto']['size']
        : 9999999;


    return [
        'valido' => !empty($nome) && !empty($senha) && $tamanhoArquivo < 2097152,
        'nome' => $nome,
        'senha' => $senha,
    ];
}

require '../v/cadastrarUsuarioView.php';
?>