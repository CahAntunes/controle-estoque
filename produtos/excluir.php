
<?php
session_start();
include_once("conexao.php");

if (isset($_GET['id'])) {
    $idProduto = $_GET['id'];

    $sql = "DELETE FROM produtos WHERE id = $idProduto";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao)) {
        $_SESSION['msg'] = "<p style='color:green;'>Produto excluido com sucesso!</p>";
        header("Location: editar_processa.php");
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Falha ao excluir produto.</p>";
        header("Location: editar_processa.php");
    }
}

?>
