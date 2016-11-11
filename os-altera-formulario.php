<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="Hege Refsnes">
   
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>..:: Rio Med ::..</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

      <div class="container">
          <div class="principal">

<?php 
//include "cabecalho.php";
 include "conecta.php";
 include "banco-os.php";
 include 'logica-usuario.php';
 include 'mpdf/mpdf.php';
 

/* @var $_GET type */
$id = $_GET['id'];
$os = buscaOs($conn, $id);

$resultadoHistOS = listaHistOS($conn, $id);

$resultadoMatOS = listaMatOS($conn, $id);
 


?>

<form action="altera-os.php" method="post">


<table  class="table table-striped table-responsive table-bordered">
    <tr>
        <td><img src="imagens/logo-mini.png" class="img-responsive img-rounded"></td>
        <td colspan="5">
            <p class="text-center">
                Av. Lobo Júnior, 688 - Penha Circular - Rio de Janeiro - RJ - CEP: 21020-125<br />
                Telefones: 2156-0500 Assistência Técnica: 2156-0525 E-mail: <a href="mailto:riomed@riomed.com.br">riomed@riomed.com.br</a><br/>
                    <a href="www.riomed.com.br">www.riomed.com.br</a>                
            </p>
        </td>
        <td colspan="2">ORDEMDE DE SERVIÇO<br /><br />
            
                           <?php $ID_form = utf8_encode("N. ".$os['id']." - ".$os['PrimeiroNome']);
                            echo $ID_form;
                           ?>
            <input  type="hidden" name="id" value="<?=$ID_form?>">
        </td>
    </tr>
        <tr>            
            <td>CLIENTE:</td>
            <td colspan="5">
                <p class="text-left">
                <?php $razaoSocial = utf8_encode($os['razaoSocial']);
                    echo $razaoSocial;
                ?>
                </p>
                <input  type="hidden" name="razaoSocial" value="<?=$razaoSocial?>">
            </td>
            
            <td>Data:</td>
            <td><p class="text-justify">
                    <?php $data = $os['dataHora']; 
                        if($data==NULL){
                            echo '00/00/00 00:00:00';
                        } else {
                            echo $data->format('d/m/Y'); 
                        }
                            ?>
                </p>
                <input type="hidden" name="data" value="<?php 
                    if($data==NULL){
                            echo '00/00/00 00:00:00';
                        } else {
                            echo $data->format('d/m/Y'); 
                        }
                        ?>">
            </td>
        </tr> 
        <tr>
            <td>ENDEREÇO:</td>
            <td><p class="text-justify">
                    <?php $endereco = utf8_encode($os['endereco']).", ".$os['enderecoNumero']; 
                echo $endereco; ?>
                </p>
                <input type="hidden" name="endereco" 
                       value="<?=$endereco?>" >
            </td>
            
            <td>BAIRRO:</td>
            <td><p class="text-justify">
                <?php $bairro = utf8_encode($os['enderecoBairro']);
                echo $bairro; ?></p>
                <input type="hidden" name="bairro" 
                       value="<?=$bairro?>">
            </td>
            
            <td>CIDADE:</td>
            <td><p class="text-justify">
                    <?php $cidade = utf8_encode($os['enderecoCidade']);
                    echo $cidade; ?>
                </p>
                <input type="hidden" name="cidade" 
                                       value="<?=$cidade;?>">
            </td>
            <td>UF:</td>
            <td>
                <p class="text-justify">
                <?php
                    $uf = $os['enderecoUF'];
                    echo $uf; ?>
                </p>
                <input  type="hidden" name="UF" 
                                       value="<?=$uf?>">
            </td>
        </tr>    
        <tr>
            <td>SOLICITANTE:</td>
            <td>
                <p class="text-justify">
                <?php $solicitante = utf8_encode($os['nomeUsuarioSolicitante']); 
                echo $solicitante; ?>
                </p>
                <input type="hidden" name="solicitante" 
                       value="<?=$solicitante?>" >
            </td>
            
            <td>LOCAL:</td>
            <td>
                <!-- Falta identificar o campo no DB -->
                <?php $local = ''; 
                echo $local; ?>
                <input type="hidden" name="local" 
                                       value="<?=$local?>">
            </td>
            <td>TELEFONE:</td>
            <td>
                <p class="text-justify">
                    <?php $telefone = $os['telefone'];
                    echo $telefone; ?>
                </p>
                <input type="hidden" name="telefone" 
                                       value="<?=$telefone?>">
            </td>
            <td>RAMAL:</td>
            <td>
                <p class="text-justify">
                    <?php $ramal = $os['ramal'];
                            echo $ramal; ?>
                </p>
                <input type="hidden" name="ramal" 
                                       value="<?=$ramal?>">
            </td>
        </tr>  
        <tr>
            <td>EQUIPAMENTO:</td>
            <td colspan="3">
                <p class="text-justify">
                    <?php $equipamento = utf8_encode($os['nomeEquip']);
                     echo $equipamento; ?>
                </p>
                <input type="hidden" name="equipamento" 
                       value="<?=$equipamento?>" >
            </td>
            
            <td>RM:</td>
            <td>
                <p class="text-justify">
                    <?php $rm = utf8_encode($os['rm']);
                    echo $rm; ?>
                </p>
                <input type="hidden" name="rm" 
                       value="<?=$rm?>" >
            </td>        
            <td colspan="2" rowspan="4" >
                <p class="center">
                    <?php $foto = $os['foto']; ?>
                    <img src="<?="http://riomed.ddns.net:7821/seci/resources/imagens/".$foto; ?>" title="<?=utf8_encode($equipamento);?>" class="img-responsive" style="width: 100px; height: 80px" />
                    
                    
                </p>
                <input type="hidden" name="foto" 
                       value="<?=$foto?>" >
            </td>
        </tr>    
        <tr>
            
            <td>MARCA:</td>
            <!-- Falta Identificar no Banco o campo Marca -->
            <td colspan="3">
                <p class="text-justify">
                    <?php $marca; ?>
                </p>
                <input  type="hidden" name="marca" 
                       value="<?=$marca?>" >
            </td>
            <td>MODELO</td>
            <td>
                <p class="text-justify">
                    <?php $modelo = utf8_encode($os['modelo']);
                    echo $modelo ?>
                </p>
                <input type="hidden" name="modelo" 
                       value="<?=$modelo?>" >
            </td>
            
        </tr>    
        <tr>
            <td>N. SÉRIE</td>
            <td colspan="3">
                <p class="text-justify">
                    <?php $nSerie = utf8_encode($os['nSerie']);
                    echo $nSerie; ?>
                </p>
                <input type="hidden" name="nserie" 
                       value="<?=$nSerie?>" >
            </td>
            <td>PATRIMÔNIO:</td>
            <td>
                <p class="text-justify">
                    <?php $patrimonio = utf8_encode($os['patrimonio']);
                        echo $patrimonio; ?>
                </p>
                <input type="hidden" name="patrimonio" 
                       value="<?=$patrimonio?>" >
            </td>
            
        </tr>    
        <tr>
            <td>SETOR</td>
            <td colspan="3">
                <p class="text-justify">
                    <?php $nomeSetor = utf8_encode($os['nomeSetor']);
                    echo $nomeSetor; ?>
                </p>
                <input type="hidden" name="nomeSetor" 
                       value="<?=$nomeSetor?>" >
            </td>
            <td>LOCALIZAÇÃO</td>
            <td>
                <p class="text-justify">
                    <?php $localizacao = utf8_encode($os['localizacao']);
                    echo $localizacao; ?>
                </p>
                <input type="hidden" name="localizacao" 
                       value="<?=$localizacao?>" >
            </td>           
        </tr>         
        <tr>
            <td>ACESSÓRIOS RETIRADOS</td>
            <td colspan="7">
                <p class="text-justify">
                    <?php echo $acessoriosRetirados = utf8_encode($os['acessoriosRetirados']); ?>
                </p>
                <input type="hidden" name="acessoriosRetirados" 
                       value="<?=$acessoriosRetirados?>"></td>
        </tr>    
        <tr>
            <td>MOTIVO</td>
            <td colspan="7">
                <p class="text-justify">
                  <?php echo $motivo = utf8_encode($os['TipoOS']); ?>                    
                </p>
                <input type="hidden" name="motivo" 
                       value="<?=$motivo?>"></td>
        </tr>        
        <tr>
            <td>ETAPA</td>
            <td colspan="4">APONTAMENTO</td>
            <td colspan="2">TÉCNICO</td>
            <td>DATA / HORA</td>
        </tr>
        <?php
                $HistOS = listaHistOS($conn, $id);
                    foreach ($HistOS as $Hist) :
                       
                ?>
        <tr>
            <td><?php echo $Hist['etapa']; ?></td>
            <td colspan="4"><?php echo utf8_encode($Hist['descricao']); ?></td>
            <td colspan="2"><?php echo $Hist['login']; ?></td>
            <td><?php $data = $Hist['dataHora']; 
                    if($data == null){
                        echo '00/00/00 00:00:00';
                    } else {
                    echo $data->format('d-m-Y H:i:s'); } 
                    ?></td>
        </tr>
            <?php endforeach; ?>
        
        <tr>
            <td>CÓD.:</td>
            <td colspan="5">PEÇAS APLICADAS</td>
            <td>QTD</td>
            <td>CUSTO</td>
        </tr>
        <tr>
            <?php
            $MatOS = listaMatOS($conn, $id);
                    foreach ($MatOS as $Mat) :
                       
                ?>
        <tr>
            <td><?php echo $Mat['id']; ?></td>
            <td colspan="5"><?php echo utf8_encode($Mat['nomeMat']); ?></td>
            <td><?php echo $Mat['quantidade']; ?></td>
            <td><?="R$ ".number_format($Mat['valorUnitario'],2,',','.'); ?></td>
        </tr>
            <?php endforeach; ?>
        
        <tr>
            <td>Observações:</td>
            <td colspan="7">
                <p class="text-justify">
                    <?php echo $observacoes = utf8_encode($os['observacoes']); ?>
                </p>
                <input type="hidden" name="observacoes" 
                       value="<?=$observacoes?>">
            </td>
        </tr>        
        <tr>
            <td>Horas Técniccas</td>
            <td colspan="7">
                <p class="text-justify">
                    <?php 
                    $horaTecnica =  $os['horasTecnicas'];
                    if($horaTecnica==null){
                    	echo '0 min';
                    } else {
                    echo $horaTecnica =  $os['horasTecnicas']." min"; } ?>
                </p>                    
                    <input type="hidden" name="horaTecnica" value="<?=$horaTecnica?>" >
            </td>
        </tr>
        <tr>
            <td>Retirado do setor por:</td>
            <td colspan="3">
                <p class="text-justify">
                    <?php echo $nomeUsuarioRetirado = utf8_encode($os['nomeUsuarioRetirado']); ?>
                </p>
                <input type="hidden" name="nomeUsuarioRetirado" value="<?=$nomeUsuarioRetirado?>">
            </td>
            <td rowspan="2" colspan="3">Autorizado por:
                <h4 class="text-center">
                    <?php echo $login = utf8_encode($os['login']); ?>
                </h4>
                <input type="hidden" name="login" value="<?=$login?>">
            </td>
            <td rowspan="2" >
                Data / Hora:
                <p class="text-center"><br />
                    <?php $dataHoraFinal = $os['dataHora']; 
                    echo $dataHoraFinal->format('d-m-Y H:i:s');
                    ?>
                </p>
                <input type="hidden" value="<?php 
                    if($dataHoraFinal==NULL){
                        echo '00/00/00 00:00:00';
                    } else {
                    echo $dataHoraFinal->format('d-m-Y H:i:s'); } ?>"
                            
            </td>
        </tr>
        <tr>
            <td>Concluído por:</td>
            <td colspan="3">
                <p class="text-justify">
                    <?php echo $nomeUsuarioAutorizado = utf8_encode($os['nomeUsuarioAutorizado']); ?>
                </p>
                <input type="hidden" name="nomeUsuarioAutorizado" value="<?=$nomeUsuarioAutorizado?>">
            </td>
        </tr>
        	<tr>
                <!-- 7 x 1 -->
                <td colspan="7"><p class="text-center">De acordo com os serviços realizados</p></td>
                <td>Satisfação</td>
            </tr>
            <tr>
            <!-- 5-2-1 -->
            <td colspan="5" rowspan="4"><p class="text-left">Responsável:</p>
                    
                    <h4 class="text-center">
                        <?php echo $nomeUsuarioResponsavel = utf8_encode($os['nomeUsuarioResponsavel']);  ?>
                    </h4>
                    <input type="hidden" name="nomeUsuarioResponsavel" value="<?=$nomeUsuarioResponsavel?>">
                    carimbo e assinatura
            </td>

            <td colspan="2" rowspan="4" >Data / Hora<br />
                <p class="text-center">
                    <?php $dataHoraAssinatura = $os['dataHoraAssinatura']; 
                    if ($dataHoraAssinatura == null){
                        echo '00/00/00 00:00:00';
                    }else{
                    echo $dataHoraAssinatura->format('d-m-Y H:i:s'); } ?>
                </p>
                <input  type="hidden" name="dataHoraAssinatura" 
                 value="<?php  if ($dataHoraAssinatura == null){
                        echo '00/00/00 00:00:00';
                    }else{
                    echo $dataHoraAssinatura->format('d-m-Y H:i:s'); }
                    ?>">   
            </td>
            <td rowspan="4">
               <input type="radio" name="satisfacao" value="<?=$os['CodSatisfacao']?>" />
                    
                 
                 <?php
                 if($os['satisfacao']==NULL){
                     echo "NÃO FOI INFORMADO";
                 } else {
                  echo   utf8_encode($os['satisfacao']);
                 }
                     ?>  
                    
                </td>
            </tr>
        </table>
    
        
</form>





