<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estoque/CSS/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <title>Cadastro Produtos</title>

    <style>
      body {
        background: url(https://cdn.pixabay.com/photo/2019/02/25/17/36/mockup-4020150_1280.jpg) no-repeat ;
        background-size: cover;
        height: 60vh;
      }

      .card {
        background: none;
        color: white;
        font-size: 20px;
        border-color: white;
      }

      .btn{
        background-color:#ff7a30;
        border-color: #e65f1f;
      }

      .btn:hover {
        background-color:#d75413;
        border-color: #d75413;
      }
    </style>
</head>

<body>

<div class="container" style="margin-top: 350px;">

<div class="row justify-content-center container-fluid">
  <div class="col-sm-3 mb-2 mb-sm-0">
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Cadastrar Produtos</h5>
        <br>
        <p class="card-text">Opção para realizar o cadastro de novos produtos ao estoque.</p>
        <br>
        <a href="produtos/cadastrar_produtos.php" class="btn btn-primary">Cadastrar Produto</a>
      </div>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Pesquisar</h5>
        <p class="card-text">Opção para pesquisar, editar e excluir produtos do estoque e para realizar movimentações de entrada e saída.</p>
        <a href="produtos/pesquisar_produtos.php" class="btn btn-primary">Buscar</a>
      </div>
    </div>
  </div>


</div> 


</body>

</html>
