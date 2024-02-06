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

$result = "INSERT INTO produtos_movimentacoes
           (produto_id, tipo, responsavel, cliente, qtde, data)
           VALUES ('$produto_id', '$tipo', '$responsavel', '$cliente', '$qtde', '$data')";


$resultado = mysqli_query($conexao, $result);
    if (mysqli_insert_id($conexao)) {
        $_SESSION['msg'] = 'Produto cadastrado com sucesso!';
        echo "<script>window.location.href='add_movimentacoes.php?produto_id=" . $produto_id . "';</script>";
    } else {
        $_SESSION['msg'] = 'Erro no Banco de dados.';
        echo "<script>window.location.href='add_movimentacoes.php?produto_id=" . $produto_id . "';</script>";
    }
?> 

