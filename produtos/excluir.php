<?php
include_once("../conexao.php");

if (isset($_GET['id'])) {
    $idProduto = $_GET['id'];

    $result = "SELECT codigo FROM produtos WHERE id = $idProduto";
    $resultado = mysqli_query($conexao, $result);
    $id_documento = mysqli_fetch_assoc($resultado)['codigo'];


    $sql = "DELETE FROM produtos WHERE id = $idProduto";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        $pasta_destino = "../upload/" . $id_documento;
        $arquivos = glob($pasta_destino . "/*");

        if (empty($arquivos)) {
            rmdir($pasta_destino);
        } else {
            foreach ($arquivos as $arquivo) {
                unlink($arquivo);
            }
            rmdir($pasta_destino);
        }

        echo "<script>alert('Produto excluído com sucesso!');";
        echo "window.location.href = 'pesquisar_produtos.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o produto');</script>";
    }

    mysqli_close($conexao);
}
