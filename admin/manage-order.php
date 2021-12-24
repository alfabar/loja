<?php include("partials/menu.php");?>
<div class="main-content">

<div class="wrapper">
    <h1>Manage Order</h1>
      <!-- Botão do administrador -->
      <a class="btn-primary" href="">Gerenciar pedidos</a>
    <br>
    <?php
    if(isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    
    ?>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Produto</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Total</th>
        <th>Pedido Data</th>
        <th>Status</th>
        <th>Nome Cliente</th>
        <th>Contato</th>
        <th>Email</th>
        <th>Endereço</th>
        <th>Ações</th>
      </tr>
      <?php 

      //Obter os dados do banco

      $sql = "SELECT * FROM tbl_order ";/// Visualizando ORDER BY id DESC produtos por id orden decrecente há grande necessidade de acertar os detalhes da data 

      // Executar a consulta query

      $res = mysqli_query($conn, $sql);

      //contagem das colunas 
      $count = mysqli_num_rows($res);

      $sn = 1; //criando um numero de serial

      //verificando com uma condição se o numero de colunas da resposta e zero
      if($count>0)
      {
        //Pedido disponivel
        while($row=mysqli_fetch_assoc($res))
        {
        $id = $row['id'];
        $food = $row['food'];
        $price = $row['price'];
        $qtd = $row['qtd'];
        $total = $row['total'];
        $order_date = $row['order_date'];
        $status = $row['status'];
        $custumer_name = $row['custumer_name'];
        $custumer_contact = $row['custumer_contact'];
        $custumer_email = $row['custumer_email'];
        $custumer_address = $row['custumer_address'];
      }
        ?>
        <tr> 
          <td><?php echo $sn++; ?></td>
          <td><?php echo $food; ?></td>
          <td><?php echo $price; ?></td>
          <td><?php echo $qtd; ?></td>
          <td><?php echo $total; ?></td>
          <td><?php echo $order_date; ?></td>
          <td><?php echo $status; ?></td>
          <td><?php echo $custumer_name; ?></td>
          <td><?php echo $custumer_contact; ?></td>
          <td><?php echo $custumer_email; ?></td>
          <td><?php echo $custumer_address; ?></td>        
          <td> 
            <a class="btn-secundary" href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>">Atualizar Pedido</a>
            </td>
      </tr>

        <?php


      }
      else
      {
        // Pedido não está disponivel 
        echo "<tr><td class='error' collspan='12'>Pedidos não disponivel</td></tr> ";
      }      
      ?>     
    </table>
</div>


</div>
<?php include("partials/footer.php");?>