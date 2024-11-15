<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>
    <style>
        body{
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <h1>LISTAGEM DE PRODUTOS</h1>
    <table align="center" cellpadding="5" cellspacing="0">
        <tr>
            <td align="center">Código</td>
            <td align="center">Descrição do Produto</td>
        </tr>
        <?php
            
            include("conecta.php");

            $comando = $pdo->prepare("SELECT * FROM produtos");
            $resultado = $comando->execute();
            
            while($linha = $comando->fetch())
            {
                $codigo = $linha["codigo"];
                $nome   = $linha["nome"];  // DA TABELA
            
                echo("
                    <tr>
                        <td> $codigo </td>
                        <td> $nome </td>
                        <td> 
                            <a href='excluir.php?codigo=$codigo'>
                                <img src='lixeira.png' width='25px'> 
                            </a>
                        </td>
                    </tr>
                ");
            }   
        ?>
    </table>
</body>
</html>




