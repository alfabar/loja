<?php include('partials-front/menu.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>procurar-produtos.php" method="POST">
            <input type="search" name="search" placeholder="Procure produtos.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //mostrar produtos ativos
        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

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
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
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
                            <img src="<?php echo SITEURL; ?>images/produtos/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php
                        }

                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
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
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>