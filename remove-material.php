<?php include 'cabecalho.php';
 include 'conecta.php';
 include 'banco-material.php';
 include 'logica-usuario.php';
 
 $id = $_GET['id']; 
 removeMaterial($conn, $id);
 $_SESSION["seccuss"] = "MATERIAL REMOVIDO COM SUCESSO!!!";
 header("Location: material-lista.phpe");
 die();



