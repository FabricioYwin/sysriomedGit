<?php
include 'logica-usuario.php';
logout();
$_SESSION['success'] = "DESLOGADO COM SUCESSO!";
header("Location: index.php");
die();

