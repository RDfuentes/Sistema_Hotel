<?php   
$database="127.0.0.1"; // SERVIDOR E PORTA UTILIZADA   
$dbname="hotel"; // BASE DE DADOS 
$usuario="root"; // USUÁRIO DO MYSQL
$dbsenha=""; // SENHA DO MYSQL

$conexao=mysql_connect ($database, $usuario, $dbsenha);
if($conexao){
      if (mysql_select_db($dbname, $conexao)){ print "";
      }else{ print "Não foi possível selecionar o Banco de Dados"; }
}else{ print "Erro ao conectar o MySQL"; }
?>
