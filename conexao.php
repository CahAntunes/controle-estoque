<?php 

$servidor = "localhost";
$usuario = "root";
$senha = "12345678";
$dbname = "Estoque_prod";


$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);


function validarTipo($tipo) {
    $tiposValidos = ['entrada', 'saida'];
    return in_array($tipo, $tiposValidos);
  }

  function validarStatus($status) {
    $statusValidos = ['compra', 'venda','devolucao', 'outros'];
    return in_array($status, $statusValidos);
  }


?>
