<?php
session_start();

include_once("../conexao.php");


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
        $imagem = NULL;
    }

    if (isset($_FILES["pdf"]) && $_FILES["pdf"]["error"] == UPLOAD_ERR_OK) {
        $pdf = $pasta_destino . "/" . $_FILES["pdf"]["name"];
        move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdf);
    } else {
        $pdf = NULL;
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

$verificarCodigo = "SELECT codigo FROM produtos WHERE codigo = '$codigo'";
$resultadoVerificacao = mysqli_query($conexao, $verificarCodigo);

if (mysqli_num_rows($resultadoVerificacao) > 0) {
    $erro['codigo'] = 'O código inserido já existe. Por favor, insira um código único.';
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

$result = "INSERT INTO produtos
           (nome, codigo, lead_time, qtde, funcionario, descricao, frequencia, data, unidade, valor_venda, valor_producao, maximo, minimo, observacao, imagem, pdf)
           VALUES
           (" . ($nome ? "'$nome'" : "NULL") . ",
            " . ($codigo ? "'$codigo'" : "NULL") . ",
            " . ($lead_time ? "'$lead_time'" : "NULL") . ",
            " . ($qtde ? "'$qtde'" : "NULL") . ",
            " . ($funcionario ? "'$funcionario'" : "NULL") . ",
            " . ($descricao ? "'$descricao'" : "NULL") . ",
            " . ($frequencia ? "'$frequencia'" : "NULL") . ",
            " . ($data ? "'$data'" : "NULL") . ",
            " . ($unidade ? "'$unidade'" : "NULL") . ",
            " . ($valor_venda ? "'$valor_venda'" : "NULL") . ",
            " . ($valor_producao ? "'$valor_producao'" : "NULL") . ",
            " . ($maximo ? "'$maximo'" : "NULL") . ",
            " . ($minimo ? "'$minimo'" : "NULL") . ",
            " . ($observacao ? "'$observacao'" : "NULL") . ",
            " . ($imagem ? "'$imagem'" : "NULL") . ",
            " . ($pdf ? "'$pdf'" : "NULL") . ")";

var_dump($valor_producao);
var_dump($valor_venda);


if (empty($erro)) {
    mysqli_query($conexao, $result);
    if (mysqli_insert_id($conexao)) {

        if ($qtde != NULL) {
            $mov = "INSERT INTO produtos_movimentacoes (produto_id, tipo, status, estoque, responsavel, cliente, qtde_mov, data)
            VALUES ('" . mysqli_insert_id($conexao) . "', 'entrada', 'compra', '" . $qtde . "', '" . $funcionario . "', 'NULL' , '" . $qtde . "', '" . $data . "')";
            mysqli_query($conexao, $mov);
        }

        if (mysqli_insert_id($conexao)) {
            $_SESSION['bancoOK'] = 'Produto cadastrado com sucesso!';
            echo "<script>window.location.href='cadastrar_produtos.php';</script>";
        }
    } else {
        $_SESSION['erro'] = 'Erro ao cadastrar produto';
        echo "<script>window.location.href='cadastrar_produtos.php';</script>";
    }
} else {
    $_SESSION['erro'] = $erro;
    echo "<script>window.location.href='cadastrar_produtos.php';</script>";
}
