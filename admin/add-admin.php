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
                    <td><input type="text" name="nome_completo" placeholder="nome completo"></td>

                </tr>
                <tr>
                    <td>Nome Usuario:</td>
                    <td><input type="text" name="nomeusuario" placeholder="nome usuario"></td>

                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input type="senha" name="senha" placeholder="senha"></td>

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

    $nome_completo = $_POST['nome_completo'];
    $nomeusuario = $_POST['nomeusuario'];
    $senha = md5($_POST['senha']); //md5 tag de criptografia de segurança

    // 2º Criar consulta SQL para salvar no banco de dados


    $sql = "INSERT INTO tbl_admin SET
nome_completo='$nome_completo',
nomeusuario='$nomeusuario',
senha='$senha'
";


    //Executando Query e salvando as informaçoes no banco de dados
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    // Depois verificar se os dados foram inseridos ou não
    if ($res == TRUE) {

        // dados inseridos com sucesso no banco de dados
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