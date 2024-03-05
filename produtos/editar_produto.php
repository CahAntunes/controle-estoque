<?php

session_start();
include_once("../conexao.php");
$id = filter_input(INPUT_GET, 'id');

?>

<script src="../js/function.js"></script>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estoque/CSS/bootstrap.css">
    <title>CRUD - Cadastrar</title>

    <style>
        .geral {
            display: flex;
            justify-content: space-between;
        }

        .descricao {
            width: 82%;
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
    </style>

</head>

<body style="background-color: #CFC0A7; font-size:18px;">

    <nav class="navbar" style="background-color: #CFC0A7; padding: 10px 15px 10px 15px;">

        <a href="../index.php" class="btn btn-outline-success me-2" style="background: #d75413; color:white; border:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
            </svg> Menu </a>

        <a href="pesquisar_produtos.php" class="btn btn-outline-secondary" style="background: #d75413; color:white; border:none;">
            Voltar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
            </svg></a>
    </nav>

    <div class="container justify-content-center border" style="background-color: white; margin-top: 2%; border-radius: 15px;">

        <?php
        if (isset($_FILES["imagem"]) && !empty($_FILES["imagem"])) {
            move_uploaded_file($_FILES["imagem"]["tmp_name"], "../upload/" . $_FILES["imagem"]["name"]);
            echo "update realizado com sucesso";
        }
        ?>

        <form id="editar" method="POST" action="editar_processa.php" class="row g-3" enctype="multipart/form-data" style="padding: 2%;">
            <h1>Editar Produtos</h1>

            <?php
            if (!empty($_SESSION['bancoOK'])) {
            ?>
                <div style="color: green;"><?php echo $_SESSION['bancoOK'] ?></div>
            <?php
                unset($_SESSION['bancoOK']);
            } else if (!empty($_SESSION['bancoErro'])) {
            ?>
                <div style="color: red;"><?php echo $_SESSION['bancoErro'] ?></div>
            <?php
                unset($_SESSION['bancoErro']);
            }
            ?>

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
                    <div class="">
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
                        <img src="<?php echo $imagem ?>" class="img-thumbnail" style="height: 150px; width: 180px" />

                    </div>
                    <div class="descricao">
                        <div class="principais">
                            <div class="col-md-1" style="width: 15%;">
                                <label>Código:</label>
                                <input class="form-control numero" type="text" name="codigo" value="<?php echo $codigo; ?>" aria-label="Digite o código do produto" maxlength="5" readonly>
                            </div>

                            <div class="col-md-4" style="width: 38%;">
                                <label>Nome:</label>
                                <input class="form-control letra" type="text" name="nome" value="<?php echo $nome; ?>" aria-label="Digite o nome do produto" maxlength="40" readonly>
                            </div>

                            <div class="col-md-5" style="width: 36%;">
                                <label>Descrição:</label>
                                <input class="form-control" type="text" name="descricao" value="<?php echo $descricao; ?>" aria-label="Digite a descrição do produto" maxlength="80">
                            </div>
                        </div>
                        <div class="informacoes" style="padding-top:2%">
                            <div class="col-md-2" style="width: 15%;">
                                <labell>Valor Produção:</labell>
                                <input class="form-control" type="text" id="valor_producao" name="valor_producao" value="<?php echo $valor_producao; ?>">
                            </div>

                            <div class="col-md-2" style="width: 15%;">
                                <label>Valor Venda:</label>
                                <input class="form-control" type="text" id="valor_venda" name="valor_venda" value="<?php echo $valor_venda; ?>">
                            </div>

                            <div class="col-md-2" style="width: 15%;">
                                <label>Minímo:</label>
                                <input class="form-control numero" type="text" name="minimo" value="<?php echo $minimo; ?>" required>
                            </div>

                            <div class="col-md-2" style="width: 15%;">
                                <label>Máximo: </label>
                                <input class="form-control numero" type="text" name="maximo" value="<?php echo $maximo; ?>" required>
                            </div>

                            <div class="col-md-2" style="width: 15%;">
                                <label>Qtde em Estoque:</label>
                                <input class="form-control numero" type="text" name="qtde" value="<?php echo $qtde; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Lead Time:</label>
                    <input class="form-control numero" type="text" name="lead_time" value="<?php echo $lead_time; ?>" aria-label="Digite o tempo de execução do produto" maxlength="3">
                </div>

                <div class="col-md-2">
                    <label>Unidade:</label>
                    <select name="unidade" class="form-select campoSelect" required>
                        <option value="un" <?php echo isset($array['unidade']) ? (($array['unidade'] == 'un') ? 'selected' : '') : ''; ?>>un</option>
                        <option value="mg" <?php echo isset($array['unidade']) ? (($array['unidade'] == 'mg') ? 'selected' : '') : ''; ?>>mg</option>
                        <option value="g" <?php echo isset($array['unidade']) ? (($array['unidade'] == 'g') ? 'selected' : '') : ''; ?>>g</option>
                        <option value="kg" <?php echo isset($array['unidade']) ? (($array['unidade'] == 'kg') ? 'selected' : '') : ''; ?>>kg</option>
                        <option value="cm" <?php echo isset($array['unidade']) ? (($array['unidade'] == 'cm') ? 'selected' : '') : ''; ?>>cm</option>
                        <option value="m" <?php echo isset($array['unidade']) ? (($array['unidade'] == 'm') ? 'selected' : '') : ''; ?>>m</option>
                        <option value="ml" <?php echo isset($array['unidade']) ? (($array['unidade'] == 'ml') ? 'selected' : '') : ''; ?>>ml</option>
                        <option value="l" <?php echo isset($array['unidade']) ? (($array['unidade'] == 'l') ? 'selected' : '') : ''; ?>>l</option>
                    </select>
                </div>


                <div class="col-md-2">
                    <label>Frequência:</label>
                    <select name="frequencia" class="form-select campoSelect" required>
                        <option value="diario" <?php echo isset($array['frequencia']) ? (($array['frequencia'] == 'diario') ? 'selected' : '') : ''; ?>>diario</option>
                        <option value="semanal" <?php echo isset($array['frequencia']) ? (($array['frequencia'] == 'semanal') ? 'selected' : '') : ''; ?>>semanal</option>
                        <option value="mensal" <?php echo isset($array['frequencia']) ? (($array['frequencia'] == 'mensal') ? 'selected' : '') : ''; ?>>mensal</option>
                        <option value="trimestral" <?php echo isset($array['frequencia']) ? (($array['frequencia'] == 'trimestral') ? 'selected' : '') : ''; ?>>trimestral</option>
                        <option value="semestral" <?php echo isset($array['frequencia']) ? (($array['frequencia'] == 'semestral') ? 'selected' : '') : ''; ?>>semestral</option>
                        <option value="anual" <?php echo isset($array['frequencia']) ? (($array['frequencia'] == 'anual') ? 'selected' : '') : ''; ?>>anual</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Data:</label>
                    <input class="form-control" type="date" name="data" id="data" value="<?php echo $data; ?>" required>
                    <script>
                        definirDataMinima('data');
                    </script>
                </div>

                <div class="col-md-4">
                    <label>Funcionário:</label>
                    <input class="form-control" type="text" name="funcionario" value="<?php echo $funcionario; ?>" maxlength="30" required>
                </div>

                <div class="col-md-8">
                    <div class="input-group mb-2">
                        <input type="file" name="imagem" class="form-control" id="inputGroupFile02" src="<?php echo $imagem; ?>" accept="image/*">
                        <span class="input-group-text" id="addon-wrapping">
                            <?php if ($imagem != null) { ?>
                                <a class='btn btn-sm btn-visualizar' href="<?php echo $imagem; ?>" type="image/*" role='button' target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                                    </svg></a>
                        </span>
                        <span class="input-group-text" name="imagem" id="addon-wrapping">
                            <a class='btn btn-sm btn-excluir' name="imagem" href='../upload/excluir_upload.php?codigo=<?php echo $codigo; ?>&id=<?php echo $id; ?>&tipo=<?php echo $imagem; ?>' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                    <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5' style="color:#b81414;" />
                                </svg></a>
                        </span>
                    <?php } ?>

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="input-group mb-2">
                        <input type="file" name="pdf" class="form-control" id="inputGroupFile02" value="<?php echo $pdf; ?>" accept="application/pdf">

                        <?php

                        if ($pdf !== NULL && file_exists($pasta_destino) && !empty(glob($pasta_destino . "/*.pdf"))) {

                        ?>
                            <span class="input-group-text" id="addon-wrapping">
                                <a class='btn btn-sm btn-visualizar' href="<?php echo $pdf; ?>" type='application/pdf' role='button' target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                                    </svg>
                                </a>
                            </span>
                        <?php
                        }
                        ?>
                        <?php if ($pdf != null) { ?>
                            <span class="input-group-text" name="pdf" id="addon-wrapping">
                                <a class='btn btn-sm btn-excluir' name="tipo" href='../upload/excluir_upload.php?codigo=<?php echo $codigo; ?>&id=<?php echo $id; ?>&tipo=<?php echo $pdf; ?>' role='button'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                        <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5' style="color:#b81414;" />
                                    </svg></a>
                            </span>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <textarea name="observacao" class="form-control" placeholder="Digite a sua observação" id="floatingTextarea"><?php echo isset($observacao) ? $observacao : ''; ?></textarea>
                        <label for="floatingTextarea">Observação</label>
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Salvar" id="salvar" style="background-color: #d75413; border-color:#d75413;"></button>
                </div>
            <?php } ?>
        </form>
    </div>

    <script src="/Estoque/js/jquery-3.7.1.min.js"></script>
    <script src="/Estoque/js/jquery.mask.js"></script>

    <script>
        function formatarValor(valor) {
            var valorFormatado = parseFloat(valor);
            return valorFormatado.toFixed(2);
        }

        $(document).ready(function() {
            $('#valor_producao').val(formatarValor(<?php echo $valor_producao; ?>));
            $('#valor_venda').val(formatarValor(<?php echo $valor_venda; ?>));

            $('#valor_producao').mask('000.000.000.000.000,00', {
                reverse: true
            });

            $('#valor_venda').mask('000.000.000.000.000,00', {
                reverse: true
            });
        });

        $(".numero").mask('0#', {
            maxlength: false
        });
        $(".letra").mask("#", {
            maxlength: false,
            translation: {
                "#": {
                    pattern: /[A-zÀ-ÿ\s]/,
                    recursive: true
                },
            },
        });
    </script>

</body>

</html>
