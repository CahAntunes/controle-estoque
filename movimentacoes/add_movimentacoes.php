<?php
session_start();
include_once("../conexao.php");
$produto_id = filter_input(INPUT_GET, 'produto_id');

?>

<script src="../js/function.js"></script>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/Estoque/js/jquery-3.7.1.min.js"></script>
    <script src="/Estoque/js/jquery.mask.js"></script>
    <link rel="stylesheet" href="/Estoque/CSS/bootstrap.css">
    <title>CRUD - Cadastrar</title>
</head>

<body style="background-color: #CFC0A7; font-size:18px;">
    <nav class="navbar" style="background-color: #CFC0A7; padding: 10px 15px 10px 15px;">

        <a href="../index.php" class="btn btn-primary me-2" style="background-color: #d75413; border-color:#d75413;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
            </svg> Menu </a>

        <a href='../produtos/view.php?id=<?php echo $produto_id ?>' class="btn btn-primary" style="background-color: #d75413; border-color:#d75413;">
            Voltar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
            </svg></a>
    </nav>

    <div class="container justify-content-center border" style="background-color: white; margin-top: 2%; border-radius: 15px; padding: 2%;">

        <form method="POST" action="addmovimentacoes_processa.php" class="row g-3">

            <h1>Adicionando movimentações</h1>

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

            $sql = "SELECT id, nome, codigo, qtde FROM produtos WHERE id = '$produto_id'";
            $busca = mysqli_query($conexao, $sql);

            while ($array = mysqli_fetch_array($busca)) {
                $id = $array['id'];
                $nome = $array['nome'];
                $codigo = $array['codigo'];
                $qtde = $array['qtde'];
            ?>
            <?php
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

            <input type="hidden" name="produto_id" value=<?php echo $produto_id ?>>

            <div class="col-md-4">
                <label>Tipo:</label>
                <select name="tipo" class="form-select campoSelect" required>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saida</option>
                </select>
            </div>



            <div class="col-md-4">
                <label>Status:</label>
                <select name="status" class="form-select campoSelect" required>
                    <option value="compra">Compra</option>
                    <option value="venda">Venda</option>
                    <option value="devolucao">Devolução</option>
                    <option value="outros">Outros</option>
                </select>
            </div>

            <div class="col-md-4">
                <label>Qtde:</label>
                <input class="form-control" type="text" name="qtde_mov" placeholder="Digite a quantidade de prodtuo" maxlength="4">
            </div>

            <div class="col-md-4">
                <label>Estoque Atual:</label>
                <input class="form-control" type="text" name="estoque" value="<?php echo $qtde ?>" readonly style="background-color:#E9ECEF;">
            </div>

            <div class="col-md-4">
                <label>Código:</label>
                <input class="form-control" type="text" value=<?php echo $codigo ?> disabled>
            </div>

            <div class="col-md-4">
                <label>Nome:</label>
                <input class="form-control" type="text" name="nome" value="<?php echo $nome ?>" maxlength="40" disabled>
            </div>

            <div class="col-md-4">
                <label>Cliente / Fornecedor:</label>
                <input class="form-control" type="text" name="cliente" placeholder="Digite o nome do cliente" maxlength="30" required>
            </div>

            <div class="col-md-2">
                <label>Data:</label>
                <input class="form-control" type="date" name="data" id="data" required>
                <script>
                    definirDataMinima('data');
                </script>
            </div>

            <div class="col-md-4">
                <label>Responsável:</label>
                <input class="form-control" type="text" name="responsavel" placeholder="Digite o nome do responsável pela movimentação" maxlength="30" required>
            </div>
            <div class="col-lg-12" style="text-align: right;">
                <button type="submit" class="btn btn-primary" value="Adicionar" id="adicionar" style="background-color: #d75413; border-color:#d75413;">Adicionar</button>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script> -->



    <!-- <script>
        $('#valor_venda').mask("#.##0,00", {
            reverse: true
        });
        $('#valor_producao').mask("#.##0,00", {
            reverse: true
        });
    </script> -->


</body>

</html>
