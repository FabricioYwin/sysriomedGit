<?php
    function buscaUsuario($conn, $login, $senha){
        $query = "select id, idCliente, login, senha from usuario where login = '{$login}' and senha = '{$senha}'";  
        $resultado = sqlsrv_query($conn, $query); 
        $usuario = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC);
        return $usuario;
        
    }
    


