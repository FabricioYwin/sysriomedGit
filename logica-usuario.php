<?php
if( !isset($_SESSION) ){ session_start(); 
function usuarioEstaLogado(){
    return isset($_SESSION["usuario_logado"]);
}

function verificaUsuario(){
     if(!usuarioEstaLogado()) {
     $_SESSION["danger"] = "Você não tem acesso a essa funcionalidade.";
     header("Location: index.php");
     die();
    }     
 }
 
 function usuarioLogado(){
     return $_SESSION['usuario_logado'];
     
 }

 function logaUsuario($login){
     $_SESSION["usuario_logado"] = $login;
 }
 
 function logout(){
     session_destroy();
     session_start();
 }

}