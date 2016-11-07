<?php
    include 'conecta.php';
    include 'banco-material.php';
    include 'cabecalho.php'; ?>

    <form class="form-horizontal">
    <div class="container">
        
        <div class="col-lg-1"><h3>Material:</h3></div>
            <div class="col-lg-10">
                <input id="buscaMaterial" class="form-control" placeholder="Digite o nome do material"></div>
            <div class="col-lg-1"><button class="btn btn-warning">Buscar</button></div>
        
    </div>

 
 <table class="table table-striped table-striped table-bordered">
     <tr>
         <th>ID OS</th>
         <th>ID Mat</th>
         <th>Nome:</th>
         <th>N. Série</th>
         <th>Valor</th>
         <th>Motivo O.S.</th>
         <th>Status</th>
     </tr>
     
         <?php
    $histMatOS = listaMatOS($conn, $nomeMat);
    foreach ($histMatOS as $histMat ): ?>
         
    <tr>
         <td><?= $histMat['IdOS']; ?></td>
         <td><?=$histMat['idMat']?></td>
         <td><?=utf8_encode($histMat['nomeMat'])?></td>
         <td><?=utf8_encode($histMat['nSerie'])?></td>
         <td><?=$histMat['valorUnitario']?></td>
         <td><?=utf8_encode($histMat['motivoOs'])?></td>
         <td><?=utf8_encode($histMat['status'])?></td>
                 
     </tr>
     <?php endforeach; ?>
 </table>
    
    </form>
    <?php   include 'rodape.php'; ?>


