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
                <div class="col-lg-2"> 
                    <label for="DataInicial">Data Inicial</label>&nbsp;
                    <input type="text" id="DataInicial" name="DataInicial" style="width: 40%">
                </div>
                <div class="col-lg-2">
                    <label for="DataFinal">Data Final</label>  &nbsp;          
                    <input type="text" id="DataFinal" name="DataFinal" style="width: 40%">
                </div>
                <!-- Início Setor -->
                <div class="col-lg-2">Setor&nbsp;
                    <select id="Setor" name="Setor" style="width: 45%">
                        <option></option>
                        <?php
                            $RelacaoSetor = SetorCliente($conn);
                            foreach ($RelacaoSetor as $SetorOS) :
                        ?>
                        <option  value="<?=$SetorOS['idSetor']?>" ><?=utf8_encode($SetorOS['nSetor'])?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Fim Setor -->                
                <!-- Início TipoOS -->
                <div class="col-lg-2">Tipo OS&nbsp;
                    <select id="TipoOS" name="TipoOS" style="width: 50%">
                        <option></option>
                        <?php
                            $RelTipoOS = TipoOSCliente($conn);
                            foreach ($RelTipoOS as $TipoOS) :
                        ?>
                        <option  value="<?=$TipoOS['idTipoOs']?>" ><?=utf8_encode($TipoOS['nomeTiposo'])?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Fim TipoOS -->
<!--                 Início Status 
-->                <div class="col-lg-2">Status &nbsp;
                    <select id="status" name="status" style="width: 50%">
                        <option></option>
                        <?php 
                            $RelStatus = statusRelOS($conn);
                            foreach ($RelStatus as $statusOS) :
                        ?>
                        <option  value="<?=$statusOS['status']?>" ><?=utf8_encode($statusOS['status'])?></option>

                        <?php endforeach;  ?>
                    </select>
                </div><!--
                 Fim Status -->
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
        <th style="width: 30%">MOTIVOS OS</th>
        <th>CUSTO</th>
        <th>TIPO OS</th>
        <th>STATUS</th>
        <th class="text-center">AÇÕES</th>
    </tr>
    <?php
   $RelacaoOS = listaOS($conn, isset($_POST['DataInicial']) ? $_POST['DataInicial'] : null, 
            isset($_POST['DataFinal']) ? $_POST['DataFinal'] : null, 
            isset($_POST['Setor']) ? $_POST['Setor'] : null, 
            isset($_POST['TipoOS']) ? $_POST['TipoOS'] : null , isset($_POST['status']) ? $_POST['status'] : null );
       
    foreach ($RelacaoOS as $os) : ?>    
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
        <td><?="R$ ".number_format($os['TotalMaterial'],2, ',', '.'); ?></td>
        <td><?=utf8_encode($os['NomeTipoOS']); ?></td>
        <td><?=utf8_encode($os['status']); ?></td>
        <td >
            <a href="os-altera-formulario.php?id=<?=$os['id']?>" class="btn btn-warning"><span class="glyphicon glyphicon-copy"></span>&nbsp;OS</a>
        </td>
    </tr>
 <?php endforeach; ?>
</table>


<?php include 'rodape.php'; ?>




