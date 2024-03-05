<?php
session_start();
include_once("../conexao.php");
$id_mov = filter_input(INPUT_GET, 'id_mov');
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

<body style="background-color: #CFC0A7;">
    <nav class="navbar" style="background-color: #CFC0A7; padding: 10px 15px 10px 15px; ">

        <a href="../index.php" class="btn btn-outline-success me-2" style="background:  #d75413; color:white; border:none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
            </svg> Menu </a>

        <a href='../produtos/view.php?id=<?php echo $produto_id ?>' class="btn btn-outline-secondary" style="background:  #d75413; color:white; border:none;">
            Voltar <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
            </svg></a>
    </nav>

    <div class="container justify-content-center border" style="background-color: white; margin-top: 2%; border-radius: 15px; padding: 2%;">

        <form method="POST" action="editarmovimentacoes_processa.php" class="row g-3">

            <h1>Editar movimentação</h1>

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

            $sql = "SELECT id, nome, codigo, qtde FROM produtos WHERE id = '$produto_id'";
            $busca = mysqli_query($conexao, $sql);

            while ($array = mysqli_fetch_array($busca)) {
                $id = $array['id'];
                $nome = $array['nome'];
                $codigo = $array['codigo'];
                $qtde = $array['qtde'];
            ?>

                <input type="hidden" name="produto_id" value=<?php echo $produto_id ?>>

                <div class="col-md-4">
                    <label>Código:</label>
                    <input class="form-control" type="text" value=<?php echo $codigo ?> disabled>
                </div>

                <div class="col-md-4">
                    <label>Nome:</label>
                    <input class="form-control" type="text" name="nome" value="<?php echo $nome ?>" disabled>
                </div>

                <div class="col-md-4">
                    <label>Estoque:</label>
                    <input class="form-control" type="text" name="qtde" value="<?php echo $qtde ?>" maxlength="4" readonly style="background-color:#E9ECEF;">
                </div>

            <?php } ?>
            <?php

            $result = "SELECT * FROM produtos_movimentacoes
            WHERE id = '$id_mov'";

            $busca2 = mysqli_query($conexao, $result);

            while ($movimentacao = mysqli_fetch_array($busca2)) {

                $id = $movimentacao['id'];
                $produto_id = $movimentacao['produto_id'];
                $tipo = $movimentacao['tipo'];
                $status = $movimentacao['status'];
                // $estoque = $movimentacao['estoque'];
                $qtde_mov = $movimentacao['qtde_mov'];
                $cliente = $movimentacao['cliente'];
                $data = $movimentacao['data'];
                $responsavel = $movimentacao['responsavel'];

            ?>
                <input type="hidden" name="id" value=<?php echo $id_mov ?>>
                <div class="col-md-4">
                    <label>Tipo:</label>
                    <select name="tipo" class="form-select campoSelect" required>
                        <option value="entrada" <?php echo isset($movimentacao['tipo']) ? (($movimentacao['tipo'] == 'entrada') ? 'selected' : '') : ''; ?>>Entrada</option>
                        <option value="saida" <?php echo isset($movimentacao['tipo']) ? (($movimentacao['tipo'] == 'saida') ? 'selected' : '') : ''; ?>>Saida</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Status:</label>
                    <select name="status" class="form-select campoSelect" required>
                        <option value="compra" <?php echo isset($movimentacao['status']) ? (($movimentacao['status'] == 'compra') ? 'selected' : '') : ''; ?>>Compra</option>
                        <option value="venda" <?php echo isset($movimentacao['status']) ? (($movimentacao['status'] == 'venda') ? 'selected' : '') : ''; ?>>Venda</option>
                        <option value="devolucao" <?php echo isset($movimentacao['status']) ? (($movimentacao['status'] == 'devolucao') ? 'selected' : '') : ''; ?>>Devolução</option>
                        <option value="outros" <?php echo isset($movimentacao['status']) ? (($movimentacao['status'] == 'outros') ? 'selected' : '') : ''; ?>>Outros</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Qtde:</label>
                    <input class="form-control" type="text" name="qtde_mov" value="<?php echo $movimentacao['qtde_mov'] ?>" maxlength="4">
                </div>

                <div class="col-md-5">
                    <label>Cliente:</label>
                    <input class="form-control" type="text" name="cliente" value="<?php echo $movimentacao['cliente'] ?>" maxlength="30" required>
                </div>

                <div class="col-md-2">
                    <label>Data:</label>
                    <input class="form-control" type="date" name="data" id="data" value="<?php echo $movimentacao['data'] ?>" required> <script>definirDataMinima('data');</script>
                </div>

                <div class="col-md-5">
                    <label>Responsável:</label>
                    <input class="form-control" type="text" name="responsavel" value="<?php echo $movimentacao['responsavel'] ?>" maxlength="30" required>
                </div>

            <?php } ?>

            <div class="col-12">
                <input type="submit" class="btn btn-primary" value="Salvar" id="salvar" style="background-color: #d75413; border-color:#d75413;">

            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
