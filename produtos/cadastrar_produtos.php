<?php
session_start();
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

    <style>
        input {
            border-color: black;
        }

        input::placeholder,
        textarea::placeholder {
            font-size: 12px;
            font-weight: bold;
            color: black;
        }

        body {
            font-size: 18px;
        }
    </style>

</head>

<body style="background-color: #CFC0A7;">
    <nav class="navbar" style="background-color: #CFC0A7">
        <form class="container-fluid justify-content-start">
            <a href="../index.php" class="btn btn-primary" style="background-color: #d75413; border-color:#d75413;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
                </svg> Menu </a>
        </form>
    </nav>

    <div class="container justify-content-center border" style="background-color: white; margin-top: 2%; border-radius: 15px; padding: 2%;">

        <?php

        if (isset($_FILES["imagem"]) && !empty($_FILES["imagem"])) {
            $imagem = move_uploaded_file($_FILES["imagem"]["tmp_name"], "../upload/" . $_FILES["imagem"]["name"]);
        }

        if (isset($_FILES["pdf"]) && !empty($_FILES["pdf"])) {
            $pdf = move_uploaded_file($_FILES["pdf"]["tmp_name"], "../upload/" . $_FILES["pdf"]["name"]);
        }

        ?>

        <form id="cadastro" method="POST" action="inserir_produto.php" class="row g-3" enctype="multipart/form-data">
            <h1>Cadastrar Produto</h1>
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

            <div class="col-md-2">
                <label>Código:</label>
                <input class="form-control numero" type="text" name="codigo" placeholder="Digite o código do produto" aria-label="Digite o código do produto" maxlength="5" required>
            </div>

            <div class="col-md-4">
                <label>Nome:</label>
                <input class="form-control letra" type="text" name="nome" placeholder="Digite o nome do produto" aria-label="Digite o nome do produto" maxlength="40" required>
            </div>

            <div class="col-md-6">
                <label>Descrição:</label>
                <input class="form-control" type="text" name="descricao" placeholder="Digite a descrição do produto" aria-label="Digite a descrição do produto" maxlength="80">
            </div>

            <div class="col-md-2">
                <labell>Valor Produção:</labell>
                <input class="form-control" type="text" id="valor_producao" name="valor_producao" placeholder="Digite o valor do produto">
            </div>

            <div class="col-md-2">
                <label>Valor Venda:</label>
                <input class="form-control" type="text" id="valor_venda" name="valor_venda" placeholder="Digite o valor do produto">
            </div>

            <div class="col-md-2">
                <label>Minímo:</label>
                <input class="form-control numero" type="text" name="minimo" placeholder="Digite a qtde min de produto" required>
            </div>

            <div class="col-md-2">
                <label>Máximo: </label>
                <input class="form-control numero" type="text" name="maximo" placeholder="Digite a qtde máx de produto" required>
            </div>

            <div class="col-md-2">
                <label>Qtde em Estoque:</label>
                <input class="form-control numero" type="text" name="qtde" placeholder="Digite a qtde de produto" maxlength="4">
            </div>

            <div class="col-md-2">
                <label>Lead Time:</label>
                <input class="form-control numero" type="text" name="lead_time" placeholder="Digite o tempo de execução" aria-label="Digite o tempo de execução do produto" maxlength="3">
            </div>

            <div class="col-md-2">
                <label>Unidade:</label>
                <select name="unidade" class="form-select campoSelect" required>
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
                <select name="frequencia" class="form-select campoSelect">
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
                <input class="form-control" type="date" name="data" id="data" required>
                <script>
                    definirDataMinima('data');
                </script>

            </div>

            <div class="col-md-4">
                <label>Funcionário:</label>
                <input class="form-control" type="text" name="funcionario" placeholder="Digite o nome do funcionário" maxlength="30" required>
            </div>

            <div class="col-md-8">
                <div class="input-group mb-2">
                    <input type="file" name="imagem" class="form-control" id="inputGroupFile02" accept="image/*">
                    <span class="input-group-text" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                        </svg></span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="input-group mb-2">
                    <input type="file" name="pdf" class="form-control" id="inputGroupFile02" accept="application/pdf">
                    <span class="input-group-text" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-paperclip" viewBox="0 0 16 16">
                            <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0z" />
                        </svg></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <textarea name="observacao" class="form-control" placeholder="Digite a sua observação" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Observação</label>
                </div>
            </div>

            <div class="col-md-8">
                <button type="submit" class="btn btn-primary" value="Cadastrar" id="cadastrar" style="background-color: #d75413; border-color:#d75413;">Cadastrar</button>
            </div>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


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
