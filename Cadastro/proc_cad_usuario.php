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

$result = "INSERT INTO produtos (nome, codigo, lead_time, qtde, funcionario, descricao, frequencia, data, unidade, valor_venda, valor_producao, maximo, minimo, observacao) VALUES ('$nome','$codigo','$lead_time','$qtde', '$funcionario', '$descricao','$frequencia','$data', '$unidade', '$valor_venda', '$valor_producao', '$maximo', '$minimo', '$observacao')";


$resultado = mysqli_query($conexao, $result);

if (mysqli_insert_id($conexao)) {
    $_SESSION['msg'] = "<p style='color:green;'>Usuário cadastrado com sucesso!</p>";
    header("Location: cad_usuario.php");
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Usuário não foi cadastrado.</p>";
    header("Location: cad_usuario.php");
}

?> 
