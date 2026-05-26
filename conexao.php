<?php

$host = "sql208.infinityfree.com";
$usuario = "if0_42027723";
$senha = "expressoburger";
$banco = "if0_42027723_expresso_burger";

$conexao = new mysqli(
    $host,
    $usuario,
    $senha,
    $banco
);

if($conexao->connect_error){

    die("Erro na conexão.");

}

$conexao->set_charset("utf8mb4");

?>

