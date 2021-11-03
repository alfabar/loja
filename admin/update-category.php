<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar Categoria</h1>
        <br><br>
        <?php
        //Verificar se o id esta verificado ou não
        if(isset($_GET['id']))
        {
            // Obter o id e detalhes
            //echo "Obtendo data";
            $id = $_GET['id'];
            //Criar uma consulta sql
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //Executar a consulta
            $res =  mysqli_query($conn, $sql);

            // Checar se as colunas encontradas são validas
            $count = mysqli_num_rows($res);


            if($count==1)
            {
                //Pedar os dados
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            }
            else
            {
                //Redirecionar para Gerenciar categoria
                $_SESSION['no-category-found'] = "<div class='error'>Categoria não encontrada</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else
        {
            //redirecionar pagina manager
            header('location:'.SITEURL.'admin/manage.php');
        }
        
        ?>



        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>
                        <label for="title">Nome Categoria</label>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php 
                        if($current_image !="")
                        {
                            //Mostrar a imagem atual
                            ?>

                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" alt="" srcset="" width="150px">
                            <?php
                        }
                        else
                        {
                            //mostar erro
                            echo "<div class='error'>Imagen Não adicionada</div>";
                        }
                        ?>

                        <label for="image">Selecione a imagem:</label>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input <?php if($featured=="Yes"){echo "selecionado";} ?> type="radio" name="featured" value="Yes"> Sim
                        <input <?php if($featured=="No"){echo "selecionado";} ?> type="radio" name="featured" value="No"> Não
                    </td>
                </tr>
                <tr>
                    <td>
                        <input <?php if($active=="Yes"){echo "selecionado";} ?> type="radio" name="active" value="Yes"> Sim
                        <input <?php if($active=="No"){echo "selecionado";} ?> type="radio" name="active" value="No"> Não
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secundary">
                    </td>
                </tr>
            </table>
        </form> 

        <?php 
        //
        if(isset($_POST['submit']))
        {
            //echo "clicado";
            // 1º Obter Ttodos os valores do formulario
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2º Atualizando a imagem selecionada
            //Verificar se a imagem foi selecionada
            if(isset($_FILES['image']['name']))
            {
                // Obter detalhes da imagem
                $image_name = $_FILES['image']['name'];

                //verificar se a imagem esta disponivel ou não
                if($image_name != "")
                {
                    //imagem disponivel
                    //Enviar nova imagem
                    //Remover a imagem atual
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
                        header('location:'.SITEURL.'admin/manage-category.php');
                        //Parar o processo
                        die();
                    }
                    //B. Remover a imagem da pasta e servidor
                    if($current_image!="")
                    {
                        $remove_path = "../images/category/".$current_image;

                        $remove = unlink($remove_path);


                        //Verificar se a imagem foi removida ou não
                        // se falhou na remoção mostrar mensagem e parar o processo
                        if($remove==false)
                        {
                            //Falhou em remover
                            $_SESSION['fail-remove'] = "<div class='error'>falhou ao remover imagem</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    }


                    

                }
                else
                {
                    $image_name = $current_image;
                }
            }
            else
            {
                $image_name = $current_image;
            }

            // 3º Atualizar o banco de dados
            $sql2 = "UPDATE tbl_category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id=$id            
            ";
            //Executar a consulta
            $res2 = mysqli_query($conn, $sql2);
            // 4º Redirecionar 
            //verificar se foi enviado
            if($res2==true)
            {
                //Categoria atualizada
                $_SESSION['update'] = "<div class='success'>Atualizado</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                //Falhou atualizar categoria
                $_SESSION['update'] = "<div class='error'>Não Atualizado</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }

           

        }
        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>