<?php
include('../config/constants.php');

//echo "Deletar comiga do banco"
if(isset($_GET['id']) AND isset($_GET['image_name']))// pode ser usado tanto && quanto AND

{    //processo que deleta
    //echo "processa e exclui";
    //1º obter o id da imagem e nome
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];   

    //2º remover a imagem se tiver disponivel
    if($image_name !="")
    {
        $path = "../images/produtos/".$image_name;
        //Remover imagem 

        $remove = unlink($path);

        //checar se a imagem foi removida ou não
        if($remove==false)
        {
            //falhou ao remover imagem
            $_SESSION['upload'] = "<div class='error'>Falha ao remover a imagem</div>";

            //redirecionar pagina painel produtos
            header('location:'.SITEURL.'admin/manage-produto.php');

            //Parar o processo de deletar
            die();
        }       
    }

    //3º deletar produto do banco de dados
    $sql = "DELETE FROM tbl_produto WHERE id=$id";

    //Executar a query consulta
    $res = mysqli_query($conn, $sql);

    //4º Redirect to manage produto with 
    if($res==true)
    {
        //Deletar o produto
        $_SESSION['delete'] = "<div class='success'>Produto deletado com sucesso</div>";
        header('location:'.SITEURL.'admin/manage-produto.php');
    }
    else
    {
        //Falhou ao deletar
        $_SESSION['delete'] = "<div class='error'>Produto deletado com Erro</div>";
        header('location:'.SITEURL.'admin/manage-produto.php');

    }
}
else
{
    //redirecionar pagina de painel
    echo "redirecionar";
    $_SESSION['unauthorized'] = "<div class='error'>Falha ao executar</div>";
    header('location:'.SITEURL.'admin/manage-produto.php');


}
?>