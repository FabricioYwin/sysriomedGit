<?php include 'cabecalho.php'; 
 include 'conect/conecta.php';
 include 'banco-material.php';
 
 $IdItem = $_GET['IdItem'];
 $material = buscaMaterial($conn, $IdItem);
 ?>

    <h3>Alterando Material</h3> 
    <form action="altera-material.php" method="post"> 
        <!--<input type="hidden" name="IdItem" value="<?//=$material['IdItem']?>">-->
        <table class="table">
            <tr>            
                <td>ID MAT:</td>
                <td><input readonly class="form-control" type="text" name="IdMat"
                           value="<?=$material['IdMat']?>"></td>
            </tr>
            <tr>            
                <td>ID ITEM:</td>
                <td><input readonly class="form-control" type="text" name="IdItem"
                           value="<?=$material['IdItem']?>"></td>
            </tr>
            
            <tr>            
                <td>NOME:</td>
                <td><input readonly class="form-control" type="text" name="nome"
                           value="<?php echo utf8_encode($material['nome']);?>"></td>
            </tr>
            <tr>            
                <td>TIPO:</td>
                <td><input readonly class="form-control" type="text" name="tipo"
                           value="<?php echo utf8_encode($material['tipo']); ?>"></td>
            </tr>
            <tr>            
                <td>N. SÉRIE:</td>
                <td><input readonly class="form-control" type="text" name="nSerie"
                           value="<?php echo utf8_encode($material['nSerie']); ?>"></td>
            </tr>
            <tr>            
                <td>CUSTO</td>
                <td><input class="form-control" type="number" name="valorUnitario"
                           value="<?=number_format($material['valorUnitario'],2);?>" step="0.01"></td>
            
<!--            <tr>
                <td>Categoria</td>
                <td>
                    <select name="categoria_id" class="form-control">
                    <?php /*foreach ($categorias as $categoria) : 
                        $essaEhACategoria = $material['categoria_id'] == $categoria['id']; 
                        $selecao = $essaEhACategoria ? "selected='selected'" : "";                        
                        ?>
                        <option  value="<?=$categoria['id']?>" <?=$selecao; ?>>
                            <?php echo utf8_encode($categoria['nome']); ?>                            
                        </option>                               
                    <?php endforeach; */ ?>
                    </select>
                </td>
            </tr>-->
            <tr>
                <td></td>
                <td>
                    <button class="btn btn-warning" type="submit" name="alterar">Alterar</button>
                </td>            
            </tr>     
        </table>
    </form>
<?php include 'rodape.php'; 