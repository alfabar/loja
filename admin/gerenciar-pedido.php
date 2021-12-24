<?php include("partials/menu.php");?>
<div class="main-content">

<div class="wrapper">
    <h1>Gerenciar pedido</h1>
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

      $sql = "SELECT * FROM tbl_pedido ";/// Visualizando pedido BY id DESC produtos por id orden decrecente há grande necessidade de acertar os detalhes da data 

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
        $produto = $row['produto'];
        $descricao = $row['descricao'];
        $qtd = $row['qtd'];
        $total = $row['total'];
        $pedido_date = $row['pedido_date'];
        $status = $row['status'];
        $cliente_nome = $row['cliente_nome'];
        $cliente_contato = $row['cliente_contato'];
        $cliente_email = $row['cliente_email'];
        $cliente_endereco = $row['cliente_endereco'];
      }
        ?>
        <tr> 
          <td><?php echo $sn++; ?></td>
          <td><?php echo $produto; ?></td>
          <td><?php echo $descricao; ?></td>
          <td><?php echo $qtd; ?></td>
          <td><?php echo $total; ?></td>
          <td><?php echo $pedido_date; ?></td>

          <td>
            <?php 
            ////realizado em rota 
            if($status=="Realizado")
            {
              echo "<label>$status</label>";
            }
            elseif($status=="Em Rota de entrega")
            {
              echo "<label style='color: orange;'>$status</label>";

            }
            elseif($status=="Entregue")
            {
              echo "<label style='color: green;'>$status</label>";

            }
            elseif($status=="Cancelado")
            {
              echo "<label style='color: red;'>$status</label>";

            }      
            ?>
          </td>

          <td><?php echo $cliente_nome; ?></td>
          <td><?php echo $cliente_contato; ?></td>
          <td><?php echo $cliente_email; ?></td>
          <td><?php echo $cliente_endereco; ?></td>        
          <td> 
            <a class="btn-secundary" href="<?php echo SITEURL; ?>admin/atualizar-pedido.php?id=<?php echo $id; ?>">Atualizar Pedido</a>
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