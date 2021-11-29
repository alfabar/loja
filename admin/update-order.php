<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar o Pedido</h1>
        <br>
        <hr>
        <?php
        
        if(isset($_GET['id']))
        {
            // Pegar os detalhes do pedido
            $id=$_GET['id'];

            //Pegar todos os detalhes baseado nesta consulta
            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            //Executar a query 
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //detalhes disponivel a tabela esta preparada para exibir dados
                $row=mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qtd = $row['qtd'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $custumer_name = $row['custumer_name'];
                $custumer_contact = $row['custumer_contact'];
                $custumer_email = $row['custumer_email'];
                $custumer_address = $row['custumer_address'];

            }
            else
            {
                // Detalhes nãodisponivel
                //redirecionar para pagina gerenciar produto

            }



            
        }
        else
        {
            //redirecionar para o site
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Nome Produto</td>
                    <td><?php echo $food; ?></td>
                </tr>
                <tr>
                    <td>Preço: </td>
                    <td><?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Quantidade</td>
                    <td><input type="number" name="qtd" value="<?php echo $qtd; ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option <?php if ($status=="Pedido Recebido") {echo "selected";} ?> value="Pedido Recebido">Pedido Recebido</option>
                            <option <?php if ($status=="Em Rota de entrega") {echo "selected";} ?> value="Em Rota de entrega">Em Rota de entrega</option>
                            <option <?php if ($status=="Entregue") {echo "selected";} ?> value="Entregue">Entregue</option>
                            <option <?php if ($status=="Cancelado") {echo "selected";} ?> value="Cancelado">Cancelado</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nome Cliente: </td>
                    <td>
                        <input type="text" name="custumer_name" value="<?php echo $custumer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Contato: </td>
                    <td>
                        <input type="text" name="custumer_contact" value="<?php echo $custumer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="custumer_email" value="<?php echo $custumer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nome Cliente: </td>
                    <td>
                        <textarea name="custumer_address" id="" cols="30" rows="5"><?php echo $custumer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Atualizar Pedido" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 

        if(isset($_POST['submit']))
        {
            //echo "clicado";
            //Pegar todos os valores do formulario
                $id = $row['id'];
                $price = $row['price'];
                $qtd = $row['qtd'];
                $total = $price * $qtd;
                $order_date = $row['order_date'];
                $status = $row['status'];
                $custumer_name = $row['custumer_name'];
                $custumer_contact = $row['custumer_contact'];
                $custumer_email = $row['custumer_email'];
                $custumer_address = $row['custumer_address'];


                // Atualizar os valores 

                $sql2 = "UPDATE tbl_order SET 

                qtd = $qtd,
                total = $total,
                status = '$status',
                custumer_name = '$custumer_name',
                custumer_contact = '$custumer_contact',
                custumer_email = '$custumer_email',
                custumer_address = '$custumer_address',
                WHERE id=$id";

                //Executa a query
                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Pedido atualizado com sucesso </div>"
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Falhou ao atualizar
                    $_SESSION['update'] = "<div class='success'>Pedido atualizado com sucesso </div>"
                    header('location:'.SITEURL.'admin/manage-order.php');
                }









                ///redirecionar


        }



        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>