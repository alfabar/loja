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
            $sql = "SELECT * FROM tbl_pedido WHERE id=$id";

            //Executar a query 
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //detalhes disponivel a tabela esta preparada para exibir dados
                $row=mysqli_fetch_assoc($res);

                $produto = $row['produto'];
                $descricao = $row['descricao'];
                $qtd = $row['qtd'];
                $total = $row['total'];
                $status = $row['status'];
                $cliente_nome = $row['cliente_nome'];
                $cliente_contato = $row['cliente_contato'];
                $cliente_email = $row['cliente_email'];
                $cliente_endereco = $row['cliente_endereco'];

            }
            else
            {
                // Detalhes nãodisponivel
                //redirecionar para pagina gerenciar produto
                header('location:'.SITEURL.'admin/gerenciar-pedido.php');

            }            
        }
        else
        {
            //redirecionar para o site
            header('location:'.SITEURL.'admin/gerenciar-pedido.php');
        }
        
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Nome Produto</td>
                    <td><?php echo $produto; ?></td>
                </tr>
                <tr>
                    <td>Preço: </td>
                    <td><?php echo $descricao; ?></td>
                </tr>
                <tr>
                    <td>Quantidade</td>
                    <td><input type="number" name="qtd" value="<?php echo $qtd; ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="status">
                            <option <?php if ($status=="Realizado") {echo "selected";} ?> value="Realizado">Realizado</option>
                            <option <?php if ($status=="Em Rota de entrega") {echo "selected";} ?> value="Em Rota de entrega">Em Rota de entrega</option>
                            <option <?php if ($status=="Entregue") {echo "selected";} ?> value="Entregue">Entregue</option>
                            <option <?php if ($status=="Cancelado") {echo "selected";} ?> value="Cancelado">Cancelado</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nome Cliente: </td>
                    <td>
                        <input type="text" name="cliente_nome" value="<?php echo $cliente_nome; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Contato: </td>
                    <td>
                        <input type="text" name="cliente_contato" value="<?php echo $cliente_contato; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="cliente_email" value="<?php echo $cliente_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Nome Cliente: </td>
                    <td>
                        <textarea name="cliente_endereco" id="" cols="30" rows="5"><?php echo $cliente_endereco; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="descricao" value="<?php echo $descricao; ?>">
                        <input type="submit" name="atualizar" value="Atualizar" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 

        if(isset($_POST['atualizar']))
        {
            //echo "clicado";
            //Pegar todos os valores do formulario
                $id = $_POST['id'];
                $descricao = $_POST['descricao'];
                $qtd = $_POST['qtd'];

                $total = $descricao * $qtd;
                
                $status = $_POST['status'];

                $cliente_nome = $_POST['cliente_nome'];
                $cliente_contato = $_POST['cliente_contato'];
                $cliente_email = $_POST['cliente_email'];
                $cliente_endereco = $_POST['cliente_endereco'];


                // Atualizar os valores 

                $sql3 = "UPDATE `tbl_pedido` SET qtd = $qtd, total = $total, status = '$status', cliente_nome = '$cliente_nome', cliente_contato = '$cliente_contato', cliente_email = '$cliente_email', cliente_endereco = '$cliente_endereco', WHERE id=$id";
                //Executa a query
                $res2 = mysqli_query($conn, $sql3);

                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Pedido atualizado com sucesso </div>";
                    header('location:'.SITEURL.'admin/gerenciar-pedido.php');
                }
                else
                {
                    //echo "Falhou";
                    //Falhou ao atualizar
                    $_SESSION['update'] = "<div class='error'>Pedido Falhou ao ser atualizado </div>";
                  
                    header('location:'.SITEURL.'admin/gerenciar-pedido.php');
                }

                ///redirecionar
        }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>