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

    ?>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Nome completo</th>
        <th>Usuario</th>
        <th>Ações</th>
      </tr>
      <tr>
        <td>1.</td>
        <td>Adriano Baram</td>
        <td>alfa_bar</td>
        <td> <a class="btn-secundary" href="">Atualizar</a>
          <a class="btn-danger" href="">delete admin</a></td>
      </tr>
      <tr>
        <td>2.</td>
        <td>Adriano Baram</td>
        <td>alfa_bar</td>
        <td> <a class="btn-secundary" href="">Atualizar</a>
          <a class="btn-danger" href="">delete admin</a></td>
      </tr>
      <tr>
        <td>3.</td>
        <td>Adriano Baram</td>
        <td>alfa_bar</td>
        <td> 
          <a class="btn-secundary" href="">Atualizar</a>
          <a class="btn-danger" href="">delete admin</a>
        </td>
      </tr>
    </table>
</div>


</div>
<?php include("partials/footer.php");?>