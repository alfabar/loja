<?php include('partials-front/menu.php'); ?>

<?php
//verificar se o produto esta selecionado au não
if(isset($_GET['food_id']))
{
    //se estiver disponivel pegar os detalhes do produto selecionado
    $food_id = $_GET['food_id'];

    //Obter os detalhes do produto selecionado
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

    //executar a query
    $res = mysqli_query($conn, $sql);

    //contar as colunas 
    $count = mysqli_num_rows($res);

    //verificar se a contagem da tabela esta disponivel ou não
    if($count==1)
    {
        // se tiver dados
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];

    }
    else
    {
        //produto não esta disponivel
         //Redirecionar para pagina homepage
        header('location:'.SITEURL);
    }
}
else
{
    //Redirecionar para pagina homepage
    header('location:'.SITEURL);


}
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Produto Selecionado</legend>

                    <div class="food-menu-img">
                        <?php
                        //Verificar a imagem se está disponivel ou não 
                        if($image_name=="")
                        {
                            //imagem não disponivel
                            echo "<div class='error'>Imagem não esta disponivel</div>";
                        }
                        else
                        {
                            //imagem está disponivel
                            ?>
                             <img src="<?php echo SITEURL; ?>images/produtos/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">

                            <?php

                        }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price"><?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php') ?>