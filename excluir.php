<?php

    include("conecta.php");

    // Vamos pegar o "codigo" da barra de endereço:
    $codigo = $_GET["codigo"];

    $comando = $pdo->prepare("DELETE FROM produtos WHERE codigo=$codigo ");
    $resultado = $comando->execute();
    include("listar.php");
    
?>