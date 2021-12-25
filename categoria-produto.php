<?php include('partials-front/menu.php'); ?>

<?php
//Verificar se o id foi pasado ou não
if(isset($_GET['categoria_id']))
{
    //o id da categoria e obtido
    $categoria_id = $_GET['categoria_id'];
    // pegar a o titulo da categoria 
    $sql = "SELECT titulo FROM tbl_categoria WHERE id=$categoria_id";

    //Executar a consulta
    $res = mysqli_query($conn, $sql);

    //Pegar os valores do banco de dados

    $row = mysqli_fetch_assoc($res);

    //Pegar o titulo

    $categoria_titulo = $row['titulo'];
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
            
            <h2>Produtos de <a href="#" class="text-white">"<?php echo $categoria_titulo; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu Produtos</h2>

            <?php


            //Criar Consulta Sql para obter os produtos com base na categoria selecionada
            $sql2 = "SELECT * FROM tbl_produto WHERE categoria_id=$categoria_id";

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
                    $id = $row2['id'];
                    $titulo = $row2['titulo'];
                    $preco = $row2['preco'];
                    $descricao = $row2['descricao'];
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
            }


            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>