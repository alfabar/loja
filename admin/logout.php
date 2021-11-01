<?php
//include constants.php
include('../config/constants.php');
//1. destruir sessão 
session_destroy();

//2º redirecionar pagina login
header('location:'.SITEURL.'admin/login.php');


?>