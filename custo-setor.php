<?php 
    include 'cabecalho.php';
    include 'conect/conecta.php';
    include 'banco-usuario.php'; 
    include 'banco-os.php';
    include 'logica-usuario.php';
 ?>


<?php if(isset($_SESSION["success"])) { ?>
    <p class="alert-success"><?= $_SESSION["success"]?></p>
<?php
    unset($_SESSION["success"]);
} ?>
<div class="container-fluid">
        <div class="row">
            <form method="post" action="">
                <div class="col-lg-1"> 
                    <label for="DataInicial">Data Inicial</label>
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="DataInicial" name="DataInicial">
                </div>
                <div class="col-lg-1">
                    <label for="DataFinal">Data Final</label>  
                </div>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="DataFinal" name="DataFinal">
                </div>
                <div class="col-lg-1 pull-right">
                    <button class="btn btn-warning">Consultar</button>  
                </div>
            </form>
        </div>
</div>
    <br />
    <div class="container-fluid">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
    
    <table id="grid-data-api" class="table table-bordered table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="/api/data/basic">
    <thead>
        <tr>            
            <th data-column-id="SETOR">SETOR</th>
            <th data-column-id="QtdOS">Quant. OS</th>
            <th data-column-id="CUSTO_TOTAL">CUSTO TOTAL</th>          
        </tr>
    </thead>
    <?php
        $RelacaoCustoSetor = listaCustoSetor($conn, isset($_POST['DataInicial']) ? $_POST['DataInicial'] : null, 
            isset($_POST['DataFinal']) ? $_POST['DataFinal'] : null);
       
    foreach ($RelacaoCustoSetor as $CustoSetor) :  ?>
   
        <tr>
            <td><?=  utf8_encode($CustoSetor['nomeSetor'])?></td>
            <td><?=  utf8_encode($CustoSetor['QtdOS'])?></td>
            <td><?="R$ ".number_format($CustoSetor['CustoTotal'],2, ',','.')?></td>           
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
    </div>
        <div class="col-lg-2"></div>    
    </div>

