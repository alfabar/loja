<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar comida</h1>
        <br><br>
        <form method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Titulo:</td>
            <td>
                <input type="text" name="title" placeholder="Titulo">
            </td>
        </tr>
        <tr>
            <td>Descrição:</td>
            <td><textarea type="text" name="description" cols="30" rows="5" placeholder="descrição do prato"></textarea></td>
            
        </tr>
        <tr>
            <td>Preço:</td>
            <td>
                <input type="number" name="price">
            </td>
        </tr>
        <tr>
            <td>Selecione a imagem:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>
        <tr>
            <td>Categoria:</td>
            <td>
                <select name="category" id="">
                    <?php
                    // codigo para visualizar categorias do banco de dados
                    // 1º Criar uma Query consulta para ativat consulta no banco de dados
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                    $res = mysqli_query($conn, $sql); 
                    
                    
                    // Contar quantidade de colunas 
                    $count = mysqli_num_rows($res);

                    // se o contador for menor que 0 então não temos

                    if($count>0)
                    {
                        //existe categoria
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //obter detalhes da categoria
                            $id = $row['id'];
                            $title = $row['title'];
                            ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>


                            <?php

                        }
                    }
                    else
                    {
                        // não existe categoria
                        ?>

                        <option value="0">Nenhuma categoria</option>
                        <?php
                    }



                    // 2º visualizar no dropdown

                    ?>                    

                </select>
            </td>
        </tr>
        <tr>
            <td>Destaque:</td>
            <td>
                <input type="radio" name="featured" value="Yes"> Sim
                <input type="radio" name="featured" value="No"> Não
            </td>
        </tr>
        <tr>
            <td>Ativo:</td>
            <td>
                <input type="radio" name="active" value="Yes"> Sim
                <input type="radio" name="active" value="No"> Não
            </td>           
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Food" class="btn-secundary"> 
            </td>
        </tr>
    </table>   
    </form>
    <?php

    // checar se o botão foi clicado ou não
  if(isset($_POST['submit']))
  {
      //echo "Clicado";
      //1º Obter dados do formulario
      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $category = $_POST['category'];

      // Verificar se o botão Radio dos Destaque está clicado ne não manter padrão
      if(isset($_POST['featured']))
      {
          $featured = $_POST['featured'];
      }
      else
      {
          $featured = "No";
      }


      //2º atualizar imagens no banco de dados

      //3º Adicionar comida ao banco de dados

      //4º Apos completar redirecionar pagina de pedidos

  }
  else
  {
      //
  }
    ?>


    
    </div>
</div>

<?php include('partials/footer.php'); ?>