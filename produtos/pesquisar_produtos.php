<?php

include_once("../conexao.php");

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "";

$sql = "select * from produtos where nome like '%$filtro%'order by nome";


$consulta = mysqli_query($conexao, $sql);
$registro = mysqli_num_rows($consulta);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estoque/CSS/bootstrap.css">
    <title>Sistema de Cadastro de Produtos</title>

    <style>
        .link {
            color: black;
        }

        .produto {
            display: inline-block;
            position: relative;
        }

        .produto img {
            position: absolute;
            margin-top: -40px;
            left: 0;
            display: none;
            width: 120px;
            height: auto;
            border-radius: 5%;
            border: 2px solid black;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #CFC0A7;">

        <div class="row" style="padding: 10px;">
            <form class="container-fluid justify-content-start" style="width: 200px;">
                <a href="../index.php" class="btn btn-primary" style="background-color: #d75413; border-color:#d75413;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
                    </svg> Menu </a>
            </form>
        </div>

        <div class="container-fluid justify-content-center">
            <div class="col-6">
                <form class="d-flex" role="search" method="get" action="">
                    <input class="form-control me-2 campo" type="text" name="filtro" placeholder="Pesquise pelo nome do produto" aria-label="Search" required autofocus>
                    <button class="btn btn-outline-success" type="submit"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 2%;">

        <?php
        print "Resultado da pesquisa com a palavra <strong>$filtro</strong><br><br>";

        print "$registro registros encontrados.";
        ?>
    </div>

    <section style="padding: 2%; ">

        <?php

        print "<table class='table table-striped table-hover table-bordered'>";
        print "<thead>";
        print "<tr>";
        print "<th scope='col'>Id</th>";
        print "<th scope='col'>Nome</th>";
        print "<th scope='col'>Código</th>";
        print "<th scope='col'>Lead_Time</th>";
        print "<th scope='col'>Qtde</th>";
        print "<th scope='col'>Funcionário</th>";
        print "<th scope='col'>Descrição</th>";
        print "<th scope='col'>Frequência</th>";
        print "<th scope='col'>Data</th>";
        print "<th scope='col'>Unidade</th>";
        print "<th scope='col'>Valor de Produção</th>";
        print "<th scope='col'>Valor de Venda</th>";
        print "<th scope='col'>Máximo</th>";
        print "<th scope='col'>Mínimo</th>";
        print "<th scope='col'>Observação</th>";
        print "</tr>";
        print "</thead>";
        print "<tbody>";

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
            $imagem = $exibirRegistro[15];

            print "<tr>";
            print "<th>$id</th>";



            print "<th> <a href='view.php?id=$id' style='text-decoration: none;' class='link'> $nome</a>"

        ?>

            <div class="produto" onmouseout="esconderImagem(this)" onmouseover="mostrarImagem(this)">
                <img src="<?php echo isset($imagem) ? $imagem : '../upload/nicolas.jpg'; ?>" alt='Imagem do produto'>
            </div>

            </th>

        <?php
            print "<th>$codigo</th>";
            print "<th>$lead_time</th>";
            print "<th>$qtde</th>";
            print "<th>$funcionario</th>";
            print "<th>$descricao</th>";
            print "<th>$frequencia</th>";
            print "<th>" . date("d/m/Y", strtotime($data)) . "</th>";
            print "<th>$unidade</th>";
            print "<th>$valor_producao</th>";
            print "<th>$valor_venda</th>";
            print "<th>$maximo</th>";
            print "<th>$minimo</th>";
            print "<th>$observacao</th>";

            print "<td>";


            print "<a class='btn btn-warning btn-sm btn-editar' href='editar_produto.php?id=$id' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/></svg>Editar</a>";
            print "&nbsp;";
            print "&nbsp;";
            print "&nbsp;";
            print "<a class='btn btn-danger btn-sm btn-excluir' href='excluir.php?id=$id' role='button' onclick='return confirmarExclusao()'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/></svg>Excluir</a>";
            print "&nbsp;";
            print "&nbsp;";
            print "&nbsp;";
            print "<a class='btn btn-info btn-sm btn-visualizar' href='view.php?id=$id'
            role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
                <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z'/><path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0'/></svg>Visualizar</a>";
            print "&nbsp;";
            print "&nbsp;";
            print "&nbsp;";

            print "</td>";
            print "</tr>";

            $idProduto = $exibirRegistro['id'];

            print "</article>";
        }

        mysqli_close($conexao);

        ?>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmarExclusao() {
            return confirm("Deseja mesmo excluir esse produto?");
        }


        function mostrarImagem(element) {
            var imagem = element.querySelector("img");
            imagem.style.display = "block";
        }

        function esconderImagem(element) {
            var imagem = element.querySelector("img");
            imagem.style.display = "none";
        }

        var links = document.querySelectorAll(".link");
        links.forEach(function(link) {
            link.addEventListener("mouseover", function() {
                var produto = this.nextElementSibling;
                mostrarImagem(produto);
            });
            link.addEventListener("mouseout", function() {
                var produto = this.nextElementSibling;
                esconderImagem(produto);
            });
        });
    </script>

</body>

</html>
