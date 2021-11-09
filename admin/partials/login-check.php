<?php 
// AUTORIZAÇÂO - controle de acesso
// checar se o usuario esta logado ou não
if(!isset($_SESSION['user']))// if user não esta configurado

{
//usuario não logado
//redireciona pagina mensagen
$_SESSION['no-login-message'] = "<div class='error'>Por favor entre no painel admin</div>";

header('location:'.SITEURL.'admin/login.php');

}
?>