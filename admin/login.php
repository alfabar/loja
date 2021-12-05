<?php include('../config/constants.php');?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login - Comida sistema Pedido</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }           
            ?>
            <!-- Formulario de Login aqui -->
            <form class="text-center" action="" method="POST">
                <label for="username">Usuário:</label>
                <input type="text" name="username" placeholder="Entre com Usuário"><br><br>
                <label for="password">Senha:</label>
                <input type="password" name="password" placeholder="Senha"><br><br>

                <input type="submit" name="submit" value="login" class="btn-primary">
            </form>
            <!-- Formulario de Login aqui Fim-->

            <p class="text-center">Criado por - <a href="">Adriano Baram</a></p>
        </div>
        <script src="" async defer></script>
    </body>
</html>
<?php
//checar se o botão submit foi clicado

if(isset($_POST['submit']))
{
    //processar para o login e senha na tela de usuario
    //1º Obter dados do form para login
    $username = $_POST['username'];
    $password = $_POST['password'];


    //2º criar consulta SQL que verifica se nome e usuario existe
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // 3º Executar a Query
    $res = mysqli_query($conn, $sql);


    //4º Contagem que checa se o usuario existe ou não
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //Usuario disponivel
        $_SESSION['login'] = "<div class='success'>Login com sucesso</div>";
        $_SESSION['user'] = $username; // para verificar se o usuario esta conectado
        //redirecionar para o painel administrador
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        //usuario falhou
         $_SESSION['login'] = "<div class='error'>Login não efetuado confira dados</div>";
         //redirecionar para o painel administrador
         header('location:'.SITEURL.'admin/login.php');
    }
    


}


?>

