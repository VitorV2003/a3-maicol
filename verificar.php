<?php
session_start();

$login = $_POST["username"];
$senha = $_POST["password"];

include("conecta.php");

$comando = $pdo->prepare("SELECT * FROM usuarios WHERE login = :login AND senha = :senha");
$comando->bindParam(':login', $login);
$comando->bindParam(':senha', $senha);

$resultado = $comando->execute();

$linha = $comando->fetch();

if ($linha) {
    // Usuário encontrado, define o perfil e outras informações na sessão
    $_SESSION["usuario"] = $linha["login"];
    $_SESSION["perfil"] = $linha["perfil"];

    // Redireciona para a tela inicial após login bem-sucedido
    header("Location: tela_inicial.php");
    exit();
} else {
    // Usuário não encontrado, redireciona para a página de login
    header("Location: index.html");
    exit();
}
