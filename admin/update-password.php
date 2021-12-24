<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Trocar a senha</h1>
        <br><br>
            <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
            ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Senha Antiga:</td>
                    <td><input type="senha" name="atual_senha" placeholder="Senha atual"></td>
                </tr>
                <tr>
                    <td>Nova senha:</td>
                    <td><input type="senha" name="nova_senha" placeholder="Senha Nova"></td>
                </tr>
                <tr>
                    <td>Confirme a Senha:</td>
                    <td><input type="senha" name="confirm_senha" placeholder="Confirme a senha"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change senha" class="btn-secundary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
// Adicionar verificar se o usuario clicou no botão submit
 if(isset($_POST['submit']))
{
    //echo "clicado";

    // 1º Obter dados dos campos do formulario
    $_id=$_POST['id'];
    $atual_senha = md5($_POST['atual_senha']);
    $nova_senha = md5($_POST['nova_senha']);
    $confirm_senha = md5($_POST['confirm_senha']);

    // 2º checar se a senha do usuario atual já existe
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND senha='$atual_senha'";

    //EXECUTAR A CONSULTA NO BANCO DE DADOS
    $res = mysqli_query($conn, $sql);

    if($res==true)

    {
        //Checar se os dados estão disponivel ou não
        $count=mysqli_num_rows($res);
        
        if($count==1)
        {
            // o usuário existe e a senha pode ser alterada
            //echo "usuario encontrado";
            // Checar se a nova senha e a confirmação da senha correspondem
            if($nova_senha==$confirm_senha)
            {
                //Atualiza nova senha
                //echo "Senha atualizada com sucesso";
                $sql2 = "UPDATE tbl_admin SET
                   senha='$nova_senha'
                   WHERE id=$id               
                ";
                //executar a Query
                $res2 = mysqli_query($conn, $sql2);
                //Checar se a query foi consultada ou não
                if($res2==true)
                {
                    //mostrar mensagen de sucesso
                    //Redireciona para Pagina do adm
                    $_SESSION['change-pwd'] = "<div class='success'>Senhas Alterada com sucesso</div>";
                    //Redirecionar o usuario
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    
                }
                else
                {
                    //mostar mensagen de erro
                    $_SESSION['change-pwd'] = "<div class='error'>Senhas não alteradas</div>";
                    //Redirecionar o usuario
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }
            }
            else
            {
                //Redireciona para Pagina do adm
                $_SESSION['pwd-not-match'] = "<div class='error'>Senhas Não Corresponde</div>";
                //Redirecionar o usuario
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }
        else
        {
            //o usuario não existe e define uma mensagem e redireciona
            $_SESSION['user-not-found'] = "<div class='error'>Usuario não encontrado</div>";
            //Redirecionar o usuario
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
    }




    // 3º verificar e a enha atuaL CORRESPONDE com a digitada

    // 4º atualizar a senha dousuario se tudo acima for verdadeiro


}

?>
<?php include('partials/footer.php')?>