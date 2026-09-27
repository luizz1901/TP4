<?php
session_start();
require_once '../m/usuarioModel.php';
require_once '../conexao.php';

try {
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        setcookie('usuario', '', time() - 3600, "/");
        header("Location: loginUsuarioController.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = verificarDadosLogin();

        if ($dados['valido']) {

            $usuario = buscarUsuarioPorNome($conexao, $dados['nome']);
            if ($usuario && $dados['senha'] === $usuario['senha']) {
                $_SESSION['id'] = $usuario['idUser'];
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['foto'] = $usuario['foto'];
                $_SESSION['sucesso'] = "Login realizado com sucesso!";

                setcookie('usuario', $usuario['idUser'], time() + (86400 * 30), "/");

                header("Location: menuPrincipalController.php");

                exit;
            } else {
                $_SESSION['erro'] = "Nome de usuário ou senha incorretos!";
                header("Location: loginUsuarioController.php");
                exit;
            }
        } else {
            $_SESSION['erro'] = "Porfavor, preencha todos os campos";
            header("Location: loginUsuarioController.php");
            exit;
        }
    }
} catch (Exception $e) {
    header("Location: ../v/paginaErro.php");
    exit;
}
function verificarDadosLogin(): array
{
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';

    return [
        'valido' => !empty($nome) && !empty($senha),
        'nome' => $nome,
        'senha' => $senha,
    ];
}
require '../v/loginUsuarioView.php';
?>