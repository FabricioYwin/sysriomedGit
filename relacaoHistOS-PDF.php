<?php
include 'banco-os.php';
$HistOS = listaHistOS($conn, $id);
    foreach ($HistOS as $Hist)
    :
        
        if($Hist['dataHora']->format('d/m/Y') == null){
            $HistData = '00/00/00 00:00:00';
        } else {
            $HistData = $Hist['dataHora']->format('d/m/Y H:m');        
        }
      ?>
       <tr>
                    <td>".$Hist['etapa']."</td>
                    <td colspan='4'>".utf8_encode($Hist['descricao'])."</td>
                    <td colspan='2'>".$Hist['login']."</td>
                    <td>".$HistData."</td>
                </tr>
        <?php
    endforeach;
