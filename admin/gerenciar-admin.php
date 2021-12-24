<?php include("partials/menu.php") ?>

<!-- Menu content começo -->
<div class="main-content">

  <div class="wrapper">
    <h1>Gerenciar admin</h1>
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
    // Sessão para atualizar usuario
    if (isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    // Sessão para troca usuario não encontrado
    if(isset($_SESSION['user-not-found']))
    {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }
    //Sessão para troca de senha não encontrada
    if(isset($_SESSION['pwd-not-match']))
    {
      echo $_SESSION['pwd-not-match'];
      unset($_SESSION['pwd-not-match']);
    }
    if(isset($_SESSION['change-pwd']))
    {
      echo $_SESSION['change-pwd'];
      unset($_SESSION['change-pwd']);
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
            $nome_completo = $rows['nome_completo'];
            $nomeusuario = $rows['nomeusuario'];

            // exibe os valores na tabela
      ?>

            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $nome_completo; ?></td>
              <td><?php echo $nomeusuario; ?></td>
              <td> 
              <a class="btn-primary" href="<?php echo SITEURL; ?>admin/atualizar-senha.php?id=<?php echo $id; ?>">Trocar senha</a>
                <a class="btn-secundary" href="<?php echo SITEURL; ?>admin/atualizar-admin.php?id=<?php echo $id; ?>">Atualizar</a>
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