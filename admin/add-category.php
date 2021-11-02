<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar Categoria</h1>
        <br><br>
        <?php        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }          
        ?>
        <!-- adicionar categoria no formulario -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>
                        <label for="title">Nome Categoria</label>
                        <input type="text" name="title" placeholder="Categoria nome">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="image">Selecione a imagem:</label>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="featured">Destaque: </label>
                        <input type="radio" name="featured" value="Yes"> Sim
                        <input type="radio" name="featured" value="No"> Não
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="active">Ativo: </label>
                        <input type="radio" name="active" value="Yes"> Sim
                        <input type="radio" name="active" value="No"> Não
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secundary">
                    </td>
                </tr>
            </table>
        </form>        
        <!-- adicionar categoria no formulario -->
        <?php 
        // checar se o botão foi clicado

        if(isset($_POST['submit']))
        
        {
            //echo "clicado";
            //1º Obtendo valores pela categoria
            $title = $_POST['title'];


            //Para os botoes radio e preciso se selecionado ou não

            if(isset($_POST['featured']))
            {
                //Obter valores do formulario
                $feature = $_POST['featured'];
            }
            else
            {
                //defina os valores padrao 
                $feature = "No";
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            // Check se a imagem selecionada ou não e definida

            //print_r($_FILES['image']);

            //die(); // o codigo para aqui
            if(isset($_FILES['image']['name']))
            {
                // Upload da imagem
                //Para fazer o upload da imagem precisamos do nome, o caminho de origem e caminho de destino
                $image_name = $_FILES['image']['name'];
                

                // Upload da imagem somente se selecionada
                if($image_name != "")
                {                
                //Auto renomear a imagem
                //obter a extenção da imagem (jpg, png, gif, etc) e.g "food1.jpg"

                $ext = end(explode('.',$image_name));

                //Renomear a imagem

                $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                $source_path = $_FILES['image']['tmp_name'];


                $destination_path = "../images/category/".$image_name;

                //finalmente o upload da imagem

                $upload = move_uploaded_file($source_path, $destination_path);

                // Checar se a imagem foi para servidor sim ou não
                if($upload==false)
                {
                    // definir mensagem
                    $_SESSION['upload'] = "<div class='error'>falhou ao subir imagem</div> ";
                    //Redirecionando para pagina
                    header('location:'.SITEURL.'admin/add-category.php');
                    //Parar o processo
                    die();
                }

                }
            }
            else
            {
                // não subiu a imagem
                $image_name="";


            }

            //2º Criar a Query Sql para inserir a categoria no banco de dados
            $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'            
            ";
            // 3º Executar a Query para salvar
            $res = mysqli_query($conn, $sql);

            // 4º Check se a query não foi adicionada ao db
            if($res==true)
            {
                //query executada e adicionada categoria
                $_SESSION['add'] = "<div class='success'>Categoria adicionada com sucesso</div> ";
                //redirecionar para gerenciar categoria
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                //falhou ao adicionar as categorias
                 $_SESSION['add'] = "<div class='success'>Erro ao adicionar categoria</div> ";
                 //redirecionar para gerenciar categoria
                 header('location:'.SITEURL.'admin/add-category.php');
            }
        }       
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>
