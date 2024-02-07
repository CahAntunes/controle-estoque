<?php
session_start();

include_once("../conexao.php");

$id = filter_input(INPUT_POST, 'id');
$produto_id = filter_input(INPUT_POST, 'produto_id');
$tipo = filter_input(INPUT_POST, 'tipo');
$responsavel = filter_input(INPUT_POST, 'responsavel');
$cliente = filter_input(INPUT_POST, 'cliente');
$qtde = filter_input(INPUT_POST, 'qtde');
$data = filter_input(INPUT_POST, 'data');

$erro = [];

// perguntar se o responsavel vai poder ser referenciado pelo codigo

if (!preg_match("/^[\p{L} ]{0,30}$/u", $cliente) || strlen($cliente) > 30) {
    $erro['cliente'] = 'O campo cliente deve conter letras e ter no máximo 30 caracteres.';
}

if (!is_numeric($qtde)) {
    $erro['qtde'] = 'O campo qtde deve conter números.';
}

$camposObrigatoriosNaoNulos = array('produto_id', 'tipo', 'responsavel', 'qtde', 'data');

foreach ($camposObrigatoriosNaoNulos as $camposObrigatorios) {
    if (empty($camposObrigatorios)) {
        $erro[$camposObrigatorios] = 'O campo' . $camposObrigatorios . ' é obrigatório.';
    }
}

$result = "INSERT INTO produtos_movimentacoes
           (produto_id, tipo, responsavel, cliente, qtde, data)
           VALUES
           (" . ($produto_id ? "'$produto_id'" : "NULL") . ",
            " . ($tipo ? "'$tipo'" : "NULL") . ",
            " . ($responsavel ? "'$responsavel'" : "NULL") . ",
            " . ($cliente ? "'$cliente'" : "NULL") . ",
            " . ($qtde ? "'$qtde'" : "NULL") . ",
            " . ($data ? "'$data'" : "NULL") . ")";
            // '$produto_id', '$tipo', '$responsavel', '$cliente', '$qtde', '$data')";

    if (empty($erro)) {
        $resultado = mysqli_query($conexao, $result);
        if (mysqli_insert_id($conexao)) {
            $_SESSION['bancoOK'] = 'Movimentação adicionada com sucesso!';
            echo "<script>window.location.href='add_movimentacoes.php?produto_id=" . $produto_id . "';</script>";
        } else {
            $_SESSION['bancoErro'] = 'Erro no Banco de dados.';
            echo "<script>window.location.href='add_movimentacoes.php?produto_id=" . $produto_id . "';</script>";
        }
    } else {
        $_SESSION['erro'] = $erro;
        echo "<script>window.location.href='add_movimentacoes.php?produto_id=" . $produto_id . "';</script>";
    }

?> 

