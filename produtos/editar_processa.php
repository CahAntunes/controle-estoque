<?php
session_start();

include_once("../conexao.php");

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$codigo = filter_input(INPUT_POST, 'codigo');
$lead_time = filter_input(INPUT_POST, 'lead_time');
$qtde = filter_input(INPUT_POST, 'qtde');
$funcionario = filter_input(INPUT_POST, 'funcionario');
$descricao = filter_input(INPUT_POST, 'descricao');
$frequencia = filter_input(INPUT_POST, 'frequencia');
$data = filter_input(INPUT_POST, 'data');
$unidade = filter_input(INPUT_POST, 'unidade');


$valor_venda = str_replace(array('.', ','), array('', '.'), filter_input(INPUT_POST, 'valor_venda'));
$valor_producao = str_replace(array('.', ','), array('', '.'), filter_input(INPUT_POST, 'valor_producao'));


$maximo = filter_input(INPUT_POST, 'maximo');
$minimo = filter_input(INPUT_POST, 'minimo');
$observacao = filter_input(INPUT_POST, 'observacao');


$sql2 = "SELECT imagem, pdf FROM produtos WHERE id = $id";

$select = mysqli_query($conexao, $sql2);

while ($array = mysqli_fetch_array($select)) {
    $imagem_ant = $array['imagem'];
    $pdf_ant = $array['pdf'];
}

if ((isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) ||
    (isset($_FILES["pdf"]) && $_FILES["pdf"]["error"] == UPLOAD_ERR_OK)
) {
    $id_documento = $codigo;

    $pasta_destino = "../upload/" . $id_documento;

    if (!file_exists($pasta_destino) && (isset($_FILES["imagem"]) || isset($_FILES["pdf"]))) {
        mkdir($pasta_destino, 0777, true);
    }

    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) {
        $imagem = $pasta_destino . "/" . $_FILES["imagem"]["name"];
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
    } else {
        if (empty($imagem_ant)) {
            $imagem = NULL;
        } else {
            $imagem = $imagem_ant;
        }
    }
    if ($imagem != $imagem_ant) {
        $sql3 = "UPDATE produtos SET imagem = '$imagem' WHERE id = $id";
        mysqli_query($conexao, $sql3);
    }

    if (isset($_FILES["pdf"]) && $_FILES["pdf"]["error"] == UPLOAD_ERR_OK) {
        $pdf = $pasta_destino . "/" . $_FILES["pdf"]["name"];
        move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdf);
    } else {
        if (empty($pdf_ant)) {
            $pdf = NULL;
        } else {
            $pdf = $pdf_ant;
        }
    }
    if ($pdf != $pdf_ant) {
        $sql4 = "UPDATE produtos SET pdf = '$pdf' WHERE id = $id";
        mysqli_query($conexao, $sql4);
    }
} else {
    $imagem = NULL;
    $pdf  = NULL;
}


$erro = [];

if (!preg_match("/^[\p{L} ]{1,40}$/u", $nome) || strlen($nome) > 40) {
    $erro['nome'] = 'O campo Nome deve conter letras e ter no máximo 40 caracteres.';
}

$camposNumericos = array('codigo', 'maximo', 'minimo');

foreach ($camposNumericos as $campo) {
    if (!is_numeric($$campo)) {
        $erro[$campo] = 'O campo ' . $campo . ' deve conter números.';
    }
}

$camposObrigatoriosNaoNulos = array('funcionario', 'data', 'unidade', 'maximo', 'minimo');

foreach ($camposObrigatoriosNaoNulos as $campo) {
    if (empty($$campo)) {
        $erro[$campo] = 'O campo' . $campo . ' é obrigatório.';
    }
}

if ($minimo > $maximo) {

    $erro['minino'] = 'O valor Minímo não deve ser superior ao valor Máximo .';
}

$sql = "UPDATE produtos SET nome='$nome', codigo='$codigo', lead_time='$lead_time', qtde='$qtde', funcionario='$funcionario', descricao='$descricao', frequencia='$frequencia', data='$data', unidade='$unidade', valor_venda='$valor_venda', valor_producao='$valor_producao', maximo='$maximo', minimo='$minimo', observacao='$observacao' WHERE id = '$id'";


if (empty($erro)) {
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['bancoOK'] = 'Produto editado com sucesso!';
        echo "<script>window.location.href='editar_produto.php?id=" . $id . "';</script>";
    } else {
        $_SESSION['bancoErro'] = 'Erro no Banco de dados.';
        echo "<script>window.location.href='editar_produto.php?id=" . $id . "';</script>";
    }
} else {
    $_SESSION['erro'] = $erro;
    echo "<script>window.location.href='editar_produto.php?id=" . $id . "';</script>";
}
