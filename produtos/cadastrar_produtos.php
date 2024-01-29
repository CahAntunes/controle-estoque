<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Cadastrar</title>
</head>

<body>
    <!-- <a href="cadastrar_produtos.php">Cadastrar</a><br> -->
    <a href="index.php">Menu</a><br>
    <h1>Cadastrar Produtos</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="POST" action="inserir_produto.php">

        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Digite o nome completo"><br><br>

        <label>Código:</label>
        <input type="text" name="codigo" placeholder="Digite o código do produto"><br><br>

        <label>Lead Time:</label>
        <input type="text" name="lead_time" placeholder="Digite o tempo de execução do produto"><br><br>

        <label>Quantidade:</label>
        <input type="text" name="qtde" placeholder="Digite a quantidade do prodtuo"><br><br>

        <label>Funcionário</label>
        <input type="text" name="funcionario" placeholder="Digite o nome do funcionário"><br><br>

        <label>Descrição:</label>
        <input type="text" name="descricao" placeholder="Digite a descrição do produto"><br><br>

        <label>Frequência:</label>
        <select name="frequencia" class="campoSelect">
            <option value="diario">diario</option>
            <option value="semanal">semanal</option>
            <option value="mensal">mensal</option>
            <option value="trimestral">trimestral</option>
            <option value="semestral">semestral</option>
            <option value="anual">anual</option>
        </select><br><br>

        <label>Data:</label>
        <input type="date" name="data" id="data"><br><br>

        <label>Unidade:</label>
        <select name="unidade" class="campoSelect">
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
        <input type="text" id= "valor_producao" name="valor_producao" placeholder="Digite o valor do produto"><br><br>

        <label>Valor Venda:</label>
        <input type="text" id= "valor_venda" name="valor_venda" placeholder="Digite o valor do produto"><br><br>

        <label>Máximo</label>
        <input type="text" name="maximo" placeholder="Digite a qtde máxima de produto"><br><br>

        <label>Minímo:</label>
        <input type="text" name="minimo" placeholder="Digite a qtde minima de produto"><br><br>

        <label>Observação: </label><br>
        <textarea name="observacao" placeholder="Digite a sua observação"> </textarea><br><br>

        <input type="submit" value="Cadastrar">
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
