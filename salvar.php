<?php

include("conexao.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

$nome = $_POST['nome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$celular = $_POST['celular'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$pagamento = $_POST['pagamento'] ?? '';
$itens = $_POST['itens'] ?? '';
$total = $_POST['total'] ?? 0;
$observacoes = $_POST['observacoes'] ?? '';

/* SEGURANÇA */

$nome = mysqli_real_escape_string($conexao, $nome);
$cpf = mysqli_real_escape_string($conexao, $cpf);
$celular = mysqli_real_escape_string($conexao, $celular);
$endereco = mysqli_real_escape_string($conexao, $endereco);
$pagamento = mysqli_real_escape_string($conexao, $pagamento);
$itens = mysqli_real_escape_string($conexao, $itens);
$observacoes = mysqli_real_escape_string($conexao, $observacoes);

$sql = "INSERT INTO pedidos
(nome, cpf, celular, endereco, pagamento, itens, total, observacoes)

VALUES

('$nome',
'$cpf',
'$celular',
'$endereco',
'$pagamento',
'$itens',
'$total',
'$observacoes')";

if($conexao->query($sql) === TRUE){

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pedido Confirmado</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, Helvetica, sans-serif;
}

body{
background:linear-gradient(135deg,#111,#1f1f1f);
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
padding:20px;
color:white;
}

.box{
background:#1d1d1d;
padding:40px;
border-radius:25px;
width:100%;
max-width:500px;
text-align:center;
box-shadow:0 0 25px rgba(255,153,0,0.4);
border:1px solid #2b2b2b;
}

h1{
color:#ff9900;
margin-bottom:15px;
font-size:34px;
}

.sub{
color:#ddd;
margin-bottom:25px;
line-height:1.5;
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
word-break:break-word;
}

strong{
color:#ffcc80;
}

.total{
font-size:28px;
color:#00e676;
font-weight:bold;
margin-top:20px;
}

.msg{
margin-top:25px;
background:#222;
padding:18px;
border-radius:15px;
line-height:1.6;
color:#ffcc80;
}

.btn{
display:inline-block;
margin-top:30px;
padding:15px 28px;
background:linear-gradient(90deg,#ff3c00,#ff9900);
color:white;
text-decoration:none;
border-radius:14px;
font-weight:bold;
font-size:16px;
transition:0.3s;
}

.btn:hover{
transform:scale(1.05);
}

</style>

</head>

<body>

<div class="box">

<h1>
🍔 Pedido Confirmado!
</h1>

<p class="sub">
Seu pedido foi enviado com sucesso para o Expresso Burger.
</p>

<div class="info">

<p>
<strong>👤 Cliente:</strong>
<?php echo $nome; ?>
</p>

<p>
<strong>📱 WhatsApp:</strong>
<?php echo $celular; ?>
</p>

<p>
<strong>📍 Endereço:</strong>
<?php echo $endereco; ?>
</p>

<p>
<strong>🍟 Pedido:</strong>
<?php echo $itens; ?>
</p>

<p>
<strong>📝 Observações:</strong>
<?php echo $observacoes; ?>
</p>

<p>
<strong>💳 Pagamento:</strong>
<?php echo $pagamento; ?>
</p>

<div class="total">

R$ <?php echo number_format((float)$total,2,',','.'); ?>

</div>

</div>

<div class="msg">

📲 Nosso entregador entrará em contato pelo WhatsApp informado.<br><br>

🔥 Obrigado por pedir no Expresso Burger!

</div>

<a href="index.html" class="btn">
🍔 Fazer outro pedido
</a>

</div>

</body>
</html>

<?php

}else{

echo "

<h2 style='color:red;text-align:center;margin-top:40px;'>
Erro ao salvar pedido.
</h2>

<p style='text-align:center;color:white;'>
".$conexao->error."
</p>

";

}

}

?>