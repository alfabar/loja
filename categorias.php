<?php include('partials-front/menu.php'); ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore os Produtos</h2>

        <?php

        /// mostar todas as categorias 
        // consulta sql
        $sql = "SELECT * FROM tbl_categoria WHERE ativo='Yes'";

        // executar a consulta
        $res = mysqli_query($conn, $sql);

        // contar as colunas 
        $count = mysqli_num_rows($res);


        //Checar se a categoria avaliavel ou nao
        if ($count > 0) {
            //categorias disponivel
            while ($row=mysqli_fetch_assoc($res)){

                //obter os valores 
                $id = $row['id'];
                $titulo = $row['titulo'];
                $image_name = $row['image_name'];
        ?>
            <a href="<?php echo SITEURL; ?>categoria-produto.php?categoria_id=<?php echo $id; ?>">
                <div class="box-3 float-container">
                    <?php
                    if($image_name=="")
                    {
                        //imagen não disponivel
                        echo "<div class='error'>Categoria não encontrada</div>";

                    }
                    else
                    {
                        //imagens disponivel
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
            //categoria não avaliavel
            echo "<div class='error'>Categoria não encontrada</div>";
        }




        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php') ?>