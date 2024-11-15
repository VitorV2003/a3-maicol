<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION["usuario"])) {
    header("Location: index.html"); // Redireciona para a página de login se não estiver logado
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #333;
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <h1>Bem-vindo, <?php echo $_SESSION["usuario"]; ?>!</h1>

    <p>Escolha a tela que deseja acessar:</p>

    <!-- Botões que redirecionam para as páginas corretas -->
    <a href="cadastrar_produto.html" class="btn">Cadastro de Produto</a>
    <a href="cadastro_funcionarios.html" class="btn">Cadastro de Funcionários</a>
    <a href="venda.html" class="btn">Tela de Vendas</a>

</body>

</html>