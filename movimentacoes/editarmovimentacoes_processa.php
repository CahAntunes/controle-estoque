<?php
session_start();
include_once("../conexao.php");

$id = filter_input(INPUT_POST, 'id');
$produto_id = filter_input(INPUT_POST, 'produto_id');
$tipo = filter_input(INPUT_POST, 'tipo');
$status = filter_input(INPUT_POST, 'status');
$estoque = filter_input(INPUT_POST, 'qtde');
$responsavel = filter_input(INPUT_POST, 'responsavel');
$cliente = filter_input(INPUT_POST, 'cliente');
$qtde_mov = filter_input(INPUT_POST, 'qtde_mov');
$data = filter_input(INPUT_POST, 'data');


$sql2 = "SELECT tipo, qtde_mov FROM produtos_movimentacoes WHERE id = $id";

$select = mysqli_query($conexao, $sql2);

while ($array = mysqli_fetch_array($select)) {
    $tipo_ant = $array['tipo'];
    $qtde_ant = $array['qtde_mov'];
}

$erro = [];

if (!is_numeric($qtde_mov)) {
    $erro[$qtde_mov] = 'O campo qtde deve conter números';
}


$camposObrigatoriosNaoNulos = array('responsavel', 'qtde_mov', 'data');
foreach ($camposObrigatoriosNaoNulos as $campo) {
    if (empty($$campo)) {
        $erro[$campo] = 'O campo' . $campo . ' é obrigatório.';
    }
}

if (validarTipo($tipo) && validarStatus($status)) {
    if ($tipo === 'entrada' && $tipo_ant === 'saida') {
        if ($status === 'venda') {
            $erro[$status] = 'O status não pode ser venda!';
        } else {
            $estoque_atual =  $estoque + $qtde_ant;
            $estoque_atual += $qtde_mov;
            $atualizar = "UPDATE produtos SET qtde='$estoque_atual' WHERE id='$produto_id'";
            mysqli_query($conexao, $atualizar);
        }

    } else if ($tipo === 'entrada' && $tipo_ant === 'entrada') {
        if ($status === 'venda') {
            $erro[$status] = 'O status não pode ser venda!';
        } else {
            $estoque_atual =  $estoque - $qtde_ant;
            $estoque_atual += $qtde_mov;
            $atualizar = "UPDATE produtos SET qtde='$estoque_atual' WHERE id='$produto_id'";
            mysqli_query($conexao, $atualizar);
        }
    }

    if ($tipo === 'saida' && $tipo_ant === 'entrada') {
        if ($status === 'compra' || $status === 'devolucao') {
            $erro[$estoque] = 'O status não pode ser compra nem devolução!';
        } else {
            $estoque_atual =  $estoque - $qtde_ant;
            $estoque_atual = $estoque_atual - $qtde_mov;
            if ($estoque_atual >= 0) {
                $atualizar = "UPDATE produtos SET qtde='$estoque_atual' WHERE id='$produto_id'";
                mysqli_query($conexao, $atualizar);
            } else {
                $erro[$estoque] = 'A mudança de tipo de <strong>Entrada</strong> para <strong>Saída</strong>, não pode ter valores negativos';
            }
        }
    } else if ($tipo === 'saida' && $tipo_ant === 'saida') {
        if ($status === 'compra' || $status === 'devolucao') {
            $erro[$estoque] = 'O status não pode ser compra nem devolução!';
        }else{
            $estoque_atual =  $estoque + $qtde_ant;
            $estoque_atual = $estoque_atual - $qtde_mov;
            if ($estoque_atual >= 0) {
                $atualizar = "UPDATE produtos SET qtde='$estoque_atual' WHERE id='$produto_id'";
                mysqli_query($conexao, $atualizar);
            } else {
                $erro[$estoque] = 'A mudança de tipo de <strong>Entrada</strong> para <strong>Saída</strong>, não pode ter valores negativos';
            }
        }

    }
       
}
   
if (empty($erro)) {

    $sql = "UPDATE produtos_movimentacoes SET tipo='$tipo', status='$status', responsavel='$responsavel', cliente='$cliente', qtde_mov='$qtde_mov', data='$data' WHERE id = '$id'";
    mysqli_query($conexao, $sql);
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['bancoOK'] = 'Movimentação editada com sucesso!';
        echo "<script>window.location.href='editar_movimentacoes.php?id_mov=" . $id . "&produto_id=" . $produto_id . "';</script>";
    } else {
        $_SESSION['bancoErro'] = 'Erro no Banco de dados.';
        echo "<script>window.location.href='editar_movimentacoes.php?id_mov=" . $id . "&produto_id=" . $produto_id . "';</script>";
    }
} else {
    $_SESSION['erro'] = $erro;
    echo "<script>window.location.href='editar_movimentacoes.php?id_mov=" . $id . "&produto_id=" . $produto_id . "';</script>";
}
// var_dump($tipo);
// var_dump($status);
// var_dump($estoque);
// var_dump($qtde_ant);
// var_dump($qtde_mov);
// var_dump($estoque_atual);
