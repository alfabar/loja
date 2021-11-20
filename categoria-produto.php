<?php include('partials-front/menu.php'); ?>

<?php
//Verificar se o id foi pasado ou não
if(isset($_GET['category_id']))
{
    //o id da categoria e obtido
    $category_id = $_GET['category_id'];
    // pegar a o titulo da categoria 
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

    //Executar a consulta
    $res = mysqli_query($conn, $sql);

    //Pegar os valores do banco de dados

    $row = mysqli_fetch_assoc($res);

    //Pegar o titulo

    $category_title = $row['title'];
}
else
{
    //categoria não passada
    //sera redirecionada para home page
    header('location:'.SITEURL);
}

?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Produtos de <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php


            //Criar Consulta Sql para obter os produtos com base na categoria selecionada
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            //executar a consulta 
            $res2 = mysqli_query($conn, $sql2);

            // contar as colunas 
            $count2 = mysqli_num_rows($res2);

            // verificar se tabela de produtos esta disponivel 
            if($count2>0)
            {
                //produtos disponivel
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                     <div class="food-menu-box">
                     <div class="food-menu-img">
                                    <?php 
                                    //checar se a imagem esta disponivel pare ser exibida
                                    if($image_name=="")
                                        {
                                            ///imagem não disponivel
                                            echo " <div class='error'>Imagem não disponivel</div>";
                                        }
                                        else
                                        {
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
            }


            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>