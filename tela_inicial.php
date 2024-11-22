<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.html");
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .btn {
            display: block;
            margin: 10px 0;
            padding: 15px 30px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
            width: 300px;
            text-align: center;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <h1>Bem-vindo, <?php echo $_SESSION["usuario"]; ?>!</h1>

    <p>Escolha a tela que deseja acessar:</p>

    <a href="cadastrar_produto.html" class="btn">Cadastro de Produto</a>
    <a href="cadastro_funcionarios.html" class="btn">Cadastro de Funcionários</a>
    <a href="venda.html" class="btn">Tela de Vendas</a>

</body>

</html>