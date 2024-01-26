<?php
session_start();
include_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Listar</title>
</head>

<body>
    <a href="cad_usuario.php">Cadastrar</a><br>
    <a href="index.php">Listar</a><br>
    <h1>Listar Usuários</h1>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);

    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

    $qnt_result_pg = 3;
    
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

    $result_usuarios = "SELECT * FROM pessoa LIMIT $inicio, $qnt_result_pg";
    $resultado_usuarios = mysqli_query($conexao, $result_usuarios);
    while ($row_usuario = mysqli_fetch_array($resultado_usuarios)) {
        echo "ID: "  . $row_usuario['id'] . "<br>";
        echo "RA: "  . $row_usuario['ra_pessoa'] . "<br>";
        echo "Nome: "  . $row_usuario['nome'] . "<br>";
        echo "Idade: "  . $row_usuario['idade'] . "<br>";
        echo "Sexo: "  . $row_usuario['sexo'] . "<br>";
        echo "Endereço: "  . $row_usuario['endereco'] . "<br>";
        echo "Nº: "  . $row_usuario['numero'] . "<br>";
        echo "Complemento: "  . $row_usuario['complemento'] . "<br>";
        echo "<a href='editar.php?id=" . $row_usuario['id'] . "'>Editar</a><br>";
        echo "<a href='proc_apagar_usuario.php?id=" . $row_usuario['id'] . "'>Apagar</a><br><hr>";
    }

    $result_pg = "SELECT COUNT(Id) AS num_result FROM pessoa";
    $resultado_pg = mysqli_query($conexao, $result_pg);
    $row_pg = mysqli_fetch_array($resultado_pg);
    // echo $row_pg['num_result'];

    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    
    $max_links = 2;
    echo "<a href='index.php?pagina=1'>Primeira </a>"; 

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant ++) {
        if($pag_ant >= 1){
            echo "<a href ='index.php?pagina=$pag_ant'>$pag_ant </a>"; 
        }
    }

    echo "$pagina"; 

    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep ++) {
        if($pag_dep <=$quantidade_pg) {
            echo "<a href ='index.php?pagina=$pag_dep'>$pag_dep </a>"; 
        }
    }
    echo "<a href='index.php?pagina=$quantidade_pg'> Ultima</a>"; 

    ?>

</body>

</html>
