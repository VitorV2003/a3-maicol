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
    $_SESSION["usuario"] = $linha["login"];
    $_SESSION["perfil"] = $linha["perfil"];

    header("Location: tela_inicial.php");
    exit();
} else {

    header("Location: index.html");
    exit();
}
