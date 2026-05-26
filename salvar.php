<?php

include("conexao.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

$nome = $_POST['nome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$celular = $_POST['celular'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$pagamento = $_POST['pagamento'] ?? '';
$total = $_POST['total'] ?? 0;
$observacoes = $_POST['observacoes'] ?? '';

$itens = json_decode($_POST['itens'], true);

if(
empty($nome) ||
empty($celular) ||
empty($endereco)
){

die("Preencha todos os campos.");

}

/* CLIENTE */

$stmtCliente = $conexao->prepare("

INSERT INTO clientes
(nome, cpf, celular, endereco)

VALUES (?, ?, ?, ?)

");

$stmtCliente->bind_param(
"ssss",
$nome,
$cpf,
$celular,
$endereco
);

$stmtCliente->execute();

$cliente_id = $conexao->insert_id;

/* PEDIDO */

$stmtPedido = $conexao->prepare("

INSERT INTO pedidos
(cliente_id, total, pagamento, observacoes)

VALUES (?, ?, ?, ?)

");

$stmtPedido->bind_param(
"idss",
$cliente_id,
$total,
$pagamento,
$observacoes
);

$stmtPedido->execute();

$pedido_id = $conexao->insert_id;

/* ITENS */

$stmtItens = $conexao->prepare("

INSERT INTO itens_pedido
(pedido_id, nome_item, preco, quantidade)

VALUES (?, ?, ?, ?)

");

foreach($itens as $item){

$nomeItem = $item['nome'];
$precoItem = $item['preco'];
$quantidade = $item['quantidade'];

$stmtItens->bind_param(
"isdi",
$pedido_id,
$nomeItem,
$precoItem,
$quantidade
);

$stmtItens->execute();

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Pedido Confirmado</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, Helvetica, sans-serif;
}

body{
background:#111;
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
padding:20px;
color:white;
}

.box{
background:#1d1d1d;
padding:40px;
border-radius:25px;
max-width:550px;
width:100%;
text-align:center;
border:1px solid #333;
}

h1{
color:#ff9900;
margin-bottom:20px;
}

.info{
background:#2a2a2a;
padding:20px;
border-radius:18px;
margin-top:20px;
text-align:left;
}

.info p{
margin:12px 0;
line-height:1.5;
}

.total{
font-size:30px;
color:#00e676;
margin-top:20px;
font-weight:bold;
}

.btn{
display:inline-block;
margin-top:30px;
padding:15px 25px;
background:linear-gradient(90deg,#ff3c00,#ff9900);
color:white;
text-decoration:none;
border-radius:12px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="box">

<h1>
🍔 Pedido Confirmado!
</h1>

<div class="info">

<p>
<strong>Cliente:</strong>
<?= htmlspecialchars($nome) ?>
</p>

<p>
<strong>WhatsApp:</strong>
<?= htmlspecialchars($celular) ?>
</p>

<p>
<strong>Endereço:</strong>
<?= htmlspecialchars($endereco) ?>
</p>

<p>
<strong>Pagamento:</strong>
<?= htmlspecialchars($pagamento) ?>
</p>

<p>
<strong>Observações:</strong>
<?= htmlspecialchars($observacoes) ?>
</p>

</div>

<div class="total">

R$
<?= number_format((float)$total,2,',','.') ?>

</div>

<a href="index.php" class="btn">
Fazer Outro Pedido
</a>

</div>

</body>
</html>

<?php

}else{

echo "Erro ao processar pedido.";

}

?>
