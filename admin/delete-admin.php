<?php

//incluir costant.php aqui
include('../config/constants.php');
// 1º pegar por id os adm que serão deletados
$id = $_GET['id'];
//2 ºCriar uma colsulta sql para deletar admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
// 3º redirecionar para pagina administrador ( sucesso/error)
$res = mysqli_query($conn, $sql);


//Checando se a query foi com sucesso
if($res==true){

    // Query executada com sucesso 
    //Criar uma variavel de sessão
    $_SESSION['delete'] = "Admin deletado com sucesso";
    //Redirecinando para pagina adminisrador
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{

    // Falhou ao deletar admin
    //echo " admin não deletado";
    $_SESSION['delete'] = "Falhou ao deletar o admin. tente denovo ";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

// Redirecionando para pagina admin
?>