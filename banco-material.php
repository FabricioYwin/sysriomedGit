<?php
include 'conect/conecta.php';

 function listaMateriais($conn){
    $materiais = array();
    $resultado = sqlsrv_query($conn, "select m.id as IdMat, I.id as IdItem, M.nome, M.tipo, I.nSerie ,I.valorUnitario from medx.dbo.material as M join medx.dbo.itemMaterial as I on M.id=I.idMaterial");
        while ($material = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)){
            array_push($materiais, $material);
        }    
        return $materiais; 
 }
 
 function listaMatOS($conn, $nomeMat){
     $histMatOS = array();
     $resultado = sqlsrv_query($conn, "SELECT os.id as IdOS, material.id as idMat, material.nome as nomeMat, 
         itemMaterial.nSerie, itemMaterial.valorUnitario, os.motivoOs, os.status FROM os 
  inner join itemMaterial on
  itemMaterial.id = os.id

inner join material on
material.id = itemMaterial.idMaterial 
where material.nome like {$nomeMat}");
     while ($histMat = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)){
         array_push($histMatOS, $histMat);
     }
    return $histMatOS;
     
 }
 
 function buscaMaterial($conn, $IdItem){
    $query = "select m.id as IdMat, I.id as IdItem, M.nome, M.tipo, I.nSerie ,I.valorUnitario from medx.dbo.material as M INNER JOIN medx.dbo.itemMaterial as I on M.id=I.idMaterial where I.Id = {$IdItem}";
    $resultado = sqlsrv_query($conn, $query) or die(print_r(sqlsrv_errors()));
    return sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC);
}




function alteraMaterial($conn, $IdItem, $valorUnitario){
    $query = "update medx.dbo.itemMaterial set valorUnitario = {$valorUnitario} where id = '{$IdItem}'";
    return sqlsrv_query($conn, $query);    
}


