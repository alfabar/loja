<?php 

include('../config/constants.php');
include('login-check.php');


?>



<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Web site de comida</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <h1>Admin Painel</h1>

    <!-- Menu seção começo -->
    <div class="menu text-center">
     <div class="wrapper">
         <ul>
             <li> <a href="index.php">Home</a> </li>
             <li> <a href="gerenciar-admin.php">Adm</a> </li>
             <li> <a href="gerenciar-category.php">Categoria</a> </li>
             <li> <a href="gerenciar-produto.php">Cardapio</a> </li>
             <li> <a href="gerenciar-order.php">Pedido</a> </li>
             <li> <a href="logout.php">Sair</a> </li>
         </ul>
     </div>

 </div>
    <!-- Menu seção fim -->