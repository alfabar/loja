<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar admin</h1>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); //  removendo mensagen da tela de sessão

        }
        ?>
        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Nome completo:</td>
                    <td><input type="text" name="full_name" placeholder="nome completo"></td>

                </tr>
                <tr>
                    <td>Nome Usuario:</td>
                    <td><input type="text" name="username" placeholder="nome usuario"></td>

                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input type="password" name="password" placeholder="senha"></td>

                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secundary">
                    </td>
                </tr>
            </table>


        </form>

    </div>


</div>





<?php include('partials/footer.php') ?>


<?php
//processar os valores dentro do banco de dados 
//Verificar se o Botão sbmit e clicado

if (isset($_POST['submit'])) {
    // Se o botão for clicado


    // 1º Obter os dados do formulario

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //md5 tag de criptografia de segurança

    // 2º Criar consulta SQL para salvar no banco de dados


    $sql = "INSERT INTO tbl_admin SET
full_name='$full_name',
username='$username',
password='$password'
";


    //Executando Query e salvando as informaçoes no banco de dados
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    // Depois verificar se os dados foram inseridos ou não
    if ($res == TRUE) {

        // dados inseridos com sucesso
        //echo " dados inseridos com sucesso";
        // Criar variavel de sessão na tela
        $_SESSION['add'] = "Admin adicionado com sucesso";
        //redirecionando para pagina admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //Falhou a conecção
        $_SESSION['add'] = "Falhou em adicionar admin";
        //redirecionando para pagina admin
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}


?>