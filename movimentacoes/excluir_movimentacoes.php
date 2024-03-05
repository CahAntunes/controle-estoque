<?php
session_start();
include_once("../conexao.php");

if (isset($_GET['id'])) {
    $idMovimentacao = $_GET['id'];
    $idProduto = $_GET['idproduto'];
    $erro = [];
    // $tipo = $_GET['tipo'];
    // $estoque = $_GET['qtde'];
    // $qtde_mov = $_GET['qtde_mov'];

    $sql = "SELECT qtde FROM produtos WHERE id = $idProduto";
    $select = mysqli_query($conexao, $sql);
    $estoque = mysqli_fetch_assoc($select)['qtde'];


    $sql2 = "SELECT tipo, qtde_mov FROM produtos_movimentacoes WHERE id = $idMovimentacao";
    $select2 = mysqli_query($conexao, $sql2);

    while ($array = mysqli_fetch_array($select2)) {
        $tipo = $array['tipo'];
        $qtde_mov = $array['qtde_mov'];
    }

    if (validarTipo($tipo)) {
        if ($tipo === 'entrada') {
            $estoque =  $estoque - $qtde_mov;
            $atualizar = "UPDATE produtos SET qtde='$estoque' WHERE id='$idProduto'";
            mysqli_query($conexao, $atualizar);

        } else if ($tipo === 'saida') {
            $estoque =  $estoque + $qtde_mov;
            $atualizar = "UPDATE produtos SET qtde='$estoque' WHERE id='$idProduto'";
            mysqli_query($conexao, $atualizar);
        }
    }else {
        echo "<script>alert('Erro ao excluir a movimentação');</script>";
    }

    // var_dump($tipo);
    // var_dump($estoque);
    // var_dump($qtde_ant);
    // var_dump($estoque_atual);

    $sql = "DELETE FROM produtos_movimentacoes WHERE id = $idMovimentacao";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        echo "<script>alert('Movimentação excluída com sucesso!');";
        echo "window.location.href = '../produtos/view.php?id=" . $idProduto. "';</script>";
    } else {
        echo "<script>alert('Erro ao excluir a movimentação');</script>";
    }

    mysqli_close($conexao);
}


?>
