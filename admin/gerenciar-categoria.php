<?php include("partials/menu.php"); ?>
<div class="main-content">

  <div class="wrapper">
    <h1>Gerenciar Categoria</h1><br><br>
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
    if (isset($_SESSION['remove'])) {
      echo $_SESSION['remove'];
      unset($_SESSION['remove']);
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }
    if (isset($_SESSION['categoria-nao-encontrada'])) {
      echo $_SESSION['categoria-nao-encontrada'];
      unset($_SESSION['categoria-nao-encontrada']);
    }
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }
    if (isset($_SESSION['failed-remove'])) {
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']);
    }


    ?>

    <!-- Botão do administrador -->
    <a class="btn-primary" href="<?php echo SITEURL; ?>admin/add-categoria.php">Adicionar Categoria</a>
    <br>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Titulo </th>
        <th>Imagen</th>
        <th>destaque</th>
        <th>Ativo</th>
        <th>Action</th>
      </tr>
      <?php

      //Query que consulta para obter dados da tabela categoria
      $sql = "SELECT * FROM tbl_categoria";

      // Comandos para Executar a consulta Query
      $res = mysqli_query($conn, $sql);

      // comando para contar as tabelas do banco de dados
      $count = mysqli_num_rows($res);

      //Criar numero de serial variavel
      $sn = 1;

      //Vamos verificar se temos ou não os dados de consulta
      if ($count > 0) {
        // Dados encontrado
        // Obter dados e disponibilizar
        while ($row = mysqli_fetch_assoc($res)) {
          $id = $row['id'];
          $titulo = $row['titulo'];
          $image_name = $row['image_name'];
          $destaque = $row['destaque'];
          $ativo = $row['ativo'];

      ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $titulo; ?></td>
            <td><?php
                if ($image_name != "") {
                  //mostrar a imagem
                ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="50px" alt="" srcset="">



              <?php

                } else {


                  echo "<div class='error'>Não há imagem adicionada</div>";
                }






              ?>
            </td>
            <td><?php echo $destaque; ?></td>
            <td><?php echo $ativo; ?></td>
            <td>
              <a class="btn-secundary" href="<?php echo SITEURL; ?>admin/atualizar-categoria.php?id=<?php echo $id; ?>">Atualizar</a>
              <a class="btn-danger" href="<?php echo SITEURL; ?>admin/deletar-categoria.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>">Excluir</a>
            </td>
          </tr>
        <?php
        }
      } else {
        //Dados não encontrado
        //Mostrar a mensagem dentro da tabela
        ?>
        <tr>
          <td colspan="6">
            <div class="error">Nenhuma categoria Adicionada</div>
          </td>
        </tr>

      <?php

      }


      ?>
    </table>
  </div>


</div>
<?php include("partials/footer.php"); ?>