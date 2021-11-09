<?php include('partials/menu.php'); ?>


<?php
    if(isset($_GET['id']))
    {
        //Pegar os detalhes 
        $id = $_GET['id'];

        //SQL query que vai selecionar produto selecionado
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        
        $res2 = mysqli_query($conn,$sql2);

        //Obter a base de dados
        $row2 = mysqli_fetch_assoc($res2);

        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $feature = $row2['feature'];
        $active = $row2['active'];

    } 
    else
    {
        //Redirecionar painel usuario
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar Produto</h1>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Titulo:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Descrição</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" ><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Preço:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Imagem atual</td>
                    <td>
                        <?php 
                        if($current_image == "")
                        {
                            //imagen não disponivel
                            echo "<div class=''>Imagen não disponivel</div>";
                        }
                        else
                        {
                            //imagen disponivel
                            ?>
                            <img src="<?php echo SITEURL; ?>images/produtos/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="100px">

                            <?php
                        }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Categoria:</td>
                    <td>
                        <select name="category" id="">
                            <?php 

                            //consultar dados do banco de tabela categoria
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //executar a query
                            $res = mysqli_query($conn, $sql);

                            //contar colunas 
                            $count = mysqli_num_rows($res);

                            //Checar se a categoria está disponivel ou não
                            if($count>0)
                            {
                                //categoria disponivel
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    // Categoria não disponivel
                                    ?>
                                    <option <?php if($current_category==$category_id) {echo "Selecionado";} ?> value='<?php echo $category_id; ?>'><?php echo $category_title; ?></option>";
                                    <?php
                                   
                               
                                }
                            }
                            else
                            {
                                // Categoria não disponivel
                                echo "<option value='0'>Categoria Não disponivel.</option>";
                            }

                            ?>                      
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Destaque:</td>
                    <td>
                        <input <?php if($feature=="Yes") {echo "checked";} ?> type="radio" name="feature" value="Yes"> Sim
                        <input <?php if($feature=="No") {echo "checked";} ?> type="radio" name="feature" value="No"> Não
                    </td>
                </tr>
                <tr>
                    <td>Ativo:</td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Sim
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> Não
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Atualizar" class="btn-secundary">
                    </td>
                </tr>
                
            </table>

        </form>
        <?php 
        if(isset($_POST['submit']))
        {
            //echo "botão clicado";
            //1º Obter os detalhes do formulario
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $feature = $_POST['feature'];
            $active = $_POST['active'];

            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];
                //Verificar se a imagem esta disponivel
                if($image_name!="")
                {
                    //imagen esta disponivel
                    //A. Enviar nova imagem
                    // Renomear a imagen
                    $ext = end(explode('.', $image_name)); // Obter extensão da imagem
                    $image_name = "Produto-site-".rand(0000, 9999).'.'.$ext; // Esta imagem sera renomeada

                    //Obter o caminho da imagem 
                    $src_path = $_FILES['image']['tmp_name']; //caminho do arquivo
                    $dest_path = "../images/produtos/".$image_name;

                    //upload a imagem para a pasta e o banco de dados
                    $upload = move_uploaded_file($src_path, $dest_path);

                    // verificar se a imagem foi upada ou não
                    if($upload==false)
                    {
                        //falhou sessão
                        $_SESSION['upload'] = "<div class='error'>Erro ao enviar</div>";
                        //redirecionar
                        header('location:'.SITEURL.'admin/manage-food.php');
                        //logo apos parar o processo
                        die();


                    }
                     //3º Remover a imagem se uma nova fou carregada
                    // B.Remove a imagem atual
                    if($current_image!="")
                    {
                        //Imagen disponivel
                        //Remove a imagem
                        $remove_path = "../images/produtos/".$current_image;

                        $remove = unlink($remove_path);

                        // verificar se foi removido ao não
                        if($remove==false)
                        {
                            $_SESSION['remove-failed'] = "<div class='error'>Erro ao Remover</div>";
                            //Redirecionar e parar o proceso
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }
                    }
                }
            }
            else
            {
                $image_name = $current_image;
            }



            //2º enviar imagem selecionada


            

            
            //4º Atualizar banco de dados 
            $sql3 = "UPDATE tbl_food SET
               title = '$title',
               description = '$description',
               price = $price,
               image_name = '$image_name',
               category_id = '$category',
               feature = '$feature',
               active = '$active'
               WHERE id=$id           
            ";

            //Executar consulta query
            $res3 = mysqli_query($conn, $sql3);

            //Checar se a query foi verificada ou não

            if($res3==true)
            {
                //query executada
                $_SESSION['update'] = "<div class='success'>Produto atualizado com sucesso</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
            {
                //Falhou ao carregar imagem
                $_SESSION['update'] = "<div class='error'>Erro ao atualizar</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }

            
            //redirecionar
        } 
        
        
        
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>
