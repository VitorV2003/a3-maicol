<?php
// Pegar os dados dos formulários
// Produto
$codigo = $_POST["codigo"] ?? null;
$descricao = $_POST["descricao"] ?? null;
$codigo_atual = $_POST["codigo_atual"] ?? null;
$descricao_atual = $_POST["descricao_atual"] ?? null;
$novo_codigo = $_POST["novo_codigo"] ?? null;
$nova_descricao = $_POST["nova_descricao"] ?? null;

// Funcionário
$cpf = $_POST["cpf"] ?? null;
$nome = $_POST["nome"] ?? null;
$senha = $_POST["senha"] ?? null;
$permissao = $_POST["permissao"] ?? null;
$salario_220h = $_POST["salario_220h"] ?? null;
$horas_trabalhadas = $_POST["horas_trabalhadas"] ?? null;
$cpf_atual = $_POST["cpf_atual"] ?? null;
$nome_atual = $_POST["nome_atual"] ?? null;
$senha_atual = $_POST["senha_atual"] ?? null;
$permissao_atual = $_POST["permissao_atual"] ?? null;
$salario_220h_atual = $_POST["salario_220h_atual"] ?? null;
$horas_trabalhadas_atual = $_POST["horas_trabalhadas_atual"] ?? null;

// Conexão com a base de dados
include("conecta.php");

// *** CRUD de Produto ***

// Inserir Produto
// Inserir Produto
if (isset($_POST["inserir_produto"])) {
    $preco = $_POST["preco"] ?? null;
    $validade = $_POST["validade"] ?? null;
    $unid_medida = $_POST["unid_medida"] ?? null;
    $desconto = $_POST["desconto"] ?? null;
    $quantidade = $_POST["quantidade"] ?? null;

    $comando = $pdo->prepare("SELECT * FROM produtos WHERE codigo = :codigo");
    $comando->bindParam(':codigo', $codigo);
    $comando->execute();

    if ($comando->rowCount() > 0) {
        echo ("<script>alert('Código já existe! Não é possível inserir dados duplicados.'); window.open('cadastrar_produto.html', '_self');</script>");
    } else {
        $comando = $pdo->prepare("INSERT INTO produtos (codigo, nome, preco, validade, unid_medida, desconto, quantidade) VALUES (:codigo, :descricao, :preco, :validade, :unid_medida, :desconto, :quantidade)");
        $comando->bindParam(':codigo', $codigo);
        $comando->bindParam(':descricao', $descricao);
        $comando->bindParam(':preco', $preco);
        $comando->bindParam(':validade', $validade);
        $comando->bindParam(':unid_medida', $unid_medida);
        $comando->bindParam(':desconto', $desconto);
        $comando->bindParam(':quantidade', $quantidade);
        $comando->execute();

        echo ("<script>alert('DADOS GRAVADOS'); window.open('cadastrar_produto.html', '_self');</script>");
    }
}


// Deletar Produto
if (isset($_POST["deletar_produto"])) {
    $comando = $pdo->prepare("DELETE FROM produtos WHERE codigo = :codigo");
    $comando->bindParam(':codigo', $codigo);

    if ($comando->execute()) {
        echo ("<script>alert('DADO DELETADO'); window.open('cadastrar_produto.html', '_self');</script>");
    } else {
        echo ("<script>alert('Erro ao deletar dado.'); window.open('cadastrar_produto.html', '_self');</script>");
    }
}

// Listar Produto
if (isset($_POST["listar_produto"])) {
    $comando = $pdo->prepare("SELECT * FROM produtos");
    $comando->execute();
    $resultados = $comando->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>";
    echo "<tr><th>Código</th><th>Descrição</th></tr>";
    foreach ($resultados as $linha) {
        echo "<tr><td>" . $linha['codigo'] . "</td><td>" . $linha['nome'] . "</td></tr>";
    }
    echo "</table>";
}

// Alterar Produto
if (isset($_POST["alterar_produto"])) {
    $comando = $pdo->prepare("SELECT * FROM produtos WHERE codigo = :codigo_atual AND nome = :descricao_atual");
    $comando->bindParam(':codigo_atual', $codigo_atual);
    $comando->bindParam(':descricao_atual', $descricao_atual);
    $comando->execute();

    if ($comando->rowCount() > 0) {
        $comando = $pdo->prepare("UPDATE produtos SET codigo = :novo_codigo, nome = :nova_descricao WHERE codigo = :codigo_atual");
        $comando->bindParam(':codigo_atual', $codigo_atual);
        $comando->bindParam(':novo_codigo', $novo_codigo);
        $comando->bindParam(':nova_descricao', $nova_descricao);

        if ($comando->execute()) {
            echo ("<script>alert('DADO ALTERADO'); window.open('cadastrar_produto.html', '_self');</script>");
        } else {
            echo ("<script>alert('Erro ao alterar dado.'); window.open('cadastrar_produto.html', '_self');</script>");
        }
    } else {
        echo ("<script>alert('Produto não encontrado para alteração.'); window.open('cadastrar_produto.html', '_self');</script>");
    }
}

// *** CRUD de Funcionário ***

// Inserir Funcionário
if (isset($_POST["inserir_funcionario"])) {
    $comando = $pdo->prepare("SELECT * FROM funcionarios WHERE cpf = :cpf");
    $comando->bindParam(':cpf', $cpf);
    $comando->execute();

    if ($comando->rowCount() > 0) {
        echo ("<script>alert('CPF já existe! Não é possível inserir dados duplicados.'); window.open('cadastro_funcionarios.html', '_self');</script>");
    } else {
        $comando = $pdo->prepare("INSERT INTO funcionarios (cpf, nome, senha, permissao, salario_220h, horas_trabalhadas) VALUES(:cpf, :nome, :senha, :permissao, :salario_220h, :horas_trabalhadas)");
        $comando->bindParam(':cpf', $cpf);
        $comando->bindParam(':nome', $nome);
        $comando->bindParam(':senha', $senha);
        $comando->bindParam(':permissao', $permissao);
        $comando->bindParam(':salario_220h', $salario_220h);
        $comando->bindParam(':horas_trabalhadas', $horas_trabalhadas);
        $comando->execute();

        echo ("<script>alert('DADOS GRAVADOS'); window.open('cadastro_funcionarios.html', '_self');</script>");
    }
}

// Deletar Funcionário
if (isset($_POST["deletar_funcionario"])) {
    $comando = $pdo->prepare("DELETE FROM funcionarios WHERE cpf = :cpf");
    $comando->bindParam(':cpf', $cpf);

    if ($comando->execute()) {
        echo ("<script>alert('DADO DELETADO'); window.open('cadastro_funcionarios.html', '_self');</script>");
    } else {
        echo ("<script>alert('Erro ao deletar dado.'); window.open('cadastro_funcionarios.html', '_self');</script>");
    }
}

// Listar Funcionário
if (isset($_POST["listar_funcionario"])) {
    $comando = $pdo->prepare("SELECT * FROM funcionarios");
    $comando->execute();
    $resultados = $comando->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>";
    echo "<tr><th>CPF</th><th>Nome</th><th>Cargo</th><th>Salário</th><th>Horas Trabalhadas</th></tr>";
    foreach ($resultados as $linha) {
        echo "<tr><td>" . $linha['cpf'] . "</td><td>" . $linha['nome'] . "</td><td>" . $linha['permissao'] . "</td><td>" . $linha['salario_220h'] . "</td><td>" . $linha['horas_trabalhadas'] . "</td></tr>";
    }
    echo "</table>";
}

// Alterar Funcionário
if (isset($_POST["alterar_funcionario"])) {
    $comando = $pdo->prepare("SELECT * FROM funcionarios WHERE cpf = :cpf_atual AND nome = :nome_atual");
    $comando->bindParam(':cpf_atual', $cpf_atual);
    $comando->bindParam(':nome_atual', $nome_atual);
    $comando->execute();

    if ($comando->rowCount() > 0) {
        $comando = $pdo->prepare("UPDATE funcionarios SET cpf = :novo_cpf, nome = :novo_nome, senha = :nova_senha, permissao = :nova_permissao, salario_220h = :novo_salario_220h, horas_trabalhadas = :novas_horas_trabalhadas WHERE cpf = :cpf_atual");
        $comando->bindParam(':cpf_atual', $cpf_atual);
        $comando->bindParam(':novo_cpf', $cpf);
        $comando->bindParam(':novo_nome', $nome);
        $comando->bindParam(':nova_senha', $senha);
        $comando->bindParam(':nova_permissao', $permissao);
        $comando->bindParam(':novo_salario_220h', $salario_220h);
        $comando->bindParam(':novas_horas_trabalhadas', $horas_trabalhadas);

        if ($comando->execute()) {
            echo ("<script>alert('DADO ALTERADO'); window.open('cadastro_funcionarios.html', '_self');</script>");
        } else {
            echo ("<script>alert('Erro ao alterar dado.'); window.open('cadastro_funcionarios.html', '_self');</script>");
        }
    } else {
        echo ("<script>alert('Funcionário não encontrado para alteração.'); window.open('cadastro_funcionarios.html', '_self');</script>");
    }
}

if (isset($_POST["listar_salarios"])) {
    $nome = $_POST['listar_nome'];
    $cpf = $_POST['listar_cpf'];

    // Filtrar salários pelo nome e CPF, se necessário
    $comando = $pdo->prepare("SELECT cpf, nome, salario_220h FROM funcionarios WHERE nome = :nome AND cpf = :cpf");
    $comando->bindParam(':nome', $nome);
    $comando->bindParam(':cpf', $cpf);
    $comando->execute();
    $resultados = $comando->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>";
    echo "<tr><th>Código</th><th>Nome</th><th>Salário</th></tr>";
    foreach ($resultados as $linha) {
        echo "<tr><td>" . $linha['cpf'] . "</td><td>" . $linha['nome'] . "</td><td>" . $linha['salario_220h'] . "</td></tr>";
    }
    echo "</table>";
}

// *** CRUD de Vendas ***
// Inserir Venda
if (isset($_POST["inserir_venda"])) {
    $codigo = $_POST["codigo"];
    $qtde_venda = $_POST["qtde_venda"];
    $data_venda = $_POST["data_venda"];
    $valor = $_POST["valor"];

    if (empty($qtde_venda) || !is_numeric($qtde_venda) || $qtde_venda <= 0) {
        echo ("<script>alert('Quantidade de venda inválida.'); window.open('index.html', '_self');</script>");
        exit;
    }

    $comando = $pdo->prepare("INSERT INTO vendas (codigo, qtde_venda, data_venda, valor) VALUES (:codigo, :qtde_venda, :data_venda, :valor)");
    $comando->bindParam(':codigo', $codigo);
    $comando->bindParam(':qtde_venda', $qtde_venda);
    $comando->bindParam(':data_venda', $data_venda);
    $comando->bindParam(':valor', $valor);

    if ($comando->execute()) {
        echo ("<script>alert('VENDA REGISTRADA'); window.open('index.html', '_self');</script>");
    } else {
        echo ("<script>alert('Erro ao registrar a venda.'); window.open('index.html', '_self');</script>");
    }
}

// Alterar Venda
if (isset($_POST["alterar_venda"])) {
    $cod_venda = $_POST["cod_venda"];
    $novo_codigo = $_POST["novo_codigo"] ?? null;
    $nova_qtde_venda = $_POST["nova_qtde_venda"] ?? null;
    $nova_data_venda = $_POST["nova_data_venda"] ?? null;
    $novo_valor = $_POST["novo_valor"] ?? null;

    $comando = $pdo->prepare("UPDATE vendas SET codigo = :novo_codigo, qtde_venda = :nova_qtde_venda, data_venda = :nova_data_venda, valor = :novo_valor WHERE cod_venda = :cod_venda");
    $comando->bindParam(':novo_codigo', $novo_codigo);
    $comando->bindParam(':nova_qtde_venda', $nova_qtde_venda);
    $comando->bindParam(':nova_data_venda', $nova_data_venda);
    $comando->bindParam(':novo_valor', $novo_valor);
    $comando->bindParam(':cod_venda', $cod_venda);

    if ($comando->execute()) {
        echo ("<script>alert('VENDA ALTERADA'); window.open('index.html', '_self');</script>");
    } else {
        echo ("<script>alert('Erro ao alterar a venda.'); window.open('index.html', '_self');</script>");
    }
}

// Deletar Venda
if (isset($_POST["deletar_venda"])) {
    $cod_venda = $_POST["cod_venda"];

    $comando = $pdo->prepare("DELETE FROM vendas WHERE cod_venda = :cod_venda");
    $comando->bindParam(':cod_venda', $cod_venda);

    if ($comando->execute()) {
        echo ("<script>alert('VENDA DELETADA'); window.open('index.html', '_self');</script>");
    } else {
        echo ("<script>alert('Erro ao deletar a venda.'); window.open('index.html', '_self');</script>");
    }
}

// Listar Vendas
if (isset($_POST["listar_vendas"])) {
    $comando = $pdo->prepare("SELECT * FROM vendas");
    $comando->execute();
    $resultados = $comando->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>";
    echo "<tr><th>Código da Venda</th><th>Código do Produto</th><th>Quantidade</th><th>Data</th><th>Valor</th></tr>";
    foreach ($resultados as $linha) {
        echo "<tr>
                <td>" . $linha['cod_venda'] . "</td>
                <td>" . $linha['codigo'] . "</td>
                <td>" . $linha['qtde_venda'] . "</td>
                <td>" . $linha['data_venda'] . "</td>
                <td>" . $linha['valor'] . "</td>
              </tr>";
    }
    echo "</table>";
}
?>



?>