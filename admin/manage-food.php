<?php include("partials/menu.php");?>
<div class="main-content">

<div class="wrapper">
    <h1>Manage Food</h1>
      <!-- Botão do administrador -->
      <a class="btn-primary" href="<?php echo SITEURL; ?>admin/add-food.php">Adicionar Comida</a>
    <br>
    <?php 
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    if(isset($_SESSION['delete']))
    {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    if(isset($_SESSION['upload']))
    {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    if(isset($_SESSION['unauthorized']))
    {
      echo $_SESSION['unauthorized'];
      unset($_SESSION['unauthorized']);
    }
    if(isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    ?>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>imagem</th>
        <th>destaque</th>
        <th>Ativo</th>
        <th>Acões</th>
      </tr>
      <?php 

      //Criar uma consulta sql para exibir dados na tabela
      $sql = "SELECT * FROM tbl_food";

      // executar a consulta query    
      $res = mysqli_query($conn, $sql);

      //Contar as colunas checada na tabela comida
      $count = mysqli_num_rows($res);

      //criar um numero de serie 
      $sn=1;

      if($count>0)
      {
        // dados encontrado da tabela comida/food
        while($row=mysqli_fetch_assoc($res))
        {
          $id = $row['id'];
          $title = $row['title'];
          $price = $row['price'];
          $image_name = $row['image_name'];
          $feature = $row['feature'];
          $active = $row['active'];
          ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $title; ?></td>
            <td><?php echo $price; ?></td>
            <td><?php 
            //
            if($image_name=="")
            {
              echo "<div class='error'>Imagem não adicionada</div>";
            }
            else
            {
              // imagem mostrar
              ?>
              <img src="<?php echo SITEURL; ?>images/produtos/<?php echo $image_name; ?>" width="50">

              <?php
            }
            
            ?></td>
            <td><?php echo $feature; ?></td>
            <td><?php echo $active; ?></td>
            <td>
              <a class="btn-secundary" href="<?php echo SITEURL; ?>admin/atualizar-produto.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">Atualizar</a>
              <a class="btn-danger" href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">Excluir</a></td>
          </tr>
          <?php
        }

      }
      else
      {
        // comida não adicionada
        echo "<tr><td colspan='7' class='error'> Comida não adicionada</td></tr>";
      }

      ?>            
    </table>
</div>


</div>
<?php include("partials/footer.php");?>