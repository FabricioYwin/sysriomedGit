<?php 
    include 'cabecalho.php';
    include 'conect/conecta.php';
    include 'banco-usuario.php'; 
    include 'banco-os.php';
    include 'logica-usuario.php';
 ?>
<link rel="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function(){
    $('#DT_OS_Lista').DataTable({
        "language": {
            "lengthMenu": "Exibindo _MENU_ registros por páginas",
            "zeroRecords": "Nenhum resultado encontrado",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum resultado disponível",
            "sSearch": "Pesquisar: ",
            "infoFiltered": "(Número _MAX_ total registros)",
            "processing": true,
        "serverSide": true,
            "ajax": "../scripts/script_busca.php",
        
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        }});
});
        
    </script>


<?php if(isset($_SESSION["success"])) { ?>
    <p class="alert-success"><?= $_SESSION["success"]?></p>
<?php
    unset($_SESSION["success"]);
} ?>
    <div class="container-fluid" >
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
    

<!--<table id="DT_OS_Lista" class="table table-bordered table-condensed table-hover table-striped" data-toggle="bootgrid" data-ajax="true" data-url="/api/data/basic">-->
<table id="DT_OS_Lista" class=" display table table-bordered table-condensed table-hover table-striped" >
    <thead>
        <tr>
            <th>ID</th>
            <th>DATA</th>
            <th>CLIENTE</th>
            <th style="width: 150px;">SETOR</th>       
            <th style="width: 150px;">MOTIVOS OS</th>
            <!--<th >MOTIVOS OS</th>-->
            <th>CUSTO TOTAL</th>
            <th>TIPO OS</th>
            <th style="width: 150px;">STATUS</th>
            <th style="width: 200px;">AÇÕES</th>
<!--            <th class="text-center">AÇÕES</th>-->
        </tr>
    </thead>
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
                echo $data->format('d/m/Y');
            ?>
        </td>       
        <td><?=utf8_encode($os['nomeFantasia']); ?></td>
        <td><?=utf8_encode($os['NomeSetor']); ?></td>       
        <td><?=utf8_encode($os['motivoOs']); ?></td>
        <td><?="R$ ".number_format($os['TotalMaterial'],2, ',', '.'); ?></td>
        <td><?=utf8_encode($os['NomeTipoOS']); ?></td>
        <td><?=utf8_encode($os['status']); ?></td>
        <td >
            <a href="os-altera-formulario.php?id=<?=$os['id']?>" target="_blank" class="btn btn-warning"><span class="glyphicon glyphicon-copy"></span>&nbsp;OS</a>
            <a href="os-pdf.php?id=<?=$os['id']?>" target="_blank" class="btn btn-warning"><img src="imagens/pdf.png" style="width: 25px; height: 20px;"> PDF</a>
        </td>
    </tr>
 <?php endforeach; ?>
</table>
    <br /><br />

<?php include 'rodape.php'; ?>