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

if($os['horasTecnicas']==null)
    {
       $horaTecnica = '0 min';
    } else {
    $horaTecnica =  $os['horasTecnicas']." min"; }
    
    if($os['dataHoraFinal']==NULL){
        $dataHoraFinal = '00/00/00 00:00:00';
    } else {
    $dataHoraFinal = $os['dataHoraFinal']->format('d/m/Y H:i:s'); }
    
    if ($os['dataHoraAssinatura'] == null){
    $dataHoraAssinatura = '00/00/00 00:00:00';
    }else{
    $dataHoraAssinatura = $os['dataHoraAssinatura']->format('d-m-Y H:i:s'); } 
    
    if($os['satisfacao']==NULL){
        $satisfacao =  "NÃO FOI INFORMADO";
    } else {
    $satisfacao =  utf8_encode($os['satisfacao']);
                 }

$html1 = "
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <style media='print'>
        body {

        font-family: sans-serif;

    }

    a {

        color: #000066;

        text-decoration: none;

    }

    table {

        border-collapse: collapse;

    }

    thead {

        vertical-align: bottom;

        text-align: center;

        font-weight: bold;

    }

    tfoot {

        text-align: center;

        font-weight: bold;

    }

    th {

        text-align: left;

        padding-left: 0.35em;

        padding-right: 0.35em;

        padding-top: 0.35em;

        padding-bottom: 0.35em;

        vertical-align: top;

    }

    td {

        padding-left: 0.35em;

        padding-right: 0.35em;

        padding-top: 0.35em;

        padding-bottom: 0.35em;

        vertical-align: top;

    }
    .textCenter{
        text-align: center;
        }

    img {

        margin: 0.2em;

        vertical-align: middle;

    }
    </style>
     <link href='css/bootstrap.css' media='print' rel='stylesheet'>
    <link href='css/estiloOS.css' media='print' rel='stylesheet' >
</head>   
<boby>
    <table border='1' class='table table-striped' cellspacing='10' cellpadding='0' style='font-size: 12px;' >
   
        <tr>
            <td colspan='1'><img src='imagens/logo-mini.png' class='img-responsive img-rounded'></td>
            <td colspan='8' class='textCenter'>
                <p class='objCenter'>            
                    Av. Lobo Júnior, 688 - Penha Circular - Rio de Janeiro - RJ<br>CEP: 21020-125
                    Telefones: 2156-0500<br > Assistência Técnica: 2156-0525 <br>
                    E-mail: <a href='mailto:riomed@riomed.com.br'>riomed@riomed.com.br</a> - Site: <a href='www.riomed.com.br'>www.riomed.com.br</a>                
                </p>
            </td>
            <td colspan='3' class='textCenter'>ORDEMDE DE SERVIÇO<br /><br />
                N. ".$os['id']."
            </td>
        </tr>
        <tr>
            <td colspan='9'>CLIENTE:&nbsp;".utf8_encode($os['razaoSocial'])."</td>
            <td colspan='3'>Data:&nbsp;".$dataHora."</td>
        </tr>
        <tr>
            <td colspan='5'>ENDEREÇO:&nbsp;".utf8_encode($os['endereco']).", ".$os['enderecoNumero']."</td>
            <td colspan='2'>BAIRRO:&nbsp;".utf8_encode($os['enderecoBairro'])."</td>
            <td colspan='4'>CIDADE:&nbsp;".utf8_encode($os['enderecoCidade'])."</td>
            <td colspan='1'>UF:&nbsp;".$os['enderecoUF']."</td>
        </tr>
        <tr>
            <td colspan='3'>SOLICITANTE:&nbsp;".utf8_encode($os['nomeUsuarioSolicitante'])."</td>
            <td colspan='4'>LOCAL:&nbsp;".$local."</td>
            <td colspan='4'>TELEFONE:".$os['telefone']."</td>
            <td>RAMAL:&nbsp;".$os['ramal']."</td>
        </tr>
        <!-- 8 Colunas -->
        <tr>
            <td colspan='7'>EQUIPAMENTO: ".utf8_encode($os['nomeEquip'])."</td>
            <td colspan='3'>RM:".utf8_encode($os['rm'])."</td>
            <td colspan='2' rowspan='4' >
                <p class='center'>
                    <img src='http://riomed.ddns.net:7821/seci/resources/imagens/".$os['foto']."' title='".utf8_encode($equipamento)."' id='fotoOS' />
                </p>
            </td>
        </tr>
        <!-- 6 Colunas -->
        <tr>
            <!-- Falta Identificar no Banco o campo Marca -->
            <td colspan='5'>MARCA:".$marca."</td>
            <td colspan='4'>MODELO: ".utf8_encode($os['modelo'])."</td>
        </tr>
        <tr>
            <td colspan='5'>N. SÉRIE: ".utf8_encode($os['nSerie'])."</td>  
            <td colspan='4'>PATRIMÔNIO: ".utf8_encode($os['patrimonio'])."</td>
        </tr>
        <tr>
            <td colspan='5'>SETOR: ".utf8_encode($os['nomeSetor'])."</td>
            <td colspan='4'>LOCALIZAÇÃO: ".utf8_encode($os['localizacao'])."</td>           
        </tr>  
        <tr>
            <td>ACESSÓRIOS RETIRADOS</td>
            <td colspan='11'>
                <p class='text-justify'>".utf8_encode($os['acessoriosRetirados'])."</p>
            </td>
        </tr>
        <tr>
            <td>MOTIVO</td>
            <td colspan='11'>".utf8_encode($os['TipoOS'])."</td>
        </tr>
        <tr>
            <td colspan='1'>ETAPA</td>
            <td colspan='7'>APONTAMENTO</td>
            <td colspan='2'>TÉCNICO</td>
            <td COLSPAN='2'>DATA / HORA</td>
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
                    <td colspan='1'>".$Hist['etapa']."</td>
                    <td colspan='7'>".utf8_encode($Hist['descricao'])."</td>
                    <td colspan='2'>".$Hist['login']."</td>
                    <td COLSPAN='2'>".$HistData."</td>";
    endforeach;
    $html3 = "</tr>
        <tr>
            <td colspan='1'>CÓD.:</td>
            <td colspan='9'>PEÇAS APLICADAS</td>
            <td colspan='1'>QTD</td>
            <td colspan='1'>CUSTO</td>
        </tr>
        <tr>";
        $MatOS = listaMatOS($conn, $id);
                    foreach ($MatOS as $Mat) :
    $html4 = "
        <tr>
            <td colspan='1'>".$Mat['id']."</td>
            <td colspan='9'>".utf8_encode($Mat['nomeMat'])."</td>
            <td colspan='1'>"; 
            if($Mat['Quant']==null)
                { $QuantMat =  '0';
                }else { $QuantMat =  $Mat['Quant']; }
           $html5 = "</td>
            <td colspan='1'>R$ ".number_format($Mat['valorUnitario'],2,',','.')."</td>
        </tr>";
           endforeach;
          $html6 = "
        
        <tr>
            <td colspan='1'>Observações:</td>
            <td colspan='11'>".utf8_encode($os['observacoes'])."</td>
        </tr>
        <tr>
            <td colspan='1'>Horas Técniccas</td>
            <td colspan='11'>".$horaTecnica."</td>
        </tr>
        <tr>
            <td colspan='8'>Retirado do setor por: ".utf8_encode($os['nomeUsuarioRetirado'])."</p>
            </td>
            <td rowspan='2' colspan='3'>Autorizado por:
                <h4 class='text-center'>".utf8_encode($os['login'])."</h4>               
            </td>
            <td rowspan='2'>
                Data / Hora:
                <p class='text-center'><br />".$dataHoraFinal."</p>
            </td>
        </tr>
        <tr>
            <td colspan='8'>Concluído por:".utf8_encode($os['nomeUsuarioAutorizado'])."</td>
        </tr>
        <tr>
            <!-- 7 x 1 -->
            <td colspan='11'><p class='text-center'>De acordo com os serviços realizados</p></td>
            <td>Satisfação</td>
        </tr>
        <tr>
            <!-- 5-2-1 -->
            <td colspan='7' rowspan='4'><p class='text-left'>Responsável:</p>
            <h4 class='text-center'>".utf8_encode($os['nomeUsuarioResponsavel'])."</h4>
                Carimbo e Assinatura
            </td>
            <td colspan='4' rowspan='4' >Data / Hora<br />
                <p class='text-center'>".$dataHoraAssinatura."</p>
            </td>
            <td rowspan='4'>
                ".$satisfacao."
            </td>
        </tr>
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