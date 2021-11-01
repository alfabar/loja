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
                    <td><input type="password" name="current_password" placeholder="Senha atual"></td>
                </tr>
                <tr>
                    <td>Nova senha:</td>
                    <td><input type="password" name="new_password" placeholder="Senha Nova"></td>
                </tr>
                <tr>
                    <td>Confirme a Senha:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirme a senha"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secundary">
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
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // 2º checar se a senha do usuario atual já existe
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

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
            if($new_password==$confirm_password)
            {
                //Atualiza nova senha
                //echo "Senha atualizada com sucesso";
                $sql2 = "UPDATE tbl_admin SET
                   password='$new_password'
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