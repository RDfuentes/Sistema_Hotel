<?php
session_start();
include ("../config/conexao.php");


$cliente_username = $_POST["usuario"];
$cliente_password = $_POST["senha"];
$enviado          = $_POST["enviado"];

if ($enviado == "posted"){    
	
if (!isset($cliente_username) or !isset($cliente_password)) { echo "Erro!";	exit; }  
if (empty($cliente_username) or empty($cliente_password)) { echo "Dados inválidos!"; exit; }

$query = "select * from tbl_usuarios where email = '$cliente_username' and senha = '$cliente_password'";
$result = mysql_query($query);
$number = mysql_num_rows($result);

if ($number==0) { ?><script>alert('Autorização inexistente/Senha inválida ou expirada.');history.back();</script>
<?php
	exit;
} else {
	$_SESSION['usuario_id'] = mysql_result($result,0,'id');
	$_SESSION['usuario_nome'] = mysql_result($result,0,'nome');
	?>
	
	<script>document.location = '../principal.php'</script>
	
	<?php
}
mysql_close($conexao);	

} 
?>
