<?php include 'cabecalho.php';
 include 'conecta.php';
 include 'banco-material.php';

$IdMat = $_POST['IdMat'];
$IdItem = $_POST['IdItem'];
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$nSerie = $_POST['nSerie'];
$valorUnitario = $_POST['valorUnitario'];


//if(array_key_exists('usado', $_POST)){
//    $usado = "true";
//} else {
//    $usado = "false";
//}

if(alteraMaterial($conn, $IdItem, $valorUnitario)) { ?>
    <p class="text-success">O Material <?=$nome; ?>, <?=$valorUnitario ?> foi alterado.</p>
<?php } else { 
    $msg = sqlsrv_errors($conn);
    ?>
    <p class="text-danger">O Material <?=$nome; ?> não foi alterado: <?=$msg; ?></p>
<?php 
}

include 'rodape.php'; ?>


