<?php 
    include 'cabecalho.php';
    include 'conecta.php';
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
                <div class="col-lg-2"> 
                    <label for="DataInicial">Data Inicial</label>&nbsp;
                    <input type="text" id="DataInicial" name="DataInicial" style="width: 40%">
                </div>
                <div class="col-lg-2">
                    <label for="DataFinal">Data Final</label>  &nbsp;          
                    <input type="text" id="DataFinal" name="DataFinal" style="width: 40%">
                </div>
                <div class="col-lg-3">Setor&nbsp;
                    <select id="setor" style="width: 45%">
                        <?php
                            $RelacaoSetor = SetorCliente($conn);
                            foreach ($RelacaoSetor as $SetorOS) :
                        ?>

                        <option  value="<?=$SetorOS['idSetor']?>" ><?=utf8_encode($SetorOS['nSetor'])?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-3">Status&nbsp;
                    <select id="status" style="width: 50%">
                        <?php
                            $statusOS = statusOS($conn);
                            foreach ($statusOS as $RelStatus) :
                        ?>
                        <option  value="<?=$RelStatus['status']?>" ><?=utf8_encode($RelStatus['status'])?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-1 pull-right">
                    <button class="btn btn-warning">Consultar</button>  
                </div>
            </form>
        </div>
    </div>
    <br>
    

<table class="table table-striped table-bordered">
    
    <tr>
        <th>ID</th>
        <th>DATA</th>
        <th>CLIENTE</th>
        <th>SETOR</th>       
        <th>MOTIVOS OS</th>
        <th>VALOR TOTAL</th>
        <th>TIPO OS</th>
<!--        <th>N. SÉRIE</th>
        <th>RM</th>-->
        <th>STATUS</th>
        <th class="text-center">AÇÕES</th>
    </tr>
    <?php
    $RelacaoOS = listaOS($conn);
    foreach ($RelacaoOS as $os) : 
// $RelacaoOS = listaOS($conn);
// foreach ($RelacaoOS as $os): ?>    
    <tr>        
        <td><?= $os['id']; ?></td>
        <td>
            <?php $data = $os['dataHora']; 
                echo $data->format('d-m-Y');
            ?>
        </td>       
        <td><?=utf8_encode($os['nomeFantasia']); ?></td>
        <td><?=utf8_encode($os['NomeSetor']); ?></td>       
        <td><?=utf8_encode($os['motivoOs']); ?></td>
        <td><?=$os['TotalMaterial']; ?></td>
        <td><?=utf8_encode($os['NomeTipoOS']); ?></td>
<!--        <td><?//=utf8_encode($os['nSerie']); ?></td>
        <td><?//=utf8_encode($os['rm']);?></td>-->
        <td><?=utf8_encode($os['status']); ?></td>
        <td >
            <a href="os-altera-formulario.php?id=<?=$os['id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-copy"></span>&nbsp;OS</a>
        </td>
    </tr>
 <?php endforeach; ?>
</table>


<?php include 'rodape.php'; ?>




