<?php
session_start();

include_once("../conexao.php");

$id = filter_input(INPUT_POST, 'id');
$produto_id = filter_input(INPUT_POST, 'produto_id');
$tipo = filter_input(INPUT_POST, 'tipo');
$status = filter_input(INPUT_POST, 'status');
$responsavel = filter_input(INPUT_POST, 'responsavel');
$cliente = filter_input(INPUT_POST, 'cliente');
$qtde_mov = filter_input(INPUT_POST, 'qtde_mov');
$data = filter_input(INPUT_POST, 'data');


$sql = "SELECT qtde FROM produtos WHERE id = $produto_id";

$estoque1 = mysqli_query($conexao, $sql);

$estoque = mysqli_fetch_assoc($estoque1)['qtde'];

$erro = [];

if (!preg_match("/^[\p{L} ]{0,30}$/u", $cliente) || strlen($cliente) > 30) {
    $erro['cliente'] = 'O campo cliente deve conter letras e ter no máximo 30 caracteres.';
}

if (!is_numeric($qtde_mov)) {
    $erro['qtde_mov'] = 'O campo qtde deve conter números.';
}

$camposObrigatoriosNaoNulos = array('produto_id', 'tipo', 'status', 'estoque', 'responsavel', 'cliente', 'qtde', 'data');

foreach ($camposObrigatoriosNaoNulos as $camposObrigatorios) {
    if (empty($camposObrigatorios)) {
        $erro[$camposObrigatorios] = 'O campo' . $camposObrigatorios . ' é obrigatório.';
    }
}

if (validarTipo($tipo) && validarStatus($status)) {
    if ($tipo === 'entrada') {
        if ($status === 'compra' || $status === 'devolucao' || $status === 'outros') {
            $estoque += $qtde_mov;
        } else {
            $erro[$status] = 'O status não pode ser venda!';
        }

    } else if ($estoque >= $qtde_mov) {
        if ($tipo === 'saida') {
            if ($status === 'venda' || $status === 'outros') {
                $estoque -= $qtde_mov;
            }
            else {
                $erro[$status] = 'O status não pode ser compra nem venda!';
             }
        }
    } else {
        $erro[$estoque] = 'Estoque insuficiente!';
    }
}

$result = "INSERT INTO produtos_movimentacoes
           (produto_id, tipo, status, estoque, responsavel, cliente, qtde_mov, data)
           VALUES
           (" . ($produto_id ? "'$produto_id'" : "NULL") . ",
            " . ($tipo ? "'$tipo'" : "NULL") . ",
            " . ($status ? "'$status'" : "NULL") . ",
            " . ($estoque ? "'$estoque'" : "NULL") . ",
            " . ($responsavel ? "'$responsavel'" : "NULL") . ",
            " . ($cliente ? "'$cliente'" : "NULL") . ",
            " . ($qtde_mov ? "'$qtde_mov'" : "NULL") . ",
            " . ($data ? "'$data'" : "NULL") . ")";


$atualizar = "UPDATE produtos SET qtde='$estoque' WHERE id='$produto_id'";

mysqli_query($conexao, $atualizar);


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
