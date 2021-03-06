<?php include('partials-front/menu.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        
        
        ?>

        <h2>Resultados da procura para <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
    <h2 class="text-center">Menu Produtos</h2>

        <?php

        //Obter a procura 
        $search = $_POST['search'];

        //SQL query para obter os produtos baseado na procura
        //SELECT
        $sql = "SELECT * FROM tbl_produto WHERE titulo LIKE '%$search%' OR descricao LIKE '%$search%'";

        //Executar a query
        $res = mysqli_query($conn, $sql);

        //Contar as colunas 
        $count = mysqli_num_rows($res);

        // Checar se o produto esta disponivel ou não

        if ($count > 0) {
            //Produto disponivel
            while ($row = mysqli_fetch_assoc($res)) {
                //Pegar os valores 
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
                        if ($image_name == "") 
                        {
                            ///imagem não disponivel
                            echo " <div class='error'>Imagem não disponivel</div>";
                        }
                         else 
                         {
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

                        <a href="#" class="btn btn-primary">Pedir Agora</a>
                    </div>
                </div>

        <?php
            }
        } else {
            //Produto não esta disponivel
            echo "<div class='error'>Produto não encontrada</div>";
        }




        ?>
        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>