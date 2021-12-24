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
    $_SESSION['delete'] = "<div class='success'>Admin deletado com sucesso</div>";
    //Redirecinando para pagina adminisrador
    header('location:'.SITEURL.'admin/gerenciar-admin.php');
}
else
{

    // Falhou ao deletar admin
    //echo " admin não deletado";
    $_SESSION['delete'] = "<div class='error'>Falhou ao deletar o admin. tente denovo </div>";
    header('location:'.SITEURL.'admin/gerenciar-admin.php');
}

// Redirecionando para pagina admin
?>