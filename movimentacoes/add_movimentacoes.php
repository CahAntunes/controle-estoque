<?php
session_start();
include_once("../conexao.php");
$produto_id = filter_input(INPUT_GET, 'produto_id');
var_dump($produto_id);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/Estoque/js/jquery-3.7.1.min.js"></script>
    <script src="/Estoque/js/jquery.mask.js"></script>
    <link rel="stylesheet" href="/Estoque/CSS/bootstrap.css">
    <title>CRUD - Teste</title>
</head>

<body>
    <nav class="navbar" style="background-color: #ced4da">
        <form class="container-fluid justify-content-start">
            <a href="../index.php" class="btn btn-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
                </svg> Menu </a>
        </form>
    </nav>

    <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>

    <div class="container justify-content-center border" style="background-color: #e3f2fd; margin-top: 2%; border-radius: 15px; padding: 2%;">

        <form method="POST" action="addmovimentacoes_processa.php" class="row g-3">

            <?php

            $sql = "SELECT * FROM produtos WHERE id = '$produto_id'";
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
            <?php 
            }
            echo $nome . " - " . $codigo;
            ?>

            <h1>Adicionando movimentações</h1>
            <input type="text" name="produto_id" value=<?php echo $produto_id ?>>
            <div class="col-md-4">
                <label>Tipo:</label>
                <select name="tipo" class="form-select campoSelect" required>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saida</option>
                    <option value="troca">Troca</option>
                    <option value="devolucao">Devolução</option>
                    <option value="outros">Outros</option>
                </select>
            </div>

            <div class="col-md-4">
                <label>Qtde:</label>
                <input class="form-control" type="text" name="qtde" placeholder="Digite a quantidade de prodtuo" maxlength="4">
            </div>

            <div class="col-md-4">
                <label>Cliente:</label>
                <input class="form-control" type="text" name="cliente" placeholder="Digite o nome do cliente" maxlength="30" required>
            </div>

            <div class="col-md-2">
                <label>Data:</label>
                <input class="form-control" type="date" name="data" id="data" required>
            </div> 

            <div class="col-md-4">
                <label>Responsável:</label>
                <input class="form-control" type="text" name="responsavel" placeholder="Digite o nome do responsável pela movimentação" maxlength="30" required>
            </div>

            <div class="col-md-8">
                <button type="submit" class="btn btn-primary" value="Adicionar" id="adicionar">Adicionar</button>
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