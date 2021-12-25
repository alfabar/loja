<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>procurar-produto.php" method="POST">
            <input type="search" name="search" placeholder="Procure aqui" required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

?>
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Procure </h2>

        <?php
        //criar uma consulta sql para mostrar os dados da categoria
        $sql = "SELECT * FROM tbl_categoria WHERE ativo='Yes' AND destaque='Yes' LIMIT 3";

        // Execute a Query
        $res = mysqli_query($conn, $sql);


        //Contar o numero de colunas a serem exibidas
        $count = mysqli_num_rows($res);

        if ($count > 0) {

            // Categoria disponivel
            while ($row = mysqli_fetch_assoc($res)) {
                //Obter os valores
                $id = $row['id'];
                $titulo = $row['titulo'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>categoria-produto.php?categoria_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        // Verificar se a imagem esta disponivel ou não
                        if ($image_name == "") {
                            //mostrar mensagen
                            echo " <div class='error'>Imagem não disponivel</div>";
                        } else {
                            //imagem disponivel
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php
                        }

                        ?>


                        <h3 class="float-text text-white"><?php echo $titulo; ?></h3>
                    </div>
                </a>

        <?php

            }
        } else {
            //Categoria não adicionada
            echo " <div class='error'>Categoria não adicionada</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu de produtos</h2>


        <?php
        //pegando os produtos da tabela no banco de dados 
        //consultar banco de dados
        $sql2 = "SELECT * FROM tbl_produto WHERE ativo='Yes' AND destaque='Yes' LIMIT 6";

        $res2 = mysqli_query($conn, $sql2);

        //
        $count2 = mysqli_num_rows($res2);

        //verificar se tem produto disponivel ou não

        if ($count2 > 0) {
            //Produto disponivel
            while ($row = mysqli_fetch_assoc($res2)) {
                //obter todos os valores
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
                            <img src="<?php echo SITEURL; ?>images/produtos/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
            echo " <div class='error'>Categoria não adicionada</div>";
        }

        ?>
        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="#">See All produtos</a>
    </p>
</section>
<!-- produto Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>