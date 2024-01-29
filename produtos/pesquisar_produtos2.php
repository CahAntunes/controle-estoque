<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Cadastro Produtos</title>

    <style type="text/css">
        #tamanhoContainer {
            width: 1800px;
        }
    </style>

</head>

<body>

    <div class="container-fluid" id="tamanhoContainer" style="margin-top: 40px;">
        <h3>Lista de Produtos</h3>
        <br />

        <div style="text-align: right;">
            <a href="index.php" role="button" class="btn btn-primary btn-sm">Voltar</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Código</th>
                    <th scope="col">Lead_Time</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Funcionário</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Frequência</th>
                    <th scope="col">Data</th>
                    <th scope="col">Unidade</th>
                    <th scope="col">Valor de Produção</th>
                    <th scope="col">Valor de Venda</th>
                    <th scope="col">Máximo</th>
                    <th scope="col">Mínimo</th>
                    <th scope="col">Observação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="" role="button">Editar</a>
                        <a class="btn btn-success btn-sm" href="" role="button">Visualizar</a>
                        <a class="btn btn-danger btn-sm" href="" role="button">Deletar</a>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>

</body>

</html>
