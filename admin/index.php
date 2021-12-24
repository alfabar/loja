
<?php include("partials/menu.php");?>
    <!-- Menu content começo -->
    <div class="main-content">

      <div class="wrapper"><h1>DASHBOARD</h1>
      <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }           
            ?>
          <div class="col-4 text-center">
          <?php
          //executar a consulta na tabela do banco de dados
          $sql = "SELECT * FROM tbl_category";
          //resposta da consulta
          $res = mysqli_query($conn, $sql);
          //contar as colunas 
          $count = mysqli_num_rows($res);
          ?>
              <h1><?php echo $count; ?></h1>
              <br>
              Categorias
          </div>
          <div class="col-4 text-center">
          <?php
          //executar a consulta na tabela do banco de dados
          $sql2 = "SELECT * FROM tbl_food";
          //resposta da consulta
          $res2 = mysqli_query($conn, $sql2);
          //contar as colunas 
          $count2 = mysqli_num_rows($res2);
          ?>
              <h1><?php echo $count2; ?></h1>
              <br>
              Produtos
          </div>
          <div class="col-4 text-center">
          <?php
          //executar a consulta na tabela do banco de dados
          $sql3 = "SELECT * FROM tbl_order";
          //resposta da consulta
          $res3 = mysqli_query($conn, $sql3);
          //contar as colunas 
          $count3 = mysqli_num_rows($res3);
          ?>
              
              <h1><?php echo $count3; ?></h1>
              <br>
              Total pedidos
          </div>
          <div class="col-4 text-center">

          <?php

          //criar uma consulta sql para obter o total de valor gerado
          // agregar os valores com função sql
          $sql4 = "SELECT sum(total) AS Total FROM tbl_order";
          //executar a query de consulta
          $res4 = mysqli_query($conn, $sql4);

          //obter o valor
          $row4 = mysqli_fetch_assoc($res4);

          //obter o total dos pedidos
          $total_pedidos = $row4['Total'];

          
          ?>
              <h1><?php echo $total_pedidos; ?></h1>
              <br>
              Valores gerados
          </div> 
          <div class="clearfix"></div>        
      </div>

  </div>
    <!-- Menu content fim -->

   <?php include("partials/footer.php");?>