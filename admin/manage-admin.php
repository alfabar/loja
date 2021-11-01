<?php include("partials/menu.php") ?>

<!-- Menu content começo -->
<div class="main-content">

  <div class="wrapper">
    <h1>Manage admin</h1>
    <br />
    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add']; // Mostrando a mensagen de sessão
      unset($_SESSION['add']); // Removendo mensagem de sessão
    }

    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    } 
    
    if (isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    ?>
    <!-- Botão do administrador -->
    <a class="btn-primary" href="add-admin.php">Adicionar Adm</a>
    <br /><br />

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Nome completo</th>
        <th>Usuario</th>
        <th>Ações</th>
      </tr>
      <?php

      // Consulta para obter todos os administradores
      $sql = "SELECT * FROM tbl_admin";
      // executando a query
      $res = mysqli_query($conn, $sql);

      // Checando a query para ver se foi consultada 
      if ($res == TRUE) {
        // CONTAGEM PARA VERIFICAR SE TEMOS DADOS NO BANCO DE DADOS
        $count = mysqli_num_rows($res);
        $sn = 1; //criando a variavel


        // verifique o número de linhas
        if ($count > 0) {
          // temos dados no banco de dados
          while ($rows = mysqli_fetch_assoc($res)) {
            // usando o loop while para obter os dados do banco de dados
            // e o loop while será executado enquanto tivermos dados no banco de dados
            // obter dados individuais
            $id = $rows['id'];
            $full_name = $rows['full_name'];
            $username = $rows['username'];

            // exibe os valores na tabela
      ?>

            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $full_name; ?></td>
              <td><?php echo $username; ?></td>
              <td> <a class="btn-secundary" href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>">Atualizar</a>
                <a class="btn-danger" href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>">delete admin</a>
              </td>
            </tr>
      <?php
          }
        } else {
          // não temos dados no banco de dados
        }
      }

      ?>

    </table>

  </div>

</div>
<!-- Menu content fim -->

<?php include("partials/footer.php"); ?>