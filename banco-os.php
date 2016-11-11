<?php

 function listaOS($conn, $DataInicial = NULL, $DataFinal = NULL, $Setor = NULL, $TipoOS = NULL, $status = NULL  ){   
    $RelacaoOS = array();
    $where = [];
    $where[] = "cliente.id = (select usuario.idCliente from usuario where usuario.login = '".usuarioLogado()."')";
     
    if ($DataInicial) {
        $where[] = "os.dataHora >= '{$DataInicial}'";
    }
    if($DataFinal) {
        $where[] = "os.dataHora <= '{$DataFinal}'";    
    }
    if ($Setor) {
        $where[] = "setor.id = '{$Setor}'";    
    }
    if ($status) {
        $where[] = "os.status = '{$status}'"; 
    }
    if ($TipoOS) {
        $where[] = "os.idTipoOs = '{$TipoOS}'";
    }
        
        $SQL = "select os.id, os.dataHora, cliente.nomeFantasia, 
        setor.nome as NomeSetor, os.motivoOs, 
        (select sum(itemMaterial.valorUnitario) from os as OS1

inner join itemMaterial on 
itemMaterial.id = os.idItemMaterial 
where OS1.id = os.id ) as TotalMaterial,
        
tipoOs.nome as NomeTipoOS,
	 itemMaterial.nSerie, itemMaterial.rm, os.status from os

inner join itemMaterial on
itemMaterial.id = os.idItemMaterial

inner join modelo on
modelo.id = itemMaterial.idModelo

inner join material on
material.id = itemMaterial.idMaterial

inner join cliente on 
cliente.id = os.idCliente

inner join setor on
setor.id = os.idSetor

inner join usuario on
usuario.id = os.idUsuarioFinal

inner join tipoOs on
tipoOs.id = os.idTipoOs

where " . implode(' AND ', $where) . "

order by dataHora DESC";
        
        $resultado = sqlsrv_query($conn, $SQL);
    
    while ($os = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)){;
        array_push($RelacaoOS, $os);
    }
    
    return $RelacaoOS;
    
 }
 
 function SetorCliente($conn){
     $RelacaoSetor = array();
     $resultadoSetor = sqlsrv_query($conn, "select setor.id as idSetor, setor.nome as nSetor from os 
         inner join cliente on cliente.id = os.idCliente
         inner join setor on setor.idCliente = cliente.id
where cliente.id = (select usuario.idCliente from usuario where usuario.login = '". usuarioLogado()."' )
group by setor.id, setor.nome order by setor.nome");
     while ($SetorOS = sqlsrv_fetch_array($resultadoSetor, SQLSRV_FETCH_ASSOC)){;
        array_push($RelacaoSetor, $SetorOS);
     }
     return $RelacaoSetor;
 }
 
 function TipoOSCliente($conn){
     $RelTipoOS = array();
     $resultadoTipoOS = sqlsrv_query($conn, "SELECT distinct idTipoOs, tipoOs.nome as nomeTiposo FROM os

inner join tipoOs on tipoOs.id = os.idTipoOs
inner join cliente on cliente.id = os.idCliente

where cliente.id = (select usuario.idCliente from usuario where usuario.login = '". usuarioLogado()."' )
order by tipoOs.nome");
     while ($TipoOS = sqlsrv_fetch_array($resultadoTipoOS, SQLSRV_FETCH_ASSOC)){;
        array_push($RelTipoOS, $TipoOS);
     }
     
     return $RelTipoOS;
 }

 function statusRelOS($conn){
     $RelStatus = array();
     $resultadoStatus = sqlsrv_query($conn, "select status from os group by status order by status");
     while ($statusOS = sqlsrv_fetch_array($resultadoStatus, SQLSRV_FETCH_ASSOC)){;
        array_push($RelStatus, $statusOS );
     }     
     return $RelStatus;
 }

 function listaHistOS($conn, $id){
    $HistOS = array();
    
    $resultadoHistOS = sqlsrv_query($conn, "select os.id as IdOs, historicoOS.etapa, historicoOS.descricao, 
        usuario.login, historicoOS.dataHora  from os 

            inner join historicoOS on
            os.id = historicoOS.idOs

            inner join usuario on
            usuario.id = historicoOS.idUsuario

            where os.id = {$id}");
    
    while ($Hist = sqlsrv_fetch_array($resultadoHistOS, SQLSRV_FETCH_ASSOC)){
        array_push($HistOS, $Hist);
    }
    return $HistOS;
 }
 
 function listaMatOS($conn, $id){
    $MatOS = array();
    
    $resultadoMatOS = sqlsrv_query($conn, "select distinct os.id as IdOS, material.id, Material.nome as nomeMat, 
        itemMaterial.matQuantidade as Quant, itemMaterial.valorUnitario from os 

        inner join itemMaterial on
        itemMaterial.id = os.idItemMaterial 

        inner join material on
        material.id = itemMaterial.idMaterial

        inner join movimentoItemMaterial on
        itemMaterial.id = movimentoItemMaterial.idItemMaterial

        where  os.id = {$id}");
    
    while ($Mat = sqlsrv_fetch_array($resultadoMatOS, SQLSRV_FETCH_ASSOC)){
        array_push($MatOS, $Mat);
    }
    return $MatOS;
 }
 
 


 function buscaOs($conn, $id){
     $query = "select  os.id,  cliente.razaoSocial, os.dataHora,  cliente.endereco, 
        cliente.enderecoNumero,  cliente.enderecoBairro,  cliente.enderecoCidade, 
        cliente.enderecoUF,  os.nomeUsuarioSolicitante,  cliente.telefone,  cliente.ramal,   material.nome as nomeEquip,  
    itemMaterial.rm,  modelo.foto, modelo.nome as modelo, itemMaterial.nSerie, itemMaterial.patrimonio, 
 setor.nome as nomeSetor, itemMaterial.localizacao, os.acessoriosRetirados, tipoOs.nome as TipoOS, os.motivoOs, 
 os.observacoes, os.horasTecnicas, os.nomeUsuarioRetirado, usuario.login, os.nomeUsuarioAutorizado, os.dataHoraFinal, 
 os.nomeUsuarioResponsavel, 
os.dataHoraAssinatura, 
 
case satisfacao	
	when 'Bom' then 1	
	when 'Ruim' then 2
	when 'Ótimo' then 3
	when 'Regular' then 4
	else 5	
	end as CodSatisfacao, 
        
os.satisfacao

from os 

inner join itemMaterial on
itemMaterial.id = os.idItemMaterial

inner join modelo on
modelo.id = itemMaterial.idModelo

inner join material on
material.id = itemMaterial.idMaterial

inner join cliente on 
cliente.id = os.idCliente

inner join setor on
setor.id = os.idSetor

inner join usuario on
usuario.id = os.idUsuarioFinal

inner join tipoOs on
tipoOs.id = os.idTipoOs

 where  os.id = {$id}";

  $resultado = sqlsrv_query($conn, $query) or die(print_r(sqlsrv_errors()));
    return sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC);
    echo $query;
 }
 
 function listaCustoSetor($conn, $DataInicial = NULL, $DataFinal = NULL){
    $RelacaoCustoSetor = array();
    $where = [];
    $where[] = "cliente.id = (select usuario.idCliente from usuario where usuario.login = '".usuarioLogado()."')";
    
    if ($DataInicial) {
        $where[] = "os.dataHora >= '{$DataInicial}'";
    }
    if($DataFinal) {
        $where[] = "os.dataHora <= '{$DataFinal}'";    
    }
    
    $SQL = "SELECT setor.nome as nomeSetor, count(os.id) as QtdOS, sum(itemMaterial.valorUnitario) as CustoTotal
  FROM os

  inner join setor on
  setor.id = os.idSetor

  inner join itemMaterial on 
  ItemMaterial.id = os.idItemMaterial

  inner join cliente on
  cliente.id = os.idCliente

    where " . implode(' AND ', $where) . "  

  group by setor.nome";
    
    $resultado = sqlsrv_query($conn, $SQL);
    
    while ($CustoSetor = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)){;
        array_push($RelacaoCustoSetor, $CustoSetor);
    }
    
    return $RelacaoCustoSetor;
 }
 

