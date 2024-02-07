<?php
include_once("../conexao.php");

if (isset($_GET['id'])) {
    $idMovimentacao = $_GET['id'];

    $sql = "DELETE FROM produtos_movimentacoes WHERE id = $idMovimentacao";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        echo "<script>alert('Movimentação excluída com sucesso!');";
        echo "window.location.href = '../produtos/pesquisar_produtos.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir a movimentação');</script>";
    }

    mysqli_close($conexao);
}
?>
