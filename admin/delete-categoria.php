<?php
include('../config/constants.php');
//echo "Delete pagina";
// Checar se o valor do id e valor nome estão configurados
if(isset($_GET['id']) AND isset($_GET['image_name']))
{

    //obter o valor e deletar
    //echo "Obter valor e deletar ";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remover as imagens fisicamente 
    if($image_name !="")
    {   //imagem disponivel então remova
        $path = "../images/category/".$image_name;
        //remover a imagem
        $remove = unlink($path);

        if($remove==false)
        {
            // Definir a mensagem da sessão
            $_SESSION['remove'] = "<div class='error'>Falhou em remover a imagem da categoria</div>";
            // redirecionar para categoria
            header('location:'.SITEURL.'admin/gerenciar-categoria.php');
            //Parar o processo
            die();
        }
    }

    // Deletar dados do banco de dados 
    //Sql Query que deleta do banco de dados
    $sql = "DELETE FROM tbl_categoria WHERE id=$id";

    //Executar a query
    $res = mysqli_query($conn, $sql);


    // Verificar se os dados foram deletados
    if($res==true)
    {
        //Definir mensagem e redirecionar
        $_SESSION['delete'] = "<div class='success'>Categoria deletada com sucesso</div>";
        //Redirecionar apos exclusão pagina de categorias
        header('location:'.SITEURL.'admin/gerenciar-categoria.php');
    }
    else
    {
        // definir mensagem de erro
        $_SESSION['delete'] = "<div class='error'>Categoria não foi deletada</div>";
        //Redirecionar apos exclusão pagina de categorias
        header('location:'.SITEURL.'admin/gerenciar-categoria.php');

    }

    // redirecionar para pagina categoria
}
else
{

    //Redirecionar a pagina de Categoria
    header('location:'.SITEURL.'admin/gerenciar-categoria.php');
}
?>