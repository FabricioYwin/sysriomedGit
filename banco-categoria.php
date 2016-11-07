<?php

function listaCategorias($conn){
    $categorias = array();
    $query = "select * from rm_Categoria_Material";
    $resultado = sqlsrv_query($conn, $query);
    while($categoria = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)){
        array_push($categorias, $categoria);
    }
    return  $categorias;
}

