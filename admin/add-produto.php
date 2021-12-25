<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar comida</h1>
        <br><br>
        <?php 

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Titulo:</td>
            <td>
                <input type="text" name="titulo" placeholder="Titulo">
            </td>
        </tr>
        <tr>
            <td>Descrição:</td>
            <td><textarea type="text" name="descricao" cols="30" rows="5" placeholder="descrição do prato"></textarea></td>
            
        </tr>
        <tr>
            <td>Preço:</td>
            <td>
                <input type="number" name="descricao">
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
                    $sql = "SELECT * FROM tbl_categoria WHERE ativo='Yes'";
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
                            $titulo = $row['titulo'];
                            ?>
                                <option value="<?php echo $id; ?>"><?php echo $titulo; ?></option>


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
                <input type="radio" name="destaque" value="Yes"> Sim
                <input type="radio" name="destaque" value="No"> Não
            </td>
        </tr>
        <tr>
            <td>Ativo:</td>
            <td>
                <input type="radio" name="ativo" value="Yes"> Sim
                <input type="radio" name="ativo" value="No"> Não
            </td>           
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add produto" class="btn-secundary"> 
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
      $titulo = $_POST['titulo'];
      $descricao = $_POST['descricao'];
      $descricao = $_POST['descricao'];
      $categoria = $_POST['categoria'];

      // Verificar se o botão Radio dos Destaque está clicado ne não manter padrão
      if(isset($_POST['destaque']))
      {
          $destaque = $_POST['destaque'];
      }
      else
      {
          $destaque = "No";
      }
      if(isset($_POST['ativo']))
      {
          $ativo = $_POST['ativo'];
      }
      else
      {
          $ativo = "No";
      }
      //2º atualizar imagens no banco de dados
      //Verificar se a imagem selecionada esta clicada
      if(isset($_FILES['image']['name']))
      {
          //obter os detalhes da imagem selecionada
          $image_name = $_FILES['image']['name'];
          // verificar se a não foi carregada pelo usuario
          if($image_name!="")
          {
              //imagem selecionada
              // A. renomear a imagem 
              // Obter a extensão da imagem selecionada (jpg, png, gif, etc.)
              $ext = end(explode('.',$image_name));


              //Criar novo nome para as imagen subidas 
              $image_name = "Produto-site-".rand(0000,9999).".".$ext;

              // B. Fazer Upload
              // obter o caminho de origem da imagem

              // caminho de origem e o atual 
              $src = $_FILES['image']['tmp_name'];

              // destino do aequivo que fara upload

              $dst = "../images/produtos/".$image_name;

              // finalmente carregando imagem
              $upload = move_uploaded_file($src, $dst);

              // verificar se a imagem subiu ou não
              if ($upload==false)
              {
                  //Se falhou carregar imagem
                  // Redirecionar para adicionar
                  $_SESSION['upload'] = "<div class='error'>Falhou ao carregar imagem do Produto</div>";
                  header('location:'.SITEURL.'admin/add-produto.php');
                  //Parar o processo
                  die();
              }
          }
      }
      else
      {
          $image_name = ""; // definir se o valor nome estiver vazio da imagem se sim

      }

      //3º Adicionar Produto ao banco de dados

      // Criar uma consulta Sql para inserir os dados no banco de dados
      //para o valor numerico não precisamos passar entre aspas '' categoria e preço aprende seu jumento essa e a hora mas para valor de string e obrigado a passare
      $sql2 = "INSERT INTO tbl_produto SET
      titulo = '$titulo',
      descricao = '$descricao',
      descricao = $descricao,
      image_name = '$image_name',
      categoria_id = $categoria,
      destaque = '$destaque',
      ativo = '$ativo'      
      ";
      //Executar a consulta ao banco
      $res2 = mysqli_query($conn, $sql2);

      //4º Apos completar redirecionar pagina de pedidos
      if($res2==true)
      {
          // Dados inseridos com sucesso
          $_SESSION['add'] = "<div class='success'>Produto adicionado com sucesso</div>";
          header('location:'.SITEURL.'admin/gerenciar-produto.php');
      }
      else
      {
          //Falhou ao inserir dados
          $_SESSION['add'] = "<div class='error'>Falhou ao adicionar produto</div>";
          header('location:'.SITEURL.'admin/gerenciar-produto.php');
      }
  }  
    ?>    
    </div>
</div>
<?php include('partials/footer.php'); ?>