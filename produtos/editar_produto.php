<?php

session_start();
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
</head>

<body>

    <nav class="navbar" style="background-color: #ced4da; padding: 10px 15px 10px 15px;">

        <a href="index.php" class="btn btn-outline-success me-2" style="background: #0d6efd; color:white; border:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
            </svg> Menu </a>

        <a href="pesquisar_produtos.php" class="btn btn-outline-secondary" style="background: #0d6efd; color:white; border:none;"> Voltar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
            </svg></a>

    </nav>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <div class="container justify-content-center border" style="background-color: #e3f2fd; margin-top: 2%; border-radius: 15px;">

        <form method="POST" action="editar_processa.php" class="row g-3" style="padding: 2%;">
            <h1>Editar Produtos</h1>
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
            ?>

                <input type="text" name="id" value="<?php echo $id; ?>" style="display: none;">

                <div class="col-md-4">
                    <label>Nome:</label>
                    <input class="form-control letra" type="text" name="nome" value="<?php echo $nome; ?>" autocomplete="off" maxlength="40" required>
                </div>

                <div class="col-md-4">
                    <label>Descrição:</label>
                    <input class="form-control" type="text" name="descricao" value="<?php echo $descricao; ?>" autocomplete="off" maxlength="80">
                </div>

                <div class="col-md-3">
                    <label>Código:</label>
                    <input class="form-control numero" type="text" name="codigo" value="<?php echo $codigo; ?>" autocomplete="off" maxlength="5" required>
                </div>

                <div class="col-md-4">
                    <label>Lead Time:</label>
                    <input class="form-control numero" type="text" name="lead_time" value="<?php echo $lead_time; ?>" autocomplete="off" maxlength="3">
                </div>

                <div class="col-md-4">
                    <label>Unidade:</label>
                    <select name="unidade" class="form-select campoSelect" required>
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

                <div class="col-md-4">
                    <label>Frequência:</label>
                    <select name="frequencia" class="form-select campoSelect">
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
                    <input class="form-control" type="date" name="data" value="<?php echo $data; ?>" id="data" required>
                </div>

                <div class="col-md-4">
                    <label>Funcionário:</label>
                    <input class="form-control" type="text" name="funcionario" value="<?php echo $funcionario; ?>" autocomplete="off" maxlength="30" required>
                </div>

                <div class="col-md-3">
                    <labell>Valor Produção:</labell>
                    <input class="form-control" type="text" id="valor_producao" name="valor_producao" value="<?php echo $valor_producao; ?>" autocomplete="off">
                </div>

                <div class="col-md-3">
                    <label>Valor Venda:</label>
                    <input class="form-control" type="text" id="valor_venda" name="valor_venda" value="<?php echo $valor_venda; ?>" autocomplete="off">
                </div>

                <div class="col-md-4">
                    <label>Qtde:</label>
                    <input class="form-control numero" type="text" name="qtde" value="<?php echo $qtde; ?>" autocomplete="off" maxlength="4">
                </div>

                <div class="col-md-4">
                    <label>Minímo:</label>
                    <input class="form-control numero" type="text" name="minimo" value="<?php echo $minimo; ?>" autocomplete="off" required>
                </div>

                <div class="col-md-4">
                    <label>Máximo: </label>
                    <input class="form-control numero" type="text" name="maximo" value="<?php echo $maximo; ?>" autocomplete="off" required>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <textarea name="observacao" class="form-control" autocomplete="off" id="floatingTextarea"><?php echo isset($observacao) ? $observacao : ''; ?></textarea>
                        <label for="floatingTextarea">Observação</label>
                    </div>
                </div>

                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Salvar" id="salvar">
                </div>
                <!-- <div class="col-6">
                    <input type="submit" class="btn btn-primary" value="cancelar" id="cancelar"> 
                </div> -->

            <?php } ?>
        </form>
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