<?php include 'conect/conecta.php';
 include 'banco-usuario.php';
 include 'logica-usuario.php';

$usuario = buscaUsuario($conn, 
        filter_input(INPUT_POST, 'login'), 
        filter_input(INPUT_POST, 'senha')        
        );     

        if($usuario == null){
            $_SESSION["danger"] = "USUÁRIO OU SENHA INVÁLIDA.";
            header("Location: index.php");
        }else{
            $_SESSION["success"] = "USUÁRIO LOGADO COM SUCESSO.";
            logaUsuario($usuario['login']);
            header("Location: os-lista.php");
        }
        die();




