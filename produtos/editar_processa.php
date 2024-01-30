<?php
session_start();

include_once("conexao.php");

$id = filter_input(INPUT_POST, 'id');
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

$sql = "UPDATE produtos SET nome='$nome', codigo='$codigo', lead_time='$lead_time', qtde='$qtde', funcionario='$funcionario', descricao='$descricao', frequencia='$frequencia', data='$data', unidade='$unidade', valor_venda='$valor_venda', valor_producao='$valor_producao', maximo='$maximo', minimo='$minimo', observacao='$observacao' WHERE id = '$id'";

$atualizar = mysqli_query($conexao, $sql); 

if (mysqli_affected_rows($conexao)) {
    $_SESSION['msg'] = "<p style='color:green;'>Produto editado com sucesso!</p>";
    header("Location: editar_produto.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Não foi possivel editar cadastro.</p>";
    header("Location: editar_produto.php");
}

?> 
