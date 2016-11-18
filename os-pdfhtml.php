<?php 
    include 'MPDF57/mpdf.php';
 include 'conect/conecta.php';
 include 'banco-os.php';
 include 'logica-usuario.php';
 
 
/* @var $_GET type */
$id = $_GET['id'];

$os = buscaOs($conn, $id);
$resultadoHistOS = listaHistOS($conn, $id);
$resultadoMatOS = listaMatOS($conn, $id);

if($os['dataHora']->format('d/m/Y') == null){
    $dataHora = '00/00/00';
} else {
    $dataHora = $os['dataHora']->format('d/m/Y');
}

$html1 = "
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <link href='css/bootstrap.min.css' media='print' rel='stylesheet'>
    <link href='css/estiloOS.css' media='print' rel='stylesheet' >
</head>   
<boby>
    <table  class='table table-striped table-responsive table-bordered' >
        <tr>
            <td><img src='imagens/logo-mini.png' class='img-responsive img-rounded'></td>
            <td colspan='5'>
                <p class='objCenter'>            
                    Av. Lobo Júnior, 688 - Penha Circular - Rio de Janeiro - RJ<br>CEP: 21020-125
                    Telefones: 2156-0500<br > Assistência Técnica: 2156-0525 <br>
                    E-mail: <a href='mailto:riomed@riomed.com.br'>riomed@riomed.com.br</a> - Site: <a href='www.riomed.com.br'>www.riomed.com.br</a>                
                </p>
            </td>
            <td colspan='2'>ORDEMDE DE SERVIÇO<br /><br />
                N. ".$os['id']."
            </td>
        </tr>
        <tr>
            <td>CLIENTE:</td>            
            <td colspan='5'>
                <p class='text-left'>".utf8_encode($os['razaoSocial'])."</p>
            </td>
            <td>Data:</td>
            <td>
                <p class='text-justify'>".$dataHora."</p>
            </td>
        </tr>
        <tr>
            <td>ENDEREÇO:</td>
            <td>
                <p class='text-justify'>".utf8_encode($os['endereco']).", ".$os['enderecoNumero']."</p>            
            </td>
            <td>BAIRRO:</td>
            <td>
                <p class='text-justify'>".utf8_encode($os['enderecoBairro'])."
            </td>
            <td>CIDADE:</td>
            <td>
                <p class='text-justify'>".utf8_encode($os['enderecoCidade'])."</p>
            </td>
            <td>UF:</td>
            <td>
                <p class='text-justify'>".$os['enderecoUF']."</p>
            </td>
        </tr>
        <tr>
            <td>SOLICITANTE:</td>
            <td>
                <p class='text-justify'>".utf8_encode($os['nomeUsuarioSolicitante'])."</p>
            </td>
            <td>LOCAL:</td>
            <td>
                <p class='text-justify'>".$local."</p>
            </td>
            <td>TELEFONE:</td>
            <td>
                <p class='text-justify'>".$os['telefone']."</p>
            </td>
            <td>RAMAL:</td>
            <td>
                <p class='text-justify'>".$os['ramal']."</p>
            </td>
        </tr>
        <tr>
            <td>EQUIPAMENTO:</td>
            <td colspan='3'>
                <p class='text-justify'>".utf8_encode($os['nomeEquip'])."</p>
            </td>
            <td>RM:</td>
            <td>
                <p class='text-justify'>".utf8_encode($os['rm'])."</p>
            </td>
            <td colspan='2' rowspan='4' >
                <p class='center'>
                    <img src='http://riomed.ddns.net:7821/seci/resources/imagens/".$os['foto']."' title='".utf8_encode($equipamento)."' id='fotoOS' />
                </p>
            </td>
        </tr>
        <tr>
            <td>MARCA:</td>
            <!-- Falta Identificar no Banco o campo Marca -->
            <td colspan='3'>
                <p class='text-justify'>".$marca."</p>
            </td>
            <td>MODELO</td>
            <td>
                <p class='text-justify'>".utf8_encode($os['modelo'])."</p>
            </td>
        </tr>
        <tr>
            <td>N. SÉRIE:</td>
            <td colspan='3'>
                <p class='text-justify'>".utf8_encode($os['nSerie'])."</p>
            </td>  
            <td>PATRIMÔNIO:</td>
            <td colspan='3'>
                <p class='text-justify'>".utf8_encode($os['patrimonio'])."</p>
            </td>
        </tr>
        <tr>
            <td>SETOR</td>
            <td colspan='3'>
                <p class='text-justify'>".utf8_encode($os['nomeSetor'])."</p>
            </td>
            <td>LOCALIZAÇÃO</td>
            <td>
                <p class='text-justify'>".utf8_encode($os['localizacao'])."</p>
            </td>           
        </tr>  
        <tr>
            <td>ACESSÓRIOS RETIRADOS</td>
            <td colspan='7'>
                <p class='text-justify'>".utf8_encode($os['acessoriosRetirados'])."</p>
            </td>
        </tr>
        <tr>
            <td>MOTIVO</td>
            <td colspan='7'>
                <p class='text-justify'>".utf8_encode($os['TipoOS'])."</p>
            </td>
        </tr>
        <tr>
            <td>ETAPA</td>
            <td colspan='4'>APONTAMENTO</td>
            <td colspan='2'>TÉCNICO</td>
            <td>DATA / HORA</td>
        </tr>";
    
$HistOS = listaHistOS($conn, $id);
    foreach ($HistOS as $Hist)
    :
        if($Hist['dataHora']->format('d/m/Y') == null){
            $HistData = '00/00/00 00:00:00';
        } else {
            $HistData = $Hist['dataHora']->format('d/m/Y H:m');        
        }
        
    $html2 = "  <tr>
                    <td>".$Hist['etapa']."</td>
                    <td colspan='4'>".utf8_encode($Hist['descricao'])."</td>
                    <td colspan='2'>".$Hist['login']."</td>
                    <td>".$HistData."</td>";
    endforeach;
    $html3 = "</tr>
        <tr>
            <td>CÓD.:</td>
            <td colspan='5'>PEÇAS APLICADAS</td>
            <td>QTD</td>
            <td>CUSTO</td>
        </tr>
        <tr>";
        $MatOS = listaMatOS($conn, $id);
                    foreach ($MatOS as $Mat) :
    $html4 = "
        <tr>
            <td>".$Mat['id']."</td>
            <td colspan='5'>".utf8_encode($Mat['nomeMat'])."</td>
            <td>"; 
            if($Mat['Quant']==null)
                { $QuantMat =  '0';
                }else { $QuantMat =  $Mat['Quant']; }
           $html5 = "</td>
            <td>R$ ".number_format($Mat['valorUnitario'],2,',','.')."</td>
        </tr>";
           endforeach;
          $html6 = "
              </table>
        </body>
</html>";
          
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('d/m/Y H:i');

    $arquivo = $date." - OS-PDF.pdf";

    $mpdf = new mPDF();
    $mpdf->SetDisplayMode('fullpage');
  
    $mpdf->writeHTML($html1."".$html2."".$html3."".$html4."".$html5."".$html6);

    $mpdf->Output($arquivo, 'I');

 ?>