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
            background-color: #afda77;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .btn {
            margin: 10px auto;
            padding: 15px 0;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s;
            width: 100%;
            max-width: 300px;
            display: block;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        p {
            margin-bottom: 20px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo $_SESSION["usuario"]; ?>!</h1>

        <p>Escolha a tela que deseja acessar:</p>

        <a href="cadastrar_produto.html" class="btn">Cadastro de Produto</a>
        <a href="cadastro_funcionarios.html" class="btn">Cadastro de Funcionários</a>
        <a href="venda.html" class="btn">Tela de Vendas</a>
    </div>
</body>

</html>