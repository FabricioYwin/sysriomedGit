use medx
select 
os.id as idOS,
         os.dataHora,
		 cliente.nomeFantasia,		 
	 setor.nome as NomeSetor,
	 os.motivoOs,
	 (select sum(itemMaterial.valorTotal) from os

inner join itemMaterial on 
itemMaterial.id = os.idItemMaterial where os.id = os.id) as TotalMaterial,
	 tipoOs.nome as NomeTipoOS,
	 itemMaterial.nSerie,
	 itemMaterial.rm,
	 os.status	

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

where cliente.id = (select usuario.idCliente from usuario where usuario.login = 'julio') 
/* and os.dataHora between CONVERT(datetime, '01-08-2016', 105) and CONVERT(datetime, '30-10-2016', 105) */




order by TotalMaterial desc

