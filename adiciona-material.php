<?php include 'cabecalho.php';
 include 'conecta.php';
 include 'banco-material.php';
 include 'logica-usuario.php';
 
 verificaUsuario(); 

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$categoria_id = $_POST['categoria_id'];
//if(array_key_exists('marcado', $_POST)){
//    $marcado = "true";
//} else {
//    $marcado = "false";
//}
    
if(insereMaterial($conn, $nome, $preco, $categoria_id)) { ?>
    <p class="text-success">O Material <?=$nome; ?>, <?=$preco ?> foi adicionado com sucesso.</p>
<?php } else { 
    $msg = sqlsrv_errors($conn);
    ?>
    <p class="text-danger">O Material <?=$nome; ?> não foi adicionado: <?=$msg; ?></p>
<?php 
}

include 'rodape.php'; ?>


