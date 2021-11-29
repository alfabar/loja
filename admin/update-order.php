<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar o Pedido</h1>
        <br>
        <hr>
        <?php
        
        if(isset($_GET['id']))
        {
            
        }
        
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Nome Produto</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Quantidade</td>
                    <td><input type="number" name="qtd"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option value="Pedido Recebido">Pedido Recebido</option>
                            <option value="Em Rota de entrega">Em Rota de entrega</option>
                            <option value="Entregue">Entregue</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nome Cliente: </td>
                    <td>
                        <input type="text" name="custumer_name" value="">
                    </td>
                </tr>
                <tr>
                    <td>Contato: </td>
                    <td>
                        <input type="text" name="custumer_contato" value="">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="text" name="custumer_email" value="">
                    </td>
                </tr>
                <tr>
                    <td>Nome Cliente: </td>
                    <td>
                        <textarea name="custumer_address" id="" cols="30" rows="5"></textarea>
                    </td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Atualizar Pedido" class="btn-secondary">
                    </td>
                </tr>
            </table>



        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>