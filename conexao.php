<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "expresso_burger";

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

