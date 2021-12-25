<?php include('partials-front/menu.php'); ?>

<?php
//verificar se o produto esta selecionado au não
if(isset($_GET['produto_id']))
{
    //se estiver disponivel pegar os detalhes do produto selecionado
    $produto_id = $_GET['produto_id'];

    //Obter os detalhes do produto selecionado
    $sql = "SELECT * FROM tbl_produto WHERE id=$produto_id";

    //executar a query
    $res = mysqli_query($conn, $sql);

    //contar as colunas 
    $count = mysqli_num_rows($res);

    //verificar se a contagem da tabela esta disponivel ou não
    if($count==1)
    {
        // se tiver dados
        $row = mysqli_fetch_assoc($res);
        $titulo = $row['titulo'];
        $preco = $row['preco'];
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
            
            <h2 class="text-center text-white">Preencha este formulário para confirmar seu pedido</h2>

            <form action="" method="POST" class="order">
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
                        <h3><?php echo $titulo; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $titulo; ?>">
                        <p class="food-price"><?php echo $preco; ?></p>
                        <input type="hidden" name="price" value="<?php echo $preco; ?>">

                        <div class="order-label">Quantidade</div>
                        <input type="number" name="qtd" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Detalhes da entrega</legend>
                    <div class="order-label">Nome Completo</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Telefone</div>
                    <input type="tel" name="contato" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Endereço</div>
                    <textarea name="endereco" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            //Verificar se o botão submit foi clicado
            if(isset($_POST['submit']))
            {
                //Obter os Valores do formulario
                $produto = $_POST['produto'];
                $preco = $_POST['preco'];
                $qtd = $_POST['qtd'];

                $total = $preco * $qtd; // Preço total e calculado Preço X QUantidade

                $order_date = date("Y-m-d h:i:s"); // Data do pedido

                $status = "Realizado"; // Pedido , em entrega , entregue e  cancelado


                $cliente_nome = $_POST['nome-completo'];
                $cliente_contato = $_POST['contato'];
                $cliente_email = $_POST['email'];
                $cliente_endereco = $_POST['endereco'];


                //Salvar o pedido no banco de dados 

                $sql2 = "INSERT INTO tbl_pedido SET produto = '$produto', preco = $preco, qtd = $qtd, total = $total, order_date = '$order_date', status = '$status', cliente_nome = '$cliente_nome', cliente_contato = '$cliente_contato', cliente_email = '$cliente_email', cliente_endereco = '$cliente_endereco'";
                 //echo $sql2; die();

                 //Executar a query

                 $res2 = mysqli_query($conn, $sql2);

                 //Checar se foi executada ou não

                 if($res2==true)
                 {
                     //Query executada e pedido foi salvo
                     $_SESSION['order'] = "<div class='success text-center'>Pedido realizado com sucesso</div>";
                     header('location:'.SITEURL);
                     

                 }
                 else
                 {
                     //falhou ao executar em salvar pedido
                     
                     $_SESSION['order'] = "<div class='error text-center'>Falha ao realizar o pedido</div>";
                     header('location:'.SITEURL);
                 }


            }
            
            ?>

        </div>
    </section>
    <!-- produto sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php') ?>