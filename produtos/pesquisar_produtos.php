<?php

include_once("conexao.php");



$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "";

$sql = "select * from produtos where nome like '%$filtro%'order by nome";


$consulta = mysqli_query($conexao, $sql);
$registro = mysqli_num_rows($consulta);

?>

<!DOCTYPE html>
<html lang="pt-br">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<head>
    <meta charset="UTF-8">
    <title>Sistema de Cadastro de Produtos</title>
    
</head>

<body>
    <a href="index.php">Menu</a><br>
    <div class="container">

        <section>
            <h1>Consultas de Produtos</h1>
            <hr><br>

            <form method="get" action="">
                Filtrar por Nome do Produto: <input type="text" name="filtro" class="campo" required autofocus>
                <input type="submit" value="Pesquisar" class="btn">
            </form>

            <?php

            print "Resultado da pesquisa com a palavra <strong>$filtro</strong><br><br>";

            print "$registro registros encontrados.";

            print "<br><br>";

            while ($exibirRegistro = mysqli_fetch_array($consulta)) {

                $id = $exibirRegistro[0];
                $nome = $exibirRegistro[1];
                $codigo = $exibirRegistro[2];
                $lead_time = $exibirRegistro[3];
                $qtde = $exibirRegistro[4];
                $funcionario = $exibirRegistro[5];
                $descricao = $exibirRegistro[6];
                $frequencia = $exibirRegistro[7];
                $data = $exibirRegistro[8];
                $unidade = $exibirRegistro[9];
                $valor_venda = $exibirRegistro[10];
                $valor_producao = $exibirRegistro[11];
                $maximo = $exibirRegistro[12];
                $minimo = $exibirRegistro[13];
                $observacao = $exibirRegistro[14];

                print "<article><hr>";

                print "Id: $id<br>";
                print "Produto: $nome<br>";
                print "Código: $codigo<br>";
                print "Tempo de produção: $lead_time<br>";
                print "Quantidade: $qtde<br>";
                print "Funcionário responsável: $funcionario<br>";
                print "Descrição do produto: $descricao<br>";
                print "Frequência: $frequencia<br>";
                print "Data: $data<br>";
                print "Unidade: $unidade<br>";
                print "Valor de venda: $valor_venda<br>";
                print "Valor de produção: $valor_producao<br>";
                print "Máximo em estoque: $maximo<br>";
                print "Mínimo em estoque: $minimo<br>";
                print "Observações: $observacao<br><br>";


                print "<a href='editar_produto.php?id=$id' class='btn-editar'>Editar</a>";
                print "&nbsp;";
                print "&nbsp;";
                print "&nbsp;";
                print "<a href='excluir.php?id=$id' class='btn-excluir'>Excluir</a>";
                print "&nbsp;";
                print "&nbsp;";
                print "&nbsp;";

                $idProduto = $exibirRegistro['id'];
                // echo "<a href='index.php?copiar=$idProduto' class='btn-copiar'>Copiar</a>";

                print "</article>";
            }

            mysqli_close($conexao);

            ?>

        </section>
    </div>

    <script>
        function confirmarExclusao() {
            return confirm("Deseja mesmo excluir esse produto?");
        }
    </script>

</body>

</html>
