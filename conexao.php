<?php

$host = "sql213.infinityfree.com";

$usuario = "if0_41969549";

$senha = "H6hnKYHtIumVg";

$banco = "if0_41969549_expresso_burger";

$conexao = new mysqli(
$host,
$usuario,
$senha,
$banco
);

if($conexao->connect_error){

    die(
    "Erro na conexão: " .
    $conexao->connect_error
    );

}

?>

