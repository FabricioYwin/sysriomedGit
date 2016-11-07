<?php

 function listaOS($conn, $DataInicial = NULL, $DataFinal = NULL, $Setor = NULL, $Status = NULL){   
    $where = [];
    $where[] = "(cliente.id = (select usuario.idCliente from usuario where usuario.login = '".usuarioLogado()."' ) and
    (os.dataHora  between CONVERT(datetime, {$dataInicial}, 105) and CONVERT(datetime, {$DataFinal}, 105)+1)) and"
    . "setor.id = {$Setor} and os.status = {$Status}";
    $resultado = sqlsrv_query($conn, "select os.id, os.dataHora, cliente.nomeFantasia, 
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

order by dataHora DESC");
    
    while ($os = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)){;
        array_push($RelacaoOS, $os);
    }
    
    return $RelacaoOS;
    
 }
 
 function SetorCliente($conn){
     $RelacaoSetor = array();
     $resultado = sqlsrv_query($conn, "select setor.id as idSetor, setor.nome as nSetor from os 
         inner join cliente on cliente.id = os.idCliente
         inner join setor on setor.id = os.idSetor
where cliente.id = (select usuario.idCliente from usuario where usuario.login = '". usuarioLogado()."' )
group by setor.id, setor.nome order by setor.nome");
     while ($SetorOS = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)){;
        array_push($RelacaoSetor, $SetorOS);
     }
     return $RelacaoSetor;
 }

 function statusOS($conn){
     $statusOS = array();
     $resultado = sqlsrv_query($conn, "select status from os group by status order by status");
     while ($RelStatus = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)){;
        array_push($statusOS, $RelStatus);
     }
     return $statusOS;
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
     $query = "select  os.id,  cliente.razaoSocial, (select left(razaoSocial, CHARINDEX(' ', razaoSocial)-1) from cliente where id = 79 ) as PrimeiroNome, os.dataHora,  cliente.endereco, 
        cliente.enderecoNumero,  cliente.enderecoBairro,  cliente.enderecoCidade, 
        cliente.enderecoUF,  os.nomeUsuarioSolicitante,  cliente.telefone,  cliente.ramal,   material.nome as nomeEquip,  
    itemMaterial.rm,  modelo.foto, modelo.nome as modelo, itemMaterial.nSerie, itemMaterial.patrimonio, 
 setor.nome as nomeSetor, itemMaterial.localizacao, os.acessoriosRetirados, tipoOs.nome as TipoOS, os.motivoOs, 
 os.observacoes, os.horasTecnicas, os.nomeUsuarioRetirado, usuario.login, os.nomeUsuarioAutorizado, os.dataHoraFinal, 
 os.nomeUsuarioResponsavel, os.dataHoraAssinatura, case satisfacao	
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
//     $query = "SELECT TOP 1000 o.id, cli.nomeFantasia, o.dataHora , cli.endereco, cli.enderecoBairro, cli.enderecoCidade, o.idUsuarioSolicitante, us.nome, cli.telefone, cli.ramal, M.nome, IM.rm
//  FROM  os as o
//
//  inner join  cliente as cli on o.idCliente = cli.id
//  
//  inner join  usuario as us on o.idUsuarioSolicitante = us.id
//   
//  inner join  itemMaterial as IM on o.idItemMaterial = IM.id
//  
//  inner join  material as M on M.id = IM.id 
//  where o.id = {$id}";
  $resultado = sqlsrv_query($conn, $query) or die(print_r(sqlsrv_errors()));
    return sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC);
 }
 

