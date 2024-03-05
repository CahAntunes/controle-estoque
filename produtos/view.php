<?php

include_once("../conexao.php");
$id = filter_input(INPUT_GET, 'id');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estoque/CSS/bootstrap.css">
    <title>CRUD - Cadastrar</title>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .geral {
            display: flex;
            justify-content: space-between;
            /* margin-bottom: -6%; */

        }

        .descricao {
            width: 85%;
        }

        .principais {
            display: flex;
            justify-content: space-between;
            /* width: 70%; */
        }

        .informacoes {
            display: flex;
            justify-content: space-between;
            /* width: 70%; */
        }

        .geral2 {
            /* display: flex;
            justify-content: space-between; */
            width: 80%;
        }

        .informacoes2 {
            display: flex;
            justify-content: space-between;
            width: 108%;
            gap: 6%;
        }

        .informacoes3 {
            margin-top: 4%;
            display: flex;
            justify-content: space-between;
            width: 108%;
            gap: 2%;
        }

        #btnEditar {
            width: 66%;
        }

        #head {
            display: flex;
            justify-content: space-between;
            width: 88%;
        }
    </style>

</head>

<body style="background-color: #CFC0A7; font-size:18px;">

    <nav class="navbar" style="background-color: #CFC0A7; padding: 10px 15px 10px 15px;">

        <a href="../index.php" class="btn btn-outline-success me-2" style="background: #d75413; color:white; border:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
            </svg> Menu </a>

        <a href="pesquisar_produtos.php" class="btn btn-outline-secondary" style="background:  #d75413; color:white; border:none;"> Voltar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
            </svg></a>

    </nav>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <div class="container justify-content-center border" style="background-color: white; margin-top: 2%; border-radius: 15px;">

        <form method="POST" action="editar_processa.php" class="row g-3" style="padding: 2%;">
            <?php
            if (isset($_SESSION['erro'])) {
            ?>
                <div style="color: red;">
                    <?php
                    foreach ($_SESSION['erro'] as $erro) {
                        echo $erro;
                    }
                    ?>
                </div>
            <?php
                unset($_SESSION['erro']);
            }
            ?>


            <div class="container">
                <div id="head" class="row g-2 aling" style="display: flex;">
                    <div class="col-4" style=" margin-top:1%;">
                        <h1>Visualizar Produtos</h1>
                    </div>
                    <div id="btnEditar" class="col-2" style="display: flex; height: 2%; margin-top:2%; ">
                        <?php print "<a class='btn btn-warning btn-sm btn-editar' href='editar_produto.php?id=$id' id='editar_produto' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/></svg>Editar</a>";
                        ?>
                    </div>
                </div>
            </div>



            <?php

            $sql = "SELECT * FROM produtos WHERE id = '$id'";
            $busca = mysqli_query($conexao, $sql);

            while ($array = mysqli_fetch_array($busca)) {
                $id = $array['id'];
                $nome = $array['nome'];
                $codigo = $array['codigo'];
                $lead_time = $array['lead_time'];
                $qtde = $array['qtde'];
                $funcionario = $array['funcionario'];
                $descricao = $array['descricao'];
                $frequencia = $array['frequencia'];
                $data = $array['data'];
                $unidade = $array['unidade'];
                $valor_venda = $array['valor_venda'];
                $valor_producao = $array['valor_producao'];
                $maximo = $array['maximo'];
                $minimo = $array['minimo'];
                $observacao = $array['observacao'];
                $imagem = $array['imagem'];
                $pdf = $array['pdf'];
            ?>

                <input type="text" name="id" value="<?php echo $id; ?>" style="display: none;">
                <div class="geral">
                    <div class="col-md-2">


                        <?php

                        $pasta_destino = "../upload/" . $codigo;

                        if ($imagem === NULL) {
                            $imagem = "../upload/nicolas.jpg";
                        } else {
                            if (!file_exists($pasta_destino) || empty(glob($pasta_destino . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE))) {
                                $imagem = "../upload/nicolas.jpg";
                            }
                        }
                        ?>
                        <a class='btn btn-sm btn-visualizar' href="<?php echo $imagem; ?>" type="image/*" role='button' target="_blank">
                            <img src="<?php echo $imagem ?>" class="img-thumbnail" style="height: 150px; width: 180px" /></a>


                    </div>
                    <div class="descricao">
                        <div class="principais">
                            <div class="col-md-1" style="width: 15%;">
                                <label>Código:</label>
                                <input class="form-control" type="text" name="codigo" value="<?php echo $codigo; ?>" autocomplete="off" maxlength="5" disabled>
                            </div>

                            <div class="col-md-4" style="width: 38%;">
                                <label>Nome:</label>
                                <input class="form-control" type="text" name="nome" value="<?php echo $nome; ?>" autocomplete="off" maxlength="40" disabled>
                            </div>

                            <div class="col-md-5" style="width: 36%;">
                                <label>Descrição:</label>
                                <input class="form-control" type="text" name="descricao" value="<?php echo $descricao; ?>" autocomplete="off" maxlength="80" disabled>
                            </div>
                        </div>
                        <div class="informacoes" style="padding-top:2%">
                            <div class="col-md-2" style="width: 15%;">
                                <labell>Valor Produção:</labell>
                                <input class="form-control" type="text" id="valor_producao" name="valor_producao" value="<?php echo $valor_producao; ?>" disabled>
                            </div>

                            <div class="col-md-2" style="width: 15%;">
                                <label>Valor Venda:</label>
                                <input class="form-control" type="text" id="valor_venda" name="valor_venda" value="<?php echo $valor_venda; ?>" disabled>
                            </div>
                            <div class="col-md-2" style="width: 15%;">
                                <label>Minímo:</label>
                                <input class="form-control" type="text" name="minimo" value="<?php echo $minimo; ?>" autocomplete="off" disabled>
                            </div>

                            <div class="col-md-2" style="width: 15%;">
                                <label>Máximo: </label>
                                <input class="form-control" type="text" name="maximo" value="<?php echo $maximo; ?>" autocomplete="off" disabled>
                            </div>

                            <div class="col-md-2" style="width: 15%;">
                                <label>Estoque Atual:</label>
                                <input class="form-control" type="text" name="qtde" value="<?php echo $qtde; ?>" autocomplete="off" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="geral2">

                    <div class="informacoes2">
                        <div class="col-md-1">
                            <label>Lead Time:</label>
                            <input class="form-control" type="text" name="lead_time" value="<?php echo $lead_time; ?>" autocomplete="off" maxlength="3" disabled>
                        </div>

                        <div class="col-md-2">
                            <label>Unidade:</label>
                            <select name="unidade" class="form-select campoSelect" disabled>
                                <option value="<?php echo $unidade; ?>"><?php echo $unidade; ?></option>
                                <option value="un">un</option>
                                <option value="mg">mg</option>
                                <option value="g">g</option>
                                <option value="kg">kg</option>
                                <option value="cm">cm</option>
                                <option value="m">m</option>
                                <option value="ml">ml</option>
                                <option value="l">l</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Frequência:</label>
                            <select name="frequencia" class="form-select campoSelect" disabled>
                                <option value="<?php echo $frequencia; ?>"><?php echo $frequencia; ?></option>
                                <option value="diario">diário</option>
                                <option value="semanal">semanal</option>
                                <option value="mensal">mensal</option>
                                <option value="trimestral">trimestral</option>
                                <option value="semestral">semestral</option>
                                <option value="anual">anual</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Data:</label>
                            <input class="form-control" type="date" name="data" value="<?php echo $data; ?>" id="data" disabled>
                        </div>

                        <div class="col-md-4">
                            <label>Funcionário:</label>
                            <input class="form-control" type="text" name="funcionario" value="<?php echo $funcionario; ?>" autocomplete="off" maxlength="30" disabled>
                        </div>
                    </div>














                    <div class="informacoes3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea name="observacao" class="form-control" autocomplete="off" id="floatingTextarea" disabled><?php echo isset($observacao) ? $observacao : ''; ?></textarea>
                                <label for="floatingTextarea">Observação</label><br><br>
                            </div>
                        </div>
                        <?php
                        if ($pdf !== NULL && file_exists($pasta_destino) && !empty(glob($pasta_destino . "/*.pdf"))) { ?>
                            <div class="col-md-6">
                                <a class='btn btn-sm btn-visualizar' href="<?php echo $pdf; ?>" type='application/pdf' role='button' target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                                    </svg></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="container">

                    <div class=" row g-2 aling" style="display: flex;">
                        <div class="col-3" style=" margin-top:1%;">
                            <h1>Movimentações</h1>
                        </div>
                        <div class="col-2" style="display: flex; height: 2%; margin-top:2%; ">
                            <?php print "<a class='btn btn-success btn-sm btn-adicionar' href='../movimentacoes/add_movimentacoes.php?produto_id=$id' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z' />
                                </svg>Add Mov</a>";
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </form>

        <?php
        print "<table class='table table-striped table-hover table-bordered'>";
        print "<thead>";
        echo "<tr>";
        echo "<th scope='col'>Nº</th>";
        echo "<th scope='col'>Tipo</th>";
        echo "<th scope='col'>Status</th>";
        echo "<th scope='col'>Responsável</th>";
        echo "<th scope='col'>Cliente</th>";
        echo "<th scope='col'>Qtde</th>";
        echo "<th scope='col'>Data</th>";
        echo "<th scope='col'></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";


        $result = "SELECT * FROM produtos_movimentacoes
        WHERE produto_id = '$id' ORDER BY id DESC";


        $consulta = mysqli_query($conexao, $result);
        $num_rows = mysqli_num_rows($consulta);
        $i = $num_rows;


        while ($movimentacao = mysqli_fetch_array($consulta)) {
        ?>
            <tr>

                <td><?php echo $i ?></td>

                <td> <?php echo $movimentacao['tipo'] ?><?php echo isset($movimentacao['tipo']) ? ($movimentacao['tipo'] === "entrada" ? ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16" style="color: green;"><path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/></svg>' : ($movimentacao['tipo'] === "saida" ? ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="color: red;"><path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/></svg>' : '')) : ''; ?>
                </td>
                <td><?php echo $movimentacao['status'] ?></td>
                <td><?php echo $movimentacao["responsavel"] ?></td>
                <td><?php echo $movimentacao["cliente"] ?></td>
                <td><?php echo $movimentacao["qtde_mov"] ?></td>
                <td><?php echo date("d/m/Y", strtotime($movimentacao["data"])) ?></td>

                <td><?php

                    if ($i === $num_rows) {
                        print "<a class='btn btn-warning btn-sm btn-editar' href='../movimentacoes/editar_movimentacoes.php?id_mov=" . $movimentacao["id"] . "&produto_id=" . $id . "' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
            <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
            <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/></svg>Editar</a>";

                        print "&nbsp;";
                        print "&nbsp;";
                        print "&nbsp;";
                        print "<a class='btn btn-danger btn-sm btn-excluir' href='../movimentacoes/excluir_movimentacoes.php?id=" . $movimentacao["id"] . "&idproduto=" . $id . "' role='button' onclick='return confirmarExclusao()'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
            <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/></svg>Excluir</a>";
                    }

                    ?></td>
            </tr>


        <?php
            $i--;
        }
        ?>
        </tbody>
        </table>

    </div>


    <script src="/Estoque/js/jquery-3.7.1.min.js"></script>
    <script src="/Estoque/js/jquery.mask.js"></script>

    <script>
        $('#valor_venda').mask("#.##0,00", {
            reverse: true
        });
        $('#valor_producao').mask("#.##0,00", {
            reverse: true
        });
    </script>

</body>

</html>
