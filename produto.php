<?php include('partials-front/menu.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>procurar-produto.php" method="POST">
            <input type="search" name="search" placeholder="Procure produtos.." required>
            <input type="submit" name="submit" value="Procurar" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu Produtos</h2>
        <?php
        //mostrar produtos ativos
        $sql = "SELECT * FROM tbl_produto WHERE ativo='Yes'";

        //executar a query
        $res = mysqli_query($conn, $sql);

        //contando o numero de colunas
        $count = mysqli_num_rows($res);

        //Checando se os produtos estao dispniveis
        if ($count > 0) {
            //produto disponivel
            while ($row = mysqli_fetch_assoc($res)) {
                //obter os valores 
                $id = $row['id'];
                $titulo = $row['titulo'];
                $preco = $row['preco'];
                $descricao = $row['descricao'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        //checar se a imagem esta disponivel pare ser exibida
                        if ($image_name == "") {
                            ///imagem não disponivel
                            echo " <div class='error'>Imagem não disponivel</div>";
                        } else {
                            //imagem disponivel
                        ?>
                            <img src="<?php echo SITEURL; ?>images/produtos/<?php echo $image_name; ?>" alt="<?php echo $titulo; ?>" class="img-responsive img-curve">
                        <?php
                        }

                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $titulo; ?></h4>
                        <p class="food-price">$<?php echo $preco; ?></p>
                        <p class="food-detail">
                            <?php echo $descricao; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>pedidos.php?produto_id=<?php echo $id; ?>" class="btn btn-primary">Pedir Agora</a>
                    </div>
                </div>


        <?php

            }
        } else {
            //Produto não disponivel
            echo "<div class='error'>Produto não encontrada</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>

</section>
<!-- produto Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>