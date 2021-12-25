<?php include('partials/menu.php'); ?>


<?php
    if(isset($_GET['id']))
    {
        //Pegar os detalhes 
        $id = $_GET['id'];

        //SQL query que vai selecionar produto selecionado
        $sql2 = "SELECT * FROM tbl_produto WHERE id=$id";
        
        $res2 = mysqli_query($conn,$sql2);

        //Obter a base de dados
        $row2 = mysqli_fetch_assoc($res2);

        $titulo = $row2['titulo'];
        $descricao = $row2['descricao'];
        $descricao = $row2['descricao'];
        $atual_image = $row2['image_name'];
        $atual_categoria = $row2['categoria_id'];
        $destaque = $row2['destaque'];
        $ativo = $row2['ativo'];

    } 
    else
    {
        //Redirecionar painel usuario
        header('location:'.SITEURL.'admin/gerenciar-produto.php');
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
                        <input type="text" name="titulo" value="<?php echo $titulo; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Descrição</td>
                    <td>
                        <textarea name="descricao" id="" cols="30" rows="5" ><?php echo $descricao; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Preço:</td>
                    <td>
                        <input type="number" name="descricao" value="<?php echo $descricao; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Imagem atual</td>
                    <td>
                        <?php 
                        if($atual_image == "")
                        {
                            //imagen não disponivel
                            echo "<div class=''>Imagen não disponivel</div>";
                        }
                        else
                        {
                            //imagen disponivel
                            ?>
                            <img src="<?php echo SITEURL; ?>images/produtos/<?php echo $atual_image; ?>" alt="<?php echo $titulo; ?>" width="100px">

                            <?php
                        }
                        
                        ?>
                         <label for="image">Selecione a imagem:</label>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Categoria:</td>
                    <td>
                        <select name="category" id="">
                            <?php 

                            //consultar dados do banco de tabela categoria
                            $sql = "SELECT * FROM tbl_categoria WHERE ativo='Yes'";

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
                                    $categoria_titulo = $row['titulo'];
                                    $categoria_id = $row['id'];

                                    // Categoria não disponivel
                                    ?>
                                    <option <?php if($atual_categoria==$categoria_id) {echo "Selecionado";} ?> value='<?php echo $categoria_id; ?>'><?php echo $categoria_titulo; ?></option>";
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
                        <input <?php if($destaque=="Yes") {echo "checked";} ?> type="radio" name="destaque" value="Yes"> Sim
                        <input <?php if($destaque=="No") {echo "checked";} ?> type="radio" name="destaque" value="No"> Não
                    </td>
                </tr>
                <tr>
                    <td>Ativo:</td>
                    <td>
                        <input <?php if($ativo=="Yes") {echo "checked";} ?> type="radio" name="ativo" value="Yes"> Sim
                        <input <?php if($ativo=="No") {echo "checked";} ?> type="radio" name="ativo" value="No"> Não
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="atual_image" value="<?php echo $atual_image; ?>">
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
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $descricao = $_POST['descricao'];
            $atual_image = $_POST['atual_image'];
            $categoria = $_POST['categoria'];
            $destaque = $_POST['destaque'];
            $ativo = $_POST['ativo'];

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

                    // Checar se a imagem foi para servidor sim ou não
                    if($upload==false)
                    {
                        //falhou sessão
                        $_SESSION['upload'] = "<div class='error'>Erro ao enviar</div>";
                        //redirecionar
                        header('location:'.SITEURL.'admin/gerenciar-produto.php');
                        //logo apos parar o processo
                        die();


                    }
                     //3º Remover a imagem se uma nova fou carregada
                    // B.Remove a imagem atual
                    if($atual_image!="")
                    {
                        //Imagen disponivel
                        //Remove a imagem
                        $remove_path = "../images/produtos/".$atual_image;

                        $remove = unlink($remove_path);

                        // verificar se foi removido ao não
                        if($remove==false)
                        {
                            $_SESSION['remove-failed'] = "<div class='error'>Erro ao Remover</div>";
                            //Redirecionar e parar o proceso
                            header('location:'.SITEURL.'admin/gerenciar-produto.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = $atual_image;
                }
            }
            else
            {
                $image_name = $atual_image;
            }
            //2º enviar imagem selecionada           

            
            //4º Atualizar banco de dados 
            $sql3 = "UPDATE tbl_produto SET
               titulo = '$titulo',
               descricao = '$descricao',
               descricao = $descricao,
               image_name = '$image_name',
               categoria_id = '$categoria',
               destaque = '$destaque',
               ativo = '$ativo'
               WHERE id=$id           
            ";

            //Executar consulta query
            $res3 = mysqli_query($conn, $sql3);

            //Checar se a query foi verificada ou não

            if($res3==true)
            {
                //query executada
                $_SESSION['update'] = "<div class='success'>Produto atualizado com sucesso</div>";
                header('location:'.SITEURL.'admin/gerenciar-produto.php');
            }
            else
            {
                //Falhou ao carregar imagem
                $_SESSION['update'] = "<div class='error'>Erro ao atualizar</div>";
                header('location:'.SITEURL.'admin/gerenciar-produto.php');
            }

            
            //redirecionar
        } 
        
        
        
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>
