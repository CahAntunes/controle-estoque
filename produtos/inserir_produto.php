<?php
session_start();

include_once("conexao.php");

$nome = filter_input(INPUT_POST, 'nome');
$codigo = filter_input(INPUT_POST, 'codigo');
$lead_time = filter_input(INPUT_POST, 'lead_time');
$qtde = filter_input(INPUT_POST, 'qtde');
$funcionario = filter_input(INPUT_POST, 'funcionario');
$descricao = filter_input(INPUT_POST, 'descricao');
$frequencia = filter_input(INPUT_POST, 'frequencia');
$data = filter_input(INPUT_POST, 'data');
$unidade = filter_input(INPUT_POST, 'unidade');
$valor_venda = str_replace(',', '.', filter_input(INPUT_POST, 'valor_venda'));
$valor_producao = str_replace(',', '.', filter_input(INPUT_POST, 'valor_producao'));
$maximo = filter_input(INPUT_POST, 'maximo');
$minimo = filter_input(INPUT_POST, 'minimo');
$observacao = filter_input(INPUT_POST, 'observacao');

$erro = [];

if (!preg_match("/^[\p{L} ]{1,40}$/u", $nome) || strlen($nome) > 40) {
    $erro['nome'] = 'O campo Nome deve conter letras e ter no máximo 40 caracteres.';
    // echo "<script>alert('O campo Nome deve conter letras e ter no máximo 40 caracteres.');</script>";
    // echo "<script>window.location.href='cadastrar_produtos.php';</script>";
    // exit;
}
// este
$camposNumericos = array('codigo','maximo', 'minimo');

foreach ($camposNumericos as $campo) {
    if (!is_numeric($$campo)) {
        $erro[$campo] = 'O campo ' . $campo . ' deve conter números.';
        // echo "<script>alert('O campo $campo deve conter números.');</script>";
        // echo "<script>window.location.href='cadastrar_produtos.php';</script>";
        // exit;
    }
}

$verificarCodigo = "SELECT codigo FROM produtos WHERE codigo = '$codigo'";
$resultadoVerificacao = mysqli_query($conexao, $verificarCodigo);

if (mysqli_num_rows($resultadoVerificacao) > 0) {
    $erro['codigo'] = 'O código inserido já existe. Por favor, insira um código único.';
    // echo "<script>alert('O código inserido já existe. Por favor, insira um código único.');</script>";
    // echo "<script>window.location.href='cadastrar_produtos.php';</script>";
    // exit;
}

$camposObrigatoriosNaoNulos = array('funcionario', 'data', 'unidade', 'maximo', 'minimo');

foreach ($camposObrigatoriosNaoNulos as $campo) {
    if (empty($$campo)) {
        $erro[$campo] = 'O campo' . $campo . ' é obrigatório.';
        // echo "<script>alert('O campo $campo é obrigatório.');</script>";
        // echo "<script>window.location.href='cadastrar_produtos.php';</script>";
        // exit;
    }
}

$result = "INSERT INTO produtos
           (nome, codigo, lead_time, qtde, funcionario, descricao, frequencia, data, unidade, valor_venda, valor_producao, maximo, minimo, observacao)
           VALUES
           (" . ($nome ? "'$nome'" : "NULL") . ",
            " . ($codigo ? "'$codigo'" : "NULL") . ",
            " . ($lead_time ? "'$lead_time'" : "NULL") . ",
            " . ($qtde ? "'$qtde'" : "NULL") . ",
            " . ($funcionario ? "'$funcionario'" : "NULL") . ",
            " . ($descricao ? "'$descricao'" : "NULL") . ",
            " . ($frequencia ? "'$frequencia'" : "NULL") . ",
            " . ($data ? "'$data'" : "NULL") . ",
            " . ($unidade ? "'$unidade'" : "NULL") . ",
            " . ($valor_venda ? "'$valor_venda'" : "NULL") . ",
            " . ($valor_producao ? "'$valor_producao'" : "NULL") . ",
            " . ($maximo ? "'$maximo'" : "NULL") . ",
            " . ($minimo ? "'$minimo'" : "NULL") . ",
            " . ($observacao ? "'$observacao'" : "NULL") . ")";



if (empty($erro)) {
    $resultado = mysqli_query($conexao, $result);
    if (mysqli_insert_id($conexao)) {
        $_SESSION['bancoOK'] = 'Produto cadastrado com sucesso!';
        echo "<script>window.location.href='cadastrar_produtos.php';</script>";
    } else {
        $_SESSION['bancoErro'] = 'Erro no Banco de dados.';
        echo "<script>window.location.href='cadastrar_produtos.php';</script>";
    }
} else {
    $_SESSION['erro'] = $erro;
    echo "<script>window.location.href='cadastrar_produtos.php';</script>";
}
// echo "<script>window.location.href='cadastrar_produtos.php';</script>";

?>

