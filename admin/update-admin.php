<?php include('partials/menu.php'); ?>


<div class="main-content">

    <div class="wrapper">
        <h1>Atualize dados admin</h1>
        <br><br>
        <?php
        //1º Pegar o id do admin selecionado
        $id = $_GET['id'];

        //2º Criar uma consulta SQL para obter detalhes
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        // Executar a query
        $res = mysqli_query($conn, $sql);

        // Verificar se a consulta foi realizada
        if ($res == true) {
            // Verificar se os dados estão disponiveis
            $count = mysqli_num_rows($res);

            // Verifique se temos dados ou não
            if ($count == 1) {
                //Obtenha detalhes
                //echo "admin disponivel";
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                //redirecione para pagina admn
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>


        <form action="" method="post">

            <table class="tbl-30">

                <tr>
                    <td>Nome Completo:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2"><input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secundary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

// Checar se o botão submit foi clicado
if (isset($_POST['submit'])) {
    // echo " botão clicado";
    // Obter todos os valores au atualizar
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //Criar uma consulta sql para atualizar admin
    $sql = "UPDATE tbl_admin SET
   full_name = '$full_name',
   username = '$username'
   WHERE id='$id'   
   ";

    // execute a query
    $res = mysqli_query($conn, $sql);

    //Verificar se a consulta foi relizada com sucesso
    if ($res == true) {
        //Admin atualizado com sucesso
        $_SESSION['update'] = "<div class='success'> Administrador atualizado com sucesso </div>";
        //Redirecionando para pagina Admin
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        //Falhou ao atualizar o admin
        $_SESSION['update'] = "<div class='error'> Administrador Não foi Atualizado </div>";
        //Redirecionando para pagina Admin
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}

?>

<?php include('partials/footer.php'); ?>