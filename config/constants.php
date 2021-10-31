<?php


//Iniciando a Sessão
session_start();

define('SITEURL', 'http://localhost/loja/');
define('LOCALHOST','localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'loja');


// 3. Executar Query para salvar no banco de dados
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Cocecção com o banco de dados
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // Selecionando o banco de dados 


?>