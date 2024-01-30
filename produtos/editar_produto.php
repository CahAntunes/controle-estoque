<?php

session_start();
include_once("conexao.php");
$id = filter_input(INPUT_GET, 'id');

?>

<html lang="pt-br">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Cadastrar</title>
</head>

<body>
    <a href="index.php">Menu</a><br>
    <a href="pesquisar_produtos.php">Voltar</a><br>
    
    <h1>Editar Produtos</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="POST" action="editar_processa.php">

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
            <!-- <label>Id:</label> -->
            <input type="text" name="id" value="<?php echo $id; ?>" style="display: none;">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo $nome; ?>" autocomplete="off"><br><br>

            <label>Código:</label>
            <input type="text" name="codigo" value="<?php echo $codigo; ?>" autocomplete="off"><br><br>

            <label>Lead Time:</label>
            <input type="text" name="lead_time" value="<?php echo $lead_time; ?>" autocomplete="off"><br><br>

            <label>Quantidade:</label>
            <input type="text" name="qtde" value="<?php echo $qtde; ?>" autocomplete="off"><br><br>

            <label>Funcionário</label>
            <input type="text" name="funcionario" value="<?php echo $funcionario; ?>" autocomplete="off"><br><br>

            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?php echo $descricao; ?>" autocomplete="off"><br><br>

            <label>Frequência:</label>
            <select name="frequencia" class="campoSelect" required>
                <option value="<?php echo $frequencia; ?>"><?php echo $frequencia; ?></option>
                <option value="diario">diario</option>
                <option value="semanal">semanal</option>
                <option value="mensal">mensal</option>
                <option value="trimestral">trimestral</option>
                <option value="semestral">semestral</option>
                <option value="anual">anual</option>
            </select><br><br>

            <label>Data:</label>
            <input type="date" name="data" value="<?php echo $data; ?>" id="data"><br><br>

            <label>Unidade:</label>
            <select name="unidade" class="campoSelect">
                <option value="<?php echo $unidade; ?>"><?php echo $unidade; ?></option>
                <option value="un">un</option>
                <option value="mg">mg</option>
                <option value="g">g</option>
                <option value="kg">kg</option>
                <option value="cm">cm</option>
                <option value="m">m</option>
                <option value="ml">ml</option>
                <option value="l">l</option>
            </select><br><br>

            <label>Valor Produção:</label>
            <input type="text" id="valor_producao" name="valor_producao" value="<?php echo $valor_producao; ?>" autocomplete="off"><br><br>

            <label>Valor Venda:</label>
            <input type="text" id="valor_venda" name="valor_venda" value="<?php echo $valor_venda; ?>" autocomplete="off"><br><br>

            <label>Máximo</label>
            <input type="text" name="maximo" value="<?php echo $maximo; ?>" autocomplete="off"><br><br>

            <label>Minímo:</label>
            <input type="text" name="minimo" value="<?php echo $minimo; ?>" autocomplete="off"><br><br>

            <label>Observação:</label><br>
            <textarea name="observacao" autocomplete="off"><?php echo isset($observacao) ? $observacao : ''; ?></textarea><br><br>

            <input type="submit" value="Salvar">
            
    <?php } ?>
    </form>

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
